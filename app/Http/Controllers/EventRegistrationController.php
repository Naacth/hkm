<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Voucher;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventRegistrationsExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventRegistrationController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegistrationForm($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('event-registrations.create', compact('event'));
    }

    /**
     * Register for event
     */
    public function register(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $rules = [
            'participant_name' => 'required|string|max:255',
            'participant_email' => 'required|email',
            'participant_phone' => 'required|string|max:20',
            'participant_nim' => 'nullable|string|max:20',
            'participant_kelas' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:qris,offline',
            'voucher_code' => 'nullable|string|max:50',
        ];

        // Conditionally add validation rule for proof of payment
        if ($event->is_paid && $request->input('payment_method') === 'qris') {
            $rules['proof_of_payment_image_path'] = 'required|image|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if user already registered for this event
        $existingRegistration = EventRegistration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->first();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar untuk event ini.');
        }

        // Pricing + voucher (only if event is paid)
        $totalPrice = $event->is_paid ? ($event->price ?? 0) : 0;
        $voucherCode = $request->input('voucher_code');
        $discountPercent = null;
        $discountAmount = 0;
        $finalPrice = $totalPrice;

        if ($event->is_paid && $voucherCode) {
            $voucher = Voucher::active()
                ->where('code', strtoupper($voucherCode))
                ->where('applicable_type', 'event')
                ->where('applicable_id', $event->id)
                ->first();

            if ($voucher) {
                $discountPercent = (int) $voucher->discount_percent;
                $discountAmount = round($totalPrice * ($discountPercent / 100), 2);
                $finalPrice = max(0, $totalPrice - $discountAmount);
            }
        }

        $registration = EventRegistration::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'registration_number' => EventRegistration::generateRegistrationNumber(),
            'participant_name' => $request->participant_name,
            'participant_phone' => $request->participant_phone,
            'participant_nim' => $request->participant_nim,
            'participant_kelas' => $request->participant_kelas,
            'participant_email' => $request->participant_email,
            'notes' => $request->notes,
            'voucher_code' => $voucherCode ? strtoupper($voucherCode) : null,
            'voucher_discount_percent' => $discountPercent,
            'discount_amount' => $discountAmount,
            'final_price' => $finalPrice,
            'payment_method' => $request->payment_method,
            'payment_status' => $event->is_paid ? 'pending' : 'paid',
            'status' => 'registered',
        ]);

        // Handle proof of payment upload if applicable
        if ($event->is_paid && $request->input('payment_method') === 'qris' && $request->hasFile('proof_of_payment_image_path')) {
            $imagePath = $request->file('proof_of_payment_image_path')->store('proof_of_payments', 'public_direct');
            $registration->update(['proof_of_payment_image_path' => $imagePath]);
        }

        return redirect()->route('event-registrations.success', $registration->id)
            ->with('success', 'Pendaftaran event berhasil! Silakan tunggu konfirmasi dari admin.');
    }

    /**
     * Show registration success page
     */
    public function success($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only see their own registration
        if (Auth::id() !== $registration->user_id) {
            abort(403);
        }

        return view('event-registrations.success', compact('registration'));
    }

    /**
     * Show user's event registrations
     */
    public function history()
    {
        $registrations = Auth::user()->eventRegistrations()->with('event')->latest()->get();
        return view('event-registrations.history', compact('registrations'));
    }

    /**
     * Show registration detail
     */
    public function show($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only see their own registration
        if (Auth::id() !== $registration->user_id) {
            abort(403);
        }

        return view('event-registrations.show', compact('registration'));
    }

    /**
     * Cancel registration
     */
    public function cancel($registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);
        
        // Ensure user can only cancel their own registration
        if (Auth::id() !== $registration->user_id) {
            abort(403);
        }

        // Only allow cancellation if registration is still registered
        if ($registration->status !== 'registered') {
            return redirect()->back()->with('error', 'Pendaftaran tidak dapat dibatalkan karena sudah dikonfirmasi.');
        }

        $registration->update(['status' => 'cancelled']);

        return redirect()->route('event-registrations.history')->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    /**
     * Admin: Show all registrations
     */
    public function adminIndex(Request $request)
    {
        $event_id = $request->get('event_id');
        $event = null;
        $registrations = collect();
        
        if ($event_id) {
            $event = Event::find($event_id);
            $registrations = EventRegistration::with(['user', 'event'])
                ->where('event_id', $event_id)
                ->latest()
                ->get();
        } else {
            $registrations = EventRegistration::with(['user', 'event'])->latest()->get();
        }
        
        // Get all events for filter dropdown
        $events = Event::orderBy('title')->get();
        
        return view('admin.event-registrations.index', compact('registrations', 'event', 'events'));
    }

    /**
     * Admin: Show registration detail
     */
    public function adminShow($registrationId)
    {
        $registration = EventRegistration::with(['user', 'event'])->findOrFail($registrationId);
        return view('admin.event-registrations.show', compact('registration'));
    }

    /**
     * Admin: Update registration status
     */
    public function adminUpdateStatus(Request $request, $registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:registered,confirmed,paid,attended,cancelled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Update status and payment_status based on the new status
        $updateData = ['status' => $request->status];
        
        // If status is set to 'paid', also update payment_status to 'paid'
        if ($request->status === 'paid') {
            $updateData['payment_status'] = 'paid';
        }
        // If status is set to 'confirmed' and event is paid, keep payment_status as is
        // If status is set to 'attended', keep payment_status as is
        // If status is set to 'cancelled', optionally set payment_status to 'failed'
        elseif ($request->status === 'cancelled') {
            $updateData['payment_status'] = 'failed';
        }

        $registration->update($updateData);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    /**
     * Admin: Show participants for specific event
     */
    public function adminEventParticipants($eventId)
    {
        $event = Event::findOrFail($eventId);
        $registrations = EventRegistration::with(['user'])
            ->where('event_id', $eventId)
            ->latest()
            ->get();

        return view('admin.events.participants', compact('event', 'registrations'));
    }

    /**
     * Admin: Export participants for specific event to Excel
     */
    public function exportParticipants($eventId)
    {
        $event = Event::findOrFail($eventId);
        $fileName = 'Peserta-' . \Str::slug($event->title) . '.xlsx';

        return Excel::download(new EventRegistrationsExport($eventId), $fileName);
    }

    /**
     * Admin: Export all event registrations (or filtered by event) to Excel
     */
    public function exportAllRegistrations(Request $request)
    {
        $event_id = $request->get('event_id');
        $fileName = 'Semua-Pendaftaran-Event-' . now()->format('Y-m-d') . '.xlsx';

        if ($event_id) {
            $event = Event::findOrFail($event_id);
            $fileName = 'Pendaftaran-' . \Str::slug($event->title) . '.xlsx';
        }

        return Excel::download(new EventRegistrationsExport($event_id), $fileName);
    }

    /**
     * Admin: Upload certificate manually for a registration
     */
    public function uploadCertificate(Request $request, $registrationId)
    {
        $registration = EventRegistration::findOrFail($registrationId);

        $request->validate([
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('certificate_file')) {
            // Delete old certificate if exists
            if ($registration->certificate_path) {
                $oldPath = public_path('uploads/' . $registration->certificate_path);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Generate filename: certificate_manual_{id}_{timestamp}.{ext}
            $file = $request->file('certificate_file');
            $extension = $file->getClientOriginalExtension();
            $filename = 'certificate_manual_' . $registration->id . '_' . time() . '.' . $extension;
            
            // Create directory if not exists
            $uploadPath = public_path('uploads/certificates/manual');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Move file to public/uploads
            $file->move($uploadPath, $filename);
            
            // Store relative path
            $relativePath = 'certificates/manual/' . $filename;

            // Update registration
            $registration->update([
                'certificate_path' => $relativePath
            ]);

            return redirect()->back()->with('success', 'Sertifikat berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload sertifikat.');
    }
}
