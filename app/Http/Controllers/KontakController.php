<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontaks = Kontak::all();
        return view('admin.kontaks.index', compact('kontaks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kontaks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'instagram' => 'nullable',
            'facebook' => 'nullable',
            'linkedin' => 'nullable',
            'youtube' => 'nullable',
            'tiktok' => 'nullable',
        ]);
        Kontak::create($validated);
        return redirect()->route('kontaks.index')->with('success', 'Kontak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kontak $kontak)
    {
        return view('admin.kontaks.edit', compact('kontak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kontak $kontak)
    {
        $validated = $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'instagram' => 'nullable',
            'facebook' => 'nullable',
            'linkedin' => 'nullable',
            'youtube' => 'nullable',
            'tiktok' => 'nullable',
        ]);
        $kontak->update($validated);
        return redirect()->route('kontaks.index')->with('success', 'Kontak berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('kontaks.index')->with('success', 'Kontak berhasil dihapus!');
    }

    /**
     * Display the public kontak page with dynamic data.
     */
    public function publicPage()
    {
        $kontak = Kontak::latest()->first();
        return view('kontak', compact('kontak'));
    }

    /**
     * Get contact data for footer
     */
    public static function getFooterContact()
    {
        return Kontak::latest()->first();
    }
}
