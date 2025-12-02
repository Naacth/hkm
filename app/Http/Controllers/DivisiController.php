<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisis = Divisi::all();
        return view('admin.divisis.index', compact('divisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.divisis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image',
            'logo' => 'nullable|image',
            'group_photo' => 'nullable|image',
        ]);
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('divisis', 'public_direct');
        }
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('divisis', 'public_direct');
        }
        if ($request->hasFile('group_photo')) {
            $validated['group_photo'] = $request->file('group_photo')->store('divisis', 'public_direct');
        }
        Divisi::create($validated);
        return redirect()->route('divisis.index')->with('success', 'Divisi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisi $divisi)
    {
        return view('admin.divisis.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisi $divisi)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image',
            'logo' => 'nullable|image',
            'group_photo' => 'nullable|image',
        ]);
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('divisis', 'public_direct');
        }
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('divisis', 'public_direct');
        }
        if ($request->hasFile('group_photo')) {
            $validated['group_photo'] = $request->file('group_photo')->store('divisis', 'public_direct');
        }
        $divisi->update($validated);
        return redirect()->route('divisis.index')->with('success', 'Divisi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return redirect()->route('divisis.index')->with('success', 'Divisi berhasil dihapus!');
    }

    /**
     * Display the public divisi page with dynamic data.
     */
    public function publicPage()
    {
        $divisis = Divisi::orderBy('name')->get();
        return view('divisi', compact('divisis'));
    }

    /**
     * Halaman detail divisi publik
     */
    public function showDetail(Divisi $divisi)
    {
        $divisi->load('members');
        return view('divisi-detail', compact('divisi'));
    }
}
