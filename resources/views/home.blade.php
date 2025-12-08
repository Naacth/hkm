@extends('layout')
@section('title', 'Home | HIMAKOM UYM')
@section('meta_description', 'HIMAKOM UYM: organisasi mahasiswa Ilmu Komputer. Lihat event, produk, dan galeri terbaru.')
@section('jsonld')
{
  "&#64;context": "https://schema.org",
  "@type": "Organization",
  "name": "HIMAKOM Universitas Yatsi Madani",
  "url": "{{ url('/') }}",
  "logo": "{{ url('/logo-himakom.png') }}"
}
@endsection
@section('content')

@section('hero')
<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white">
                <div class="hero-content">
                    <div class="hero-badge mb-4">
                        <span class="badge bg-light text-primary px-4 py-2 rounded-pill fs-6 fw-semibold">
                            <i class="bi bi-star-fill me-2"></i>Organisasi Mahasiswa Terdepan
                        </span>
                    </div>
                    <h1 class="display-4 display-lg-2 fw-bold mb-4 hero-title">
                        <span class="text-gradient">HIMAKOM</span>
                        <br>
                        <span class="fs-4 fs-lg-3 fw-medium">Universitas Yatsi Madani</span>
                    </h1>
                    <p class="lead mb-4" style="font-size: 1.4rem; line-height: 1.7; opacity: 0.95;">
                        Himpunan Mahasiswa <strong>Ilmu Komputer</strong> yang berdedikasi mengembangkan potensi dan kreativitas mahasiswa
                    </p>
                    <div class="hero-features mb-5">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.2rem;"></i>
                                    <span>Pengembangan Skill</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.2rem;"></i>
                                    <span>Networking Profesional</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.2rem;"></i>
                                    <span>Event & Workshop</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="feature-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.2rem;"></i>
                                    <span>Sertifikat Resmi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-buttons d-flex flex-wrap gap-3">
                        <a href="/about" class="btn btn-light btn-lg rounded-pill px-4 py-3 shadow-lg" style="min-width: 180px;">
                            <i class="bi bi-info-circle me-2"></i>Tentang Kami
                        </a>
                        <a href="/event" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 shadow-lg" style="min-width: 180px;">
                            <i class="bi bi-calendar-event me-2"></i>Lihat Event
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image-container position-relative">
                    <div class="hero-image-bg position-absolute top-50 start-50 translate-middle" 
                         style="width: 400px; height: 400px; background: rgba(255,255,255,0.1); border-radius: 50%; filter: blur(100px);"></div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80" 
                         class="hero-image rounded-4 shadow-2xl position-relative" 
                         style="max-width: 90%; height: auto; border: 6px solid rgba(255,255,255,0.2); transform: rotate(-2deg);">
                    <div class="hero-decoration position-absolute top-0 end-0 translate-middle">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="bi bi-code-slash text-white" style="font-size: 2rem;"></i>
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
    
    <!-- Scroll Down Indicator -->
    <div class="scroll-indicator position-absolute bottom-0 start-50 translate-middle-x mb-4">
        <div class="scroll-arrow text-white text-center">
            <div class="mb-2">Scroll Down</div>
            <i class="bi bi-chevron-down" style="font-size: 1.5rem; animation: bounce 2s infinite;"></i>
        </div>
    </div>
</div>

</div>
<!-- End Hero Section -->

<!-- Stats Section -->
<div class="stats-section py-5 bg-light">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 transition-all">
                    <i class="bi bi-people-fill text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2 counter" data-target="{{ $totalMembers ?? 50 }}">{{ $totalMembers ?? 50 }}+</h3>
                    <p class="text-muted mb-0">Anggota Aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 transition-all">
                    <i class="bi bi-calendar-check text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2 counter" data-target="{{ $totalEvents ?? 5 }}">{{ $totalEvents ?? 5 }}+</h3>
                    <p class="text-muted mb-0">Event Aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 transition-all">
                    <i class="bi bi-diagram-3 text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2 counter" data-target="{{ $divisiCount ?? 5 }}">{{ $divisiCount ?? 5 }}+</h3>
                    <p class="text-muted mb-0">Divisi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 transition-all">
                    <i class="bi bi-award text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2 counter" data-target="{{ $upcomingEvents ?? 3 }}">{{ $upcomingEvents ?? 3 }}+</h3>
                    <p class="text-muted mb-0">Event Mendatang</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-content">
                    <h2 class="display-5 fw-bold text-primary mb-4">Tentang HIMAKOM UYM</h2>
                    <p class="lead mb-4">
                        HIMAKOM UYM adalah organisasi mahasiswa yang berdedikasi untuk mengembangkan potensi mahasiswa Ilmu Komputer melalui berbagai kegiatan akademik, sosial, dan profesional.
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="feature-item d-flex align-items-start">
                                <div class="feature-icon me-3">
                                    <i class="bi bi-bullseye text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Visi</h5>
                                    <p class="text-muted small">Mewujudkan HIMAKOM sebagai organisasi mahasiswa yang unggul, inovatif, dan berkontribusi aktif dalam pengembangan teknologi informasi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-item d-flex align-items-start">
                                <div class="feature-icon me-3">
                                    <i class="bi bi-lightbulb text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Misi</h5>
                                    <p class="text-muted small">Mengembangkan potensi dan kreativitas mahasiswa Ilmu Komputer melalui berbagai program dan kegiatan yang inovatif.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image text-center">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" 
                         class="img-fluid rounded-4 shadow-lg" 
                         alt="HIMAKOM Team">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<!-- Latest Events Section -->
@if($latestEvents && $latestEvents->count() > 0)
<div class="events-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Event Terbaru</h2>
            <p class="lead text-muted">Jangan lewatkan kegiatan menarik dari HIMAKOM</p>
        </div>
        <div class="row g-4">
            @foreach($latestEvents as $event)
            <div class="col-lg-4 col-md-6">
                <div class="event-card bg-white rounded-4 shadow-sm h-100 overflow-hidden transition-all">
                    <div class="event-image-container position-relative">
                        @if($event->image)
                            <img src="{{ $event->image_url }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="{{ $event->title }}">
                        @else
                            <div class="bg-primary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-calendar-event text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="event-badge position-absolute top-0 end-0 m-3">
                            <span class="badge bg-{{ $event->status == 'active' ? 'success' : 'secondary' }} px-3 py-2">
                                {{ $event->status == 'active' ? 'Aktif' : 'Selesai' }}
                            </span>
                        </div>
                    </div>
                    <div class="event-content p-4">
                        <div class="event-meta mb-3">
                            <div class="d-flex align-items-center text-muted small mb-2">
                                <i class="bi bi-calendar3 me-2"></i>
                                <span>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</span>
                            </div>
                            @if($event->location)
                            <div class="d-flex align-items-center text-muted small mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-3">{{ $event->title }}</h5>
                        <p class="text-muted mb-4">{{ Str::limit($event->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="event-price">
                                @if($event->price > 0)
                                    <span class="fw-bold text-primary">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                @else
                                    <span class="fw-bold text-success">Gratis</span>
                                @endif
                            </div>
                            <a href="/event" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-arrow-right me-1"></i>Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="/event" class="btn btn-primary btn-lg rounded-pill">
                <i class="bi bi-calendar-event me-2"></i>Lihat Semua Event
            </a>
        </div>
    </div>
</div>
@endif

<!-- Features Section -->
<div class="features-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Keunggulan HIMAKOM</h2>
            <p class="lead text-muted">Mengapa memilih bergabung dengan HIMAKOM?</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card bg-white rounded-4 shadow-sm h-100 p-4 text-center transition-all">
                    <div class="feature-icon-container mb-4">
                        <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Komunitas Solid</h4>
                    <p class="text-muted">Lingkungan yang suportif, kekeluargaan, dan kolaboratif untuk semua anggota dengan networking yang luas.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card bg-white rounded-4 shadow-sm h-100 p-4 text-center transition-all">
                    <div class="feature-icon-container mb-4">
                        <i class="bi bi-award-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Pengembangan Diri</h4>
                    <p class="text-muted">Beragam pelatihan, seminar, workshop, dan kompetisi untuk meningkatkan skill dan wawasan teknologi.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card bg-white rounded-4 shadow-sm h-100 p-4 text-center transition-all">
                    <div class="feature-icon-container mb-4">
                        <i class="bi bi-lightning-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Inovasi & Kreativitas</h4>
                    <p class="text-muted">Ruang untuk menuangkan ide kreatif dan inovatif di bidang teknologi informasi dengan dukungan penuh.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Products Section -->
@if($latestProducts && $latestProducts->count() > 0)
<div class="products-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Produk Terbaru</h2>
            <p class="lead text-muted">Temukan produk unggulan dari HIMAKOM</p>
        </div>
        <div class="row g-4">
            @foreach($latestProducts as $produk)
            <div class="col-lg-4 col-md-6">
                <div class="product-card bg-white rounded-4 shadow-sm h-100 overflow-hidden transition-all">
                    <div class="product-image-container position-relative">
                        @if($produk->image)
                            <img src="{{ asset('uploads/'.$produk->image) }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="{{ $produk->name }}">
                        @else
                            <div class="bg-primary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-box-seam text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="product-badge position-absolute top-0 end-0 m-3">
                            <span class="badge bg-{{ $produk->status == 'active' ? 'success' : 'secondary' }} px-3 py-2">
                                {{ $produk->status == 'active' ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>
                    </div>
                    <div class="product-content p-4">
                        <h5 class="fw-bold mb-3">{{ $produk->name }}</h5>
                        <p class="text-muted mb-4">{{ Str::limit($produk->description, 100) }}</p>
                        
                        @if($produk->features)
                        <div class="product-features mb-4">
                            <h6 class="fw-bold text-primary mb-2">Fitur:</h6>
                            <ul class="list-unstyled small text-muted">
                                @foreach(explode(',', $produk->features) as $feature)
                                    <li class="mb-1"><i class="bi bi-check-circle text-success me-2"></i>{{ trim($feature) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="product-price">
                                <span class="fw-bold text-primary fs-5">Rp {{ number_format($produk->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="/produk" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>Lihat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="/produk" class="btn btn-primary btn-lg rounded-pill">
                <i class="bi bi-box-seam me-2"></i>Lihat Semua Produk
            </a>
        </div>
    </div>
</div>
@endif

<!-- Testimonial Section -->
<div class="testimonial-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Kata Mereka Tentang HIMAKOM</h2>
            <p class="lead text-muted">Pengalaman dan kesan dari anggota HIMAKOM</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card bg-white rounded-4 shadow-sm p-4 h-100">
                    <div class="testimonial-content mb-4">
                        <div class="quote-icon mb-3">
                            <i class="bi bi-quote text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <p class="text-muted mb-0">"HIMAKOM memberikan saya kesempatan untuk mengembangkan skill programming dan networking yang sangat berharga. Komunitas yang sangat solid dan suportif!"</p>
                    </div>
                    <div class="testimonial-author d-flex align-items-center">
                        <div class="author-avatar me-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-person text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Ahmad Rizki</h6>
                            <small class="text-muted">Anggota Divisi Programming</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card bg-white rounded-4 shadow-sm p-4 h-100">
                    <div class="testimonial-content mb-4">
                        <div class="quote-icon mb-3">
                            <i class="bi bi-quote text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <p class="text-muted mb-0">"Melalui HIMAKOM, saya belajar banyak tentang leadership dan project management. Event-event yang diadakan sangat bermanfaat untuk pengembangan diri."</p>
                    </div>
                    <div class="testimonial-author d-flex align-items-center">
                        <div class="author-avatar me-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-person text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Sarah Putri</h6>
                            <small class="text-muted">Ketua Divisi Design</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card bg-white rounded-4 shadow-sm p-4 h-100">
                    <div class="testimonial-content mb-4">
                        <div class="quote-icon mb-3">
                            <i class="bi bi-quote text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <p class="text-muted mb-0">"HIMAKOM bukan hanya organisasi, tapi keluarga. Di sini saya menemukan teman-teman seperjuangan dan mentor yang selalu siap membantu."</p>
                    </div>
                    <div class="testimonial-author d-flex align-items-center">
                        <div class="author-avatar me-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-person text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Muhammad Fajar</h6>
                            <small class="text-muted">Anggota Divisi Networking</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section py-5 text-center" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);">
    <div class="container">
        <h2 class="display-5 fw-bold text-white mb-4">Bergabunglah dengan HIMAKOM</h2>
        <p class="lead text-white mb-5" style="opacity: 0.9;">
            Mari bersama-sama membangun masa depan teknologi yang lebih baik
        </p>
        <a href="/event" class="btn btn-light btn-lg rounded-pill px-5 py-3 shadow-sm">
            <i class="bi bi-calendar-event me-2"></i>Lihat Event & Kegiatan
        </a>
    </div>
</div>

<!-- Gallery Preview Section -->
@if($latestGallery && $latestGallery->count() > 0)
<div class="gallery-preview py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Galeri Kegiatan</h2>
            <p class="lead text-muted">Momen-momen berharga dari berbagai kegiatan HIMAKOM</p>
        </div>
        <div class="row g-4">
            @foreach($latestGallery as $gallery)
            <div class="col-md-4">
                <div class="gallery-item rounded-4 overflow-hidden shadow-sm">
                    @if($gallery->image)
                        <img src="{{ asset('uploads/'.$gallery->image) }}" 
                             class="img-fluid w-100" 
                             style="height: 250px; object-fit: cover;" 
                             alt="{{ $gallery->title }}">
                    @else
                        <div class="bg-primary d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="gallery-overlay p-3 bg-white">
                        <h5 class="fw-bold mb-2">{{ $gallery->title }}</h5>
                        <p class="text-muted small mb-0">{{ Str::limit($gallery->description, 80) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="/galeri" class="btn btn-outline-primary btn-lg rounded-pill">
                <i class="bi bi-images me-2"></i>Lihat Galeri Lengkap
            </a>
        </div>
    </div>
</div>
@endif

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

/* Stats Cards */
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

/* Feature Cards */
.feature-card {
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(25, 118, 210, 0.15) !important;
}

.feature-icon-container {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.feature-icon-container i {
    color: white !important;
    font-size: 2rem !important;
}

/* Event Cards */
.event-card {
    transition: all 0.3s ease;
    position: relative;
}

.event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(25, 118, 210, 0.15) !important;
}

.event-badge {
    z-index: 2;
}

/* Product Cards */
.product-card {
    transition: all 0.3s ease;
    position: relative;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(25, 118, 210, 0.15) !important;
}

.product-badge {
    z-index: 2;
}

/* Gallery Items */
.gallery-item {
    transition: all 0.3s ease;
    position: relative;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    transform: translateY(0);
}

/* Testimonial Cards */
.testimonial-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.testimonial-card .card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.testimonial-card .testimonial-text {
    flex: 1;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.quote-icon {
    opacity: 0.7;
}

/* Responsive Styles */
@media (max-width: 991.98px) {
    .hero-section {
        text-align: center;
        padding: 4rem 0;
    }
    
    .hero-image-container {
        margin-top: 3rem;
    }
    
    .hero-buttons {
        justify-content: center;
    }
    
    .stat-card {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 767.98px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-buttons .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .section-spacing {
        padding: 3rem 0;
    }
    
    .feature-item {
        margin-bottom: 1rem;
    }
}

/* Animation for elements */
.fade-in {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Card hover effect */
.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

/* Button hover effect */
.btn-hover {
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-hover::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.2);
    transition: width 0.3s ease;
    z-index: -1;
}

.btn-hover:hover::after {
    width: 100%;
}

/* Loading animation */
@keyframes pulse {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
}

.loading {
    animation: pulse 1.5s infinite;
    background: #f0f0f0;
    border-radius: 0.25rem;
}

/* Responsive images */
.img-cover {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Section spacing */
.section-spacing {
    padding: 5rem 0;
}

.author-avatar {
    transition: transform 0.3s ease;
}

.testimonial-card:hover .author-avatar {
    transform: scale(1.1);
}

/* Button Styles */
.btn-light {
    background: rgba(255, 255, 255, 0.9);
    border: none;
    transition: all 0.3s ease;
}

.btn-light:hover {
    background: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
}

.btn-outline-light {
    border-color: rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
}

.btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fff;
    transform: translateY(-2px);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        min-height: 80vh;
    }
    
    .display-3 {
        font-size: 2.5rem;
    }
    
    .display-5 {
        font-size: 2rem;
    }
    
    .hero-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
}

/* Animation Classes */
.animate__fadeInLeft {
    animation-duration: 0.8s;
}

.animate__fadeInRight {
    animation-duration: 0.8s;
}

.transition-all {
    transition: all 0.3s ease;
}

/* Counter Animation */
.counter {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1976d2;
}

/* Scroll Animation */
.fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.fade-in-up.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Loading Animation */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { left: -100%; }
    100% { left: 100%; }
}
</style>

<!-- JavaScript for Home Page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current) + '+';
            }, 16);
        });
    }

    // Scroll Animation
    function handleScrollAnimation() {
        const elements = document.querySelectorAll('.fade-in-up');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (elementTop < window.innerHeight - elementVisible) {
                element.classList.add('visible');
            }
        });
    }

    // Intersection Observer for better performance
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // Trigger counter animation when stats section is visible
                if (entry.target.classList.contains('stats-section')) {
                    setTimeout(animateCounters, 500);
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.stats-section, .about-section, .features-section, .events-section, .products-section, .testimonial-section, .gallery-preview').forEach(el => {
        el.classList.add('fade-in-up');
        observer.observe(el);
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            const rate = scrolled * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
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

    // Add loading animation to cards
    document.querySelectorAll('.event-card, .product-card, .testimonial-card').forEach(card => {
        card.classList.add('loading');
        setTimeout(() => {
            card.classList.remove('loading');
        }, Math.random() * 1000 + 500);
    });

    // Initialize AOS (Animate On Scroll) alternative
    handleScrollAnimation();
    window.addEventListener('scroll', handleScrollAnimation);

    // Add hover effects to cards
    document.querySelectorAll('.event-card, .product-card, .testimonial-card, .feature-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add click ripple effect to buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});

// Add ripple effect CSS
const style = document.createElement('style');
style.textContent = `
    .btn {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>

@endsection 