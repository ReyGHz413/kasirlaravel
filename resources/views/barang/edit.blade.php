@extends('layouts.app')


@section('content')
  <div class="container">
    <h2>Edit Barang</h2>


    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="namabarang" class="form-control" value="{{ $barang->namabarang }}" required>
      </div>
      <div class="mb-3">
        <label>Stok</label>
        <input type="text" name="stok" class="form-control" value="{{ $barang->stok }}" required>
      </div>
      <div class="mb-3">
        <label>Harga Barang</label>
        <input type="text" name="harga" class="form-control" value="{{ $barang->harga }}" required>
      </div>
      <button type="submit" class="btn btn-success">Update</button>
    </form>
  </div>
@endsection

