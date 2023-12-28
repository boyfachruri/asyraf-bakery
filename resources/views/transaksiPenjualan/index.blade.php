@extends('welcome')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Transaksi Penjualan</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block table-responsive">
                <table id="tb_penjualan" class="table nk-tb-list nk-tb-ulist" data-auto-responsive="false" width="100%"
                    style="color: #000000">
                    <thead style="color: #9d72ff">
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Total Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div><!-- .nk-block -->
        </div>
    </div>

    <script type="text/javascript">
        var tb_penjualan;
        var tb_penjualan = $('#tb_penjualan').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            ajax: "{{ url('/getTablePenjualan') }}",
            columns: [{
                    data: null,
                    width: '1px',
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1 + '.';
                    }
                },
                {
                    data: 'no_transaksi'
                },
                {
                    data: 'total_transaksi'
                },
                {
                    data: 'tanggal_transaksi',
                    render: function(data, type, row) {
                        // console.log(row);
                        var tahun = data.substr(0, 4);
                        var bulan = data.substr(5, 2);
                        var tanggal = data.substr(8, 2);
                        var waktu = data.substr(11, 8);
                        return tanggal + "/" + bulan + "/" + tahun + " " + waktu;
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        var statusColorClass = (data.toLowerCase() === 'cancelled') ? 'text-danger' : 'text-success';
                        return '<span class="' + statusColorClass + '">' + data + '</span>';
                    }
                },
                // {
                //     data: 'no_transaksi',
                //     render: function(data, type, row) {
                //         return '<div class="drodown">' +
                //             '<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">' +
                //             '<em class="icon ni ni-more-h"></em></a>' +
                //             '<div class="dropdown-menu dropdown-menu-right">' +
                //             '<ul class="link-list-opt no-bdr">' +
                //             '<li><a href="#" onClick=hapusProduk("'+row.no_transaksi+'")><em class="icon ni ni-delete"></em><span>Hapus</span></a></li>' +
                //             '<li><a href="#" onClick=editProduk("'+row.no_transaksi+'")><em class="icon ni ni-edit"></em><span>Edit</span></button></li>' +
                //             '</ul>' +
                //             '</div>' +
                //             '</div>';
                //     }
                // },
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '<a class="btn btn-icon btn-trigger"><em class="icon ni ni-plus-sm"></em></a>',
                },
                {
                    data: 'id_penjualan',
                    render: function(data, type, row) {
                        return '<div class="drodown">' +
                            '<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">' +
                            '<em class="icon ni ni-more-h"></em></a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<ul class="link-list-opt no-bdr">' +
                            '<li><a href="#" onClick=hapusProduk("'+row.id_penjualan+'")><em class="icon ni ni-delete"></em><span>Cancel</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>';
                    }
                }
            ],
            // dom: '<"toolbar akun">frtip',
        });

        $('#tb_penjualan tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = tb_penjualan.row(tr);

            if (row.child.isShown()) {
                $(this).find('em').removeClass('icon ni ni-minus-sm');
                $(this).find('em').addClass('icon ni ni-plus-sm');
                // This row is already open - close it
                row.child.hide();
                // tr.removeClass('shown');
            } else {
                // Open this row
                $(this).find('em').removeClass('icon ni ni-plus-sm');
                $(this).find('em').addClass('icon ni ni-minus-sm');
                var data = row.data();
                // row.child(detailPenjualan(data)).show();
                row.child(detailPenjualan(data)).show();
                // tr.addClass('shown');
            }
        });

        function detailPenjualan(d) {

            // console.log("test", d);
            $.getJSON("{{ url('getTablePenjualanDetail') }}" + "/" + d.no_transaksi, function (data) {
                console.log('tampil', data);
                $.each(data, function( key, val ) {
                
                $('#bodystatus'+d.no_transaksi).append(
                    '<tr>'+
                        '<td>'+val.nama_produk+'</td>'+
                        '<td><b>'+val.quantity+'</b></td>'+
                        '<td>'+val.total_harga+'</td>'+
                    '</tr>'
                )
            });
            })

            var html =
                '<div class="card card-preview">' +
                     '<div class="card-inner">' + 
                        '<div class="row g-4">'+
                    // '<div class="col-lg-5">'+
                    // '</div>'+
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<span class="card-text"><h6><b>Detail Produk</b></h6></span>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<div class="table-responsive">'+
                                '<table class="table nk-tb-list nk-tb-ulist" data-auto-responsive="false" id="tb_detail" width="100%">'+
                                    '<thead>'+
                                        '<tr class="nk-tb-item nk-tb-head">'+
                                            '<th class="nk-tb-col"><span class="sub-text">Nama Produk</span></th>'+
                                            '<th class="nk-tb-col"><span class="sub-text">Qty</span></th>'+
                                            '<th class="nk-tb-col"><span class="sub-text">Total Harga</span></th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody id = "bodystatus'+d.no_transaksi+'">'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                    '</div>'+
                '</div>';
            return html;
        }

        function hapusProduk(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'Data akan di cancel',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then(function(a) {
                if (a.value == true) {
                    Delete(id);
                } else {
                    //block(false,'.content-body');
                }
            })
        }

        function Delete(id) {
            $.ajax({
                url: "{{ url('/cancelPenjualan') }}",
                type: "POST",
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(event, data) {
                    Swal.fire("Information", event.Pesan, "success");
                    tb_penjualan.ajax.reload(null, true);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("Information", textStatus + ' Save : ' + errorThrown, "warning");
                }
            });
        }

        // $("div.akun").html(
        //     '<button type="button" id="tambahakun" class="btn btn-info"> Tambah </button>'
        // );
    </script>
@endsection
