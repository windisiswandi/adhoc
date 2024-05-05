<script>
    $(function () {
      $('#jawabanEssay').summernote()
    })
</script>

<div class="content" id="read">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-lg-8">
                @if ($soalEssay->count())
                <div class="card">
                    <div class="card-header">
                        No. {{ $index + 1 }} <br>
                    </div>
                    <div class="card-body">
                            @php echo Crypt::decrypt($masterSoalEssay['soal']); @endphp
                            <div class="form-group clearfix">
                                <div class="form-group mt-3">
                                    <textarea class="form-control"  id="jawabanEssay" cols="30" rows="10">{{$soalEssay[$index]['jawaban']}}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id_peserta" id="id_peserta" value="{{ $idPeserta }}">
                            <input type="hidden" name="id_soal" id="id_soal" value="{{ $masterSoalEssay['id'] }}">
                            <input type="hidden" name="index" id="index" value="{{ $index }}">
                            @php
                               $totalsoalEssay = $soalEssay->count();
                            @endphp
                            <input type="hidden" name="total_soal_essay" id="total_soal_essay" value="{{ $totalsoalEssay }}">

                            <button class="btn btn-info" onClick="simpanJawabanAndNext()">simpan <i class="fas fa-arrow-right"></i></button>
                    </div>

                </div>
                @endif
            </div>

            <div class="col-lg-4">
                @if($soalEssay->count())
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">Matriks Jawaban Pilihan Essai</h6>
                    </div>
                    <div class="card-body text-justify">
                        @foreach ($soalEssay as $key => $item)
                            <button class="btn btn-{{ $item['jawaban'] == null ? 'outline-' : '' }}success btn-sm mb-1 btn-none" onClick="tampilSoal({{ $key }})">
                                @php $no = $key + 1; @endphp
                                {{ $no < 10 ? '0' . $no : $no }}
                            </button>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- @if ($index+1 == $totalsoalEssay)
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
