<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Anggota PIKR</title>
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
        <h1>LAPORAN DATA ANGGOTA PIKR</h1>
        <p>Tanggal: {{ date('d-m-Y') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama PIKR</th>
                <th>Nama Anggota</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggota as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pikr->nama }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->telepon }}</td>
                <td>{{ $item->jabatan ? $item->jabatan->nama : '-' }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Anggota: {{ $anggota->count() }}</p>
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
    </div>
</body>
</html>