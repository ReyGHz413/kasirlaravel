@extends('layouts.app')

@section('title', 'Form Pembelian')

@section('content')
<div class="container">
    <h2>Form Pembelian</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Barang</label>
            <select name="barang_id" id="barang_id" class="form-select" required>
                <option value="">Pilih Barang</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}" 
                            data-harga="{{ $barang->harga }}" 
                            data-stok="{{ $barang->stok }}">
                        {{ $barang->namabarang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Harga Barang (Rp)</label>
            <input type="text" id="harga_barang" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Stok Tersedia</label>
            <input type="text" id="stok_barang" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Diskon (%)</label>
            <input type="number" name="diskon" id="diskon" class="form-control" min="1" max="100" required>
        </div>

        <div class="mb-3">
            <label>Total Pembelian (Rp)</label>
            <input type="text" id="total_pembelian" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
    </form>
</div>

<script>
    function updateTotal() {
        const harga = parseInt(document.getElementById('harga_barang').value || 0);
        const jumlah = parseInt(document.getElementById('jumlah').value || 0);
        const diskon = parseFloat(document.getElementById('diskon').value || 0);
        const stok = parseInt(document.getElementById('stok_barang').value || 0);

        if (jumlah > stok) {
            alert('Jumlah melebihi stok yang tersedia.');
            document.getElementById('jumlah').value = stok;
            return;
        }

        const hargaDiskonPerItem = harga * (diskon / 100);
        const hargaSetelahDiskon = harga - hargaDiskonPerItem;
        const total = hargaSetelahDiskon * jumlah;
        
        document.getElementById('total_pembelian').value = total.toLocaleString('id-ID');
    }

    // Update harga dan stok saat barang dipilih
    document.getElementById('barang_id').addEventListener('change', function() {
        const selectedBarang = this.options[this.selectedIndex];
        const harga = selectedBarang.getAttribute('data-harga') || '';
        const stok = selectedBarang.getAttribute('data-stok') || '';

        document.getElementById('harga_barang').value = harga;
        document.getElementById('stok_barang').value = stok;

        updateTotal();
    });

    // Hitung total saat jumlah atau diskon diubah
    document.getElementById('jumlah').addEventListener('input', updateTotal);
    document.getElementById('diskon').addEventListener('input', updateTotal);
</script>
@endsection
