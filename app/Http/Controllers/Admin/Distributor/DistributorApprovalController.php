<?php

namespace App\Http\Controllers\Admin\Distributor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DistributorApprovalController extends Controller
{
    public function show($id)
{
    // Find the distributor by ID
    $distributor = User::findOrFail($id);

    // Pass the distributor to the view
    return view('Admin.Distributors.show', compact('distributor'));
}

public function index(Request $request)
{
    $query = User::where('type', '2'); // Hanya pengguna dengan tipe distributor

    // Pencarian berdasarkan nama, email, atau nama perusahaan
    if ($request->has('search') && $request->search !== null) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('nama_perusahaan', 'like', "%{$search}%");
        });
    }

    // Pagination 10 data per halaman
    $distributors = $query->paginate(10);

    return view('Admin.Distributors.index', compact('distributors'));
}

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->save();

        return redirect()->route('admin.distributors.index')->with('success', 'Distributor approved successfully.');
    }
}
