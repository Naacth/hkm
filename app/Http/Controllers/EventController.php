<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Services\CertificateGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Base validation rules
        $rules = [
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'event_type' => 'required|in:free,paid,public',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_jsonld' => 'nullable|string',
        ];

        // Conditional validation based on event type
        if ($request->event_type === 'paid') {
            $rules['price'] = 'required|numeric|min:0';
            $rules['qris_image_path'] = 'nullable|image';
            $rules['certificate_template'] = 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240';
            $rules['whatsapp_group_link'] = 'nullable|url';
            $rules['google_form_link'] = 'nullable|url';
        } elseif ($request->event_type === 'public') {
            $rules['google_form_link'] = 'required|url';
        } else {
            // Free event
            $rules['certificate_template'] = 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240';
            $rules['google_form_link'] = 'nullable|url';
        }

        // Certificate settings validation
        $rules['cert_x'] = 'nullable|integer|min:0';
        $rules['cert_y'] = 'nullable|integer|min:0';
        $rules['cert_font_size'] = 'nullable|integer|min:1';
        $rules['cert_color'] = 'nullable|string|max:7';

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'event-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
            $validated['image'] = 'events/' . $imageName;
        }

        if ($request->hasFile('qris_image_path')) {
            $qrisImage = $request->file('qris_image_path');
            $qrisImageName = 'qris-' . time() . '.' . $qrisImage->getClientOriginalExtension();
            $qrisImage->move(public_path('uploads/qris'), $qrisImageName);
            $validated['qris_image_path'] = 'qris/' . $qrisImageName;
        }

        if ($request->hasFile('certificate_template')) {
            $certificate = $request->file('certificate_template');
            $certName = 'cert-' . time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('uploads/certificates'), $certName);
            $validated['certificate_template'] = 'certificates/' . $certName;
        }

        // Set is_paid based on event_type for backward compatibility
        $validated['is_paid'] = $request->event_type === 'paid';

        Event::create($validated);
        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Base validation rules
        $rules = [
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'event_type' => 'required|in:free,paid,public',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_jsonld' => 'nullable|string',
        ];

        // Conditional validation based on event type
        if ($request->event_type === 'paid') {
            $rules['price'] = 'required|numeric|min:0';
            $rules['qris_image_path'] = 'nullable|image';
            $rules['certificate_template'] = 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240';
            $rules['whatsapp_group_link'] = 'nullable|url';
            $rules['google_form_link'] = 'nullable|url';
        } elseif ($request->event_type === 'public') {
            $rules['google_form_link'] = 'required|url';
        } else {
            // Free event
            $rules['certificate_template'] = 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240';
            $rules['google_form_link'] = 'nullable|url';
        }

        // Certificate settings validation
        $rules['cert_x'] = 'nullable|integer|min:0';
        $rules['cert_y'] = 'nullable|integer|min:0';
        $rules['cert_font_size'] = 'nullable|integer|min:1';
        $rules['cert_color'] = 'nullable|string|max:7';

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image && file_exists(public_path('uploads/' . $event->image))) {
                unlink(public_path('uploads/' . $event->image));
            }
            $image = $request->file('image');
            $imageName = 'event-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
            $validated['image'] = 'events/' . $imageName;
        }

        if ($request->hasFile('qris_image_path')) {
            // Delete old QRIS image if exists
            if ($event->qris_image_path && file_exists(public_path('uploads/' . $event->qris_image_path))) {
                unlink(public_path('uploads/' . $event->qris_image_path));
            }
            $qrisImage = $request->file('qris_image_path');
            $qrisImageName = 'qris-' . time() . '.' . $qrisImage->getClientOriginalExtension();
            $qrisImage->move(public_path('uploads/qris'), $qrisImageName);
            $validated['qris_image_path'] = 'qris/' . $qrisImageName;
        }

        if ($request->hasFile('certificate_template')) {
            // Delete old certificate template if exists
            if ($event->certificate_template && file_exists(public_path('uploads/' . $event->certificate_template))) {
                unlink(public_path('uploads/' . $event->certificate_template));
            }
            $certificate = $request->file('certificate_template');
            $certName = 'cert-' . time() . '.' . $certificate->getClientOriginalExtension();
            $certificate->move(public_path('uploads/certificates'), $certName);
            $validated['certificate_template'] = 'certificates/' . $certName;
        }

        // Set is_paid based on event_type for backward compatibility
        $validated['is_paid'] = $request->event_type === 'paid';

        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Display the public event page with dynamic data.
     */
    public function publicPage()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('event', compact('events'));
    }

    /**
     * Download certificate for event registration
     */
    public function downloadCertificate($registrationId)
    {
        $registration = \App\Models\EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only download their own certificate
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk mendownload sertifikat ini.');
        }

        if (!$registration->canDownloadCertificate()) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia atau Anda belum hadir di event.');
        }

        // Check if manual certificate exists
        if ($registration->certificate_path) {
            $filePath = public_path('uploads/' . $registration->certificate_path);
            
            if (file_exists($filePath)) {
                $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta';
                $extension = pathinfo($registration->certificate_path, PATHINFO_EXTENSION);
                $filename = 'Sertifikat_' . $participantName . '_' . $registration->event->title . '.' . $extension;
                $filename = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $filename); // Sanitize filename

                return response()->download($filePath, $filename);
            }
        }

        try {
            // Generate personalized certificate
            $certificateGenerator = new CertificateGeneratorService();
            
            // Try advanced generation first, fallback to basic if needed
            try {
                $certificatePath = $certificateGenerator->generateCertificate($registration);
            } catch (\Exception $e) {
                \Log::warning('Advanced certificate generation failed, trying basic method: ' . $e->getMessage());
                $certificatePath = $certificateGenerator->generateCertificateBasic($registration);
            }
            
            // Mark as downloaded
            $registration->markCertificateAsDownloaded();

            // Generate download filename with participant name
            $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta';
            $filename = 'Sertifikat_' . $participantName . '_' . $registration->event->title . '.png';
            $filename = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $filename); // Sanitize filename

            $fullPath = public_path('uploads/' . $certificatePath);
            
            return response()->download($fullPath, $filename);

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Certificate generation failed: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Fallback to template if generation fails
            if ($registration->event->certificate_template) {
                $templatePath = public_path('uploads/' . $registration->event->certificate_template);
                if (file_exists($templatePath)) {
                    $registration->markCertificateAsDownloaded();
                    return response()->download($templatePath);
                }
            }

            return redirect()->back()->with('error', 'Gagal menghasilkan sertifikat: ' . $e->getMessage());
        }
    }

    /**
     * Show user's certificates page
     */
    public function certificates()
    {
        $user = auth()->user();
        $registrations = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->where('status', 'attended')
            ->whereHas('event', function($query) {
                $query->whereNotNull('certificate_template');
            })
            ->latest()
            ->get();

        return view('certificates.index', compact('registrations'));
    }

    /**
     * Join WhatsApp group for event (only for paid participants)
     */
    public function joinWhatsAppGroup($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only access their own registration
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk bergabung ke grup ini.');
        }

        // Check if user can access WhatsApp group
        if (!$registration->canAccessWhatsAppGroup()) {
            return redirect()->back()->with('error', 'Anda harus menyelesaikan pembayaran terlebih dahulu untuk bergabung ke grup WhatsApp.');
        }

        // Check if event has WhatsApp group link
        if (!$registration->event->whatsapp_group_link) {
            return redirect()->back()->with('error', 'Grup WhatsApp untuk event ini belum tersedia.');
        }

        // Redirect to WhatsApp group
        return redirect($registration->event->whatsapp_group_link);
    }

    /**
     * Test certificate generation for debugging
     */
    public function testCertificate($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only access their own registration
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk test sertifikat ini.');
        }

        try {
            $certificateGenerator = new CertificateGeneratorService();
            
            // Try advanced test first, fallback to basic if needed
            try {
                $certificatePath = $certificateGenerator->testFontGeneration($registration);
            } catch (\Exception $e) {
                \Log::warning('Advanced test certificate generation failed, trying basic method: ' . $e->getMessage());
                $certificatePath = $certificateGenerator->generateCertificateBasic($registration);
            }
            
            $fullPath = public_path('uploads/' . $certificatePath);
            
            return response()->download(
                $fullPath,
                'test_certificate_' . $registration->id . '.png'
            );

        } catch (\Exception $e) {
            \Log::error('Test certificate generation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal generate test sertifikat: ' . $e->getMessage());
        }
    }

    /**
     * Download original certificate template (PDF)
     */
    public function downloadTemplate($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only download their own certificate
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk mendownload template ini.');
        }

        if (!$registration->canDownloadCertificate()) {
            return redirect()->back()->with('error', 'Template belum tersedia atau Anda belum hadir di event.');
        }

        if (!$registration->event->certificate_template) {
            return redirect()->back()->with('error', 'Template sertifikat tidak tersedia.');
        }

        // Mark as downloaded
        $registration->markCertificateAsDownloaded();

        // Generate download filename
        $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta';
        $filename = 'Template_Sertifikat_' . $participantName . '_' . $registration->event->title . '.pdf';
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename); // Sanitize filename

        $templatePath = public_path('uploads/' . $registration->event->certificate_template);
        
        return response()->download(
            $templatePath,
            $filename
        );
    }

    /**
     * Preview custom certificate without downloading
     */
    public function previewCustomCertificate($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only access their own registration
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk preview sertifikat ini.');
        }

        if (!$registration->canDownloadCertificate()) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia atau Anda belum hadir di event.');
        }

        try {
            $certificateGenerator = new CertificateGeneratorService();
            
            // Get custom parameters from request
            $customX = request('x'); // X position
            $customY = request('y'); // Y position
            $fontSize = request('font_size'); // Font size
            $color = request('color', '#003399'); // Color (default blue)
            
            $certificatePath = $certificateGenerator->generateCertificateNameOnly(
                $registration, 
                $customX, 
                $customY, 
                $fontSize, 
                $color
            );
            
            // Return image response instead of download
            $fullPath = public_path('uploads/' . $certificatePath);
            return response()->file($fullPath);

        } catch (\Exception $e) {
            \Log::error('Custom certificate preview failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal preview sertifikat: ' . $e->getMessage());
        }
    }

    /**
     * Generate certificate with automatic optimal positioning
     */
    public function generateAutoPositioned($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Check if user owns this registration
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Unauthorized access to certificate');
        }

        // Check if user has attended the event
        if ($registration->status !== 'attended') {
            return redirect()->back()->with('error', 'Sertifikat hanya tersedia untuk peserta yang telah hadir.');
        }

        try {
            $certificateGenerator = new CertificateGeneratorService();
            $certificatePath = $certificateGenerator->generateCertificateWithAutoPositioning($registration);
            
            if (!$certificatePath) {
                return redirect()->back()->with('error', 'Gagal membuat sertifikat dengan posisi otomatis.');
            }

            $fullPath = public_path('uploads/' . $certificatePath);
            
            if (!file_exists($fullPath)) {
                return redirect()->back()->with('error', 'File sertifikat tidak ditemukan.');
            }

            return response()->download($fullPath, 'sertifikat_auto_' . $registration->event->title . '_' . $registration->participant_name . '.png');

        } catch (\Exception $e) {
            \Log::error('Auto-positioned certificate generation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat sertifikat: ' . $e->getMessage());
        }
    }

    /**
     * Generate certificate with only participant name (custom positioning)
     */
    public function generateNameOnly($registrationId)
    {
        $registration = EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        
        // Ensure user can only access their own registration
        if (auth()->id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk generate sertifikat ini.');
        }

        if (!$registration->canDownloadCertificate()) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia atau Anda belum hadir di event.');
        }

        try {
            $certificateGenerator = new CertificateGeneratorService();
            
            // Get custom parameters from request
            $customX = request('x'); // X position
            $customY = request('y'); // Y position
            $fontSize = request('font_size'); // Font size
            $color = request('color', '#003399'); // Color (default blue)
            
            $certificatePath = $certificateGenerator->generateCertificateNameOnly(
                $registration, 
                $customX, 
                $customY, 
                $fontSize, 
                $color
            );
            
            // Mark as downloaded
            $registration->markCertificateAsDownloaded();

            // Generate download filename
            $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta';
            $filename = 'Sertifikat_Nama_' . $participantName . '_' . $registration->event->title . '.png';
            $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename); // Sanitize filename

            $fullPath = public_path('uploads/' . $certificatePath);
            
            return response()->download(
                $fullPath,
                $filename
            );

        } catch (\Exception $e) {
            \Log::error('Name-only certificate generation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal generate sertifikat: ' . $e->getMessage());
        }
    }
    /**
     * Generate all certificates for an event in batch
     */
    public function batchGenerateCertificates(Request $request, Event $event, CertificateGeneratorService $generator)
    {
        try {
            // Get settings from request or use event defaults
            $customX = $request->input('cert_x') ?? $event->cert_x;
            $customY = $request->input('cert_y') ?? $event->cert_y;
            $fontSize = $request->input('cert_font_size') ?? $event->cert_font_size;
            $color = $request->input('cert_color') ?? $event->cert_color ?? '#003399';

            $result = $generator->generateBatchCertificates(
                $event->id,
                $customX,
                $customY,
                $fontSize,
                $color
            );

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil generate ' . $result['generated'] . ' sertifikat.',
                    'zip_url' => asset('storage/' . $result['zip_path']),
                    'details' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal generate sertifikat.',
                    'details' => $result
                ], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Batch generation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download the batch generated certificates ZIP file
     */
    public function downloadBatchCertificates($filename)
    {
        $path = public_path('uploads/certificates/batch/' . $filename);
        
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($path);
    }
}
