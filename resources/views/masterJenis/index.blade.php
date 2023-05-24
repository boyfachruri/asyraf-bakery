@extends('welcome')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Data Jenis</h3>
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
                                        <button type="button" class="btn btn-primary" id="addjenis"><em class="icon ni ni-plus"></em><span>Tambah</span></button>
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
                <table id="tb_jenis" class="table nk-tb-list nk-tb-ulist" data-auto-responsive="false" width="100%" style="color: #000000">
                    <thead style="color: #9d72ff">
                        <th>No</th>
                        <th>Nama Jenis</th>
                        <th>Kode Jenis</th>
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
        var tb_jenis;
        var tb_jenis = $('#tb_jenis').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: "{{ url('/getTableJenis') }}",
            columns: [{
                    data: null,
                    width: '1px',
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1 + '.';
                    }
                },
                {
                    data: 'nama_jenis'
                },
                {
                    data: 'kode_jenis'
                },
                {
                    data: 'tgl_buat',
                    render: function(data, type, row) {
                        var tahun = data.substr(0, 4);
                        var bulan = data.substr(5, 2);
                        var tanggal = data.substr(8, 2);
                        return tanggal + "/" + bulan + "/" + tahun;
                    }
                },
                {
                    data: 'id_jenis',
                    render: function(data, type, row) {
                        return '<div class="drodown">' +
                            '<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">' +
                            '<em class="icon ni ni-more-h"></em></a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<ul class="link-list-opt no-bdr">' +
                            '<li><a href="#" onClick=hapusJenis("'+row.id_jenis+'")><em class="icon ni ni-delete"></em><span>Hapus</span></a></li>' +
                            '<li><a href="#" onClick=editJenis("'+row.id_jenis+'")><em class="icon ni ni-edit"></em><span>Edit</span></button></li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>';
                    }
                }
            ],
            // dom: '<"toolbar akun">frtip',
        });

        $('#addjenis').click(function() {
            $('#modaldialog').addClass('modal-sm');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Tambah Jenis Produk');
            $('#modalbody').load('viewjenis');
            $('#modalDefault').data('id', 0);
            $('#modalDefault').modal('show');
            $('.modal-footer').hide();
        })

        // $('#edituser').click(function() {
        function editJenis(id) {
            // alert(id);
            $('#modaldialog').addClass('modal-sm');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Jenis Produk');
            $('#modalbody').load('viewjenisupdate');
            $('#modalDefault').data('id', id);
            $('#modalDefault').modal('show');
            $('.modal-footer').hide();
        }

        function hapusJenis(id) {
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
        }

        function Delete(id) {
            $.ajax({
                url : "{{ url('/deleteJenis') }}",
                type:"POST",
                data: { id: id,"_token": "{{ csrf_token() }}" },
                dataType:"json",
                success:function(event, data){
                    Swal.fire("Information",event.Pesan,"success");
                    tb_jenis.ajax.reload(null,true);
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
