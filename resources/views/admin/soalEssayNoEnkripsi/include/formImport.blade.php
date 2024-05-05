<form action="{{ route('import.Soal.Essay.No.Enkripsi') }}" method="POST" enctype="multipart/form-data">
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
