@extends('admin.master')

@section('title','Daftar Calon Peserta')
@section('layout','Daftar Calon Peserta')
@section('menuPpk','text-primary text-bold')
@section('menuCalonPeserta','active')
@section('parent','Master Data')
@section('child','Daftar Calon Peserta')

@section('cssTambahan')
<link rel="stylesheet" href="{{ asset('css/bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTable.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap4DataTableResponsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
@endsection

@section('jsTambahan')
<script type="text/javascript" src="{{ asset('js/DataTablesFlexible/Newjquery-3.5.1.js') }}"> </script>
<script type="text/javascript" src="{{ asset('js/DataTablesFlexible/Newjquery.dataTables.min.js') }}"> </script>
<script type="text/javascript" src="{{ asset('js/DataTablesFlexible/NewdataTables.bootstrap4.min.js') }}"> </script>
<script src="{{ asset('js/SweatAlert/sweetalert2@10.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function () {
    bsCustomFileInput.init();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-user').DataTable({
            buttons: [
        'copy', 'excel', 'pdf'
    ],
            processing: true,
            serverSide: true,
            ajax: '{{ route("calon.Peserta.Index.Get.Json") }}',
            columns: [
                {   "data": null,
                    "class": "align-top",
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                },
                {"name": "name", "data": "name"},
                {"name": "no_pendaftaran", "data": "no_pendaftaran"},
                {"name": "wilayah", "data": "wilayah"},
                {
                    "orderable": true,
                    "searchable": true,
                    data: function(row) {
                        let aksi = '<span class="text-success">Telah Memiliki Kelas</span>';
                        if (row.status == null) {
                            aksi = '<span class="text-danger">Belum Memiliki Kelas</span>';
                        }
                        return aksi;
                    }
                },
                {
                "orderable": true,
                "searchable": true,
                data: function(row) {
                    let editCalonPeserta = `<a href="{{ route('calon.Peserta.Edit', '') }}/${row.id}" class="badge badge-primary">Edit Calon Peserta</a> `;
                    let hapusCalonPeserta = `<a href="{{ route('calon.Peserta.Hapus', '') }}/${row.id}" class="badge badge-danger" data-confirm-delete="true">Hapus Calon Peserta</a> `;
                    let hapusSesi = `<a href="{{ route('calon.Peserta.Hapus.Sesi', '') }}/${row.id}" class="badge bg-warning">Hapus Sesi Aktif</a>`;
                    if (row.status != null) {
                        hapusCalonPeserta = '';
                        editCalonPeserta ='';
                    }
                        return editCalonPeserta + hapusCalonPeserta + hapusSesi;
                    }
                }

            ]
        });
    });

</script>
@endsection




@section('content')
<div class="row">
    <div class="col-12 mb-2">
        <div class="btn-group" role="group">
            <a href="{{ route('calon.Peserta.Create') }}" class="btn btn-success">{{ 'Tambah Data' }}</a>
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalImportExcel">{{ 'Import Excel' }}</a>
            <a href="{{ asset('Dokumen/FormatImportCalonPeserta_Import.xlsx') }}" class="btn btn-primary">Unduh Format Excel</a>
        </div>
    </div>
</div>




{{-- Start Modal import Data --}}
<div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Import Data Calon Peserta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                {{--  --}}
                <form action="{{ route('calon.Peserta.Import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            @csrf
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih File</label>
                                    </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </div>
                    </form>
                {{--  --}}
        </div>
    </div>
</div>
{{-- end Modal Import Data --}}

<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
                @endif
                @if (session()->has('failures'))
                    <table class="table table-danger">
                        <tr>
                            <td>Baris</td>
                            <td>Attribut</td>
                            <td>Error</td>
                            <td>Value</td>
                        </tr>
                        @foreach (session()->get('failures') as $item)
                        <tr>
                            <td>{{ $item->row() }}</td>
                            <td>{{ $item->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->errors() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $item->values()[$item->attribute()] }}</td>
                        </tr>
                        @endforeach
                    </table>
                @endif


                <div class="table-responsive">
                    <div id="table1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                        <div class="row dt-row">
                            <div class="col-sm-12">
                                <table class="table dataTable no-footer table-bordered table-striped dtr-inline" id="tabel-user" style="width:100%" aria-describedby="tabel-user">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0">No</th>
                                            <th class="sorting" tabindex="0">Nama</th>
                                            <th class="sorting" tabindex="0">No Pendaftaran</th>
                                            <th class="sorting" tabindex="0">Wilayah</th>
                                            <th class="sorting" tabindex="0">Status</th>
                                            <th class="sorting" tabindex="0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="callout callout-info">
            *) Peserta login menggunakan password angka 12345678<br>
            **) <span class="badge bg-warning">Hapus Sesi Aktif</span> untuk mengijinkan peserta login ulang
        </div>

    </div>
</div>




    <!-- MULAI MODAL KONFIRMASI DELETE-->

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b></b></p>
                    <p>Apakah Anda Yakin Menghapus Data Calon Peserta</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                        Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKHIR MODAL -->

     <!-- MULAI MODAL KONFIRMASI DELETE-->

     <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal-sesi" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> Apakah Anda Yakin Menghapus Sesi Peserta ? <br>
                        Dengan menghapus sesi, maka Peserta Ujian diizinkan untuk login kembali ke dalam Aplikasi CAT  dan melanjutkan Ujian<br>
                        Note : Menghapus sesi bukanlah menghapus data peserta
                    </p>
                    {{-- <p>
                        Dengan menghapus sesi, maka Peserta Ujian diizinkan untuk login kembali ke dalam Aplikasi CAT
                    </p> --}}
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus-sesi">Hapus
                        Sesi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKHIR MODAL -->

@endsection
