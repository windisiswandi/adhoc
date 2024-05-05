<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PENGUMUMAN HASIL SELEKSI TERTULIS<</title>
<style>
table,h3, p {
    border-collapse: collapse;
    font-family: Tahoma, Geneva, sans-serif;
    margin: 0 auto;
}

table td {
    padding: 15px;
}

table thead td {
    background-color: #54585d;
    color: #ffffff;
    font-weight: bold;
    font-size: 13px;
    border: 1px solid #54585d;
}

table tbody td {
    color: #636363;
    border: 1px solid #dddfe1;
    font-size: 12px;
}

table tbody tr {
    background-color: #f9fafb;
}

table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}
</style>
</head>
<body>

<center><h3>PENGUMUMAN HASIL SELEKSI TERTULIS</h3>
    <p>
        Kelas : {{$kelas == null ? 'Semua kelas' : $kelas->nama_kelas }} <br>
        Wilayah : {{$wilayah == null ? 'Semua wilayah' : $wilayah }}
    </p>
</center>
<br>
<table>
    <thead>
        <tr>
            <td>No</td>
            <td>No Pendaftaran</td>
            <td>Nama</td>
            <td>Kelas</td>
            <td>Wilayah</td>
            <td>Nilai</td>
        </tr>
    </thead>
    <tbody>
        @foreach ( $hasil as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->no_pendaftaran }}</td>
            <td>{{ $item->nama_peserta }}</td>
            <td>{{ $item->nama_kelas }}</td>
            <td>{{ $item->wilayah }}</td>
            <td>{{ Crypt::decrypt($item->nilai_pilihan_ganda) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
