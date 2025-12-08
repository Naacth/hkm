<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'HIMAKOM Universitas Yatsi Madani')</title>
    @hasSection('meta_description')
    <meta name="description" content="@yield('meta_description')">
    @endif
    @yield('extra_meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1976d2;
            --primary-dark: #0d47a1;
            --accent-color: #64b5f6;
            --text-light: #f8f9fa;
            --text-dark: #212529;
            --bg-light: #f8f9fa;
            --transition: all 0.3s ease;
        }
        
        body { 
            font-family: 'Montserrat', Arial, sans-serif; 
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Responsive Typography */
        html { font-size: 16px; }
        @media (max-width: 768px) { html { font-size: 15px; } }
        @media (max-width: 576px) { html { font-size: 14px; } }
        /* Navbar Styles */
        .navbar {
            background: linear-gradient(90deg, var(--primary-dark) 60%, var(--primary-color) 100%) !important;
            padding: 0.8rem 0;
            transition: var(--transition);
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar .nav-link, .navbar .navbar-brand {
            transition: color 0.2s, transform 0.2s;
        }
        .navbar .nav-link:hover, .navbar .navbar-brand:hover {
            color: #64b5f6 !important;
            transform: translateY(-2px) scale(1.08);
        }
        .navbar .nav-link.active {
            color: #1976d2 !important;
            font-weight: 700;
        }
        .navbar .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 4px 24px rgba(13, 71, 161, 0.12);
            border: 1px solid rgba(13, 71, 161, 0.1);
            min-width: 200px;
        }
        .navbar .dropdown-menu.show {
            display: block;
        }
        
        /* Hover dropdown styles */
        .navbar .dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        
        .navbar .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            margin-top: 0;
        }
        
        .navbar .dropdown:hover .dropdown-toggle {
            color: #64b5f6 !important;
        }
        .navbar .dropdown-item:hover {
            background: #e3f2fd;
            color: #0d47a1 !important;
        }
        .navbar .bi {
            transition: color 0.2s, transform 0.3s cubic-bezier(.68,-0.55,.27,1.55);
        }
        .navbar .nav-link:hover .bi, .navbar .dropdown-item:hover .bi {
            color: #1976d2 !important;
            transform: rotate(-12deg) scale(1.2);
        }
        /* Button Styles */
        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            z-index: -1;
        }
        
        .btn:hover::before {
            width: 100%;
        }
        
        .btn-primary, .btn-primary:active, .btn-primary:focus {
            background: linear-gradient(90deg, var(--primary-color) 60%, var(--accent-color) 100%) !important;
            border: none;
            box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 118, 210, 0.4);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        .bg-blue-gradient {
            background: linear-gradient(90deg, #1976d2 60%, #64b5f6 100%) !important;
        }
        .footer {
            background: linear-gradient(90deg, #0d47a1 60%, #1976d2 100%) !important;
            color: #fff;
        }
        .footer a {
            color: #bbdefb;
            transition: color 0.2s, transform 0.2s;
        }
        .footer a:hover {
            color: #fff;
            transform: scale(1.2) rotate(-8deg);
        }
        .footer .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.1);
            border-color: #fff;
            transform: scale(1.1);
        }
        .footer .input-group .form-control:focus {
            border-color: #64b5f6;
            box-shadow: 0 0 0 0.2rem rgba(100, 181, 246, 0.25);
        }
        .footer .input-group .btn:hover {
            background-color: #1565c0;
            transform: translateY(-1px);
        }
        .footer ul li a:hover {
            color: #64b5f6 !important;
            transform: translateX(5px);
        }
        .footer .text-primary {
            color: #64b5f6 !important;
        }
    </style>
    @hasSection('jsonld')
    <script type="application/ld+json">
@yield('jsonld')
    </script>
    @endif
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: #f4f8fb;">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="/logo-himakom.png" alt="Logo HIMAKOM" width="40" height="40" class="me-2 rounded-circle shadow">
                <span class="fw-bold">HIMAKOM UYM</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/">
                            <i class="bi bi-house-door me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item d-flex align-items-center" href="/about"><i class="bi bi-info-circle me-1"></i> About Us</a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="/kabinet"><i class="bi bi-diagram-3 me-1"></i> Kabinet</a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="/divisi"><i class="bi bi-people me-1"></i> Divisi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/event">
                            <i class="bi bi-calendar-event me-1"></i> Event
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/produk">
                            <i class="bi bi-box-seam me-1"></i> Produk Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/galeri">
                            <i class="bi bi-images me-1"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/kontak">
                            <i class="bi bi-envelope me-1"></i> Kontak
                        </a>
                    </li>
                    
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}"><i class="bi bi-person me-1"></i> Profil</a></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ route('orders.history') }}"><i class="bi bi-cart me-1"></i> Riwayat Pesanan</a></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ route('event-registrations.history') }}"><i class="bi bi-calendar-check me-1"></i> Event Saya</a></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ route('certificates.index') }}"><i class="bi bi-award me-1"></i> Sertifikat Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-fill py-4">
        @yield('hero')
        <div class="container">
            @yield('content')
        </div>
        
        <!-- Back to Top Button -->
        <button onclick="topFunction()" id="backToTop" title="Go to top" class="btn btn-primary rounded-circle position-fixed" style="bottom: 20px; right: 20px; width: 50px; height: 50px; display: none; z-index: 99;">
            <i class="bi bi-arrow-up"></i>
        </button>
    </main>
    <footer class="footer mt-auto shadow-lg">
        <div class="container py-5">
            <div class="row">
                <!-- Logo dan Deskripsi -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="/logo-himakom.png" alt="Logo HIMAKOM" width="50" height="50" class="me-3 rounded-circle shadow">
                        <div>
                            <h5 class="mb-0 fw-bold">HIMAKOM UYM</h5>
                            <small class="text-light">Himpunan Mahasiswa Komputer</small>
                        </div>
                    </div>
                    <p class="text-light mb-3">
                        Wadah bagi mahasiswa Teknik Informatika Universitas Yatsi Madani untuk mengembangkan potensi, 
                        berorganisasi, dan berkontribusi dalam kemajuan teknologi informasi.
                    </p>
                    <div class="d-flex">
                        @if($footerKontak && $footerKontak->instagram)
                            <a href="{{ $footerKontak->instagram }}" target="_blank" class="btn btn-outline-light btn-sm me-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-instagram"></i>
                            </a>
                        @endif
                        @if($footerKontak && $footerKontak->facebook)
                            <a href="{{ $footerKontak->facebook }}" target="_blank" class="btn btn-outline-light btn-sm me-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-facebook"></i>
                            </a>
                        @endif
                        @if($footerKontak && $footerKontak->youtube)
                            <a href="{{ $footerKontak->youtube }}" target="_blank" class="btn btn-outline-light btn-sm me-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-youtube"></i>
                            </a>
                        @endif
                        @if($footerKontak && $footerKontak->linkedin)
                            <a href="{{ $footerKontak->linkedin }}" target="_blank" class="btn btn-outline-light btn-sm me-2 rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        @endif
                        @if($footerKontak && $footerKontak->tiktok)
                            <a href="{{ $footerKontak->tiktok }}" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Menu Navigasi -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Menu Utama</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-house-door me-2"></i> Home
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/about" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-info-circle me-2"></i> About Us
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/kabinet" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-diagram-3 me-2"></i> Kabinet
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/divisi" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-people me-2"></i> Divisi
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Program & Aktivitas -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Program</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/event" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-calendar-event me-2"></i> Event
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/produk" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-box-seam me-2"></i> Produk Kami
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/galeri" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-images me-2"></i> Galeri
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/kontak" class="text-light text-decoration-none d-flex align-items-center">
                                <i class="bi bi-envelope me-2"></i> Kontak
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Informasi Kontak -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Hubungi Kami</h6>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt-fill me-3 text-primary"></i>
                            <span class="text-light">
                                @if($footerKontak && $footerKontak->address)
                                    {{ $footerKontak->address }}
                                @else
                                    Universitas Yatsi Madani<br>
                                    <small class="text-muted"> Jl. Aria Santika No.40A, RT.005/RW.011, Margasari, Kec. Karawaci, Kota Tangerang, Banten</small>
                                @endif
                            </span>
                        </div>
                        @if($footerKontak && $footerKontak->email)
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope-fill me-3 text-primary"></i>
                                <a href="mailto:{{ $footerKontak->email }}" class="text-light text-decoration-none">{{ $footerKontak->email }}</a>
                            </div>
                        @endif
                        @if($footerKontak && $footerKontak->phone)
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-telephone-fill me-3 text-primary"></i>
                                <a href="tel:{{ $footerKontak->phone }}" class="text-light text-decoration-none">{{ $footerKontak->phone }}</a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Newsletter Signup -->
                    <div class="mt-4">
                        <h6 class="fw-bold mb-3 text-white">Newsletter</h6>
                        <p class="text-light small mb-3">Dapatkan update terbaru tentang kegiatan HIMAKOM</p>
                        <form id="newsletterForm">
                            <div class="input-group">
                                <input type="email" id="newsletterEmail" class="form-control" placeholder="Email Anda" aria-label="Email" required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </form>
                        <div id="newsletterMessage" class="mt-2" style="display: none;"></div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">
                        &copy; {{ date('Y') }} HIMAKOM Universitas Yatsi Madani. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-light">
                        Made with <i class="bi bi-heart-fill text-danger"></i> by Komdigi Division
                    </small>
                </div>
            </div>
        </div>
    </footer>

    
    <!-- Custom Footer JavaScript -->
    <script>
        // Newsletter form handling
        document.getElementById('newsletterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('newsletterEmail').value;
            const messageDiv = document.getElementById('newsletterMessage');
            
            if (email) {
                // Simulate newsletter subscription
                messageDiv.innerHTML = '<div class="alert alert-success alert-sm mb-0"><i class="bi bi-check-circle me-1"></i>Terima kasih! Email berhasil didaftarkan untuk newsletter.</div>';
                messageDiv.style.display = 'block';
                document.getElementById('newsletterEmail').value = '';
                
                // Hide message after 5 seconds
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 5000);
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll for footer elements
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe footer elements
        document.querySelectorAll('.footer .col-lg-4, .footer .col-lg-2').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Initialize Bootstrap dropdowns -->
    <!-- Back to Top Button Script -->
    <script>
        // Back to top button
        window.onscroll = function() {
            scrollFunction();
            navbarScroll();
        };
        
        function scrollFunction() {
            var backToTopBtn = document.getElementById("backToTop");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTopBtn.style.display = "flex";
                backToTopBtn.style.justifyContent = "center";
                backToTopBtn.style.alignItems = "center";
            } else {
                backToTopBtn.style.display = "none";
            }
        }
        
        function topFunction() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
        
        // Navbar scroll effect
        function navbarScroll() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
            
            console.log('Bootstrap dropdowns initialized:', dropdownList.length);
            
            // Add hover functionality to dropdowns
            const dropdowns = document.querySelectorAll('.navbar .dropdown');
            
            dropdowns.forEach(function(dropdown) {
                const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                let hoverTimeout;
                
                // Show dropdown on hover
                dropdown.addEventListener('mouseenter', function() {
                    clearTimeout(hoverTimeout);
                    dropdownMenu.classList.add('show');
                    dropdownToggle.setAttribute('aria-expanded', 'true');
                });
                
                // Hide dropdown when mouse leaves
                dropdown.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(function() {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                    }, 100); // Small delay to prevent flickering
                });
                
                // Keep dropdown open when hovering over menu items
                dropdownMenu.addEventListener('mouseenter', function() {
                    clearTimeout(hoverTimeout);
                });
                
                dropdownMenu.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(function() {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                    }, 100);
                });
                
                // Still allow click functionality for mobile/touch devices
                dropdownToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                    } else {
                        // Close other dropdowns first
                        document.querySelectorAll('.navbar .dropdown-menu.show').forEach(function(menu) {
                            menu.classList.remove('show');
                        });
                        document.querySelectorAll('.navbar .dropdown-toggle[aria-expanded="true"]').forEach(function(toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        });
                        
                        // Open this dropdown
                        dropdownMenu.classList.add('show');
                        dropdownToggle.setAttribute('aria-expanded', 'true');
                    }
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.navbar .dropdown')) {
                    document.querySelectorAll('.navbar .dropdown-menu.show').forEach(function(menu) {
                        menu.classList.remove('show');
                    });
                    document.querySelectorAll('.navbar .dropdown-toggle[aria-expanded="true"]').forEach(function(toggle) {
                        toggle.setAttribute('aria-expanded', 'false');
                    });
                }
            });
            
            console.log('Hover dropdowns initialized for', dropdowns.length, 'dropdowns');
        });
    </script>
</body>
</html> 