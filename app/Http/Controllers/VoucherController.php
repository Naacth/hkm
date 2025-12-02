<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Produk;
use App\Models\Event;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function storeForProduk(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:vouchers,code',
            'discount_percent' => 'required|in:10,20,30,50,80,100',
        ]);

        Voucher::create([
            'code' => strtoupper($validated['code']),
            'discount_percent' => $validated['discount_percent'],
            'applicable_type' => 'produk',
            'applicable_id' => $produk->id,
            'is_active' => true,
        ]);

        return back()->with('success', 'Voucher berhasil ditambahkan.');
    }

    public function storeForEvent(Request $request, Event $event)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:vouchers,code',
            'discount_percent' => 'required|in:10,20,30,50,80,100',
        ]);

        Voucher::create([
            'code' => strtoupper($validated['code']),
            'discount_percent' => $validated['discount_percent'],
            'applicable_type' => 'event',
            'applicable_id' => $event->id,
            'is_active' => true,
        ]);

        return back()->with('success', 'Voucher berhasil ditambahkan.');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return back()->with('success', 'Voucher dihapus.');
    }
}


