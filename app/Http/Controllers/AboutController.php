<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all();
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'values' => 'nullable|array',
            'history' => 'nullable',
            'milestones' => 'nullable|array',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('abouts', 'public_direct');
        }
        $validated['values'] = $request->input('values', []);
        $validated['milestones'] = $request->input('milestones', []);
        About::create($validated);
        return redirect()->route('abouts.index')->with('success', 'About berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'values' => 'nullable|array',
            'history' => 'nullable',
            'milestones' => 'nullable|array',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('abouts', 'public_direct');
        }
        $validated['values'] = $request->input('values', []);
        $validated['milestones'] = $request->input('milestones', []);
        $about->update($validated);
        return redirect()->route('abouts.index')->with('success', 'About berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->route('abouts.index')->with('success', 'About berhasil dihapus!');
    }

    /**
     * Display the public about page with dynamic data.
     */
    public function publicPage()
    {
        // Ambil data about terbaru (atau bisa disesuaikan kebutuhan)
        $about = About::latest()->first();
        return view('about', compact('about'));
    }
}
