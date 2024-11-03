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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .bg-login-image {
            background-image: url('<?= asset('images/login.png') ?>');
            background-size: contain;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Silakan Masuk!</h1>
                                    </div>
                                    {{ show_error($errors) }}
                                    <form action="{{ route('login.action') }}" method="post" class="user">
                                        {{ csrf_field() }}
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control-user" placeholder="Username" name="username">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary btn-user">Masuk</button>

                                    </form>
                                </div>
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