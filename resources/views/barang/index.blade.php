@extends('layouts.app')


@section('content')
  <div class="container">
    <h2>Daftar Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>


    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama Barang</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($barang as $b)
          <tr>
            <td>{{ $b->namabarang }}</td>
            <td>{{ $b->stok }}</td>
            <td>{{ number_format($b->harga, 0, ',', '.') }}</td>
            <td>
              <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('barang.destroy', $b->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                  onclick="return confirm('Hapus Barang ini?')">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
