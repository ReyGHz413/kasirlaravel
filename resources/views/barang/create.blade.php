@extends('layouts.app')
@section('content')
  <div class="container">
    <h2>Tambah Barang</h2>


    <form action="{{ route('barang.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="namabarang" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" min="0" required>
      </div>
      <div class="mb-3">
        <label>Harga</label>
        <input type="text" name="harga" class="form-control" required>
      </div>
      <div class="form-group">
    <label for="diskon">Diskon (%)</label>
    <input type="number" name="diskon" id="diskon" step="0.01" class="form-control" value="{{ old('diskon', $barang->diskon ?? 0) }}">
</div>
      <button type="submit" class="btn btn-success">Simpan</button>
    </form>
  </div>
@endsection

