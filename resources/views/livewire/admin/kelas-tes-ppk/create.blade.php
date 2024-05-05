<div>
    {{-- --}}
    <form>
        @csrf
        <div class="card-header">
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" placeholder="Nama Kelas" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas" value="{{ old('nama_kelas') }}" required autocomplete="nama_kelas" autofocus wire:model="wrNamaKelas">
                        @error('wrNamaKelas') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Waktu Pengerjaan</label>
                        <input id="waktu_pengerjaan" placeholder="Waktu Pengerjaan Berdasarkan Hitungan Menit" type="number" class="form-control @error('waktu_pengerjaan') is-invalid @enderror" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan') }}" required autocomplete="waktu_pengerjaan" wire:model="wRWaktuPengerjaan">
                        @error('wRWaktuPengerjaan') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    {{-- <div class="form-group">
                            <label>Jam</label>
                            <input id="jam" placeholder="Jam" type="time" class="form-control @error('jam') is-invalid @enderror" name="jam" value="{{ old('jam') }}" required autocomplete="jam" wire:model="wRJam">
                    @error('wRJam') <span class="text-danger error">{{ $message }}</span>@enderror
                </div> --}}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Tes</label>
                    <input id="tanggal" type="date" placeholder="Tanggal Assessment" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" required autocomplete="tanggal" autofocus wire:model="wRTanggal">
                    @error('wRTanggal') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Jumlah Soal Essay</label>
                    <input id="jml_essay" placeholder="Jumlah Soal Essay" type="number" class="form-control @error('jml_essay') is-invalid @enderror" name="jml_essay" value="{{ old('jml_essay') }}" autocomplete="jml_essay" wire:model="jumlahSoalEssay">
                    @error('jumlahSoalEssay') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Jumlah Soal Pilihan Ganda</label>
                    <input id="jml_pil_ganda" placeholder="Jumlah Soal Pilihan Ganda" type="number" class="form-control @error('jml_pil_ganda') is-invalid @enderror" name="jml_pil_ganda" value="{{ old('jml_pil_ganda') }}" autocomplete="jml_pil_ganda" wire:model="jumlahSoalGanda">
                    @error('jumlahSoalGanda') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
        </div>
</div>
</div>

<div class="card-body">
    <div class="row text-center">
        <div class="col-md-9">
            
        </div>
        <div class="col-md-3 ">
            <th>{{__('Jml Soal Dg Tingkat Kesulitan')}}</th>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-4">
            <th>{{__('Standar Kompetensi')}}</th>
        </div>
        <div class="col-md-5">
            <th>{{__('Materi Pokok')}}</th>
        </div>
        <div class="col-md-1">
            <th>{{__('Mudah')}}</th>
        </div>
        <div class="col-md-1">
            <th>{{__('Sedang')}}</th>
        </div>
        <div class="col-md-1">
            <th>{{__('Sulit')}}</th>
        </div>
    </div>
    <hr>
    @if (!is_null($jumlahSoalGanda))
    @foreach ($soalBerdasarkanMateriPokok as $key =>$value)
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" value="{{ $value->getStandarKompetensi->nama }}" readonly class="form-control">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <input id="" type="text" class="form-control @error('') is-invalid @enderror" name="" value="{{ $value->nama }}" readonly>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input id="" @if(!$value->kriteriaMudah($value->id))readonly @endif placeholder="Mudah" type="number" style="border-color: green;" class="form-control @error('') is-invalid @enderror" name="" value="{{ $value->id  }}" autocomplete="" wire:model="wROpsiPertama.{{ $value->id }}">
                @error('')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input id="" @if(!$value->kriteriaSedang($value->id))readonly @endif  placeholder="Sedang" type="number" class="form-control is-warning @error('') is-invalid @enderror" name="" value="{{ old('') }}" autocomplete="" wire:model="wROpsiKedua.{{ $value->id }}">
                @error('')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input id="" @if(!$value->kriteriaSulit($value->id))readonly @endif  placeholder="Sulit" type="number" style="border-color: red;" class="form-control @error('') is-invalid @enderror" name="" value="{{ old('') }}" autocomplete="" wire:model="wROpsiKetiga.{{ $value->id }}">
                @error('')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>


<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" wire:click.prevent="store()">Save</button>
            @if (session()->has('message'))
            <div class="alert alert-{{ $alert }}">
                {{ session('message') }}
            </div>
            @endif
            @if ($alert == 'success')
            <!-- <a href="#" type="button" class="btn btn-warning">Tambah Baru</a> -->
            <a href="{{ route('kelas.Ppk.Tes.Index') }}" type="button" class="btn btn-secondary">Kembali</a>
            @endif
        </div>
    </div>
</div>
</form>






{{-- --}}
</div>