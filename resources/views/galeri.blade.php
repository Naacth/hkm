@extends('layout')
@section('title', 'Galeri | HIMAKOM UYM')
@section('meta_description', 'Galeri foto kegiatan HIMAKOM UYM: dokumentasi event, workshop, dan aktivitas lainnya.')
@section('jsonld')
{
  "&#64;context": "https://schema.org",
  "@type": "ImageGallery",
  "name": "Galeri HIMAKOM UYM",
  "image": [
    @foreach($galeris as $g)"{{ asset('uploads/'.$g->image) }}"@if(!$loop->last),@endif @endforeach
  ]
}
@endsection
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 60vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">
                        <i class="bi bi-images me-3"></i>Galeri Kegiatan
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.3rem;">
                        Momen-momen berharga dari berbagai kegiatan HIMAKOM UYM
                    </p>
                    <div class="stats-row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="row justify-content-center">
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $galeris->count() }}</div>
                                    <div class="stat-label">Total Foto</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $galeris->count() > 0 ? $galeris->count() : 0 }}</div>
                                    <div class="stat-label">Kegiatan</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">2024</div>
                                    <div class="stat-label">Tahun Aktif</div>
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

<!-- Featured Gallery Section -->
<div class="featured-gallery py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Galeri Pilihan</h2>
            <p class="lead text-muted">Momen terbaik dari berbagai kegiatan HIMAKOM</p>
        </div>
        
        @if($galeris->count() > 0)
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="featured-image-container rounded-4 overflow-hidden shadow-lg position-relative">
                    <img src="{{ asset('uploads/'.$galeris->first()->image) }}" 
                         class="featured-image w-100" 
                         style="height: 400px; object-fit: cover;" 
                         alt="{{ $galeris->first()->title }}"
                         onerror="this.src='https://via.placeholder.com/800x400/1976d2/ffffff?text=Galeri+HIMAKOM'">
                    <div class="featured-overlay p-4">
                        <h4 class="text-white fw-bold mb-2">{{ $galeris->first()->title }}</h4>
                        <p class="text-white mb-0" style="opacity: 0.9;">{{ $galeris->first()->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row g-3">
                    @foreach($galeris->skip(1)->take(4) as $index => $galeri)
                    <div class="col-6">
                        <div class="small-gallery-item rounded-3 overflow-hidden shadow-sm position-relative">
                            <img src="{{ asset('uploads/'.$galeri->image) }}" 
                                 class="w-100" 
                                 style="height: 120px; object-fit: cover;" 
                                 alt="{{ $galeri->title }}"
                                 onerror="this.src='https://via.placeholder.com/300x120/1976d2/ffffff?text=Galeri'">
                            <div class="small-overlay">
                                <i class="bi bi-zoom-in text-white"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="featured-placeholder text-center py-5">
            <div class="placeholder-image rounded-4 overflow-hidden shadow-lg mx-auto" style="max-width: 600px;">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80" 
                     class="w-100" 
                     style="height: 400px; object-fit: cover;" 
                     alt="Galeri Placeholder">
                <div class="placeholder-overlay p-4">
                    <h4 class="text-white fw-bold mb-2">Galeri HIMAKOM</h4>
                    <p class="text-white mb-0" style="opacity: 0.9;">Momen terbaik dari berbagai kegiatan HIMAKOM UYM</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Gallery Grid Section -->
<div class="gallery-grid-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Semua Foto</h2>
            <p class="lead text-muted">Jelajahi semua momen berharga dari kegiatan HIMAKOM</p>
        </div>
        
        @if($galeris->count() > 0)
        <div class="gallery-masonry">
            @foreach($galeris as $index => $galeri)
            <div class="gallery-item animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="gallery-card rounded-4 overflow-hidden shadow-sm transition-all">
                    <div class="gallery-image-container position-relative">
                        <img src="{{ asset('uploads/'.$galeri->image) }}" 
                             class="gallery-image w-100" 
                             style="height: 250px; object-fit: cover;" 
                             alt="{{ $galeri->title }}"
                             onerror="this.src='https://via.placeholder.com/400x250/1976d2/ffffff?text=Galeri+HIMAKOM'">
                        <div class="gallery-overlay">
                            <div class="overlay-content text-center">
                                <h5 class="text-white fw-bold mb-2">{{ $galeri->title }}</h5>
                                <p class="text-white small mb-3" style="opacity: 0.9;">{{ Str::limit($galeri->description, 80) }}</p>
                                <button class="btn btn-light btn-sm rounded-pill" 
                                        onclick="showGalleryDetails('{{ $galeri->title }}', '{{ $galeri->description }}', '{{ asset('uploads/'.$galeri->image) }}')">
                                    <i class="bi bi-eye me-1"></i>Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-gallery text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-images display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada foto galeri</h4>
            <p class="text-muted">Foto galeri akan ditampilkan di sini setelah data tersedia.</p>
        </div>
        @endif
    </div>
</div>

<!-- Quote Section -->
<div class="quote-section py-5 text-center" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);">
    <div class="container">
        <div class="quote-content text-white">
            <i class="bi bi-quote display-1 mb-4" style="opacity: 0.3;"></i>
            <blockquote class="blockquote">
                <p class="lead mb-3" style="font-size: 1.3rem;">
                    "Setiap momen di HIMAKOM adalah inspirasi untuk terus berkembang dan berkontribusi dalam dunia teknologi."
                </p>
                <footer class="blockquote-footer text-white" style="opacity: 0.8;">
                    <cite>Ketua HIMAKOM UYM</cite>
                </footer>
            </blockquote>
        </div>
    </div>
</div>

<!-- Gallery Details Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-images me-2"></i>Detail Galeri
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="galleryModalContent">
                    <!-- Content will be populated by JavaScript -->
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

/* Stats Styles */
.stats-row {
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

/* Featured Gallery */
.featured-image-container {
    position: relative;
    transition: transform 0.3s ease;
}

.featured-image-container:hover {
    transform: scale(1.02);
}

.featured-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
}

.small-gallery-item {
    transition: transform 0.3s ease;
}

.small-gallery-item:hover {
    transform: scale(1.05);
}

.small-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.small-gallery-item:hover .small-overlay {
    opacity: 1;
}

/* Gallery Masonry */
.gallery-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.gallery-card {
    transition: all 0.3s ease;
    background: white;
}

.gallery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
}

.gallery-image-container {
    position: relative;
    overflow: hidden;
}

.gallery-image {
    transition: transform 0.3s ease;
}

.gallery-card:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(25, 118, 210, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.overlay-content {
    padding: 1rem;
}

/* Quote Section */
.quote-section {
    position: relative;
}

.quote-content {
    position: relative;
    z-index: 2;
}

/* Empty State */
.empty-gallery {
    background: #fff;
    border-radius: 1rem;
    border: 2px dashed #dee2e6;
}

/* Modal Styles */
.modal-content {
    border: none;
}

.modal-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
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
    
    .gallery-masonry {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
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

.transition-all {
    transition: all 0.3s ease;
}
</style>

<script>
function showGalleryDetails(title, description, imageUrl) {
    const modalContent = document.getElementById('galleryModalContent');
    modalContent.innerHTML = `
        <div class="text-center mb-4">
            <img src="${imageUrl}" class="img-fluid rounded-3 shadow-sm mb-3" alt="${title}" style="max-height: 400px; object-fit: cover;">
            <h4 class="fw-bold text-primary mb-2">${title}</h4>
        </div>
        <div class="gallery-details">
            <div class="detail-item mb-3">
                <i class="bi bi-info-circle text-primary me-2"></i>
                <span class="fw-semibold">Judul:</span> ${title}
            </div>
            <div class="detail-item mb-3">
                <i class="bi bi-image text-primary me-2"></i>
                <span class="fw-semibold">Deskripsi:</span>
            </div>
            <div class="gallery-description p-3 bg-light rounded-3">
                <p class="mb-0">${description}</p>
            </div>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    modal.show();
}
</script>

@endsection