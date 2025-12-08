<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path('uploads/testimonials');
        
        // Create upload directory if it doesn't exist
        if (!File::isDirectory($this->uploadPath)) {
            File::makeDirectory($this->uploadPath, 0755, true, true);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('photo');
        $data['is_active'] = $request->has('is_active');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'testimonial-' . time() . '.' . $photo->getClientOriginalExtension();
            
            // Resize and save the image
            $image = Image::make($photo);
            $image->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $image->save($this->uploadPath . '/' . $filename, 85);
            $data['photo'] = $filename;
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('photo');
        $data['is_active'] = $request->has('is_active');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimonial->photo && file_exists($this->uploadPath . '/' . $testimonial->photo)) {
                unlink($this->uploadPath . '/' . $testimonial->photo);
            }

            $photo = $request->file('photo');
            $filename = 'testimonial-' . time() . '.' . $photo->getClientOriginalExtension();
            
            // Resize and save the image
            $image = Image::make($photo);
            $image->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $image->save($this->uploadPath . '/' . $filename, 85);
            $data['photo'] = $filename;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete photo if exists
        if ($testimonial->photo && file_exists($this->uploadPath . '/' . $testimonial->photo)) {
            unlink($this->uploadPath . '/' . $testimonial->photo);
        }

        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial berhasil dihapus.'
        ]);
    }

    /**
     * Toggle active status of the specified resource.
     */
    public function toggleStatus(Testimonial $testimonial)
    {
        $testimonial->update([
            'is_active' => !$testimonial->is_active
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status testimonial berhasil diubah.',
            'is_active' => $testimonial->is_active
        ]);
    }
}
