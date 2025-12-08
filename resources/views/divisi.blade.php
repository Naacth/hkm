@extends('layout')
@section('title', 'Divisi | HIMAKOM UYM')
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); min-height: 60vh; display: flex; align-items: center; padding: 6rem 0;">
    <div class="container position-relative z-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">
                        <i class="bi bi-people-fill me-3"></i>Divisi HIMAKOM
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.3rem;">
                        Setiap divisi memiliki peran penting dalam mendukung visi dan misi HIMAKOM UYM
                    </p>
                    <div class="stats-row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="row justify-content-center">
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $divisis->count() }}</div>
                                    <div class="stat-label">Divisi</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $divisis->sum(function($divisi) { return $divisi->members->count(); }) }}</div>
                                    <div class="stat-label">Anggota</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $divisis->filter(function($divisi) { return $divisi->members->count() > 0; })->count() }}</div>
                                    <div class="stat-label">Aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animated Background Elements -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>
</div>

<!-- Divisi Cards Section -->
<div class="container py-5 section-spacing">
    <div class="row g-4 justify-content-center">
        @forelse($divisis as $index => $divisi)
        <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
            <div class="divisi-card card border-0 shadow-lg h-100 text-center bg-white rounded-4 overflow-hidden transition-all" 
                 style="transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                
                <!-- Card Header with Gradient -->
                <div class="card-header-gradient position-relative overflow-hidden" style="height: 120px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        @if($divisi->photo)
                            <img src="{{ asset('uploads/'.$divisi->photo) }}" 
                                 class="divisi-photo rounded-circle border-4 border-white shadow-lg img-cover" 
                                 style="width: 100px; height: 100px;"
                                 alt="{{ $divisi->name }}"
                                 loading="lazy">
                        @else
                            <div class="divisi-photo-placeholder rounded-circle border-4 border-white shadow-lg d-flex align-items-center justify-content-center bg-white" style="width: 100px; height: 100px;">
                                <i class="bi bi-people-fill text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="card-body pb-0 pt-5">
                    <h5 class="fw-bold mb-2 text-primary">{{ $divisi->name }}</h5>
                    <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.5;">
                        {{ Str::limit($divisi->description, 120) }}
                    </p>
                    
                    <!-- Member Count Badge -->
                    <div class="mt-3 mb-4">
                        <span class="badge bg-primary rounded-pill px-3 py-2 shadow-sm">
                            <i class="bi bi-people-fill me-1"></i>{{ $divisi->members->count() }} Anggota
                        </span>
                    </div>
                    
                    <div class="card-footer border-0 bg-transparent pb-4">
                        <a href="{{ route('divisi.detail', $divisi->id) }}" 
                           class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all btn-hover">
                            <i class="bi bi-arrow-right-circle me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5" data-aos="fade-up">
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="bi bi-people display-1 text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">Belum ada data divisi</h4>
                <p class="text-muted">Divisi akan ditampilkan di sini setelah data tersedia.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
/* Hero Section */
.hero-section {
    position: relative;
    overflow: hidden;
    color: white;
}

.hero-content {
    position: relative;
    z-index: 2;
}

/* Stats Row */
.stats-row {
    margin-top: 3rem;
}

.stat-item {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    padding: 1.25rem;
    text-align: center;
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
    height: 100%;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.2);
}

.stat-number {
    font-size: 1.75rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.25rem;
    line-height: 1.2;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0;
}

/* Divisi Cards */
.divisi-card {
    border: none;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.divisi-card .card-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.divisi-card .card-text {
    flex: 1;
    margin-bottom: 1.5rem;
}

.divisi-card .card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--text-dark);
}

.divisi-card .card-text {
    color: var(--text-muted);
    font-size: 0.95rem;
    line-height: 1.6;
}

.divisi-card .btn {
    padding: 0.6rem 1.5rem;
    font-weight: 600;
    border-radius: 2rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    margin-top: auto;
}

.divisi-card .btn i {
    transition: transform 0.3s ease;
}

.divisi-card .btn:hover i {
    transform: translateX(3px);
}

.divisi-photo {
    transition: transform 0.3s ease;
    border: 4px solid white;
    background: white;
}

.divisi-photo-placeholder {
    width: 100px;
    height: 100px;
    background: white;
    transition: all 0.3s ease;
}

.divisi-card:hover .divisi-photo {
    transform: scale(1.1);
}

/* Hover Effect */
.divisi-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(25, 118, 210, 0.15) !important;
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .hero-section {
        min-height: 50vh;
        padding: 5rem 0;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
    
    .stat-item {
        padding: 1rem 0.5rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .divisi-card {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 767.98px) {
    .hero-section {
        padding: 4rem 0;
        text-align: center;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .stat-item {
        margin-bottom: 1rem;
    }
    
    .stats-row .col-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
    
    .stats-row .col-4:last-child {
        flex: 0 0 100%;
        max-width: 100%;
        margin-top: 1rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate__fadeInUp {
    animation-name: fadeInUp;
    animation-duration: 0.8s;
    animation-fill-mode: both;
}

.animate__delay-1s {
    animation-delay: 0.5s;
}

.animate__delay-2s {
    animation-delay: 1s;
}

/* No Divisi Message */
.no-divisi {
    padding: 3rem 0;
    text-align: center;
    background: #f8f9fa;
    border-radius: 1rem;
    margin: 2rem 0;
}

.no-divisi i {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.no-divisi h4 {
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.no-divisi p {
    color: var(--text-muted);
    max-width: 500px;
    margin: 0 auto 1.5rem;
}
</style>

@endsection