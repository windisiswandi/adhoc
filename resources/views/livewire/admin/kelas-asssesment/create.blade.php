<div>
{{--  --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" placeholder="Nama Kelas" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" value="{{ old('nama_kelas') }}" required autocomplete="nama_kelas" autofocus>
                            @error('nama_kelas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Waktu Pengerjaan</label>
                            <input id="waktu_pengerjaan" placeholder="Waktu Pengerjaan" type="number" class="form-control @error('waktu_pengerjaan') is-invalid @enderror" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan') }}" required autocomplete="waktu_pengerjaan">
                            @error('waktu_pengerjaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Assessment</label>
                            <input id="tanggal" type="date" placeholder="Tanggal Assessment" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" required autocomplete="tanggal" autofocus>
                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" style="width: 100%;" value="{{ old('kategori') }}" required wire:model = "idKategoriGet">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                            <div class="error invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jam</label>
                            <input id="jam" placeholder="Jam" type="time" class="form-control @error('jam') is-invalid @enderror" name="jam" value="{{ old('jam') }}" required autocomplete="jam">
                            @error('jam')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                  <div class="col-md-6">
                        @if (count($cekSoalPilihanGanda) > 0)
                                <div class="form-group">
                                    <label>Jumlah Soal Pilihan Ganda</label>
                                    <input id="jml_pil_ganda" placeholder="Jumlah Soal Pilihan Ganda" type="number" class="form-control @error('jml_pil_ganda') is-invalid @enderror" name="jml_pil_ganda" value="{{ old('jml_pil_ganda') }}"  autocomplete="jml_pil_ganda" >
                                    @error('jml_pil_ganda')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        @endif

                        @if (count($cekSoalSebabAkibat) > 0)
                            <div class="form-group">
                                <label>Jumlah Soal Sebab Akibat</label>
                                <input id="jml_sebab_akibat" placeholder="Jumlah Soal Sebab Akibat" type="number" class="form-control @error('jml_sebab_akibat') is-invalid @enderror" name="jml_sebab_akibat" value="{{ old('jml_sebab_akibat') }}" autocomplete="jml_sebab_akibat" >
                                @error('jml_sebab_akibat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        @if (count($cekSoalBenarSalah) > 0)
                            <div class="form-group">
                                <label>Jumlah Soal Benar Salah</label>
                                <input id="jml_benar_salah" placeholder="Jumlah Soal Benar Salah" type="number" class="form-control @error('jml_benar_salah') is-invalid @enderror" name="jml_benar_salah" value="{{ old('jml_benar_salah') }}" autocomplete="jml_benar_salah" >
                                @error('jml_benar_salah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        @if (count($cekSoalMetodeSkala) > 0)
                            <div class="form-group">
                                <label>Jumlah Soal Metode Skala</label>
                                <input id="jml_metode_skala" placeholder="Jumlah Soal Metode Skala" type="number" class="form-control @error('jml_metode_skala') is-invalid @enderror" name="jml_metode_skala" value="{{ old('jml_metode_skala') }}"  autocomplete="jml_metode_skala" >
                                @error('jml_metode_skala')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
{{--  --}}
</div>
