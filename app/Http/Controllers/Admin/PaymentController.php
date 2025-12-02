<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display pending payments
     */
    public function index()
    {
        $pendingEventRegistrations = EventRegistration::with(['event', 'user'])
            ->where('payment_status', 'pending')
            ->where('payment_method', 'qris')
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingOrders = Order::with(['produk', 'user'])
            ->where('status', 'pending')
            ->where('payment_method', 'qris')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.payments.index', compact('pendingEventRegistrations', 'pendingOrders'));
    }

    /**
     * Approve event payment
     */
    public function approveEventPayment(Request $request, $registrationId)
    {
        try {
            $registration = EventRegistration::findOrFail($registrationId);
            
            if ($registration->payment_status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses sebelumnya'
                ], 400);
            }

            $registration->update([
                'payment_status' => 'paid'
            ]);

            Log::info('Event payment approved', [
                'registration_id' => $registrationId,
                'event_id' => $registration->event_id,
                'user_id' => $registration->user_id,
                'approved_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran event berhasil disetujui'
            ]);

        } catch (\Exception $e) {
            Log::error('Error approving event payment', [
                'registration_id' => $registrationId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyetujui pembayaran'
            ], 500);
        }
    }

    /**
     * Approve product payment
     */
    public function approveProductPayment(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            
            if ($order->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses sebelumnya'
                ], 400);
            }

            $order->update([
                'status' => 'confirmed'
            ]);

            Log::info('Product payment approved', [
                'order_id' => $orderId,
                'product_id' => $order->produk_id,
                'user_id' => $order->user_id,
                'approved_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran produk berhasil disetujui'
            ]);

        } catch (\Exception $e) {
            Log::error('Error approving product payment', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyetujui pembayaran'
            ], 500);
        }
    }

    /**
     * Reject payment
     */
    public function rejectPayment(Request $request, $type, $id)
    {
        try {
            if ($type === 'event') {
                $registration = EventRegistration::findOrFail($id);
                $registration->update(['payment_status' => 'failed']);
                
                Log::info('Event payment rejected', [
                    'registration_id' => $id,
                    'rejected_by' => auth()->id()
                ]);
            } elseif ($type === 'product') {
                $order = Order::findOrFail($id);
                $order->update(['status' => 'cancelled']);
                
                Log::info('Product payment rejected', [
                    'order_id' => $id,
                    'rejected_by' => auth()->id()
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil ditolak'
            ]);

        } catch (\Exception $e) {
            Log::error('Error rejecting payment', [
                'type' => $type,
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menolak pembayaran'
            ], 500);
        }
    }
}
