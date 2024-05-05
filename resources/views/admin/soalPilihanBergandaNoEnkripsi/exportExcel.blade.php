<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">no</th>
      <th scope="col">soal</th>
      <th scope="col">pilihan_a</th>
      <th scope="col">pilihan_b</th>
      <th scope="col">pilihan_c</th>
      <th scope="col">pilihan_d</th>
      <th scope="col">kunci</th>
      <th scope="col">nilai_benar</th>
      <th scope="col">nilai_salah</th>
    </tr>
  </thead>
  <tbody>
    @foreach($soalPilihanGanda as $item)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{Crypt::encrypt($item->soal)}}</td>
      <td>{{Crypt::encrypt($item->pil_a)}}</td>
      <td>{{Crypt::encrypt($item->pil_b)}}</td>
      <td>{{Crypt::encrypt($item->pil_c)}}</td>
      <td>{{Crypt::encrypt($item->pil_d)}}</td>
      <td>{{$item->kunci}}</td>
      <td>{{$item->nilai_benar}}</td>
      <td>{{$item->nilai_salah}}</td>
    </tr>
    @endforeach
  </tbody>
</table>