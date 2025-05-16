@extends('layouts.app')

@section('title', 'Histori Nota Pembelian')

@section('content')
<div class="container">
    <h2>Histori Nota Pembelian</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($notas->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Nota</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Pembelian (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notas as $nota)
                    <tr>
                        <td>{{ $nota->id }}</td>
                        <td>{{ $nota->barang->namabarang }}</td>
                        <td>{{ $nota->jumlah }}</td>
                        <td>{{ $nota->tanggal_pembelian }}</td>
                        <td>{{ number_format($nota->total_pembelian, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('nota.show', $nota->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada transaksi.</p>
    @endif
</div>
@endsection
