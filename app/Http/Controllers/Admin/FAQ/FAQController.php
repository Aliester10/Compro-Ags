<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('Admin.Faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('Admin.Faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ created successfully.');
    }

    public function show($faq_id)
    {
        $faq = Faq::findOrFail($faq_id);
        return view('Admin.Faq.show', compact('faq'));
    }

    public function edit($faq_id)
    {
        $faq = Faq::findOrFail($faq_id);
        return view('Admin.Faq.edit', compact('faq'));
    }

    public function update(Request $request, $faq_id)
    {
        $faq = Faq::findOrFail($faq_id);

        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy($faq_id)
    {
        $faq = Faq::findOrFail($faq_id);
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully.');
    }
}
