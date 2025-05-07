<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Support\Facades\File;

class ActivityController extends Controller
{
    // Define the new image path as a property for easy reuse
    private $imagePath = 'assets/img/about';

    public function index()
    {
        $activities = Activity::all();
        return view('Admin.Activity.index', compact('activities'));
    }

    public function create()
    {
        return view('Admin.Activity.create');
    }

   // ActivityController.php

public function store(Request $request)
{
    // Validasi request
    $request->validate([
        'title' => 'required',
        'year' => 'required|numeric',
        'location' => 'required',
        'description' => 'required',
        'status' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'tanggal_mulai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
    ]);

    // Simpan data aktivitas
    $activity = new Activity();
    $activity->title = $request->title;
    $activity->year = $request->year;
    $activity->location = $request->location;
    $activity->description = $request->description;
    $activity->status = $request->status;
    
    // Simpan tanggal mulai dan selesai
    if ($request->has('tanggal_mulai')) {
        $activity->tanggal_mulai = $request->tanggal_mulai;
    }
    
    if ($request->has('tanggal_selesai')) {
        $activity->tanggal_selesai = $request->tanggal_selesai;
    }
    
    $activity->save();

    // Proses upload gambar
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/img/about'), $imageName);
            
            ActivityImage::create([
                'activity_id' => $activity->id,
                'image' => $imageName
            ]);
        }
    }

    return redirect()->route('admin.activity.index')->with('success', 'Aktivitas berhasil ditambahkan');
}

    public function show(Activity $activity)
    {
        return view('Admin.Activity.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('Admin.Activity.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:akan datang,sudah terlaksana',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai', // Validasi tanggal selesai harus setelah atau sama dengan tanggal mulai
        ]);
        
        $activity->update([
            'year' => $request->year,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);        

        if ($request->hasFile('images')) {
            // Ensure the directory exists
            $directory = public_path($this->imagePath);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $imageName);

                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $imageName,
                ]);
            }
        }

        return redirect()->route('admin.activity.index')->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        foreach ($activity->images as $image) {
            $filePath = public_path($this->imagePath . '/' . $image->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $image->delete();
        }

        $activity->delete();
        return redirect()->route('admin.activity.index')->with('success', 'Activity deleted successfully.');
    }

    // Tambahan untuk hapus 1 gambar saja
    public function destroyImage($id)
    {
        $image = ActivityImage::findOrFail($id);
        $filePath = public_path($this->imagePath . '/' . $image->image);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $image->delete();
        return response()->json(['success' => true]);
    }
}