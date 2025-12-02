<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Voucher;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Show order form
     */
    public function showOrderForm($produk)
    {
        $produk = Produk::findOrFail($produk);
        return view('orders.create', compact('produk'));
    }

    /**
     * Create new order
     */
    public function store(Request $request, $produk)
    {
        $produk = Produk::findOrFail($produk);

        $rules = [
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:qris,offline',
            'delivery_method' => 'required|in:pickup,delivery',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_nim' => 'nullable|string|max:20',
            'customer_kelas' => 'nullable|string|max:50',
            'customer_email' => 'required|email',
            'customer_address' => 'nullable|string',
            'notes' => 'nullable|string',
            'voucher_code' => 'nullable|string|max:50',
        ];

        // Conditionally add validation rule for proof of payment
        if ($request->input('payment_method') === 'qris') {
            $rules['proof_of_payment_image_path'] = 'required|image|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $totalPrice = $produk->price * $request->quantity;

        $voucherCode = $request->input('voucher_code');
        $discountPercent = null;
        $discountAmount = 0;
        $finalPrice = $totalPrice;

        if ($voucherCode) {
            $voucher = Voucher::active()
                ->where('code', strtoupper($voucherCode))
                ->where('applicable_type', 'produk')
                ->where('applicable_id', $produk->id)
                ->first();

            if ($voucher) {
                $discountPercent = (int) $voucher->discount_percent;
                $discountAmount = round($totalPrice * ($discountPercent / 100), 2);
                $finalPrice = max(0, $totalPrice - $discountAmount);
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(), // Bisa null jika tidak login
            'produk_id' => $produk->id,
            'order_number' => Order::generateOrderNumber(),
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'voucher_code' => $voucherCode ? strtoupper($voucherCode) : null,
            'voucher_discount_percent' => $discountPercent,
            'discount_amount' => $discountAmount,
            'final_price' => $finalPrice,
            'payment_method' => $request->payment_method,
            'delivery_method' => $request->delivery_method,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_nim' => $request->customer_nim,
            'customer_kelas' => $request->customer_kelas,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        // Handle proof of payment upload if applicable
        if ($request->input('payment_method') === 'qris' && $request->hasFile('proof_of_payment_image_path')) {
            $imagePath = $request->file('proof_of_payment_image_path')->store('proof_of_payments', 'public_direct');
            $order->update(['proof_of_payment_image_path' => $imagePath]);
        }

        return redirect()->route('orders.success', $order->id)
            ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi dari admin.');
    }

    /**
     * Show order success page
     */
    public function success($orderId)
    {
        $order = Order::with(['produk', 'user'])->findOrFail($orderId);
        
        // Ensure user can only see their own order
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        return view('orders.success', compact('order'));
    }

    /**
     * Show user's order history
     */
    public function history()
    {
        $orders = Auth::user()->orders()->with('produk')->latest()->get();
        return view('orders.history', compact('orders'));
    }

    /**
     * Show order detail
     */
    public function show($orderId)
    {
        $order = Order::with(['produk', 'user'])->findOrFail($orderId);
        
        // Ensure user can only see their own order
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Cancel order
     */
    public function cancel($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Ensure user can only cancel their own order
        if (Auth::id() !== $order->user_id) {
            abort(403);
        }

        // Only allow cancellation if order is still pending
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.history')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * Admin: Show all orders
     */
    public function adminIndex()
    {
        $orders = Order::with(['user', 'produk'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Admin: Show order detail
     */
    public function adminShow($orderId)
    {
        $order = Order::with(['user', 'produk'])->findOrFail($orderId);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Admin: Update order status
     */
    public function adminUpdateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Admin: Export all orders to Excel
     */
    public function exportOrders()
    {
        $fileName = 'Pesanan-' . \Str::slug(now()->format('Y-m-d H:i:s')) . '.xlsx';
        return Excel::download(new OrdersExport(), $fileName);
    }
}
