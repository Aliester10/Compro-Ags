<?php

namespace App\Http\Controllers\Admin\QnaGuest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QnaGuest;

class QnaGuestController extends Controller
{
    public function index()
    {
        $qnaguests = QnaGuest::all();
        return view('Admin.QnaGuest.index', compact('qnaguests'));
        return view('Member.qna-guest.qna-guest');
    }

    public function create()
    {
        return view('Admin.QnaGuest.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('faq_images', 'public');
        }

        QnaGuest::create($data);

        return redirect()->route('admin.qnaguest.index')->with('success', 'Qna Guest created successfully');
    }

    public function edit(QnaGuest $qnaguest)
    {
        return view('Admin.QnaGuest.edit', compact('qnaguest'));
    }

    public function update(Request $request, QnaGuest $qnaguest)
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('faq_images', 'public');
        }

        $qnaguest->update($data);

        return redirect()->route('admin.qnaguest.index')->with('success', 'Qna Guest updated successfully');
    }

    public function destroy(QnaGuest $qnaguest)
    {
        $qnaguest->delete();
        return redirect()->route('admin.qnaguest.index')->with('success', 'Qna Guest deleted successfully');
    }
}
