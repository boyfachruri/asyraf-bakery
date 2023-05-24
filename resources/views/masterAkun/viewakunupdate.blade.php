<form action="{{ url('updateakun') }}" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}" readonly />
    <input name="id" id="id" type="hidden" readonly />
    <div class="form-group"> <label class="form-label" for="name">Masukkan Nama</label>
        <div class="form-control-wrap"> <input type="text" class="form-control" autocomplete="off" name="name"
                id="name" placeholder="Nama" required>
        </div>
    </div>
    <div class="form-group"> <label class="form-label" for="email">Masukkan Email</label>
        <div class="form-control-wrap"> <input type="email" class="form-control" autocomplete="off" name="email"
                id="email" placeholder="Email" required> </div>
    </div>
    {{-- test --}}
    {{-- <div class="form-group"> <label class="form-label"
        for="password">Masukkan Password</label>
    <div class="form-control-wrap"> <input type="password"
            class="form-control" autocomplete="off" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group"> <label class="form-label"
        for="re-password">Masukkan Password Lagi</label>
    <div class="form-control-wrap"> <input type="password"
            class="form-control" autocomplete="off" name="re-password" id="re-password" placeholder="Re-Password">
    </div> --}}
    <div class="form-group">
        <label class="form-label" for="tipe_akun">Tipe Akun</label>
        <div class="form-control-wrap ">
            <select data-placeholder="Pilih Tipe Akun" class="form-control select2" name="tipe_akun" id="tipe_akun"
                required>
                <option value=""></option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn btn-outline-primary" data-dismiss="modal">Batal</a>
        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
        {{-- <a href="#" class="btn btn-primary">Simpan</a> --}}
    </div>
</form>




<script text="text/javascript">
    var id = $('#modalDefault').data('id');
    // alert(id);
    $('#id').val(id);

    $.getJSON("{{ url('/getIdAkun') }}" + "/" + id, function(data) {
        $('#name').val(data.name);
        $('#email').val(data.email);
        // $('#password').val(data.password);
        $('#tipe_akun').val(data.tipe_akun);
    })

    



    //untuk show password
    var showPass = 0;
    $('.pass1').on('click', function() {
        if (showPass == 0) {
            console.log($(this));
            $("#password").prop("type", "text");
            $(this).find('em').removeClass('icon ni ni-eye');
            $(this).find('em').addClass('icon ni ni-eye-off');
            showPass = 1;
        } else {
            console.log($(this));
            $("#password").prop("type", "password");
            $(this).find('em').removeClass('icon ni ni-eye-off');
            $(this).find('em').addClass('icon ni ni-eye');
            showPass = 0;
        }
    });

    var showPass2 = 0;
    $('.pass2').on('click', function() {
        if (showPass2 == 0) {
            $("#re-password").prop("type", "text");
            $(this).find('em').removeClass('icon ni ni-eye');
            $(this).find('em').addClass('icon ni ni-eye-off');
            showPass2 = 1;
        } else {
            $("#re-password").prop("type", "password");
            $(this).find('em').removeClass('icon ni ni-eye-off');
            $(this).find('em').addClass('icon ni ni-eye');
            showPass2 = 0;
        }
    });

    // $('.select2').select2();
</script>
