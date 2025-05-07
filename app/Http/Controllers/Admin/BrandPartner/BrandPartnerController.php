<?php

namespace App\Http\Controllers\Admin\BrandPartner;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandPartners = BrandPartner::all();
        return view('Admin.Brand.index', compact('brandPartners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'gambar' => 'required|image|max:2048',
                'type' => 'required|in:brand,principal,ecommerce,distributor',
                'url' => 'nullable|string',
                'nama' => 'nullable|string',
            ]);

            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');

                // Generate nama file unik menggunakan SHA256
                $hash = hash('sha256', time() . $image->getClientOriginalName());
                $imageName = $hash . '.' . $image->getClientOriginalExtension();

                // Tentukan direktori berdasarkan tipe
                $directoryMap = [
                    'brand' => 'assets/img/mereklogo/brand',
                    'principal' => 'assets/img/mereklogo/principal',
                    'ecommerce' => 'assets/img/mereklogo/ecommerce',
                    'distributor' => 'assets/img/mereklogo/distributor',
                ];

                $directory = public_path($directoryMap[$validated['type']]);

                // Pastikan folder ada, jika tidak maka buat folder
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Pindahkan file ke folder yang sesuai
                $image->move($directory, $imageName);
                
                // Simpan path relatif ke database
                $imagePath = $directoryMap[$validated['type']] . '/' . $imageName;
                
                // Log data sebelum penyimpanan
                Log::info('Akan menyimpan data brand partner dengan type: ' . $validated['type']);
                
                // Gunakan DB facade langsung untuk menghindari masalah dengan ORM
                DB::table('brand_partner')->insert([
                    'gambar' => $imagePath,
                    'type' => $validated['type'],
                    'url' => $validated['url'] ?? null,
                    'nama' => $validated['nama'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                return redirect()->route('admin.brand.index')->with('success', 'Brand Partner berhasil ditambahkan.');
            }
            
            return back()->with('error', 'Gambar harus disertakan.')->withInput();
            
        } catch (\Exception $e) {
            Log::error('Error saving brand partner: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('Admin.Brand.show', compact('brandPartner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('Admin.Brand.edit', compact('brandPartner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $brandPartner = BrandPartner::findOrFail($id);

            $validated = $request->validate([
                'gambar' => 'nullable|image|max:2048',
                'type' => 'required|in:brand,principal,ecommerce,distributor',
                'url' => 'nullable|string',
                'nama' => 'nullable|string',
            ]);

            // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($brandPartner->gambar && file_exists(public_path($brandPartner->gambar))) {
                    unlink(public_path($brandPartner->gambar));
                }

                $image = $request->file('gambar');
                $hash = hash('sha256', time() . $image->getClientOriginalName());
                $imageName = $hash . '.' . $image->getClientOriginalExtension();

                // Tentukan direktori berdasarkan tipe
                $directoryMap = [
                    'brand' => 'assets/img/mereklogo/brand',
                    'principal' => 'assets/img/mereklogo/principal',
                    'ecommerce' => 'assets/img/mereklogo/ecommerce',
                    'distributor' => 'assets/img/mereklogo/distributor',
                ];

                $directory = public_path($directoryMap[$validated['type']]);

                // Pastikan folder ada, jika tidak maka buat folder
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Pindahkan file ke folder yang sesuai
                $image->move($directory, $imageName);

                // Simpan path relatif ke database
                $imagePath = $directoryMap[$validated['type']] . '/' . $imageName;
                
                // Update data menggunakan query builder
                DB::table('brand_partner')
                    ->where('id', $id)
                    ->update([
                        'gambar' => $imagePath,
                        'type' => $validated['type'],
                        'url' => $validated['url'] ?? $brandPartner->url,
                        'nama' => $validated['nama'] ?? $brandPartner->nama,
                        'updated_at' => now(),
                    ]);
            } else {
                // Update tanpa mengubah gambar
                DB::table('brand_partner')
                    ->where('id', $id)
                    ->update([
                        'type' => $validated['type'],
                        'url' => $validated['url'] ?? $brandPartner->url,
                        'nama' => $validated['nama'] ?? $brandPartner->nama,
                        'updated_at' => now(),
                    ]);
            }

            return redirect()->route('admin.brand.index')->with('success', 'Brand Partner berhasil diperbarui.');
            
        } catch (\Exception $e) {
            Log::error('Error updating brand partner: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $brandPartner = BrandPartner::findOrFail($id);

            // Hapus gambar jika ada
            if ($brandPartner->gambar && file_exists(public_path($brandPartner->gambar))) {
                unlink(public_path($brandPartner->gambar));
            }

            $brandPartner->delete();

            return redirect()->route('admin.brand.index')->with('success', 'Brand Partner berhasil dihapus.');
            
        } catch (\Exception $e) {
            Log::error('Error deleting brand partner: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}