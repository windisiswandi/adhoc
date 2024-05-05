<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">No Urut</th>
      <th scope="col">No Pendaftaran</th>
      <th scope="col">Nama</th>
      <th scope="col">Kecamatan</th>
      <th scope="col">Gelombang</th>
      <th scope="col">Waktu Pelaksanaan</th>
    </tr>
  </thead>
  <tbody>
    @forelse($pesertaTes as $idx => $peserta)
    <tr>
      <td>{{$idx+1}}</td>
      <td>{{$peserta->peserta->nip}}</td>
      <td>{{$peserta->peserta->name}}</td>
      <td>{{$peserta->peserta->kecamatan}}</td>
      <td>{{$kelas->nama_kelas}}</td>
      <td>{{\Carbon\Carbon::create($kelas->tanggal)->format('d-m-Y H:i:s')}}</td>
    </tr>
    @empty
    <tr>
      <td colspan="6">Tidak Ada Data</td>
    </tr>
    @endforelse
  </tbody>
</table>