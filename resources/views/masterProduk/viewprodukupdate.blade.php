<form action="{{ url('updateproduk') }}" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}" readonly />
    <input name="id" id="id" type="hidden" readonly />
    <div class="form-group"> <label class="form-label" for="nama_produk">Nama Produk</label>
        <div class="form-control-wrap"> <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                placeholder="Masukkan Nama Produk" required>
        </div>
    </div>
    <div class="form-group"> <label class="form-label" for="kode_produk">Kode Produk</label>
        <div class="form-control-wrap"> <input type="text" class="form-control" name="kode_produk" id="kode_produk"
                placeholder="Masukkan Kode Produk"> </div>
    </div>
    <div class="form-group"> <label class="form-label" for="harga">Harga Produk</label>
        <div class="form-control-wrap">
            <div class="input-group">
                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2"><em class="icon ni ni-sign-idr"></em></span> </div>
                <input type="number" class="form-control" name="harga" id="harga"
                    placeholder="Masukkan Harga Produk" required>                
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="kode_jenis">Jenis Produk</label>
        <div class="form-control-wrap ">
            <select data-placeholder="Pilih Jenis" class="form-control select2" name="kode_jenis" id="kode_jenis"
                required>
                <option value=""></option>
                @foreach ($dropdown as $key)
                    <option value="{{ $key->kode_jenis }}">
                        {{ $key->nama_jenis }}
                    </option>
                @endforeach
            </select>
        </div>
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

    $.getJSON("{{ url('/getIdProduk') }}" + "/" + id, function(data) {
        $('#nama_produk').val(data[0].nama_produk);
        $('#kode_produk').val(data[0].kode_produk);
        $('#harga').val(data[0].harga);
        $('#kode_jenis').val(data[0].kode_jenis).trigger('change');
        // $('#password').val(data.password);
        // $('#tipe_akun').val(data.tipe_akun);
    })

    $('.select2').select2();
</script>
