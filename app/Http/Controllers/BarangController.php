<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Barang',
            'result' => Barang::with('jenisBarang')->get(),
            'jenisBarang' => JenisBarang::all()
        ];

        // dd($data['result']);

        return view('barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh form
        $request->validate([
            'jenis_id' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
        ]);

        // Buat barang baru
        $barang = new Barang();
        $barang->jenis_id = $request->input('jenis_id');
        $barang->nama_barang = $request->input('nama_barang');
        $barang->harga = $request->input('harga');
        $barang->stok = $request->input('stok');
        $barang->save();

        return redirect()->route('barang')->with('status', 'success')->with('message', 'Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim oleh form
        $request->validate([
            'jenis_id' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
        ]);

        // Temukan barang yang akan diperbarui berdasarkan ID
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->route('barang')->with('status', 'error')->with('message', 'Barang tidak ditemukan');
        }

        // Perbarui data barang
        $barang->jenis_id = $request->input('jenis_id');
        $barang->nama_barang = $request->input('nama_barang');
        $barang->harga = $request->input('harga');
        $barang->stok = $request->input('stok');
        $barang->save();

        return redirect()->route('barang')->with('status', 'success')->with('message', 'Data barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan barang yang akan dihapus berdasarkan ID
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->route('barang')->with('status', 'error')->with('message', 'Barang tidak ditemukan');
        }

        // Hapus barang
        $barang->delete();

        return redirect()->route('barang')->with('status', 'success')->with('message', 'Data barang berhasil dihapus');
    }
}
