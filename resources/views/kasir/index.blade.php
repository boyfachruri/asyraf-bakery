@extends('welcome')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="container">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Transaksi Penjualan</h3>
                </div>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabItem5">
                            <span>Pilih Produk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabItem6">
                            <span>Produk Yang Dipilih</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabItem5">
                        {{-- <div class="col-md-6"> --}}
                        {{-- <h5 style="color: #9d72ff">Pilih Produk</h5> --}}
                        <ul id="available-products" class="list-group">
                            <!-- Contoh produk -->
                            @foreach ($produk as $item)
                                <li class="list-group-item product-item" data-product-id="{{ $item->id_produk }}"
                                    data-product-name="{{ $item->nama_produk }}" data-product-price="{{ $item->harga }}">
                                    {{ $item->nama_produk }} <br> Harga: {{ $item->harga }}
                                    <button type="button"
                                        class="btn btn-success btn-sm float-right add-product-btn">Tambah</button>
                                </li>
                            @endforeach
                            <!-- Tambahkan produk lainnya sesuai kebutuhan -->
                        </ul>
                        <div id="empty-available-products" class="list-group">
                            <li class="list-group-item">Tidak Ada Produk</li>
                        </div>
                        {{-- </div> --}}
                    </div>
                    <div class="tab-pane" id="tabItem6">
                        <div>
                            {{-- <h5 style="color: #9d72ff">Produk yang Dipilih</h5> --}}
                            <ul id="selected-products" class="list-group">
                                <!-- Produk yang dipilih akan ditampilkan di sini -->
                            </ul>
                            <div id="total-price-container" style="display: none;">
                                <li class="list-group-item"><b> Harga: <span id="total-price">Rp. 0</span></b></li>
                            </div>
                            <div class="text-right" id="process-order-container" style="display: none;">
                                <button type="button" class="btn btn-primary" id="process-order-btn">Proses
                                    Pesanan</button>
                            </div>
                            <div id="empty-selected-products" class="list-group">
                                <li class="list-group-item">Tidak Ada Produk</li>
                            </div>

                        </div>
                    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Fungsi untuk menambah produk ke daftar yang dipilih
                        $('#available-products').on('click', '.add-product-btn', function() {
                            var productItem = $(this).closest('.product-item');
                            var productId = productItem.data('product-id');
                            var productName = productItem.data('product-name');
                            console.log("productName", productItem.data());
                            var productPrice = productItem.data('product-price');

                            // Hapus dari menu kiri
                            productItem.hide();

                            // Tambahkan ke daftar yang dipilih
                            var selectedProductItem = $(
                                '<li class="list-group-item selected-product-item" data-product-id="' + productId +
                                '" data-product-price="' + productPrice + '">');
                            selectedProductItem.html('<div class="d-flex justify-content-between align-items-center">' +
                                '<span>' + productName + '</span>' +
                                '<input type="number" class="quantity-input ml-3" name="selected_quantity[' +
                                productId + ']" value="1" min="1">' +
                                '</div>');
                            selectedProductItem.append('<div class="price-per-item">Harga Satuan: Rp. ' + productPrice
                                .toLocaleString() + '</div>');
                            selectedProductItem.append(
                                '<button type="button" class="btn btn-danger btn-sm float-right remove-product-btn">Hapus</button>'
                            );

                            $('#selected-products').append(selectedProductItem);

                            // Hitung ulang total harga
                            updateTotalPrice();
                            updateEmptyProductMessage();
                        });

                        // Fungsi untuk menghapus produk dari daftar yang dipilih
                        $('#selected-products').on('click', '.remove-product-btn', function() {
                            var selectedProductItem = $(this).closest('.selected-product-item');
                            var productId = selectedProductItem.data('product-id');

                            // Hapus dari daftar yang dipilih
                            selectedProductItem.remove();

                            // Tambahkan kembali ke menu kiri
                            var availableProductItem = $('#available-products').find('[data-product-id="' + productId +
                                '"]');
                            availableProductItem.show();

                            // Hitung ulang total harga
                            updateTotalPrice();

                            // Tambahkan pemanggilan fungsi ini setelah menghapus produk
                            updateEmptyProductMessage();
                        });

                        // Fungsi untuk menghitung total harga
                        function updateTotalPrice() {
                            var total = 0;

                            // Loop melalui setiap produk yang dipilih
                            $('#selected-products .selected-product-item').each(function() {
                                var quantityInput = $(this).find('.quantity-input');
                                var quantity = parseInt(quantityInput.val()) ||
                                    1; // Jika kuantitas kosong atau tidak valid, set ke 1
                                quantityInput.val(quantity); // Update nilai input

                                var price = $(this).data('product-price');

                                // Hitung subtotal dan tambahkan ke total
                                var subtotal = quantity * parseFloat(price);
                                total += subtotal;

                                // Tampilkan harga dikali kuantitas di samping nama produk yang dipilih
                                var pricePerItemElement = $(this).find('.price-per-item');
                                pricePerItemElement.text('Harga: Rp. ' + subtotal.toLocaleString());
                            });

                            // Tampilkan total harga di luar tabel
                            $('#total-price').text('Rp. ' + total.toLocaleString());

                            // Tampilkan atau sembunyikan total harga container
                            if (total > 0) {
                                $('#total-price-container').show();
                            } else {
                                $('#total-price-container').hide();
                            }

                            // Tampilkan atau sembunyikan tombol "Proses Pesanan"
                            var selectedProductsCount = $('#selected-products .selected-product-item').length;
                            if (selectedProductsCount > 0) {
                                $('#process-order-container').show();
                            } else {
                                $('#process-order-container').hide();
                            }
                        }

                        // Fungsi untuk menampilkan pesan "Produk Kosong" jika tidak ada produk
                        function updateEmptyProductMessage() {
                            var availableProductsCount = $('#available-products .product-item:visible').length;
                            var selectedProductsCount = $('#selected-products .selected-product-item').length;

                            console.log(availableProductsCount, 'availableProductsCount');

                            if (availableProductsCount <= 0) {
                                $('#empty-available-products').show();
                            } else {
                                $('#empty-available-products').hide();
                            }

                            // Ganti ini dari == menjadi <=
                            if (selectedProductsCount <= 0) {
                                $('#empty-selected-products').show();
                                $('#total-price-container')
                            .hide(); // Sembunyikan total harga jika tidak ada produk yang dipilih
                                $('#process-order-container')
                            .hide(); // Sembunyikan tombol "Proses Pesanan" jika tidak ada produk yang dipilih
                            } else {
                                $('#empty-selected-products').hide();
                            }
                        }

                        // Event listener untuk tombol "Proses Pesanan"
                        $('#process-order-btn').on('click', function() {
                            // Lakukan proses pesanan di sini
                            var selectedProducts = [];
                            $('#selected-products .selected-product-item').each(function() {
                                var productId = $(this).data('product-id');
                                var quantity = parseInt($(this).find('.quantity-input').val()) || 1;

                                selectedProducts.push({
                                    id: productId,
                                    quantity: quantity
                                });
                            });

                            console.log(selectedProducts, "selectedProducts");

                            // Hitung total harga
                            var totalHarga = $('#total-price').text().replace('Rp. ', '').replace(',', '');
                            console.log(totalHarga, "totalHarga");

                            // Kirim data produk yang dipilih ke controller menggunakan AJAX


                            Swal.fire({
                                title: 'Apakah kamu yakin?',
                                text: 'Data akan di proses',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Batal'
                            }).then(function(a) {
                                if (a.value == true) {
                                    saveTr();
                                } else {
                                    //block(false,'.content-body');
                                }
                            })

                            function saveTr() {
                                $.ajax({
                                    type: "POST",
                                    url: '{{ route('process.order') }}',
                                    data: {
                                        selected_products: selectedProducts,
                                        total_harga: totalHarga,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    dataType: "json",
                                    success: function(event, data) {
                                        Swal.fire("Information", event.Pesan, "success");
                                        location.reload();;
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        Swal.fire("Information", textStatus + ' Save : ' + errorThrown,
                                            "warning");
                                    }
                                });
                            }
                            // $.ajax({
                            //     type: 'POST',
                            //     url: '{{ route('process.order') }}',
                            //     data: {
                            //         selected_products: selectedProducts,
                            //         total_harga: totalHarga,
                            //         _token: '{{ csrf_token() }}'
                            //     },
                            //     success: function (response) {
                            //         alert(response.message); // Tampilkan pesan sukses
                            //     },
                            //     error: function (error) {
                            //         console.log(error);
                            //         alert('Terjadi kesalahan saat memproses pesanan');
                            //     }
                            // });
                        });

                        // Event listener untuk mengatasi kuantitas kosong saat kehilangan fokus
                        $('#selected-products').on('blur', '.quantity-input', function() {
                            var quantity = parseInt($(this).val()) || 1;
                            $(this).val(quantity);
                            updateTotalPrice();
                        });

                        // Panggil fungsi untuk menampilkan pesan "Produk Kosong"
                        updateEmptyProductMessage();
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
