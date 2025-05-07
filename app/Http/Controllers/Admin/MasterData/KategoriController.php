<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('Admin.MasterData.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.MasterData.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon_default' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'icon_hover' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'url' => 'nullable|url',
        ]);

        $iconDefaultPath = null;
        $iconHoverPath = null;

        if ($request->hasFile('icon_default')) {
            $iconDefaultPath = 'assets/img/iconcategory/default/' . time() . '_' . $request->file('icon_default')->getClientOriginalName();
            $request->file('icon_default')->move(public_path('assets/img/iconcategory/default'), $iconDefaultPath);
        }

        if ($request->hasFile('icon_hover')) {
            $iconHoverPath = 'assets/img/iconcategory/hover/' . time() . '_' . $request->file('icon_hover')->getClientOriginalName();
            $request->file('icon_hover')->move(public_path('assets/img/iconcategory/hover'), $iconHoverPath);
        }

        Kategori::create([
            'nama' => $request->nama,
            'icon_default' => $iconDefaultPath,
            'icon_hover' => $iconHoverPath,
            'url' => $request->url,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('Admin.MasterData.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('Admin.MasterData.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon_default' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'icon_hover' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'url' => 'nullable|url',
        ]);

        $kategori = Kategori::findOrFail($id);

        if ($request->hasFile('icon_default')) {
            if ($kategori->icon_default && file_exists(public_path($kategori->icon_default))) {
                unlink(public_path($kategori->icon_default));
            }
            $kategori->icon_default = 'assets/img/iconcategory/default/' . time() . '_' . $request->file('icon_default')->getClientOriginalName();
            $request->file('icon_default')->move(public_path('assets/img/iconcategory/default'), $kategori->icon_default);
        }

        if ($request->hasFile('icon_hover')) {
            if ($kategori->icon_hover && file_exists(public_path($kategori->icon_hover))) {
                unlink(public_path($kategori->icon_hover));
            }
            $kategori->icon_hover = 'assets/img/iconcategory/hover/' . time() . '_' . $request->file('icon_hover')->getClientOriginalName();
            $request->file('icon_hover')->move(public_path('assets/img/iconcategory/hover'), $kategori->icon_hover);
        }

        $kategori->nama = $request->nama;
        $kategori->url = $request->url;
        $kategori->save();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        if ($kategori->icon_default && file_exists(public_path($kategori->icon_default))) {
            unlink(public_path($kategori->icon_default));
        }

        if ($kategori->icon_hover && file_exists(public_path($kategori->icon_hover))) {
            unlink(public_path($kategori->icon_hover));
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori deleted successfully.');
    }
}