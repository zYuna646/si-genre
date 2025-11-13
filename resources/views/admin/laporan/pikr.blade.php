<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan PIKR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA PIKR</h1>
        <p>Tanggal: {{ date('d-m-Y') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama PIKR</th>
                <th>Deskripsi</th>
                <th>Status SK</th>
                <th>Jumlah Anggota</th>
                <th>Jumlah Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pikrs as $index => $pikr)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pikr->name }}</td>
                <td>{{ $pikr->desc }}</td>
                <td>{{ !empty($pikr->sk) ? 'Memiliki SK' : 'Belum Memiliki SK' }}</td>
                <td>{{ \App\Models\Anggota::where('pikr_id', $pikr->id)->count() }}</td>
                <td>{{ \App\Models\Kegiatan::where('pikr_id', $pikr->id)->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total PIKR: {{ $pikrs->count() }}</p>
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
    </div>
</body>
</html>