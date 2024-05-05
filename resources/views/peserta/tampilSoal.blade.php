<div class="content" id="read">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-lg-8">
                @if ($soalPilihanGanda->count())
                <div class="card">
                    <div class="card-header">
                        No. {{ $index + 1 }} <br>
                    </div>
                    <div class="card-body" id="wrap-soal">
                            @php echo Crypt::decrypt($masterSoalPilihanGanda['soal']); @endphp
                            <div class="form-group clearfix">
                                <table border="0">
                                    <tr>
                                        <th width="20px"></th>
                                        <th width="1000px"></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input class="form-check-input" type="radio" name="jawaban" id="a"
                                                    value="A" {{ (old('jawaban') ?? $soalPilihanGanda[$index]['jawaban']) == 'A' ? 'checked': '' }} >
                                                <label class="text " for="a">A</label>
                                            </div>
                                                </td>
                                            <td> @php echo Crypt::decrypt($masterSoalPilihanGanda['pil_a']); @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input class="form-check-input" type="radio" name="jawaban" id="b"
                                                value="B" {{ (old('jawaban') ?? $soalPilihanGanda[$index]['jawaban']) == 'B' ? 'checked': '' }} >
                                                <label class="text " for="b">B</label>
                                            </div>
                                        </td>
                                        <td>
                                            @php echo Crypt::decrypt($masterSoalPilihanGanda['pil_b']); @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input class="form-check-input" type="radio" name="jawaban" id="c"
                                                    value="C" {{ (old('jawaban') ?? $soalPilihanGanda[$index]['jawaban']) == 'C' ? 'checked': '' }} >
                                                <label class="text " for="c">C</label>
                                            </div>
                                        </td>
                                        <td>
                                            @php echo Crypt::decrypt($masterSoalPilihanGanda['pil_c']); @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                            <input class="form-check-input" type="radio" name="jawaban" id="d"
                                                    value="D" {{ (old('jawaban') ?? $soalPilihanGanda[$index]['jawaban']) == 'D' ? 'checked': '' }} >
                                                <label class="text " for="d">D</label>
                                            </div>
                                        </td>
                                        <td>
                                            @php echo Crypt::decrypt($masterSoalPilihanGanda['pil_d']); @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <input type="hidden" name="id_peserta" id="id_peserta" value="{{ $idPeserta }}">
                            <input type="hidden" name="id_soal" id="id_soal" value="{{ $masterSoalPilihanGanda['id'] }}">
                            <input type="hidden" name="index" id="index" value="{{ $index }}">
                            @php
                               $totalSoalPilihanGanda = $soalPilihanGanda->count();
                            @endphp
                            <input type="hidden" name="total_soal_pilihan_ganda" id="total_soal_pilihan_ganda" value="{{ $totalSoalPilihanGanda }}">

                            <button class="btn btn-info" onClick="simpanJawabanAndNext()">simpan <i class="fas fa-arrow-right"></i></button>
                    </div>

                </div>
                @endif
            </div>

            <div class="col-lg-4">
                @if($soalPilihanGanda->count())
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">Matriks Jawaban Pilihan Ganda</h6>
                    </div>
                    <div class="card-body text-justify">
                        @foreach ($soalPilihanGanda as $key => $item)
                            <button class="btn btn-{{ $item['jawaban'] == null ? 'outline-' : '' }}success btn-sm mb-1 btn-none" onClick="tampilSoal({{ $key }})">
                                @php $no = $key + 1; @endphp
                                {{ $no < 10 ? '0' . $no : $no }}
                            </button>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- @if ($index+1 == $totalSoalPilihanGanda)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop">
                    Selesai
                  </button> --}}
                  {{-- modal --}}
                    {{-- <div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Informasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin keluar ? <br>
                                Pastikan telah menjawab seluruh pertanyaan. <br>
                                Klik tombol 'Selesai' untuk menyelesaikan ujian <br>
                                Klik tombol 'Kembali' untuk kembali mengerjakan soal <br>
                                <a href="{{ route('ujian.Selesai.Submit') }}" class="btn btn-danger mt-2">Selesai</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>

                            </div>
                            </div>
                        </div>
                    </div> --}}
                  {{-- modal --}}
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>
