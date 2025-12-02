@extends('layout')
@section('title', 'About Us | HIMAKOM UYM')
@section('content')
@php $about = $about ?? null; @endphp

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 60vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white">
                <div class="hero-content animate__animated animate__fadeInLeft">
                    <h1 class="display-4 fw-bold mb-4">
                        Tentang <span class="text-warning">HIMAKOM</span>
                    </h1>
                    <p class="lead mb-4" style="font-size: 1.3rem; line-height: 1.6;">
                        {{ $about->description ?? 'Himpunan Mahasiswa Ilmu Komputer Universitas Yatsi Madani yang berdedikasi untuk mengembangkan potensi mahasiswa dalam bidang teknologi informasi.' }}
                    </p>
                    <div class="hero-stats">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">2+</div>
                                    <div class="stat-label">Tahun</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">50+</div>
                                    <div class="stat-label">Anggota</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">5+</div>
                                    <div class="stat-label">Event</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center animate__animated animate__fadeInRight">
                <div class="hero-image-container">
                    @if(!empty($about?->image))
                        <img src="{{ asset('uploads/'.$about->image) }}" 
                             class="hero-image rounded-4 shadow-2xl" 
                             style="max-width: 100%; height: auto; border: 4px solid rgba(255,255,255,0.3);">
                    @else
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" 
                             class="hero-image rounded-4 shadow-2xl" 
                             style="max-width: 100%; height: auto; border: 4px solid rgba(255,255,255,0.3);">
                    @endif
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

<!-- About Content Section -->
<div class="about-content-section py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="about-text">
                    <h2 class="display-5 fw-bold text-primary mb-4">{{ $about->title ?? 'Tentang HIMAKOM UYM' }}</h2>
                    <p class="lead mb-4">
                        {{ $about->description ?? 'HIMAKOM UYM adalah organisasi mahasiswa yang berdedikasi untuk mengembangkan potensi mahasiswa Ilmu Komputer melalui berbagai kegiatan akademik, sosial, dan profesional.' }}
                    </p>
                    <p class="text-muted mb-4">
                        Kami berkomitmen untuk membangun generasi digital yang inovatif, profesional, dan berdaya saing global melalui berbagai program dan kegiatan yang berkualitas.
                    </p>
                    
                    <!-- Values Section -->
                    <div class="values-section mt-5">
                        <h4 class="fw-bold text-primary mb-3">Nilai-Nilai Kami</h4>
                        <div class="row g-3">
                            @if($about && is_array($about->values))
                                @foreach($about->values as $index => $value)
                                <div class="col-md-6">
                                    <div class="value-item d-flex align-items-center">
                                        <div class="value-icon me-3">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $value }}</span>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="col-md-6">
                                    <div class="value-item d-flex align-items-center">
                                        <div class="value-icon me-3">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <span class="fw-semibold">Integritas</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="value-item d-flex align-items-center">
                                        <div class="value-icon me-3">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <span class="fw-semibold">Inovasi</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="value-item d-flex align-items-center">
                                        <div class="value-icon me-3">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <span class="fw-semibold">Kolaborasi</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="value-item d-flex align-items-center">
                                        <div class="value-icon me-3">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <span class="fw-semibold">Excellence</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image text-center">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80" 
                         class="img-fluid rounded-4 shadow-lg" 
                         alt="HIMAKOM Team">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- History Section -->
<div class="history-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Sejarah & Perjalanan</h2>
            <p class="lead text-muted">Perjalanan panjang HIMAKOM dalam membangun komunitas teknologi</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="history-content bg-white rounded-4 p-5 shadow-lg">
                    <h4 class="fw-bold text-primary mb-4">
                        <i class="bi bi-clock-history me-2"></i>Sejarah Singkat
                    </h4>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        {{ $about->history ?? 'HIMAKOM UYM didirikan dengan visi untuk menjadi wadah pengembangan potensi mahasiswa Ilmu Komputer yang unggul dan inovatif. Sejak berdirinya, HIMAKOM telah mengadakan berbagai kegiatan yang berkontribusi pada pengembangan skill dan wawasan teknologi mahasiswa.' }}
                    </p>
                    
                    <!-- Milestones -->
                    <div class="milestones-section mt-5">
                        <h5 class="fw-bold text-primary mb-4">Milestone HIMAKOM</h5>
                        <div class="timeline">
                            @if($about && is_array($about->milestones))
                                @foreach($about->milestones as $index => $milestone)
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">{{ $milestone }}</h6>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">2024 - Pendirian HIMAKOM</h6>
                                        <p class="text-muted">HIMAKOM UYM resmi didirikan sebagai organisasi mahasiswa Ilmu Komputer.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">2024 - Program Pengembangan</h6>
                                        <p class="text-muted">Meluncurkan berbagai program pengembangan skill dan kompetensi.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">2025 - Ekspansi Kegiatan</h6>
                                        <p class="text-muted">Memperluas kegiatan ke berbagai bidang teknologi dan inovasi.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">2025 - Prestasi Nasional</h6>
                                        <p class="text-muted">Mencapai berbagai prestasi di tingkat nasional dan regional.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">2025 - Digital Transformation</h6>
                                        <p class="text-muted">Mengadopsi teknologi digital dalam semua aspek kegiatan.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="achievements-card bg-white rounded-4 p-4 shadow-lg h-100">
                    <h4 class="fw-bold text-primary mb-4">
                        <i class="bi bi-trophy-fill me-2"></i>Pencapaian
                    </h4>
                    
                    <div class="achievement-items">
                        <div class="achievement-item d-flex align-items-center mb-3">
                            <div class="achievement-icon me-3">
                                <i class="bi bi-award text-warning"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">5+ Prestasi</h6>
                                <p class="text-muted small mb-0">Kompetisi nasional</p>
                            </div>
                        </div>
                        
                        <div class="achievement-item d-flex align-items-center mb-3">
                            <div class="achievement-icon me-3">
                                <i class="bi bi-people text-success"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">50+ Anggota</h6>
                                <p class="text-muted small mb-0">Mahasiswa aktif</p>
                            </div>
                        </div>
                        
                        <div class="achievement-item d-flex align-items-center mb-3">
                            <div class="achievement-icon me-3">
                                <i class="bi bi-calendar-event text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">5+ Event</h6>
                                <p class="text-muted small mb-0">Kegiatan tahunan</p>
                            </div>
                        </div>
                        
                        <div class="achievement-item d-flex align-items-center mb-3">
                            <div class="achievement-icon me-3">
                                <i class="bi bi-handshake text-info"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">15+ Partner</h6>
                                <p class="text-muted small mb-0">Kerjasama eksternal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission Vision Section -->
<div class="mission-vision-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="mission-card bg-white rounded-4 p-5 shadow-lg h-100">
                    <div class="card-icon mb-4">
                        <i class="bi bi-bullseye text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="fw-bold text-primary mb-3">Visi</h3>
                    <p class="text-muted" style="line-height: 1.8;">
                        Mewujudkan HIMAKOM sebagai organisasi mahasiswa yang unggul, inovatif, dan berkontribusi aktif dalam pengembangan teknologi informasi di tingkat nasional dan internasional.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="vision-card bg-white rounded-4 p-5 shadow-lg h-100">
                    <div class="card-icon mb-4">
                        <i class="bi bi-lightbulb text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="fw-bold text-primary mb-3">Misi</h3>
                    <ul class="text-muted" style="line-height: 1.8;">
                        <li>Mengembangkan potensi dan kreativitas mahasiswa Ilmu Komputer</li>
                        <li>Meningkatkan solidaritas dan profesionalisme anggota</li>
                        <li>Menjadi pelopor inovasi teknologi di lingkungan kampus</li>
                        <li>Membangun jaringan kerjasama dengan berbagai pihak</li>
                    </ul>
                </div>
            </div>
        </div>
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

/* Hero Stats */
.hero-stats {
    margin-top: 2rem;
}

.stat-item {
    padding: 1rem;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 1rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-align: center;
}

.stat-number {
    font-size: 1.8rem;
    color: #fff;
}

.stat-label {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Hero Image */
.hero-image-container {
    position: relative;
}

.hero-image {
    transition: transform 0.3s ease;
}

.hero-image:hover {
    transform: scale(1.05);
}

/* Values Section */
.value-item {
    transition: all 0.3s ease;
}

.value-item:hover {
    transform: translateX(10px);
}

.value-icon {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    background: #1976d2;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #1976d2;
}

.timeline-content {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    border-left: 4px solid #1976d2;
}

/* Achievement Items */
.achievement-item {
    transition: all 0.3s ease;
}

.achievement-item:hover {
    transform: translateX(10px);
}

.achievement-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* Mission Vision Cards */
.mission-card, .vision-card {
    transition: all 0.3s ease;
}

.mission-card:hover, .vision-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.card-icon {
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

/* Team Cards */
.team-card {
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.team-avatar img {
    transition: transform 0.3s ease;
}

.team-card:hover .team-avatar img {
    transform: scale(1.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        min-height: 50vh;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
    
    .display-5 {
        font-size: 2rem;
    }
    
    .stat-item {
        padding: 0.75rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}

/* Animation Classes */
.animate__fadeInLeft {
    animation-duration: 0.8s;
}

.animate__fadeInRight {
    animation-duration: 0.8s;
}
</style>

@endsection