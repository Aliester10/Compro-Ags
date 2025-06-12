<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\CompanyParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyParameters = CompanyParameter::all();
        return view('Admin.Parameter.index', compact('companyParameters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Parameter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sejarah_singkat' => 'nullable|string',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'no_wa' => 'required|string',
            'alamat' => 'required|string',
            'maps' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'about_gambar' => 'nullable|image|max:2048',
            'logo' => 'nullable|image|max:2048',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'ekatalog' => 'nullable|string',
            'whatsapp_1' => 'nullable|string',
            'whatsapp_2' => 'nullable|string',
            'visimisi_1' => 'nullable|string',
            'visimisi_2' => 'nullable|string',
            'visimisi_3' => 'nullable|string',
            'website' => 'nullable|url',
            'nomor_induk_berusaha' => 'nullable|string',
            'surat_keterangan' => 'nullable|string',
        ]);

        // Handle about_gambar file upload
        if ($request->hasFile('about_gambar')) {
            $validated['about_gambar'] = $request->file('about_gambar')->store('uploads/about', 'public');
        }

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('uploads/logo', 'public');
        }

        CompanyParameter::create($validated);

        return redirect()->route('parameter.index')->with('success', 'Company parameter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $companyParameter = CompanyParameter::findOrFail($id);
        return view('Admin.Parameter.show', compact('companyParameter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companyParameter = CompanyParameter::findOrFail($id);
        return view('Admin.Parameter.edit', compact('companyParameter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sejarah_singkat' => 'nullable|string',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'no_wa' => 'required|string',
            'alamat' => 'required|string',
            'maps' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'about_gambar' => 'nullable|image|max:2048',
            'logo' => 'nullable|image|max:2048',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'ekatalog' => 'nullable|string',
            'whatsapp_1' => 'nullable|string',
            'whatsapp_2' => 'nullable|string',
            'visimisi_1' => 'nullable|string',
            'visimisi_2' => 'nullable|string',
            'visimisi_3' => 'nullable|string',
            'website' => 'nullable|url',
            'nomor_induk_berusaha' => 'nullable|string',
            'surat_keterangan' => 'nullable|string',
        ]);

        $companyParameter = CompanyParameter::findOrFail($id);

        // Handle about_gambar file upload and removal
        if ($request->hasFile('about_gambar')) {
            // Validasi file gambar
            $request->validate([
                'about_gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
            // Hapus file lama jika ada
            if ($companyParameter->about_gambar) {
                Storage::disk('public')->delete($companyParameter->about_gambar);
            }
        
            // Simpan file baru
            $validated['about_gambar'] = $request->file('about_gambar')->store('uploads/about', 'public');
        }

        // Handle logo file upload and removal
        if ($request->hasFile('logo')) {
            // Validasi file logo
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            // Hapus file lama jika ada
            if ($companyParameter->logo) {
                Storage::disk('public')->delete($companyParameter->logo);
            }
        
            // Simpan file baru
            $validated['logo'] = $request->file('logo')->store('uploads/logo', 'public');
        }

        $companyParameter->update($validated);

        return redirect()->route('parameter.index')->with('success', 'Company parameter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $companyParameter = CompanyParameter::findOrFail($id);

        // Delete about_gambar if exists
        if ($companyParameter->about_gambar) {
            Storage::disk('public')->delete($companyParameter->about_gambar);
        }

        // Delete logo if exists
        if ($companyParameter->logo) {
            Storage::disk('public')->delete($companyParameter->logo);
        }

        $companyParameter->delete();

        return redirect()->route('parameter.index')->with('success', 'Company parameter deleted successfully.');
    }
}