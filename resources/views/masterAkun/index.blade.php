@extends('welcome')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Data Akun</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="more-options">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <!-- Modal Trigger Code -->
                                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault"><em class="icon ni ni-plus"></em><span>Tambah</span></button> --}}
                                        <button type="button" class="btn btn-primary" id="adduser"><em class="icon ni ni-plus"></em><span>Tambah</span></button>
                                        {{-- <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                        <a href="#" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Tambah</span></a> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block table-responsive">
                <table id="tb_akun" class="table nk-tb-list nk-tb-ulist" data-auto-responsive="false" width="100%" style="color: black">
                    <thead style="color: #9d72ff">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tipe Akun</th>
                        <th>Tanggal Buat</th>
                        <th></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div><!-- .nk-block -->
        </div>
    </div>

    <script type="text/javascript">
        var tb_akun;
        var tb_akun = $('#tb_akun').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: "{{ url('/getTableAkun') }}",
            columns: [{
                    data: null,
                    width: '1px',
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1 + '.';
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'tipe_akun'
                },
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        var tahun = data.substr(0, 4);
                        var bulan = data.substr(5, 2);
                        var tanggal = data.substr(8, 2);
                        return tanggal + "/" + bulan + "/" + tahun;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return '<div class="drodown">' +
                            '<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">' +
                            '<em class="icon ni ni-more-h"></em></a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<ul class="link-list-opt no-bdr">' +
                            '<li><a href="#" onClick=hapusUser("'+row.id+'")><em class="icon ni ni-delete"></em><span>Hapus</span></a></li>' +
                            '<li><a href="#" onClick=editUser("'+row.id+'")><em class="icon ni ni-edit"></em><span>Edit</span></button></li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>';
                    }
                }
            ],
            // dom: '<"toolbar akun">frtip',
        });

        $('#adduser').click(function() {
            $('#modaldialog').addClass('modal-sm');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Tambah Akun');
            $('#modalbody').load('viewakun');
            $('#modalDefault').data('id', 0);
            $('#modalDefault').modal('show');
            $('.modal-footer').hide();
        })

        // $('#edituser').click(function() {
        function editUser(id) {
            // alert(id);
            $('#modaldialog').addClass('modal-sm');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Akun');
            $('#modalbody').load('viewakunupdate');
            $('#modalDefault').data('id', id);
            $('#modalDefault').modal('show');
            $('.modal-footer').hide();
        }

        function hapusUser(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'Data akan terhapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then(function(a){
                if (a.value==true)
                {
                    Delete(id);
                } else {
                    //block(false,'.content-body');
                }
            })
            // alert(id);
            // $('#modaldialog').addClass('modal-sm');
            // $('#modaltitle').addClass('white');
            // $('#modaltitle').html('Edit Akun');
            // $('#modalbody').load('viewakunupdate');
            // $('#modalDefault').data('id', id);
            // $('#modalDefault').modal('show');
            // $('.modal-footer').hide();
        }

        function Delete(id) {
            $.ajax({
                url : "{{ url('/deleteAkun') }}",
                type:"POST",
                data: { id: id,"_token": "{{ csrf_token() }}" },
                dataType:"json",
                success:function(event, data){
                    Swal.fire("Information",event.Pesan,"success");
                    tb_akun.ajax.reload(null,true);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    Swal.fire("Information",textStatus+' Save : '+errorThrown,"warning");
                }
            });
        }

        // $("div.akun").html(
        //     '<button type="button" id="tambahakun" class="btn btn-info"> Tambah </button>'
        // );
    </script>
@endsection
