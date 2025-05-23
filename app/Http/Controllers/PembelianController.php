<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\DetailNota; // Tambahkan ini di atas
use Illuminate\Support\Facades\DB; // Untuk transaksi DB
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan di atas


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
        'barang_id' => 'required|array',
        'jumlah' => 'required|array',
        'diskon' => 'required|array',
        'barang_id.*' => 'required|exists:barangs,id',
        'jumlah.*' => 'required|integer|min:1',
        'diskon.*' => 'required|numeric|min:0|max:100',
    ]);

    DB::beginTransaction();

    try {
        $totalPembelian = 0;
        $totalKeuntungan = 0;

        // Simpan nota kosong dulu
        $nota = Nota::create([
            'tanggal_pembelian' => now()->toDateString(),
            'total_pembelian' => 0,
            'keuntungan' => 0,
        ]);

        // Loop semua barang yang dibeli
        foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $jumlah = $request->jumlah[$index];
            $diskon = $request->diskon[$index];

            if ($jumlah > $barang->stok) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Stok tidak cukup untuk barang: ' . $barang->namabarang);
            }

            $hargaAsli = $barang->harga;
            $hargaDiskonPerBarang = $hargaAsli * ($diskon / 100);
            $hargaSetelahDiskon = $hargaAsli - $hargaDiskonPerBarang;
            $subtotal = $hargaSetelahDiskon * $jumlah;
            $keuntungan = $hargaDiskonPerBarang * $jumlah;

            // Simpan ke detail nota
            DetailNota::create([
                'nota_id' => $nota->id,
                'barang_id' => $barang->id,
                'jumlah' => $jumlah,
                'diskon' => $diskon,
                'harga_asli' => $hargaAsli,
                'harga_diskon' => $hargaDiskonPerBarang,
                'subtotal' => $subtotal,
            ]);

            // Kurangi stok barang
            $barang->stok -= $jumlah;
            $barang->save();

            // Akumulasi total
            $totalPembelian += $subtotal;
            $totalKeuntungan += $keuntungan;
        }

        // Update total dan keuntungan di nota
        $nota->update([
            'total_pembelian' => $totalPembelian,
            'keuntungan' => $totalKeuntungan,
        ]);

        DB::commit();

        return redirect()->route('nota.index')->with('success', 'Nota berhasil dibuat.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
    }
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
        $nota = Nota::with('detailnota.barang')->findOrFail($id);
        return view('nota.show', compact('nota'));
    }

    public function cetak($id)
{
    $nota = Nota::with('detailnota.barang')->findOrFail($id);

    $pdf = Pdf::loadView('nota.cetak', compact('nota'));
    return $pdf->stream('nota-pembelian-'.$nota->id.'.pdf');
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
