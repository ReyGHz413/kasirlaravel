<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan semua barang
  public function index()
  {
    $barang = Barang::all();
    return view('barang.index', compact('barang'));
  }

  // Menampilkan form tambah barang
  public function create()
  {
    return view('barang.create');
  }

  // Menyimpan data barang baru
  public function store(Request $request)
  {
    $request->validate([
      'namabarang' => 'required',
      'stok' => 'required',
      'harga' => 'required'
    ]);


    Barang::create($request->all());
    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
  }


  // Menampilkan form edit barang
  public function edit($id)
  {
    $barang = Barang::findOrFail($id);
    return view('barang.edit', compact('barang'));
  }


  // Menyimpan perubahan data barang
  public function update(Request $request, $id)
  {
    $request->validate([
      'namabarang' => 'required',
      'stok' => 'required',
      'harga' => 'required'
    ]);


    $barang = Barang::findOrFail($id);
    $barang->update($request->all());
    return redirect()->route('barang.index')->with('success', 'List Barang berhasil diperbarui');
  }


  // Menghapus barang
  public function destroy($id)
  {
    Barang::destroy($id);
    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
  }

}
