<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Produk;
use App\Models\User;
use App\Models\UserProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class MemberController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query untuk user dengan tipe 0 (members)
        $query = User::where('type', 0);
    
        // Tambahkan logika pencarian
        if ($request->has('search') && $request->search !== null) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%");
            });
        }
    
        // Pagination 10 data per halaman
        $members = $query->paginate(10);
    
        // Kembalikan data ke view
        return view('Admin.Members.index', compact('members'));
    }
    

    public function create()
    {
        $locations = Location::all();
        return view('Admin.Members.create', compact('locations'));
    }


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'gender' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'nama_perusahaan' => 'nullable|string|max:255',
        'no_telp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'location_id' => 'nullable|exists:locations,id',
    ]);

    $randomPassword = Str::random(8);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'password' => Hash::make($randomPassword),
        'type' => 0, // member
        'nama_perusahaan' => $request->nama_perusahaan,
        'location_id' => $request->location_id,
        'no_telp' => $request->no_telp,
        'alamat' => $request->alamat,

    ]);

    session()->flash('password', $randomPassword);

    return redirect()->route('members.show', $user->id);
}


    public function show($id)
    {
        $member = User::findOrFail($id);
        $password = session('password');


        return view('Admin.Members.show', compact('member', 'password'));
    }


    public function edit($id)
{
    $member = User::findOrFail($id);
    return view('Admin.Members.edit', compact('member'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'gender' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'nama_perusahaan' => 'nullable|string|max:255',
        'no_telp' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $member = User::findOrFail($id);

    $member->update([
        'name' => $request->name,
        'email' => $request->email,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'nama_perusahaan' => $request->nama_perusahaan,
        'no_telp' => $request->no_telp,
        'alamat' => $request->alamat,
    ]);

    if ($request->filled('password')) {
        $member->update(['password' => Hash::make($request->password)]);
    }

    return redirect()->route('members.index')->with('success', 'Member updated successfully.');
}



    public function destroy($id)
    {
        $member = User::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function addProducts($id)
    {
        $member = User::findOrFail($id);
        $produks = Produk::all(); // Mendapatkan semua produk yang tersedia

        return view('Admin.Members.add-products', compact('member', 'produks'));
    }

    public function storeProducts(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'produk_id' => 'required|array|min:1', // Ensure at least one product is selected
        'produk_id.*' => 'exists:produk,id', // Validate that each selected product exists
        'pembelian.*' => 'nullable|date', // Optional date validation
    ],[
        'produk_id.required' => 'Please select at least one product.',
    ]);

    // Find the member
    $member = User::findOrFail($id);

    // Save the selected products and purchase dates
    foreach ($request->produk_id as $produk_id) {
        $pembelianDate = $request->pembelian[$produk_id] ?? null;

        // Save the product to the user_produk table
        UserProduk::create([
            'user_id' => $member->id,
            'produk_id' => $produk_id,
            'pembelian' => $pembelianDate,
        ]);
    }

    return redirect()->route('members.show', $member->id)->with('success', 'Products added to member successfully.');
}




    public function editProducts($id)
    {
        $member = User::with('userProduk')->findOrFail($id);

        $userProduks = $member->userProduk;

        return view('Admin.Members.edit-products', compact('member', 'userProduks'));
    }


    public function updateProducts(Request $request, $id)
{
    $request->validate([
        'produk_id.*' => 'exists:produk,id',
        'pembelian.*' => 'nullable|date', // Allow null or valid date
    ]);

    $member = User::findOrFail($id);

    // Get existing products and purchase dates for comparison
    $existingProducts = $member->userProduk->pluck('produk_id')->toArray();
    $existingPurchases = $member->userProduk->pluck('pembelian', 'produk_id')->toArray();

    // Prepare submitted products and purchases
    $submittedProducts = $request->produk_id ?? [];
    $submittedPurchases = $request->pembelian ?? [];

    // Compare existing and submitted products
    $productsChanged = array_diff($existingProducts, $submittedProducts) || array_diff($submittedProducts, $existingProducts);
    $purchasesChanged = false;

    foreach ($submittedProducts as $index => $produk_id) {
        $submittedPurchaseDate = $submittedPurchases[$index] ?? null;
        $existingPurchaseDate = $existingPurchases[$produk_id] ?? null;

        if ($submittedPurchaseDate != $existingPurchaseDate) {
            $purchasesChanged = true;
            break;
        }
    }

    // If no changes were made, return with a message
    if (!$productsChanged && !$purchasesChanged) {
        return redirect()->route('members.show', $member->id)->with('info', 'No changes were made.');
    }

    // If changes detected, remove old products and insert new ones
    UserProduk::where('user_id', $member->id)->delete();

    if ($request->has('produk_id')) {
        foreach ($submittedProducts as $index => $produk_id) {
            UserProduk::create([
                'user_id' => $member->id,
                'produk_id' => $produk_id,
                'pembelian' => $submittedPurchases[$index] ?? null,
            ]);
        }
    }

    return redirect()->route('members.show', $member->id)->with('success', 'Products updated successfully.');
}

public function updatePassword(Request $request, $id)
{
    $request->validate([
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::findOrFail($id);
    $user->password = bcrypt($request->password);
    $user->save();

    return response()->json(['success' => true]);
}












}
