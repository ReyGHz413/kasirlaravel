<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembelian #{{ $nota->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2c2c2c;
            background-color: #fff;
            padding: 20px;
        }
        h2, h4 {
            color: #6e4f3a;
            margin-bottom: 5px;
        }
        p {
            margin: 2px 0;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #6e4f3a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .summary {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th {
            background-color: #c2a88b;
            color: #fff;
            padding: 8px;
            border: 1px solid #6e4f3a;
        }
        td {
            padding: 8px;
            border: 1px solid #6e4f3a;
        }
        .total {
            font-weight: bold;
            text-align: right;
            background-color: #f5eee6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nota Pembelian</h2>
        <p><strong>Toko Grosir</strong></p>
    </div>

    <div class="summary">
        <p><strong>ID Nota:</strong> #{{ $nota->id }}</p>
        <p><strong>Tanggal Pembelian:</strong> {{ \Carbon\Carbon::parse($nota->tanggal_pembelian)->format('d M Y') }}</p>
        <p><strong>Total Pembelian:</strong> Rp {{ number_format($nota->total_pembelian, 0, ',', '.') }}</p>
    </div>

    <h4>Rincian Barang</h4>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Asli</th>
                <th>Diskon (%)</th>
                <th>Harga Diskon</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nota->detailnota as $detail)
                <tr>
                    <td>{{ $detail->barang->namabarang }}</td>
                    <td>Rp {{ number_format($detail->harga_asli, 0, ',', '.') }}</td>
                    <td>{{ $detail->diskon }}%</td>
                    <td>Rp {{ number_format($detail->harga_diskon, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="total">Total Pembelian</td>
                <td class="total">Rp {{ number_format($nota->total_pembelian, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>