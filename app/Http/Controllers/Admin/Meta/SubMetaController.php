<?php

namespace App\Http\Controllers\Admin\Meta;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\SubMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubMetaController extends Controller
{
    /**
     * Display a listing of the sub metas for a meta.
     */
    public function index($metaId)
    {
        $meta = Meta::findOrFail($metaId);
        $subMetas = DB::table('sub_meta')->where('meta_id', $metaId)->get();
        
        return view('Admin.Meta.SubMeta.index', compact('meta', 'subMetas'));
    }

    /**
     * Show the form for creating a new sub meta.
     */
    public function create($metaId)
    {
        $meta = Meta::findOrFail($metaId);
        
        return view('Admin.Meta.SubMeta.create', compact('meta'));
    }

    /**
     * Store a newly created sub meta in storage.
     */
    public function store(Request $request, $metaId)
    {
        $meta = Meta::findOrFail($metaId);
        
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(5) . '_' . $image->getClientOriginalName();
                
                // Create directory if it doesn't exist
                $targetDir = ('assets/img/konten/submeta');
                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }
                
                // Move the uploaded file to the target directory
                $image->move($targetDir, $imageName);
                
                // Store the full path
                $imagePath = 'assets/img/konten/submeta/' . $imageName;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error uploading image: ' . $e->getMessage());
            }
        }

        // Insert directly using DB facade
        DB::table('sub_meta')->insert([
            'meta_id' => $meta->id,
            'title' => $request->title,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.meta.submeta.index', $meta->id)
            ->with('success', 'Sub Meta created successfully.');
    }

    /**
     * Show the form for editing the specified sub meta.
     */
    public function edit($metaId, $subMetaId)
    {
        $meta = Meta::findOrFail($metaId);
        $subMeta = DB::table('sub_meta')->where('id', $subMetaId)->first();
        
        if (!$subMeta) {
            return redirect()->route('admin.meta.submeta.index', $meta->id)
                ->with('error', 'Sub Meta not found.');
        }
        
        return view('Admin.Meta.SubMeta.edit', compact('meta', 'subMeta'));
    }

    /**
     * Update the specified sub meta in storage.
     */
    public function update(Request $request, $metaId, $subMetaId)
    {
        $meta = Meta::findOrFail($metaId);
        $subMeta = DB::table('sub_meta')->where('id', $subMetaId)->first();
        
        if (!$subMeta) {
            return redirect()->route('admin.meta.submeta.index', $meta->id)
                ->with('error', 'Sub Meta not found.');
        }
        
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        // Handle image upload
        $imagePath = $subMeta->image; // Keep old image path by default
        if ($request->hasFile('image')) {
            try {
                // Delete old image if it exists
                if ($subMeta->image && File::exists($subMeta->image)) {
                    File::delete($subMeta->image);
                }
                
                // Upload new image
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(5) . '_' . $image->getClientOriginalName();
                
                // Create directory if it doesn't exist
                $targetDir = ('assets/img/konten/submeta');
                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }
                
                // Move the uploaded file to the target directory
                $image->move($targetDir, $imageName);
                
                // Store the full path
                $imagePath = 'assets/img/konten/submeta/' . $imageName;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error uploading image: ' . $e->getMessage());
            }
        }

        // Update directly using DB facade
        DB::table('sub_meta')
            ->where('id', $subMetaId)
            ->update([
                'title' => $request->title,
                'image' => $imagePath,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.meta.submeta.index', $meta->id)
            ->with('success', 'Sub Meta updated successfully.');
    }

    /**
     * Remove the specified sub meta from storage.
     */
    public function destroy($metaId, $subMetaId)
    {
        $subMeta = DB::table('sub_meta')->where('id', $subMetaId)->first();
        
        if ($subMeta) {
            // Delete the associated image if it exists
            if ($subMeta->image && File::exists($subMeta->image)) {
                File::delete($subMeta->image);
            }
            
            // Delete the record
            DB::table('sub_meta')->where('id', $subMetaId)->delete();
        }
    
        return redirect()->route('admin.meta.submeta.index', $metaId)
            ->with('success', 'Sub Meta deleted successfully.');
    }
}