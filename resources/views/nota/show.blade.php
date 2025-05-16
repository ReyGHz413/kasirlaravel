@extends('layouts.app')

@section('title', 'Detail Nota Pembelian')

@section('content')
<div class="container">
    <h2>Detail Nota Pembelian</h2>

    <table class="table table-bordered">
        <tr>
            <th>ID Nota</th>
            <td>{{ $nota->id }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $nota->barang->namabarang }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $nota->jumlah }}</td>
        </tr>
        <tr>
            <th>Harga Asli (Rp)</th>
            <td>{{ number_format($nota->harga_asli, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Nominal Diskon (%)</th>
            <td>{{ $nota->nominal_diskon }}%</td>
        </tr>
        <tr>
            <th>Harga Diskon per Barang (Rp)</th>
            <td>{{ number_format($nota->harga_diskon, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Pembelian (Rp)</th>
            <td>{{ number_format($nota->total_pembelian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Keuntungan (Rp)</th>
            <td>{{ number_format($nota->keuntungan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembelian</th>
            <td>{{ $nota->tanggal_pembelian }}</td>
        </tr>
    </table>

    <a href="{{ route('nota.index') }}" class="btn btn-secondary">Kembali ke Histori</a>
</div>
@endsection
