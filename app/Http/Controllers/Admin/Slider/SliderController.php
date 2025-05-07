<?php
namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Meta;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    // Display all sliders
    public function index()
    {
        $sliders = Slider::all();
        return view('Admin.Slider.index', compact('sliders'));
    }

    // Show form to create a new slider
    public function create()
    {
        $activities = Activity::all(); // Retrieve all activities
        $routes = [
            'home' => route('home'),
            'about' => route('about'),
        ];

        $metas = Meta::where('start_date', '<=', today())
                     ->where('end_date', '>=', today())
                     ->get();

        return view('Admin.Slider.create', compact('activities', 'routes', 'metas'));
    }

    // Store new slider - DENGAN VERSI RAW INSERT
    public function store(Request $request)
    {
        try {
            \Log::debug('Request data for slider creation: ', $request->all());
            
            $request->validate([
                'image_url' => 'required|image',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            // Save image to public/assets/img/slider
            $image = $request->file('image_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/img/slider'), $imageName);
            $imagePath = 'assets/img/slider/' . $imageName;

            // Tentukan kondisi checkbox
            $show_specification = $request->has('show_specification') ? 1 : 0;
            $show_button = $request->has('show_button') ? 1 : 0;
            
            $data = [
                'image_url' => $imagePath,
                'title' => $request->title,
                'title_color' => $request->title_color ?? '#000000',
                'description' => $request->description,
                'description_color' => $request->description_color ?? '#000000',
                'show_specification' => $show_specification,
                'show_button' => $show_button,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            if ($show_specification) {
                $data['specification_text'] = $request->specification_text;
                $data['specification_color'] = $request->specification_color ?? '#000000';
                $data['line_color'] = $request->line_color ?? '#dddddd';
            } else {
                $data['specification_text'] = null;
                $data['specification_color'] = null;
                $data['line_color'] = null;
            }
            
            if ($show_button) {
                if (empty($request->button_text) || empty($request->button_url)) {
                    return redirect()->back()->with('error', 'Jika tampilkan button dicentang, text dan URL button harus diisi.')->withInput();
                }
                
                $data['button_text'] = $request->button_text;
                $data['button_url'] = $request->button_url;
                $data['button_text_color'] = $request->button_text_color ?? '#FFFFFF';
            } else {
                $data['button_text'] = null;
                $data['button_url'] = null;
                $data['button_text_color'] = null;
            }
            
            \Log::debug('Slider to be saved: ', $data);
            
            DB::table('sliders')->insert($data);
            
            return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil dibuat!');
        } catch (\Exception $e) {
            \Log::error('Error creating slider: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    // Show form to edit an existing slider
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $activities = Activity::all();
        $routes = [
            'home' => route('home'),
            'about' => route('about'),
            'product' => route('product.index'),
            'portal' => route('portal'),
        ];

        $metas = Meta::where('start_date', '<=', today())
                     ->where('end_date', '>=', today())
                     ->get();

        return view('Admin.Slider.edit', compact('slider', 'routes', 'activities', 'metas'));
    }

    // Update slider - DENGAN VERSI RAW UPDATE
    public function update(Request $request, $id)
    {
        try {
            \Log::debug('Request data for slider update: ', $request->all());
            
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $slider = Slider::findOrFail($id);
            
            $data = [
                'title' => $request->title,
                'title_color' => $request->title_color ?? '#000000',
                'description' => $request->description,
                'description_color' => $request->description_color ?? '#000000',
                'updated_at' => now(),
            ];
            
            if ($request->hasFile('image_url')) {
                if (File::exists(public_path($slider->image_url))) {
                    File::delete(public_path($slider->image_url));
                }

                $image = $request->file('image_url');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/img/slider'), $imageName);
                $data['image_url'] = 'assets/img/slider/' . $imageName;
            }
            
            $show_specification = $request->has('show_specification') ? 1 : 0;
            $show_button = $request->has('show_button') ? 1 : 0;
            
            $data['show_specification'] = $show_specification;
            $data['show_button'] = $show_button;
            
            if ($show_specification) {
                $data['specification_text'] = $request->specification_text;
                $data['specification_color'] = $request->specification_color ?? '#000000';
                $data['line_color'] = $request->line_color ?? '#dddddd';
            } else {
                $data['specification_text'] = null;
                $data['specification_color'] = null;
                $data['line_color'] = null;
            }
            
            if ($show_button) {
                if (empty($request->button_text) || empty($request->button_url)) {
                    return redirect()->back()->with('error', 'Jika tampilkan button dicentang, text dan URL button harus diisi.')->withInput();
                }
                
                $data['button_text'] = $request->button_text;
                $data['button_url'] = $request->button_url;
                $data['button_text_color'] = $request->button_text_color ?? '#FFFFFF';
            } else {
                $data['button_text'] = null;
                $data['button_url'] = null;
                $data['button_text_color'] = null;
            }
            
            \Log::debug('Slider to be updated: ', $data);
            
            DB::table('sliders')->where('id', $id)->update($data);
            
            return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating slider: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    // Delete slider
    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            if (File::exists(public_path($slider->image_url))) {
                File::delete(public_path($slider->image_url));
            }

            $slider->delete();

            return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting slider: ' . $e->getMessage());
            
            return redirect()->route('admin.slider.index')->with('error', 'Error menghapus slider: ' . $e->getMessage());
        }
    }
}
?>