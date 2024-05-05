
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laporan Kelas {{ $kelas }}</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css?v=3.2.0') }}">

<body onload="window.print()">

    <table class="table table-striped table-borderless">
        <thead>
          <tr >
            <th style="text-align:center;"colspan="5">Pengumuman Hasil Seleksi Tertulis</th>
          </tr>
        </thead>
        <tbody>
            <tr >
                <td style="text-align:center;"colspan="5">Gelombang Tes : {{ $kelas }}</td>
            </tr>
        </tbody>

      </table>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">No Urut</th>
      <th scope="col">No Pendaftaran</th>
      <th scope="col">Nama</th>
      <th scope="col">Nilai</th>
      <th scope="col">Kecamatan</th>
    </tr>
  </thead>

</table>

</body>
</html>
