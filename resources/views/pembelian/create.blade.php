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

        <div id="barang-container">
            <div class="barang-row row mb-3">
                <div class="col-md-3">
                    <label>Nama Barang</label>
                    <select name="barang_id[]" class="form-select barang-select" required>
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
                <div class="col-md-2">
                    <label>Harga (Rp)</label>
                    <input type="text" class="form-control harga-barang" readonly>
                </div>
                <div class="col-md-2">
                    <label>Stok</label>
                    <input type="text" class="form-control stok-barang" readonly>
                </div>
                <div class="col-md-1">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control jumlah-barang" min="1" required>
                </div>
                <div class="col-md-2">
                    <label>Diskon (%)</label>
                    <input type="number" name="diskon[]" class="form-control diskon-barang" min="1" max="100" required>
                </div>
                <div class="col-md-2">
                    <label>Subtotal (Rp)</label>
                    <input type="text" class="form-control subtotal-barang" readonly>
                </div>
                <div class="col-md-12 mt-2">
                    <button type="button" class="btn btn-danger btn-sm remove-barang">Hapus</button>
                </div>
            </div>
        </div>

        <button type="button" id="add-barang" class="btn btn-success mb-3">Tambah Barang</button>

        <div class="mb-3">
            <label>Total Pembelian (Rp)</label>
            <input type="text" id="total_pembelian" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
    </form>
</div>

<script>
    function updateSubtotal(row) {
        const harga = parseInt(row.querySelector('.harga-barang').value || 0);
        const jumlah = parseInt(row.querySelector('.jumlah-barang').value || 0);
        const diskon = parseFloat(row.querySelector('.diskon-barang').value || 0);
        const stok = parseInt(row.querySelector('.stok-barang').value || 0);

        if (jumlah > stok) {
            alert('Jumlah melebihi stok yang tersedia.');
            row.querySelector('.jumlah-barang').value = stok;
            return;
        }

        const hargaSetelahDiskon = harga - (harga * (diskon / 100));
        const subtotal = hargaSetelahDiskon * jumlah;
        row.querySelector('.subtotal-barang').value = subtotal.toLocaleString('id-ID');

        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal-barang').forEach(input => {
            total += parseInt(input.value.replace(/\D/g, '') || 0);
        });
        document.getElementById('total_pembelian').value = total.toLocaleString('id-ID');
    }

    function bindEvents(row) {
        row.querySelector('.barang-select').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            row.querySelector('.harga-barang').value = selected.getAttribute('data-harga') || '';
            row.querySelector('.stok-barang').value = selected.getAttribute('data-stok') || '';
            updateSubtotal(row);
        });

        row.querySelector('.jumlah-barang').addEventListener('input', () => updateSubtotal(row));
        row.querySelector('.diskon-barang').addEventListener('input', () => updateSubtotal(row));

        row.querySelector('.remove-barang').addEventListener('click', function () {
            row.remove();
            updateTotal();
        });
    }

    document.getElementById('add-barang').addEventListener('click', function () {
        const container = document.getElementById('barang-container');
        const original = container.querySelector('.barang-row');
        const clone = original.cloneNode(true);

        clone.querySelectorAll('input').forEach(input => {
            input.value = '';
        });
        clone.querySelector('.barang-select').value = '';
        bindEvents(clone);

        container.appendChild(clone);
    });

    document.querySelectorAll('.barang-row').forEach(bindEvents);
</script>
@endsection
