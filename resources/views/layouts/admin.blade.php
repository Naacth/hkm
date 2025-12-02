<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | HIMAKOM UYM</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 2px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            min-height: 100vh;
        }
        
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .page-title {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: #1976d2;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <h4 class="text-white fw-bold">
                            <i class="bi bi-shield-check me-2"></i>
                            Admin Panel
                        </h4>
                        <small class="text-white-50">HIMAKOM UYM</small>
                    </div>
                    
                    <!-- Navigation -->
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin-dashboard') }}">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" 
                               href="{{ route('events.index') }}">
                                <i class="bi bi-calendar-event"></i>
                                Events
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.event-registrations.*') ? 'active' : '' }}" 
                               href="{{ route('admin.event-registrations.index') }}">
                                <i class="bi bi-people"></i>
                                Pendaftaran Event
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('produks.*') ? 'active' : '' }}" 
                               href="{{ route('produks.index') }}">
                                <i class="bi bi-box"></i>
                                Produk
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index') }}">
                                <i class="bi bi-cart"></i>
                                Orders
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('galeris.*') ? 'active' : '' }}" 
                               href="{{ route('galeris.index') }}">
                                <i class="bi bi-images"></i>
                                Galeri
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('divisis.*') ? 'active' : '' }}" 
                               href="{{ route('divisis.index') }}">
                                <i class="bi bi-diagram-3"></i>
                                Divisi
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('divisi-members.*') ? 'active' : '' }}" 
                               href="{{ route('divisi-members.index') }}">
                                <i class="bi bi-person-badge"></i>
                                Anggota Divisi
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('abouts.*') ? 'active' : '' }}" 
                               href="{{ route('abouts.index') }}">
                                <i class="bi bi-info-circle"></i>
                                About
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kabinets.*') ? 'active' : '' }}" 
                               href="{{ route('kabinets.index') }}">
                                <i class="bi bi-building"></i>
                                Kabinet
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kontaks.*') ? 'active' : '' }}" 
                               href="{{ route('kontaks.index') }}">
                                <i class="bi bi-telephone"></i>
                                Kontak
                            </a>
                        </li>
                        
                        <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" 
                               href="{{ route('admin.payments.index') }}">
                                <i class="bi bi-credit-card"></i>
                                Pembayaran
                            </a>
                        </li>
                        
                        @if(auth('admin')->user()->role === 'superadmin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.super-admin.*') ? 'active' : '' }}" 
                               href="{{ route('admin.super-admin.dashboard') }}">
                                <i class="bi bi-gear"></i>
                                Super Admin
                            </a>
                        </li>
                        @endif
                    </ul>
                    
                    <!-- User Info -->
                    <div class="mt-auto pt-4">
                        <div class="text-center">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-2"></i>
                                    {{ auth('admin')->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top navbar -->
                <div class="navbar navbar-admin navbar-expand-lg sticky-top">
                    <div class="container-fluid">
                        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="d-flex align-items-center">
                            <h1 class="page-title h4 mb-0">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    @yield('breadcrumb')
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <!-- Page content -->
                <div class="py-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>