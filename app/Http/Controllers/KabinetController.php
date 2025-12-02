<?php

namespace App\Http\Controllers;

use App\Models\Kabinet;
use Illuminate\Http\Request;

class KabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabinets = Kabinet::all();
        return view('admin.kabinets.index', compact('kabinets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kabinets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image',
            'description' => 'nullable',
        ]);
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('kabinets', 'public_direct');
        }
        Kabinet::create($validated);
        return redirect()->route('kabinets.index')->with('success', 'Kabinet berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabinet $kabinet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabinet $kabinet)
    {
        return view('admin.kabinets.edit', compact('kabinet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kabinet $kabinet)
    {
        $validated = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image',
            'description' => 'nullable',
        ]);
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('kabinets', 'public_direct');
        }
        $kabinet->update($validated);
        return redirect()->route('kabinets.index')->with('success', 'Kabinet berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabinet $kabinet)
    {
        $kabinet->delete();
        return redirect()->route('kabinets.index')->with('success', 'Kabinet berhasil dihapus!');
    }

    /**
     * Display the public kabinet page with dynamic data.
     */
    public function publicPage()
    {
        $kabinets = Kabinet::orderBy('position')->get();
        return view('kabinet', compact('kabinets'));
    }
}
