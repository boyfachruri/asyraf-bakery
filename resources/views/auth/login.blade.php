<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ url('assets/images/asyraf-logo/asyraf-bakery-roti.png') }}">
    <!-- Page Title  -->
    <title>Login</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ url('assets/css/dashlite.css?ver=2.9.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ url('assets/css/theme.css?ver=2.9.0') }}">
    <style>
        body {
            background-image: url('{{ url('assets/images/asyraf-logo/bg-asyraf-bakery.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(210, 210, 210, 0.5);
            /* Warna gelap di sini (RGBA format) */
        }

        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 300px;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        {{-- <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-dark logo-img logo-img-lg" src="{{ url('assets/images/asyraf-logo/asyraf-bakery.png') }}" alt="logo-dark">
                            </a>
                        </div> --}}
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="brand-logo pb-4 text-center">
                                    {{-- <a href="html/index.html" class="logo-link"> --}}
                                        <img class="logo-dark logo-img logo-img-lg"
                                            src="{{ url('assets/images/asyraf-logo/asyraf-bakery.png') }}"
                                            alt="logo-dark">
                                    {{-- </a> --}}
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        {{-- <div class="nk-block-des">
                                            <p>Access the CryptoLite panel using your email and passcode.</p>
                                        </div> --}}
                                    </div>
                                </div>
                                <form method="POST" action="{{ url('/login') }}">
                                    @csrf
                                
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email or Username</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="default-01" name="email" value="{{ old('email') }}" placeholder="Enter your email address or username">
                                        </div>
                                        {{-- @if($errors->has('email'))
                                            <div class="alert alert-danger float-right alert-dismissible fade show" role="alert">
                                                {{ $errors->first('email') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif --}}
                                    </div>
                                
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Passcode</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                                        </div>
                                        {{-- @if($errors->has('password'))
                                            <div class="alert alert-danger float-right alert-dismissible fade show" role="alert">
                                                {{ $errors->first('password') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif --}}
                                    </div>
                                
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>

                                @if($errors->any())
                            <div id="error-alert" class="alert alert-pro alert-danger fade show floating-alert" role="alert">
                                <div class="d-flex">
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                                {{-- <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="html/pages/auths/auth-register-v2.html">Create an account</a>
                                </div> --}}
                                {{-- <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                </div>
                                <ul class="nav justify-center gx-4">
                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/english.png" alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/spanish.png" alt="" class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/french.png" alt="" class="language-flag">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2019 CryptoLite. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=2.9.0"></script>
    <script src="./assets/js/scripts.js?ver=2.9.0"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('error-alert');
            if (alert) {
                setTimeout(function() {
                    alert.remove();
                }, 1500); // Hapus alert setelah 3 detik
    
                // Tambahkan event listener untuk tombol penutup
                var closeButton = alert.querySelector('.close');
                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        alert.remove();
                    });
                }
            }
        });
    </script>
</html>
