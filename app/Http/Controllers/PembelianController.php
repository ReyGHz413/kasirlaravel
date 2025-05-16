<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Barang;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    // Menampilkan form pembelian
    public function create()
    {
        $barangs = Barang::all();
        return view('pembelian.create', compact('barangs'));
    }

    // Menyimpan transaksi pembelian
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'diskon' => 'required|numeric|min:1|max:100',
        ]);

        // Ambil data barang
        $barang = Barang::findOrFail($request->barang_id);

        // Cek stok barang
        if ($request->jumlah > $barang->stok) {
            return redirect()->back()->with('error', 'Stok tidak cukup. Tersedia: ' . $barang->stok);
        }

        // Hitung harga setelah diskon
        $harga_asli = (int) $barang->harga;
        $diskon_persen = (float) $request->diskon;
        $harga_diskon_per_barang = $harga_asli * ($diskon_persen / 100);
        $harga_setelah_diskon = $harga_asli - $harga_diskon_per_barang;
        $total_harga = $harga_setelah_diskon * $request->jumlah;
        $keuntungan = $harga_diskon_per_barang * $request->jumlah;

        // Simpan Nota
        Nota::create([
            'barang_id' => $barang->id,
            'jumlah' => $request->jumlah,
            'nominal_diskon' => $diskon_persen,
            'harga_asli' => $harga_asli,
            'harga_diskon' => $harga_diskon_per_barang,
            'total_pembelian' => $total_harga,
            'keuntungan' => $keuntungan,
            'tanggal_pembelian' => now()->toDateString(),
        ]);

        // Kurangi stok barang
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()->route('nota.index')->with('success', 'Nota berhasil dibuat.');
    }

    // Menampilkan semua nota
    public function index()
    {
        $notas = Nota::with('barang')->latest()->get();
        return view('nota.index', compact('notas'));
    }

    // Menampilkan detail nota
    public function show($id)
    {
        $nota = Nota::with('barang')->findOrFail($id);
        return view('nota.show', compact('nota'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'namabarang' => 'required',
        'stok' => 'required|integer|min:0',
        'harga' => 'required|integer|min:0'
    ]);

    $barang = Barang::findOrFail($id);
    $barang->update($request->all());

    // Update harga pada nota yang menggunakan barang ini
    foreach ($barang->notas as $nota) {
        $nota->harga_asli = $barang->harga;
        $nota->harga_diskon = $barang->harga * ($nota->nominal_diskon / 100);
        $nota->total_pembelian = ($barang->harga - $nota->harga_diskon) * $nota->jumlah;
        $nota->save();
    }

    return redirect()->route('barang.index')->with('success', 'List Barang berhasil diperbarui');
}

}
