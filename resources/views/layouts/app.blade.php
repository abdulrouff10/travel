<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel App - @yield('title')</title>
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- AdminLTE 3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <style>
        .brand-link .brand-text {
            margin-left: 0.5rem;
        }
        
        /* Custom styles untuk konsistensi */
        .info-box {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .info-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            margin-bottom: 1rem;
        }
        
        /* Warna custom */
        .bg-primary { background-color: #007bff !important; }
        .bg-success { background-color: #28a745 !important; }
        .bg-warning { background-color: #ffc107 !important; }
        .bg-info { background-color: #17a2b8 !important; }
        .bg-danger { background-color: #dc3545 !important; }
        
        .btn-primary { background-color: #007bff; border-color: #007bff; }
        .btn-success { background-color: #28a745; border-color: #28a745; }
        .btn-warning { background-color: #ffc107; border-color: #ffc107; }
        .btn-info { background-color: #17a2b8; border-color: #17a2b8; }
        
        .navbar-light { background-color: #ffffff !important; }

        /* Styles untuk halaman guest, login, register */
        .guest-layout .main-sidebar,
        .guest-layout .main-header,
        .guest-layout .main-footer,
        .guest-layout .content-header {
            display: none !important;
        }

        .guest-layout .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .guest-layout .content {
            padding: 0 !important;
        }

        .guest-layout .container-fluid {
            padding: 0 !important;
        }

        /* Hero gradient untuk halaman guest */
        .hero-gradient {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }

        /* Styles untuk halaman auth (login & register) */
        .min-vh-100 {
            min-height: 100vh;
        }

        .rounded-lg {
            border-radius: 1rem !important;
        }

        .form-label {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            border-right: 0;
            transition: all 0.3s;
        }

        .form-control {
            border-left: 0;
            padding: 0.75rem 0.75rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .form-control:focus + .input-group-prepend .input-group-text {
            border-color: #007bff;
        }

        .btn-primary {
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .card {
            border: none;
            overflow: hidden;
        }

        .card-header {
            background: transparent;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        /* Perbaikan untuk dropdown profile */
        .navbar-nav .nav-link.dropdown-toggle {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-right: 0.5rem;
        }

        .user-name {
            font-size: 0.875rem;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 0.1rem;
        }

        .user-role {
            font-size: 0.75rem;
            opacity: 0.8;
            line-height: 1;
        }

        .dropdown-menu-lg {
            min-width: 14rem;
        }

        .dropdown-header {
            font-size: 0.875rem;
            font-weight: 600;
        }

    </style>
    
    @stack('styles')
</head>
<body class="hold-transition @if(in_array(Route::currentRouteName(), ['guest', 'login', 'register'])) guest-layout @else sidebar-mini layout-fixed @endif">
<div class="wrapper">

    @if(!in_array(Route::currentRouteName(), ['guest', 'login', 'register']))
    <!-- Navbar (Hanya untuk non-guest pages) -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">{{ auth()->user()->role === 'admin' ? 'Admin' : 'Penumpang' }}</span>
                        </div>
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">
                            <i class="fas fa-user mr-2"></i>Profile Settings
                        </span>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

    <!-- Main Sidebar Container (Hanya untuk non-guest pages) -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <i class="fas fa-bus brand-icon ml-2"></i>
            <span class="brand-text font-weight-bold">Travel App</span>
            <br>
            <small class="brand-text-sm">
            </small>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <!-- Admin Menu -->
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.schedules.index') }}" class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>Kelola Jadwal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Data Penumpang</p>
                                </a>
                            </li>
                        @else
                            <!-- Penumpang Menu -->
                            <li class="nav-item">
                                <a href="{{ route('penumpang.dashboard') }}" class="nav-link {{ request()->routeIs('penumpang.dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penumpang.schedules.index') }}" class="nav-link {{ request()->routeIs('penumpang.schedules.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-bus"></i>
                                    <p>Jadwal Travel</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penumpang.bookings.index') }}" class="nav-link {{ request()->routeIs('penumpang.bookings.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-ticket-alt"></i>
                                    <p>Pesanan Saya</p>
                                </a>
                            </li>
                        @endif
                        
                        <!-- Common Menu Items -->
                        <li class="nav-header">AKUN</li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                            </form>
                        </li>
                    @else
                        <!-- Guest Menu -->
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                <p>Login</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Register</p>
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(!in_array(Route::currentRouteName(), ['guest', 'login', 'register']))
        <!-- Content Header (Page header) - Hanya untuk non-guest pages -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="icon fas fa-check"></i>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="icon fas fa-ban"></i>
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>

    @if(!in_array(Route::currentRouteName(), ['guest', 'login', 'register']))
    <!-- Main Footer (Hanya untuk non-guest pages) -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">Travel App</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
    @endif
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function() {
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>

@stack('scripts')
</body>
</html>