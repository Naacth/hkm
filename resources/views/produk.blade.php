@extends('layout')
@section('title', 'Produk Kami | HIMAKOM UYM')
@section('meta_description', 'Produk dan layanan teknologi dari HIMAKOM UYM: pengembangan software, pelatihan, konsultasi.')
@section('jsonld')
{
  "&#64;context": "https://schema.org",
  "@type": "ItemList",
  "name": "Produk HIMAKOM UYM",
  "itemListElement": [
    @foreach($produks as $i => $p)
    {
      "&#64;type": "Product",
      "name": "{{ addslashes($p->name) }}",
      @if($p->image)"image": "{{ asset('uploads/'.$p->image) }}",@endif
      "description": "{{ addslashes(Str::limit($p->description, 160)) }}",
      @if(!empty($p->price))"offers": {"&#64;type":"Offer","price":"{{ $p->price }}","priceCurrency":"IDR"},@endif
      "position": {{ $i + 1 }}
    }@if(!$loop->last),@endif
    @endforeach
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
                        <i class="bi bi-box-seam-fill me-3"></i>Produk & Layanan
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.3rem;">
                        Solusi teknologi inovatif dan layanan berkualitas dari HIMAKOM UYM
                    </p>
                    <div class="stats-row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="row justify-content-center">
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $produks->count() }}</div>
                                    <div class="stat-label">Produk</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">100%</div>
                                    <div class="stat-label">Kualitas</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">24/7</div>
                                    <div class="stat-label">Support</div>
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

<!-- Products Section -->
<div class="products-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Produk & Layanan Unggulan</h2>
            <p class="lead text-muted">Berbagai solusi teknologi yang kami tawarkan untuk mendukung pengembangan mahasiswa dan komunitas</p>
        </div>
        
        @if($produks->count() > 0)
        <div class="row g-4">
            @foreach($produks as $index => $produk)
            <div class="col-lg-4 col-md-6">
                <div class="product-card bg-white rounded-4 shadow-lg overflow-hidden transition-all animate__animated animate__fadeInUp" 
                     style="animation-delay: {{ $index * 0.1 }}s;">
                    
                    <!-- Product Image -->
                    <div class="product-image-container position-relative">
            @if($produk->image)
                            <img src="{{ asset('uploads/'.$produk->image) }}" 
                                 class="product-image w-100" 
                                 style="height: 250px; object-fit: cover;" 
                                 alt="{{ $produk->name }}"
                                 onerror="this.src='https://via.placeholder.com/400x250/1976d2/ffffff?text=Produk+HIMAKOM'">
                        @else
                            <div class="product-image-placeholder w-100 d-flex align-items-center justify-content-center bg-primary"
                                 style="height: 250px;">
                                <i class="bi bi-box-seam text-white" style="font-size: 4rem;"></i>
                            </div>
            @endif
                        
                        <!-- Product Badge -->
                @if($produk->price)
                        <div class="product-badge position-absolute top-0 end-0 m-3">
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                <i class="bi bi-tag-fill me-1"></i>Rp {{ number_format($produk->price,0,',','.') }}
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="product-content p-4">
                        <h4 class="fw-bold text-primary mb-3">{{ $produk->name }}</h4>
                        <p class="text-muted mb-4" style="line-height: 1.6;">
                            {{ Str::limit($produk->description, 120) }}
                        </p>
                        
                        <!-- Product Features -->
                        <div class="product-features mb-4">
                            @if($produk->quality_guaranteed)
                            <div class="feature-item d-flex align-items-center mb-2">
                                <i class="bi bi-shield-check text-success me-2"></i>
                                <span class="text-muted small">Kualitas Terjamin</span>
                            </div>
                            @endif
                            @if($produk->support_24_7)
                            <div class="feature-item d-flex align-items-center mb-2">
                                <i class="bi bi-clock text-warning me-2"></i>
                                <span class="text-muted small">Support 24/7</span>
                            </div>
                            @endif
                            @if($produk->periodic_support)
                            <div class="feature-item d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-check text-info me-2"></i>
                                <span class="text-muted small">Support Berkala</span>
                            </div>
                            @endif
                            @if($produk->features)
                            <div class="feature-item d-flex align-items-center">
                                <i class="bi bi-list-check text-primary me-2"></i>
                                <span class="text-muted small">{{ Str::limit($produk->features, 50) }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Product Actions -->
                        <div class="product-actions">
                            @auth
                                <a href="{{ route('orders.create', $produk) }}" class="btn btn-primary btn-lg w-100 rounded-pill mb-2">
                                    <i class="bi bi-cart-plus me-2"></i>Order Sekarang
                                </a>
                                @if($produk->whatsapp_link)
                                    <a href="{{ $produk->whatsapp_link }}" target="_blank" class="btn btn-outline-success btn-lg w-100 rounded-pill mb-2">
                                        <i class="bi bi-whatsapp me-2"></i>Konsultasi WhatsApp
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg w-100 rounded-pill mb-2">
                                    <i class="bi bi-lock me-2"></i>Login untuk Order
                                </a>
                                @if($produk->whatsapp_link)
                                    <a href="{{ $produk->whatsapp_link }}" target="_blank" class="btn btn-outline-success btn-lg w-100 rounded-pill mb-2">
                                        <i class="bi bi-whatsapp me-2"></i>Konsultasi WhatsApp
                                    </a>
                                @endif
                            @endauth
                            
                            <!-- QRIS Payment -->
                            @if($produk->qris_image)
                                <div class="qris-section mt-3 p-3 bg-light rounded-3">
                                    <h6 class="fw-semibold text-success mb-2">
                                        <i class="bi bi-qr-code me-2"></i>Pembayaran QRIS
                                    </h6>
                                    <div class="text-center">
                                        <img src="{{ asset('uploads/'.$produk->qris_image) }}" 
                                             class="img-fluid rounded-3 shadow-sm" 
                                             style="max-height: 150px;" 
                                             alt="QRIS Pembayaran">
                                        <p class="text-muted small mt-2 mb-0">Scan QRIS untuk pembayaran</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-products text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-box-seam display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada produk</h4>
            <p class="text-muted">Produk akan ditampilkan di sini setelah data tersedia.</p>
        </div>
                @endif
    </div>
</div>

<!-- Services Section -->
<div class="services-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Layanan Kami</h2>
            <p class="lead text-muted">Berbagai layanan yang kami sediakan untuk mendukung pengembangan teknologi</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="service-card bg-white rounded-4 p-4 shadow-lg h-100 transition-all">
                    <div class="service-icon mb-4">
                        <i class="bi bi-code-slash text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Pengembangan Software</h4>
                    <p class="text-muted mb-4">
                        Layanan pengembangan aplikasi web, mobile, dan desktop sesuai kebutuhan dengan teknologi terkini.
                    </p>
                    <ul class="text-muted small">
                        <li>Web Development</li>
                        <li>Mobile Apps</li>
                        <li>Desktop Applications</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-card bg-white rounded-4 p-4 shadow-lg h-100 transition-all">
                    <div class="service-icon mb-4">
                        <i class="bi bi-laptop text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Pelatihan & Workshop</h4>
                    <p class="text-muted mb-4">
                        Program pelatihan intensif dan workshop untuk meningkatkan skill teknologi mahasiswa.
                    </p>
                    <ul class="text-muted small">
                        <li>Programming Bootcamp</li>
                        <li>UI/UX Design</li>
                        <li>Data Science</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-card bg-white rounded-4 p-4 shadow-lg h-100 transition-all">
                    <div class="service-icon mb-4">
                        <i class="bi bi-gear text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Konsultasi IT</h4>
                    <p class="text-muted mb-4">
                        Layanan konsultasi teknologi informasi untuk membantu solusi digital yang tepat.
                    </p>
                    <ul class="text-muted small">
                        <li>System Analysis</li>
                        <li>Digital Transformation</li>
                        <li>IT Strategy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Mengapa Memilih Kami?</h2>
            <p class="lead text-muted">Keunggulan yang membedakan produk dan layanan HIMAKOM</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon-container mb-3">
                        <i class="bi bi-award text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Kualitas Terjamin</h5>
                    <p class="text-muted small">Produk dan layanan dengan standar kualitas tinggi yang teruji.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon-container mb-3">
                        <i class="bi bi-clock text-success" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Tepat Waktu</h5>
                    <p class="text-muted small">Pengerjaan yang cepat dan sesuai dengan timeline yang disepakati.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon-container mb-3">
                        <i class="bi bi-headset text-warning" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Support 24/7</h5>
                    <p class="text-muted small">Dukungan teknis yang tersedia setiap saat untuk membantu Anda.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-item text-center">
                    <div class="feature-icon-container mb-3">
                        <i class="bi bi-shield-check text-info" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Keamanan Data</h5>
                    <p class="text-muted small">Jaminan keamanan data dan privasi yang terjamin dalam setiap produk.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section py-5 text-center" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);">
    <div class="container">
        <h2 class="display-5 fw-bold text-white mb-4">Siap Memulai Proyek?</h2>
        <p class="lead text-white mb-5" style="opacity: 0.9;">
            Hubungi kami untuk konsultasi dan mendapatkan solusi teknologi terbaik
        </p>
        <a href="/kontak" class="btn btn-light btn-lg rounded-pill px-5 py-3 shadow-sm">
            <i class="bi bi-envelope me-2"></i>Hubungi Kami
        </a>
    </div>
</div>

<!-- Product Details Modal -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-box-seam me-2"></i>Detail Produk
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="productModalContent">
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

/* Product Cards */
.product-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(25, 118, 210, 0.15) !important;
}

.product-image {
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

.product-image-placeholder {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Service Cards */
.service-card {
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.service-icon {
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

/* Feature Items */
.feature-item {
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-icon-container {
    width: 80px;
    height: 80px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.feature-item:hover .feature-icon-container {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    color: white;
}

/* Empty State */
.empty-products {
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
function showProductDetails(name, description, price, qualityGuaranteed, periodicSupport, support24_7, features) {
    const modalContent = document.getElementById('productModalContent');
    
    let featuresHtml = '';
    if (qualityGuaranteed) {
        featuresHtml += '<span class="badge bg-success me-2 mb-2"><i class="bi bi-shield-check me-1"></i>Kualitas Terjamin</span>';
    }
    if (periodicSupport) {
        featuresHtml += '<span class="badge bg-info me-2 mb-2"><i class="bi bi-calendar-check me-1"></i>Support Berkala</span>';
    }
    if (support24_7) {
        featuresHtml += '<span class="badge bg-warning me-2 mb-2"><i class="bi bi-clock me-1"></i>24/7 Support</span>';
    }
    
    // Check if there are any features to display
    const hasFeatures = qualityGuaranteed || periodicSupport || support24_7 || (features && features.trim() !== '');
    
    modalContent.innerHTML = `
        <div class="text-center mb-4">
            <div class="product-icon-large mb-3">
                <i class="bi bi-box-seam text-primary" style="font-size: 4rem;"></i>
            </div>
            <h4 class="fw-bold text-primary mb-2">${name}</h4>
        </div>
        <div class="product-info-grid">
            <div class="info-item mb-3">
                <i class="bi bi-info-circle text-primary me-2"></i>
                <span class="fw-semibold">Nama Produk:</span> ${name}
            </div>
            <div class="info-item mb-3">
                <i class="bi bi-tag text-primary me-2"></i>
                <span class="fw-semibold">Harga:</span> ${price}
            </div>
            ${hasFeatures ? `
            <div class="info-item mb-3">
                <i class="bi bi-gear text-primary me-2"></i>
                <span class="fw-semibold">Fitur:</span>
            </div>
            <div class="product-features-display mb-3">
                ${featuresHtml}
            </div>
            ` : ''}
            ${features && features.trim() !== '' ? `
            <div class="info-item mb-3">
                <i class="bi bi-list-check text-primary me-2"></i>
                <span class="fw-semibold">Fitur Tambahan:</span>
            </div>
            <div class="product-features-additional p-3 bg-light rounded-3">
                <p class="mb-0">${features}</p>
            </div>
            ` : ''}
            <div class="info-item mb-3">
                <i class="bi bi-info-circle text-primary me-2"></i>
                <span class="fw-semibold">Deskripsi:</span>
            </div>
            <div class="product-description p-3 bg-light rounded-3">
                <p class="mb-0">${description}</p>
            </div>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();
}
</script>

@endsection