<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">no</th>
      <th scope="col">soal</th>
    </tr>
  </thead>
  <tbody>
    @foreach($soalEssay as $item)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{Crypt::encrypt($item->soal)}}</td>
    </tr>
    @endforeach
  </tbody>
</table>