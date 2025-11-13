<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Detail PIKR</title>
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
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 14px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
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
        .page-break {
            page-break-after: always;
        }
        .pikr-info {
            margin-bottom: 20px;
        }
        .pikr-info table {
            border: none;
        }
        .pikr-info table td {
            border: none;
            padding: 3px;
        }
        .pikr-info table td:first-child {
            font-weight: bold;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DETAIL PIKR</h1>
        <p>Tanggal: {{ date('d-m-Y') }}</p>
    </div>
    
    <div class="pikr-info">
        <table>
            <tr>
                <td>Nama PIKR</td>
                <td>: {{ $pikr->name }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>: {{ $pikr->desc }}</td>
            </tr>
            <tr>
                <td>Status SK</td>
                <td>: {{ !empty($pikr->sk) ? 'Memiliki SK' : 'Belum Memiliki SK' }}</td>
            </tr>
            <tr>
                <td>Tanggal Registrasi</td>
                <td>: {{ $pikr->created_at->format('d-m-Y') }}</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <h2>DATA ANGGOTA</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggota as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ optional($item->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $item->jabatans->count() ? $item->jabatans->pluck('nama')->join(', ') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total Anggota: {{ $anggota->count() }}</p>
    </div>
    
    <div class="page-break"></div>
    
    <div class="section">
        <h2>DATA KEGIATAN</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
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
        <p>Total Kegiatan: {{ $kegiatan->count() }}</p>
    </div>
    
    <div class="section">
        <h2>DATA ARTIKEL</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artikel as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->isVerified ? 'Terverifikasi' : 'Pending' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total Artikel: {{ $artikel->count() }}</p>
    </div>
    
    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        <p>Tanggal: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>
</html>