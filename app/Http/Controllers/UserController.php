<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data User',
            'result' => User::all()
        ];

        return view('users.index', $data);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh form
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,kasir',
        ]);

        // Buat pengguna baru
        $user = new User;
        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users')->with('status', 'success')->with('message', 'Data pengguna berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim oleh form
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,kasir',
        ]);

        // Temukan pengguna yang akan diperbarui berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('status', 'error')->with('message', 'Pengguna tidak ditemukan');
        }

        // Perbarui data pengguna
        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

        $user->save();

        return redirect()->route('users')->with('status', 'success')->with('message', 'Data pengguna berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Temukan pengguna yang akan dihapus berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('status', 'error')->with('message', 'Pengguna tidak ditemukan');
        }

        // Hapus pengguna
        $user->delete();

        return redirect()->route('users')->with('status', 'success')->with('message', 'Data pengguna berhasil dihapus');
    }
}
