@extends('welcome')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Data Akun</h3>
                        <div class="nk-block-des text-soft">
                            <p>Total akun adalah {{ $count }} akun.</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="more-options">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" class="form-control" id="default-04"
                                                placeholder="Search by name">
                                        </div>
                                    </li>
                                    {{-- <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-toggle="dropdown">Status</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>Actived</span></a></li>
                                                <li><a href="#"><span>Inactived</span></a></li>
                                                <li><a href="#"><span>Blocked</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> --}}
                                    <li class="nk-block-tools-opt">
                                        <a href="#" class="btn btn-icon btn-primary d-md-none"><em
                                                class="icon ni ni-plus"></em></a>
                                        <a href="#" class="btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>Tambah</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="nk-tb-list is-separate mb-3">
                    <div class="nk-tb-item nk-tb-head">
                        {{-- <div class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="uid">
                            <label class="custom-control-label" for="uid"></label>
                        </div>
                    </div> --}}
                        <div class="nk-tb-col"><span class="sub-text">No</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Nama</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">tanggal buat</span></div>
                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Tipe Akun</span></div>
                        {{-- <div class="nk-tb-col tb-col-lg"><span class="sub-text">Last Order</span></div> --}}
                        {{-- <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div> --}}
                        <div class="nk-tb-col nk-tb-col-tools"></div>
                    </div><!-- .nk-tb-item -->
                    @foreach ($users as $user)
                        <div class="nk-tb-item">
                            {{-- <div class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="uid1">
                            <label class="custom-control-label" for="uid1"></label>
                        </div>
                    </div> --}}
                            <div class="nk-tb-col">
                                <span class="tb-amount">{{ $loop->iteration }}</span>
                            </div>
                            <div class="nk-tb-col">
                                {{-- <a href="">
                                    <div class="user-card">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </a> --}}
                                <div class="user-card">
                                    {{-- <div class="user-avatar bg-primary">
                                <span>AB</span>
                            </div> --}}
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ date('Y-m-d', strtotime($user->created_at)) }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>Admin</span>
                            </div>
                            {{-- <div class="nk-tb-col tb-col-lg">
                        <span>10 Feb 2020</span>
                    </div> --}}
                            {{-- <div class="nk-tb-col tb-col-md">
                        <span class="tb-status text-success">Active</span>
                    </div> --}}
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    {{-- <li><a href="html/ecommerce/customer-details.html"><em class="icon ni ni-eye"></em><span>View Details</span></a></li> --}}
                                                    <li><a href="#"><em
                                                                class="icon ni ni-delete"></em><span>Hapus</span></a></li>
                                                    <li><a href="#"><em
                                                                class="icon ni ni-edit"></em><span>Ubah</span></a></li>
                                                    {{-- <li class="divider"></li>
                                            <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend</span></a></li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                    @endforeach

                </div><!-- .nk-tb-list -->
                <div class="card">
                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                                <ul class="pagination justify-content-center justify-content-md-start">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul><!-- .pagination -->
                            </div>
                            <div class="g">
                                <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                    <div>Page</div>
                                    <div>
                                        <select class="form-select" data-search="on" data-dropdown="xs center">
                                            <option value="page-1">1</option>
                                            <option value="page-2">2</option>
                                            <option value="page-4">4</option>
                                            <option value="page-5">5</option>
                                            <option value="page-6">6</option>
                                            <option value="page-7">7</option>
                                            <option value="page-8">8</option>
                                            <option value="page-9">9</option>
                                            <option value="page-10">10</option>
                                            <option value="page-11">11</option>
                                            <option value="page-12">12</option>
                                            <option value="page-13">13</option>
                                            <option value="page-14">14</option>
                                            <option value="page-15">15</option>
                                            <option value="page-16">16</option>
                                            <option value="page-17">17</option>
                                            <option value="page-18">18</option>
                                            <option value="page-19">19</option>
                                            <option value="page-20">20</option>
                                        </select>
                                    </div>
                                    <div>OF 102</div>
                                </div>
                            </div><!-- .pagination-goto -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
@endsection
