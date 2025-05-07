<?php

namespace App\Http\Controllers\Admin\Meta;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MetaController extends Controller
{
    public function index()
    {
        $metas = Meta::all();
        return view('Admin.Meta.index', compact('metas'));
    }

    public function create()
    {
        return view('Admin.Meta.create');
    }

    public function show($slug)
    {
        $meta = Meta::where('slug', $slug)->firstOrFail();
        return view('Admin.Meta.show', compact('meta'));
    }

    public function edit($id)
    {
        $meta = Meta::findOrFail($id);
        return view('Admin.Meta.edit', compact('meta'));
    }

    public function destroy($id)
    {
        $meta = Meta::findOrFail($id);
        
        // Delete the associated image if it exists
        if ($meta->image && File::exists(public_path('assets/img/konten/' . $meta->image))) {
            File::delete(public_path('assets/img/konten/' . $meta->image));
        }
        
        $meta->delete();
    
        return redirect()->route('admin.meta.index')->with('success', 'Meta deleted successfully.');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);
    
        $slug = Str::slug($request->title, '-');
    
        // Check if the slug already exists and append a number to make it unique
        $originalSlug = $slug;
        $count = 1;
        while (Meta::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(5) . '_' . $image->getClientOriginalName();
            
            // Create directory if it doesn't exist
            $targetDir = public_path('assets/img/konten');
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            
            // Move the uploaded file to the target directory
            $image->move($targetDir, $imageName);
        }
    
        Meta::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imageName,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return redirect()->route('admin.meta.index')->with('success', 'Meta created successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);
    
        $meta = Meta::findOrFail($id);
    
        // Check if the title is being updated and generate a new slug if needed
        if ($meta->title !== $request->title) {
            $slug = Str::slug($request->title, '-');
    
            // Check if the new slug already exists and append a number to make it unique
            $originalSlug = $slug;
            $count = 1;
            while (Meta::where('slug', $slug)->exists() && $meta->slug !== $slug) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        } else {
            // Keep the old slug if the title hasn't changed
            $slug = $meta->slug;
        }

        // Handle image upload
        $imageName = $meta->image; // Keep old image by default
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($meta->image && File::exists(public_path('assets/img/konten/' . $meta->image))) {
                File::delete(public_path('assets/img/konten/' . $meta->image));
            }
            
            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(5) . '_' . $image->getClientOriginalName();
            
            // Create directory if it doesn't exist
            $targetDir = public_path('assets/img/konten');
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            
            // Move the uploaded file to the target directory
            $image->move($targetDir, $imageName);
        }
    
        // Update the meta with the new data
        $meta->update([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imageName,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return redirect()->route('admin.meta.index')->with('success', 'Meta updated successfully.');
    }
    
    public function uploadImage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('file')) {
            // Get the file from the request
            $image = $request->file('file');
            
            // Create a unique filename
            $filename = time() . '_' . Str::random(5) . '_' . $image->getClientOriginalName();
            
            // Specify the target directory path (using absolute path from your configuration)
            $targetDir = public_path('assets/img/konten');
            
            // Create directory if it doesn't exist
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            
            // Move the uploaded file to the target directory
            $image->move($targetDir, $filename);
            
            // Return the image URL needed by editor (if using one like Froala, CKEditor, etc.)
            return response()->json([
                'link' => asset('assets/img/konten/' . $filename)
            ]);
        }
        
        return response()->json([
            'error' => 'No file uploaded'
        ], 400);
    }
}