<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('admin.produks.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'price' => 'nullable|numeric',
            'quality_guaranteed' => 'boolean',
            'periodic_support' => 'boolean',
            'support_24_7' => 'boolean',
            'features' => 'nullable|string',
            'qris_image_path' => 'nullable|image',
            'whatsapp_link' => 'nullable|url',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_jsonld' => 'nullable|string',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produks', 'public_direct');
        }

        if ($request->hasFile('qris_image_path')) {
            $validated['qris_image_path'] = $request->file('qris_image_path')->store('qris', 'public_direct');
        }
        
        Produk::create($validated);
        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('admin.produks.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'price' => 'nullable|string',
            'quality_guaranteed' => 'boolean',
            'periodic_support' => 'boolean',
            'support_24_7' => 'boolean',
            'features' => 'nullable|string',
            'qris_image_path' => 'nullable|image',
            'whatsapp_link' => 'nullable|url',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_jsonld' => 'nullable|string',
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($produk->image) {
                Storage::disk('public_direct')->delete($produk->image);
            }
            $validated['image'] = $request->file('image')->store('produks', 'public_direct');
        }

        if ($request->hasFile('qris_image_path')) {
            // Delete old QRIS image if exists
            if ($produk->qris_image_path) {
                Storage::disk('public_direct')->delete($produk->qris_image_path);
            }
            $validated['qris_image_path'] = $request->file('qris_image_path')->store('qris', 'public_direct');
        }
        
        $produk->update($validated);
        return redirect()->route('produks.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Display the public produk page with dynamic data.
     */
    public function publicPage()
    {
        $produks = Produk::orderBy('created_at', 'desc')->get();
        return view('produk', compact('produks'));
    }
}
