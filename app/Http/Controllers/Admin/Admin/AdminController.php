<?php
namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Tampilkan daftar admin.
     */
    public function index()
    {
        $admins = User::where('type', 1)->get(); // Tampilkan hanya pengguna dengan type = 1 (Admin)
        return view('Admin.Admins.index', compact('admins'));
    }

    /**
     * Form untuk menambah admin baru.
     */
    public function create()
    {
        return view('Admin.Admins.create');
    }

    /**
     * Simpan admin baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/', // Validasi domain @gmail.com
            ],
            'password' => 'nullable|string|min:8',
        ]);
    
        $password = $request->password ?? Str::random(8);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'type' => 1, // type = 1 untuk admin
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }
    
    public function edit(User $admin)
    {
        return view('Admin.Admins.edit', compact('admin'));
    }

    /**
     * Perbarui data admin.
     */
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $admin->id, // Pastikan email unik kecuali miliknya sendiri
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/', // Validasi domain @gmail.com
            ],
            'password' => 'nullable|string|min:8', // Validasi password jika diisi
        ], [
            'email.regex' => 'Email harus menggunakan domain @gmail.com.', // Pesan error kustom untuk regex
        ]);
    
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            // Update password jika ada input password baru
            'password' => $request->filled('password') ? Hash::make($request->password) : $admin->password,
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Hapus admin.
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
