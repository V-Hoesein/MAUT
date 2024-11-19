<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Log in</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .bg-login-image {
            background-image: url('{{ asset("images/login.jpg") }}');
            background-size: cover;
            background-position: center;
        }

        .card-login {
            border-radius: 10px;
            overflow: hidden;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        body {
            background-color: #f8f9fc;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10 col-md-12">
                <div class="card card-login shadow-lg border-0">
                    <div class="row no-gutters">
                        <!-- Login Image -->
                        <div class="col-md-6 bg-login-image d-none d-md-block"></div>
                        <!-- Login Form -->
                        <div class="col-md-6 p-4">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                <p class="text-muted mb-4">Silakan masuk untuk melanjutkan.</p>
                            </div>
                            {{ show_error($errors) }}
                            <form action="{{ route('login.action') }}" method="post" class="user">
                                {{ csrf_field() }}
                                <!-- Username -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Username" name="username">
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <!-- Login Button -->
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-sign-in-alt"></i> Masuk
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="#" class="text-success">Lupa password?</a>
                            </div>
                            <div class="text-center">
                                <a href="#" class="text-success">Buat akun baru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('startbootstrap-sb-admin-2/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
