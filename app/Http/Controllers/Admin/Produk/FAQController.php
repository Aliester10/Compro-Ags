<?php

namespace App\Http\Controllers\Admin\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukFAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index($produk_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $faqs = $produk->faqs;
        return view('Admin.Faq.index', compact('faqs', 'produk'));
    }

    public function create($produk_id)
    {
        $produk = Produk::findOrFail($produk_id);
        return view('Admin.Faq.create', compact('produk'));
    }

    public function store(Request $request, $produk_id)
    {
        $produk = Produk::findOrFail($produk_id);

        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        $produk->faqs()->create($request->all());

        return redirect()->route('admin.faq.index', $produk_id)->with('success', 'FAQ created successfully.');
    }

    public function show($produk_id, $faq_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $faq = ProdukFAQ::where('produk_id', $produk_id)->findOrFail($faq_id);
        return view('Admin.Faq.show', compact('faq','produk'));
    }

    public function edit($produk_id, $faq_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $faq = ProdukFAQ::where('produk_id', $produk_id)->findOrFail($faq_id);
        return view('Admin.Faq.edit', compact('faq','produk'));
    }

    public function update(Request $request, $produk_id, $faq_id)
    {
        $faq = ProdukFAQ::where('produk_id', $produk_id)->findOrFail($faq_id);

        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faq.index', $produk_id)->with('success', 'FAQ updated successfully.');
    }

    public function destroy($produk_id, $faq_id)
    {
        $faq = ProdukFAQ::where('produk_id', $produk_id)->findOrFail($faq_id);
        $faq->delete();

        return redirect()->route('admin.faq.index', $produk_id)->with('success', 'FAQ deleted successfully.');
    }
}
