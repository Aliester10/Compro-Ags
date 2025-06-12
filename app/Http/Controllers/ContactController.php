<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyParameter;

class ContactController extends Controller
{
    public function index()
    {
        // Ambil data pertama dari tabel compro_parameter
        $companyInfo = CompanyParameter::first();
        
        return view('contact', compact('companyInfo'));
    }
}