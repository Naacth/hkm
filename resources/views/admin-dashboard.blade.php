@extends('layouts.admin')
@section('title', 'Dashboard Admin | HIMAKOM UYM')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-speedometer2 me-3"></i>Dashboard Admin
                </h1>
                <p class="lead mb-0">Selamat datang di panel administrasi HIMAKOM UYM</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="admin-info">
                    <div class="d-flex align-items-center justify-content-md-end">
                        <div class="admin-avatar me-3">
                            <i class="bi bi-person-circle" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="admin-details">
                            <div class="fw-bold">Administrator</div>
                            <small class="opacity-75">HIMAKOM UYM</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="statistics-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-primary">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-primary mb-1">{{ App\Models\Event::count() }}</h3>
                            <p class="text-muted mb-0">Total Events</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-success">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-people text-success" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-success mb-1">{{ App\Models\Divisi::count() }}</h3>
                            <p class="text-muted mb-0">Total Divisi</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-images text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-warning mb-1">{{ App\Models\Galeri::count() }}</h3>
                            <p class="text-muted mb-0">Total Galeri</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-info">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-box-seam text-info" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-info mb-1">{{ App\Models\Produk::count() }}</h3>
                            <p class="text-muted mb-0">Total Produk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Second Row Statistics -->
        <div class="row g-4 mt-2">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-primary">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-cart-check text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-primary mb-1">{{ App\Models\Order::count() }}</h3>
                            <p class="text-muted mb-0">Total Pesanan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-clock text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-warning mb-1">{{ App\Models\Order::where('status', 'pending')->count() }}</h3>
                            <p class="text-muted mb-0">Pesanan Pending</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-success">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-check-circle text-success" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-success mb-1">{{ App\Models\Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->count() }}</h3>
                            <p class="text-muted mb-0">Pesanan Dikonfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-info">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-currency-dollar text-info" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-info mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                            <p class="text-muted mb-0">Total Pendapatan (Produk + Event)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Third Row Statistics -->
        <div class="row g-4 mt-2">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-success">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-calendar-check text-success" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-success mb-1">{{ App\Models\EventRegistration::count() }}</h3>
                            <p class="text-muted mb-0">Total Pendaftaran Event</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-info">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-cash-coin text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-info mb-1">Rp {{ number_format($cancelledRevenue, 0, ',', '.') }}</h3>
                            <p class="text-muted mb-0">Pendapatan Dibatalkan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-clock text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-warning mb-1">{{ App\Models\EventRegistration::where('status', 'registered')->count() }}</h3>
                            <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-primary">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-person-check text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-primary mb-1">{{ App\Models\EventRegistration::where('status', 'attended')->count() }}</h3>
                            <p class="text-muted mb-0">Peserta Hadir</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-info">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-award text-info" style="font-size: 2.5rem;"></i>
                            </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-info mb-1">{{ App\Models\EventRegistration::where('status', 'attended')->where('certificate_downloaded', true)->count() }}</h3>
                            <p class="text-muted mb-0">Sertifikat Didownload</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-primary">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-bag-check text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-primary mb-1">Rp {{ number_format($orderRevenue, 0, ',', '.') }}</h3>
                            <p class="text-muted mb-0">Pendapatan Produk</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 shadow-sm border-start border-4 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3">
                            <i class="bi bi-ticket-perforated text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="fw-bold text-warning mb-1">Rp {{ number_format($eventRevenue, 0, ',', '.') }}</h3>
                            <p class="text-muted mb-0">Pendapatan Event</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="quick-actions-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-primary mb-3">Kelola Konten Website</h2>
            <p class="lead text-muted">Pilih menu di bawah untuk mengelola berbagai konten website HIMAKOM</p>
        </div>
        
        <div class="row g-4">
            <!-- About Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-info-circle text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola About</h4>
                    <p class="text-muted mb-4">
                        Edit informasi tentang HIMAKOM, visi misi, sejarah, dan nilai-nilai organisasi.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('abouts.index') }}" class="btn btn-primary btn-lg w-100 rounded-pill">
                            <i class="bi bi-pencil-square me-2"></i>Kelola About
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Event Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-calendar-event text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Event</h4>
                    <p class="text-muted mb-4">
                        Tambah, edit, dan hapus event kegiatan HIMAKOM dengan informasi lengkap.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('events.index') }}" class="btn btn-success btn-lg w-100 rounded-pill">
                            <i class="bi bi-calendar-plus me-2"></i>Kelola Event
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-images text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Galeri</h4>
                    <p class="text-muted mb-4">
                        Upload dan kelola foto-foto kegiatan dan dokumentasi HIMAKOM.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('galeris.index') }}" class="btn btn-warning btn-lg w-100 rounded-pill">
                            <i class="bi bi-image me-2"></i>Kelola Galeri
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Product Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-box-seam text-info" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Produk</h4>
                    <p class="text-muted mb-4">
                        Kelola produk dan layanan yang ditawarkan HIMAKOM kepada anggota.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('produks.index') }}" class="btn btn-info btn-lg w-100 rounded-pill">
                            <i class="bi bi-box me-2"></i>Kelola Produk
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-envelope text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Kontak</h4>
                    <p class="text-muted mb-4">
                        Update informasi kontak dan media sosial HIMAKOM.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('kontaks.index') }}" class="btn btn-danger btn-lg w-100 rounded-pill">
                            <i class="bi bi-envelope-open me-2"></i>Kelola Kontak
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Cabinet Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-diagram-3 text-secondary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Kabinet</h4>
                    <p class="text-muted mb-4">
                        Kelola struktur kepemimpinan dan pengurus HIMAKOM.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('kabinets.index') }}" class="btn btn-secondary btn-lg w-100 rounded-pill">
                            <i class="bi bi-people-fill me-2"></i>Kelola Kabinet
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Division Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-diagram-2 text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Divisi</h4>
                    <p class="text-muted mb-4">
                        Kelola divisi-divisi dalam HIMAKOM dan anggota-anggotanya.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('divisis.index') }}" class="btn btn-primary btn-lg w-100 rounded-pill">
                            <i class="bi bi-diagram-2 me-2"></i>Kelola Divisi
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Division Members Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-person-badge text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Anggota Divisi</h4>
                    <p class="text-muted mb-4">
                        Kelola anggota-anggota dalam setiap divisi HIMAKOM.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('divisi-members.index') }}" class="btn btn-success btn-lg w-100 rounded-pill">
                            <i class="bi bi-person-plus me-2"></i>Kelola Anggota
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Orders Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-cart-check text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Pesanan</h4>
                    <p class="text-muted mb-4">
                        Kelola semua pesanan dari pelanggan HIMAKOM dan update status pesanan.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-lg w-100 rounded-pill">
                            <i class="bi bi-cart-check me-2"></i>Kelola Pesanan
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Event Registrations Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-calendar-check text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Pendaftaran Event</h4>
                    <p class="text-muted mb-4">
                        Kelola pendaftaran event, konfirmasi peserta, dan upload sertifikat.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-success btn-lg w-100 rounded-pill">
                            <i class="bi bi-calendar-check me-2"></i>Kelola Pendaftaran
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Payment Management -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-credit-card text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kelola Pembayaran</h4>
                    <p class="text-muted mb-4">
                        Kelola pembayaran QRIS, approve pembayaran event dan produk secara manual.
                    </p>
                    <div class="action-buttons">
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-warning btn-lg w-100 rounded-pill">
                            <i class="bi bi-credit-card me-2"></i>Kelola Pembayaran
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- System Settings -->
            <div class="col-lg-4 col-md-6">
                <div class="action-card bg-white rounded-4 shadow-lg p-4 h-100 transition-all">
                    <div class="action-icon mb-4">
                        <i class="bi bi-gear text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Pengaturan Sistem</h4>
                    <p class="text-muted mb-4">
                        Konfigurasi pengaturan website dan sistem administrasi.
                    </p>
                    <div class="action-buttons">
                        <button class="btn btn-warning btn-lg w-100 rounded-pill" disabled>
                            <i class="bi bi-gear me-2"></i>Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="recent-activity-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-primary mb-3">Aktivitas Terbaru</h2>
            <p class="lead text-muted">Ringkasan aktivitas terbaru dalam sistem</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="activity-card bg-white rounded-4 shadow-lg p-4">
                    <h4 class="fw-bold text-primary mb-3">
                        <i class="bi bi-calendar-check me-2"></i>Event Terbaru
                    </h4>
                    <div class="activity-list">
                        @forelse($recentEvents as $event)
                        <div class="activity-item d-flex align-items-center mb-3 p-3 bg-light rounded-3">
                            <div class="activity-icon me-3">
                                <i class="bi bi-calendar-event text-primary"></i>
                            </div>
                            <div class="activity-content flex-grow-1">
                                <h6 class="fw-bold mb-1">{{ $event->title }}</h6>
                                <p class="text-muted small mb-0">{{ $event->date }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-calendar-x display-4"></i>
                            <p class="mt-2">Belum ada event</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="activity-card bg-white rounded-4 shadow-lg p-4">
                    <h4 class="fw-bold text-primary mb-3">
                        <i class="bi bi-people me-2"></i>Divisi Terbaru
                    </h4>
                    <div class="activity-list">
                        @forelse($recentDivisis as $divisi)
                        <div class="activity-item d-flex align-items-center mb-3 p-3 bg-light rounded-3">
                            <div class="activity-icon me-3">
                                <i class="bi bi-diagram-2 text-success"></i>
                            </div>
                            <div class="activity-content flex-grow-1">
                                <h6 class="fw-bold mb-1">{{ $divisi->name }}</h6>
                                <p class="text-muted small mb-0">{{ Str::limit($divisi->description, 50) }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-people-x display-4"></i>
                            <p class="mt-2">Belum ada divisi</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="activity-card bg-white rounded-4 shadow-lg p-4">
                    <h4 class="fw-bold text-primary mb-3">
                        <i class="bi bi-cart-check me-2"></i>Pesanan Terbaru
                    </h4>
                    <div class="activity-list">
                        @forelse($recentOrders as $order)
                        <div class="activity-item d-flex align-items-center mb-3 p-3 bg-light rounded-3">
                            <div class="activity-icon me-3">
                                <i class="bi bi-cart-check text-warning"></i>
                            </div>
                            <div class="activity-content flex-grow-1">
                                <h6 class="fw-bold mb-1">{{ $order->customer_name }}</h6>
                                <p class="text-muted small mb-0">{{ $order->produk->name ?? 'Produk tidak ditemukan' }} - {{ $order->getStatusLabel() }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-cart-x display-4"></i>
                            <p class="mt-2">Belum ada pesanan</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats Section -->
<div class="quick-stats-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="quick-stat-card bg-gradient-primary text-white rounded-4 p-4 text-center">
                    <i class="bi bi-calendar-event display-4 mb-3"></i>
                    <h3 class="fw-bold mb-2">{{ App\Models\Event::where('date', '>=', now())->count() }}</h3>
                    <p class="mb-0">Event Mendatang</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="quick-stat-card bg-gradient-success text-white rounded-4 p-4 text-center">
                    <i class="bi bi-people display-4 mb-3"></i>
                    <h3 class="fw-bold mb-2">{{ App\Models\DivisiMember::count() }}</h3>
                    <p class="mb-0">Total Anggota</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="quick-stat-card bg-gradient-warning text-white rounded-4 p-4 text-center">
                    <i class="bi bi-images display-4 mb-3"></i>
                    <h3 class="fw-bold mb-2">{{ App\Models\Galeri::count() }}</h3>
                    <p class="mb-0">Foto Galeri</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="quick-stat-card bg-gradient-info text-white rounded-4 p-4 text-center">
                    <i class="bi bi-box-seam display-4 mb-3"></i>
                    <h3 class="fw-bold mb-2">{{ App\Models\Produk::count() }}</h3>
                    <p class="mb-0">Produk Aktif</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

.admin-avatar {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

/* Statistics Cards */
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: rgba(25, 118, 210, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Action Cards */
.action-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
}

.action-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(25, 118, 210, 0.15) !important;
}

.action-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin: 0 auto;
}

/* Activity Cards */
.activity-card {
    transition: all 0.3s ease;
}

.activity-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.activity-item {
    transition: all 0.3s ease;
}

.activity-item:hover {
    background: #e9ecef !important;
    transform: translateX(10px);
}

.activity-icon {
    width: 40px;
    height: 40px;
    background: rgba(25, 118, 210, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1976d2;
}

/* Quick Stats Cards */
.quick-stat-card {
    transition: all 0.3s ease;
}

.quick-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .admin-info {
        justify-content: center !important;
        margin-top: 1rem;
    }
    
    .display-6 {
        font-size: 2rem;
    }
}

/* Animation Classes */
.transition-all {
    transition: all 0.3s ease;
}
</style>

@endsection
