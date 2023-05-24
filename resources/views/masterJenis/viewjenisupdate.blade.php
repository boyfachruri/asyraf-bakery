<form action="{{ url('updatejenis') }}" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}" readonly />
    <input name="id" id="id" type="hidden" readonly />
    <div class="form-group"> <label class="form-label" for="nama_jenis">Masukkan Nama Jenis</label>
        <div class="form-control-wrap"> <input type="text" class="form-control" name="nama_jenis" id="nama_jenis"
                placeholder="Nama Jenis" required>
        </div>
    </div>
    <div class="form-group"> <label class="form-label" for="kode_jenis">Masukkan Kode Jenis</label>
        <div class="form-control-wrap"> <input type="text" class="form-control" name="kode_jenis" id="kode_jenis"
                placeholder="Kode Jenis"> </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-outline-primary" data-dismiss="modal">Batal</a>
        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
    </div>
</form>

<script text="text/javascript">
    var id = $('#modalDefault').data('id');
    // alert(id);
    $('#id').val(id);

    $.getJSON("{{ url('/getIdJenis') }}" + "/" + id, function(data) {
        $('#nama_jenis').val(data.nama_jenis);
        $('#kode_jenis').val(data.kode_jenis);
        // $('#password').val(data.password);
        // $('#tipe_akun').val(data.tipe_akun);
    })

    $('.select2').select2();
</script>
