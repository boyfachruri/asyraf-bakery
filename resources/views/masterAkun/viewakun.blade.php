<form action="{{ url('tambahakun') }}" method="post" >
    <input name="_token" type="hidden" value="{{ csrf_token() }}" readonly />
    <div class="form-group"> <label class="form-label" for="name">Masukkan Nama</label>
        <div class="form-control-wrap"> <input type="text" class="form-control" name="name" id="name"
                placeholder="Nama" required>
        </div>
    </div>
    <div class="form-group"> <label class="form-label" for="email">Masukkan Email</label>
        <div class="form-control-wrap"> <input type="email" class="form-control" name="email" id="email"
                placeholder="Email" required> </div>
    </div>
    <div class="form-group"> <label class="form-label" for="password">Masukkan Password</label>
        <div class="form-control-wrap">
            <div class="input-group"> <input type="password" class="form-control" name="password" id="password"
                    placeholder="Password" required autocomplete="new-password">
                <div class="input-group-append"> <span class="input-group-text pass1" id="basic-addon2"><em
                            class="icon ni ni-eye"></em></span> </div>
            </div>
        </div>
    </div>



    <div class="form-group"> <label class="form-label" for="re-password">Masukkan Password Lagi</label>
        <div class="form-control-wrap">
            <div class="input-group"> <input type="password" class="form-control" name="re-password" id="re-password"
                    placeholder="Password" required>
                <div class="input-group-append">
                    <span class="input-group-text bg-white ck1" id="basic-addon2">
                        <em class="icon ni ni-cross bg-danger-dim"></em>
                    </span>
                    <span class="input-group-text pass2" id="basic-addon2">
                        <em class="icon ni ni-eye"></em>
                    </span>
                </div>
            </div>
        </div>
    </div>
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
        <button type="submit" class="btn btn-primary" id="btnSave" disabled="true">Simpan</button>
    </div>
</form>

<script text="text/javascript">
    // if ($('#re-password').val() == $('#password').val()) {
    //     $('#message').html('Cocok').css('color', 'green');
    //     $('#btnSave').disabled = "false";
    // }

    // if ($('#tipe_akun)').val('0') ) {
    //     document.getElementById("btnSave").disabled = true;
    // }

    // $('#tipe_akun').click(function()
    // {
    //     if ($('tipe_akun').val("0"))
    //     {
    //         document.getElementById("btnSave").disabled = true;
    //         // $('#btnSave').disabled = "false";
    //     } else {
    //         document.getElementById("btnSave").disabled = false;
    //         // $('#btnSave').disabled = "true";
    //     }
    // });

    if ($('#tipe_akun').val() == "") {
        document.getElementById("btnSave").disabled = true;
    } else {
        document.getElementById("btnSave").disabled = false;
    }

    // untuk menyamakan password dan button submit aktif
    $('#password, #re-password').on('keyup', function() {
        if ($('#re-password').val() == $('#password').val()) {
            // $('#pesan').html('Cocok').css('color', 'green');
            $('.ck1').find('em').removeClass('icon ni ni-cross bg-danger-dim');
            $('.ck1').find('em').addClass('icon ni ni-check bg-success-dim');
            document.getElementById("btnSave").disabled = false;
            // alert($('#tipe_akun').val());
        } else {
            // $('#pesan').html('Tidak Cocok').css('color', 'red');
            $('.ck1').find('em').removeClass('icon ni ni-check bg-success-dim');
            $('.ck1').find('em').addClass('icon ni ni-cross bg-danger-dim');
            document.getElementById("btnSave").disabled = true;
            // alert($('#tipe_akun').val());
        }
    });

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

    $('.select2').select2();
</script>
