@extends('layout')
@section('title', 'Divisi | HIMAKOM UYM')
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 60vh; display: flex; align-items: center;">
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
<div class="container py-5">
    <div class="row g-4 justify-content-center">
        @forelse($divisis as $index => $divisi)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="divisi-card card border-0 shadow-lg h-100 text-center bg-white rounded-4 overflow-hidden transition-all animate__animated animate__fadeInUp" 
                 style="animation-delay: {{ $index * 0.1 }}s; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                
                <!-- Card Header with Gradient -->
                <div class="card-header-gradient position-relative overflow-hidden" style="height: 120px; background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        @if($divisi->photo)
                            <img src="{{ asset('uploads/'.$divisi->photo) }}" 
                                 class="divisi-photo rounded-circle border-4 border-white shadow-lg" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="divisi-photo-placeholder rounded-circle border-4 border-white shadow-lg d-flex align-items-center justify-content-center bg-white">
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
                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            <i class="bi bi-people-fill me-1"></i>{{ $divisi->members->count() }} Anggota
                        </span>
                    </div>
                    
                    <div class="card-footer border-0 bg-transparent pb-4">
                        <a href="{{ route('divisi.detail', $divisi->id) }}" 
                           class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-all">
                            <i class="bi bi-arrow-right-circle me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
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
/* Hero Section Styles */
.hero-section {
    position: relative;
    overflow: hidden;
}

.z-3 {
    z-index: 3;
}

/* Floating Shapes Animation */
.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 10%;
    animation-delay: 2s;
}

.shape-3 {
    width: 60px;
    height: 60px;
    top: 40%;
    left: 80%;
    animation-delay: 4s;
}

.shape-4 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    left: 20%;
    animation-delay: 1s;
}

.shape-5 {
    width: 70px;
    height: 70px;
    top: 80%;
    right: 30%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Stats Styles */
.stats-row {
    margin-top: 2rem;
}

.stat-item {
    padding: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-number {
    font-size: 2rem;
    color: #fff;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Divisi Card Styles */
.divisi-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    overflow: hidden;
}

.divisi-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(25, 118, 210, 0.15) !important;
}

.divisi-photo {
    transition: transform 0.3s ease;
}

.divisi-card:hover .divisi-photo {
    transform: scale(1.1);
}

.divisi-photo-placeholder {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.9);
}



/* Button Styles */
.btn-primary {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(25, 118, 210, 0.3);
}

/* Empty State */
.empty-state {
    background: #f8f9fa;
    border-radius: 1rem;
    border: 2px dashed #dee2e6;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        min-height: 50vh;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
    
    .stat-item {
        padding: 0.75rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .members-grid {
        grid-template-columns: 1fr;
    }
}

/* Animation Classes */
.animate__fadeInUp {
    animation-duration: 0.8s;
}

.animate__delay-1s {
    animation-delay: 0.3s;
}

.animate__delay-2s {
    animation-delay: 0.6s;
}
</style>

@endsection