@extends('layouts.app')

@section('title', 'Detail Nota Pembelian')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detail Nota Pembelian</h2>

    <table class="table table-bordered">
        <tr>
            <th style="width: 200px;">ID Nota</th>
            <td>{{ $nota->id }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembelian</th>
            <td>{{ $nota->tanggal_pembelian }}</td>
        </tr>
        <tr>
            <th>Total Pembelian (Rp)</th>
            <td>{{ number_format($nota->total_pembelian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Keuntungan (Rp)</th>
            <td>{{ number_format($nota->keuntungan, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h4 class="mt-5">Rincian Barang</h4>
    <table class="table table-striped table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nama Barang</th>
                <th>Harga Asli (Rp)</th>
                <th>Diskon (%)</th>
                <th>Harga Setelah Diskon (Rp)</th>
                <th>Jumlah</th>
                <th>Subtotal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nota->detailNota as $detail)
                <tr>
                    <td>{{ $detail->barang->namabarang }}</td>
                    <td>{{ number_format($detail->harga_asli, 0, ',', '.') }}</td>
                    <td>{{ $detail->diskon }}%</td>
                    <td>{{ number_format($detail->harga_asli - $detail->harga_diskon, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data barang dalam nota ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('nota.cetak', $nota->id) }}" class="btn btn-primary" target="_blank">Cetak PDF</a>
    <br>

    <a href="{{ route('nota.index') }}" class="btn btn-secondary mt-3">← Kembali ke Histori Nota</a>
</div>
@endsection
