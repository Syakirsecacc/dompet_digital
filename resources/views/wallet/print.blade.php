<!DOCTYPE html>
<html>
<head>
    <title>Print Mutasi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        .no-print { margin-bottom: 20px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()">🖨️ Print Sekarang</button>
        <a href="{{ url()->previous() }}">⬅️ Kembali</a>
    </div>

    <h2>Mutasi Transaksi - {{ Auth::user()->name }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mutasi as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $m->credit ? 'Credit' : 'Debit' }}</td>
                    <td>Rp{{ number_format($m->credit ?: $m->debit) }}</td>
                    <td>{{ $m->description }}</td>
                    <td>{{ $m->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>