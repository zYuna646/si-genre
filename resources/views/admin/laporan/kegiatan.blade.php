<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Kegiatan PIKR</title>
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
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA KEGIATAN PIKR</h1>
        <p>Tanggal: {{ date('d-m-Y') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama PIKR</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Lokasi</th>
                <th>Tujuan</th>
                <th>Tema</th>
                <th>Jumlah Peserta</th>
                <th>Status Laporan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pikr->name }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ optional($item->tanggal_pelaksanaan)->format('d-m-Y') }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->tujuan, 50) }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->tema, 30) }}</td>
                <td>{{ optional($item->laporanKegiatan)->jumlah_peserta ?? '-' }}</td>
                <td>{{ optional($item->laporanKegiatan)->isVerified ? 'Terverifikasi' : 'Pending' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Kegiatan: {{ $kegiatan->count() }}</p>
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
    </div>
</body>
</html>