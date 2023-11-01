<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Jenis Barang',
            'result' => JenisBarang::all()
        ];

        return view('jenis_barang.index', $data);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh form
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        // Buat jenis barang baru
        $jenis_barang = new JenisBarang();
        $jenis_barang->nama_jenis = $request->input('nama_jenis');
        $jenis_barang->save();

        return redirect()->route('jenis-barang')->with('status', 'success')->with('message', 'Data jenis barang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim oleh form
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        // Temukan jenis barang yang akan diperbarui berdasarkan ID
        $jenis_barang = JenisBarang::find($id);

        if (!$jenis_barang) {
            return redirect()->route('jenis-barang')->with('status', 'error')->with('message', 'Jenis barang tidak ditemukan');
        }

        // Perbarui data jenis barang
        $jenis_barang->nama_jenis = $request->input('nama_jenis');
        $jenis_barang->save();

        return redirect()->route('jenis-barang')->with('status', 'success')->with('message', 'Data jenis barang berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Temukan jenis barang yang akan dihapus berdasarkan ID
        $jenis_barang = JenisBarang::find($id);

        if (!$jenis_barang) {
            return redirect()->route('jenis-barang')->with('status', 'error')->with('message', 'Jenis barang tidak ditemukan');
        }

        // Hapus jenis barang
        $jenis_barang->delete();

        return redirect()->route('jenis-barang')->with('status', 'success')->with('message', 'Data jenis barang berhasil dihapus');
    }
}
