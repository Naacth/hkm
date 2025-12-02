<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::all();
        return view('admin.galeris.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'required|image',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_jsonld' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('galeris', 'public_direct');
        }
        Galeri::create($validated);
        return redirect()->route('galeris.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeris.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_jsonld' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('galeris', 'public_direct');
        }
        $galeri->update($validated);
        return redirect()->route('galeris.index')->with('success', 'Galeri berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('galeris.index')->with('success', 'Galeri berhasil dihapus!');
    }

    /**
     * Display the public galeri page with dynamic data.
     */
    public function publicPage()
    {
        $galeris = Galeri::orderBy('created_at', 'desc')->get();
        return view('galeri', compact('galeris'));
    }
}
