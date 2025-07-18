<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('startbootstrap-sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon">
                    <i class="fa fa-signal"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.nama') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item" {{ is_hidden('home.dashboard') }}>
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('home.public') }}>
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- <li class="nav-item" {{ is_hidden('user.index') }}>
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li> -->

            <li class="nav-item" {{ is_hidden('kelas.index') }}>
                <a class="nav-link" href="{{ route('kelas.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kelas</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('mapel.index') }}>
                <a class="nav-link" href="{{ route('mapel.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Mapel</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('topik.index') }}>
                <a class="nav-link" href="{{ route('topik.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Topik</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('kriteria.index') }}>
                <a class="nav-link" href="{{ route('kriteria.index') }}">
                    <i class="fas fa-fw fa-tag"></i>
                    <span>Kriteria</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('guru.index') }}>
                <a class="nav-link" href="{{ route('guru.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Guru</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('alternatif.index') }}>
                <a class="nav-link" href="{{ route('alternatif.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Alternatif</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('nilai.index') }}>
                <a class="nav-link" href="{{ route('nilai.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item" {{ is_hidden('maut.index') }}>
                <a class="nav-link" href="{{ route('maut.index') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>MAUT</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        @auth
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_user }}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('startbootstrap-sb-admin-2/img/undraw_profile.svg') }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profil') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.password') }}">
                                        <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Password
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item no-arrow">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Login</span>
                                </a>
                            </li>
                        @endauth

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">@yield('title', $title)</h1>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('startbootstrap-sb-admin-2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
