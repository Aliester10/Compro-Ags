<?php

namespace App\Http\Controllers\Member\QnaGuest1;

use App\Http\Controllers\Controller;
use App\Models\QnaGuest;
use Illuminate\Http\Request;

class QnaGuest1Controller extends Controller
{
    public function index()
    {
        $qnaguests = QnaGuest::all(); // Ambil data QnA Guest
        return view('Member.qna-guest.qna-guest', compact('qnaguests'));
    }
}
