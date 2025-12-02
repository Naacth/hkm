@extends('layout')
@section('title', 'Kabinet | HIMAKOM UYM')
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 60vh; display: flex; align-items: center; border-radius: 0 0 2rem 2rem;">
    <div class="container position-relative z-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <h1 class="display-4 fw-bold mb-4 animate_animated animate_fadeInUp">
                        <i class="bi bi-diagram-3-fill me-3"></i>Struktur Kepengurusan
                    </h1>
                    <p class="lead mb-4 animate_animated animatefadeInUp animate_delay-1s" style="font-size: 1.3rem;">
                        Tim kepemimpinan yang berdedikasi untuk memajukan HIMAKOM UYM
                    </p>
                    <div class="stats-row animate_animated animatefadeInUp animate_delay-2s">
                        <div class="row justify-content-center">
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">{{ $kabinets->count() }}</div>
                                    <div class="stat-label">Pengurus</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">2024</div>
                                    <div class="stat-label">Periode</div>
                                </div>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number fw-bold">100%</div>
                                    <div class="stat-label">Komitmen</div>
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

<!-- Organizational Structure Section -->
<div class="structure-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Struktur Organisasi</h2>
            <p class="lead text-muted">Hierarki kepemimpinan dan pembagian tugas yang jelas untuk efektivitas organisasi</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="org-chart-container bg-white rounded-4 shadow-lg p-5 animate_animated animate_fadeInUp">
                    <!-- Organization Chart -->
                    <div class="org-chart">
                        <!-- Level 1: Pembina -->
                        <div class="org-level level-1">
                            <div class="org-item pembina">
                                <div class="org-box">
                                    <h5 class="org-title">PEMBINA</h5>
                                    <p class="org-description">Penasihat dan Pembimbing</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Level 2: Ketua Umum -->
                        <div class="org-level level-2">
                            <div class="org-item ketua-umum">
                                <div class="org-box">
                                    <h5 class="org-title">KETUA UMUM</h5>
                                    <p class="org-description">Pemimpin Tertinggi Organisasi</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Level 3: Wakil Ketua Umum -->
                        <div class="org-level level-3">
                            <div class="org-item wakil-ketua">
                                <div class="org-box">
                                    <h5 class="org-title">WAKIL KETUA UMUM</h5>
                                    <p class="org-description">Wakil Pemimpin Organisasi</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Level 4: Core Functions -->
                        <div class="org-level level-4">
                            <div class="org-item sekretaris">
                                <div class="org-box">
                                    <h5 class="org-title">SEKRETARIS UMUM</h5>
                                    <p class="org-description">Administrasi & Dokumentasi</p>
                                </div>
                            </div>
                            
                            <div class="org-item bendahara">
                                <div class="org-box">
                                    <h5 class="org-title">BENDAHARA UMUM</h5>
                                    <p class="org-description">Keuangan & Aset</p>
                                </div>
                            </div>
                            
                            <div class="org-item psdm-akademik">
                                <div class="org-box">
                                    <h5 class="org-title">DEPARTEMEN PSDM & AKADEMIK</h5>
                                    <p class="org-description">SDM & Pengembangan Akademik</p>
                                </div>
                            </div>
                            
                            <div class="org-item humas">
                                <div class="org-box">
                                    <h5 class="org-title">HUMAS</h5>
                                    <p class="org-description">Hubungan Masyarakat</p>
                                </div>
                            </div>
                            
                            <div class="org-item komdigi-ekraf">
                                <div class="org-box">
                                    <h5 class="org-title">DEPARTEMEN KOMDIGI & EKRAF</h5>
                                    <p class="org-description">Komunikasi Digital & Ekonomi Kreatif</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Level 5: Divisions -->
                        <div class="org-level level-5">
                            <div class="org-item divisi-psdm">
                                <div class="org-box">
                                    <h5 class="org-title">DIVISI PSDM</h5>
                                    <p class="org-description">Pengembangan Sumber Daya Manusia</p>
                                </div>
                            </div>
                            
                            <div class="org-item divisi-akademik">
                                <div class="org-box">
                                    <h5 class="org-title">DIVISI AKADEMIK</h5>
                                    <p class="org-description">Pengembangan Akademik</p>
                                </div>
                            </div>
                            
                            <div class="org-item divisi-komdigi">
                                <div class="org-box">
                                    <h5 class="org-title">DIVISI KOMDIGI</h5>
                                    <p class="org-description">Komunikasi Digital</p>
                                </div>
                            </div>
                            
                            <div class="org-item divisi-ekraf">
                                <div class="org-box">
                                    <h5 class="org-title">DIVISI EKRAF</h5>
                                    <p class="org-description">Ekonomi Kreatif</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Level 6: Members -->
                        <div class="org-level level-6">
                            <div class="org-item anggota">
                                <div class="org-box anggota-box">
                                    <h5 class="org-title">ANGGOTA HIMPUNAN</h5>
                                    <p class="org-description">Mahasiswa Aktif Program Studi Komputer</p>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leadership Team Section -->
<div class="leadership-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Tim Kepemimpinan</h2>
            <p class="lead text-muted">Bertemu dengan para pemimpin yang menggerakkan HIMAKOM ke arah yang lebih baik</p>
        </div>
        
        @if($kabinets->count() > 0)
        <div class="row g-4">
            @foreach($kabinets as $index => $kabinet)
            <div class="col-lg-4 col-md-6">
                <div class="leadership-card bg-white rounded-4 shadow-lg overflow-hidden transition-all animate_animated animate_fadeInUp" 
                     style="animation-delay: {{ $index * 0.1 }}s;">
                    
                    <!-- Profile Image -->
                    <div class="profile-image-container position-relative">
                        @if($kabinet->photo)
                            <img src="{{ asset('uploads/'.$kabinet->photo) }}" 
                                 class="profile-image w-100" 
                                 style="height: 300px; object-fit: cover;" 
                                 alt="{{ $kabinet->name }}">
                        @else
                            <div class="profile-image-placeholder w-100 d-flex align-items-center justify-content-center bg-primary"
                                 style="height: 300px;">
                                <i class="bi bi-person-badge text-white" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        
                        <!-- Position Badge -->
                        <div class="position-badge position-absolute bottom-0 start-0 end-0 p-3" 
                             style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                            <h5 class="text-white fw-bold mb-1">{{ $kabinet->position }}</h5>
                            <p class="text-white mb-0" style="opacity: 0.9;">{{ $kabinet->name }}</p>
                        </div>
                    </div>
                    
                    <div class="profile-content p-4">
                        <h4 class="fw-bold text-primary mb-2">{{ $kabinet->name }}</h4>
                        <p class="text-primary fw-semibold mb-3">{{ $kabinet->position }}</p>
                        
                        @if($kabinet->description)
                        <p class="text-muted mb-4" style="line-height: 1.6;">
                            {{ Str::limit($kabinet->description, 120) }}
                        </p>
                        @endif
                        
                        <!-- Profile Details -->
                        <div class="profile-details">
                            <div class="detail-item d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-event text-primary me-2"></i>
                                <span class="text-muted small">Periode {{ date('Y') }}</span>
                            </div>
                            <div class="detail-item d-flex align-items-center mb-2">
                                <i class="bi bi-award text-success me-2"></i>
                                <span class="text-muted small">Pengurus Aktif</span>
                            </div>
                        </div>
                        
                        <!-- Profile Actions -->
                        <div class="profile-actions mt-4">
                            <button class="btn btn-outline-primary btn-sm w-100 rounded-pill" 
                                    onclick="showProfileDetails('{{ $kabinet->name }}', '{{ $kabinet->position }}', '{{ $kabinet->description ?? 'Tidak ada deskripsi tersedia.' }}')">
                                <i class="bi bi-person-lines-fill me-2"></i>Lihat Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-leadership text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-people display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada data kabinet</h4>
            <p class="text-muted">Data kepengurusan akan ditampilkan di sini setelah tersedia.</p>
        </div>
        @endif
    </div>
</div>

<!-- Values Section -->
<div class="values-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">Nilai Kepemimpinan</h2>
            <p class="lead text-muted">Prinsip-prinsip yang menjadi fondasi kepemimpinan di HIMAKOM</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="value-card bg-white rounded-4 p-4 text-center shadow-lg h-100 transition-all">
                    <div class="value-icon mb-4">
                        <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Integritas</h4>
                    <p class="text-muted">
                        Menjunjung tinggi kejujuran, transparansi, dan akuntabilitas dalam setiap keputusan dan tindakan.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="value-card bg-white rounded-4 p-4 text-center shadow-lg h-100 transition-all">
                    <div class="value-icon mb-4">
                        <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Kolaborasi</h4>
                    <p class="text-muted">
                        Membangun kerja sama tim yang solid dan sinergis untuk mencapai tujuan bersama.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="value-card bg-white rounded-4 p-4 text-center shadow-lg h-100 transition-all">
                    <div class="value-icon mb-4">
                        <i class="bi bi-lightbulb text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Inovasi</h4>
                    <p class="text-muted">
                        Mendorong kreativitas dan inovasi dalam pengembangan program dan solusi teknologi.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="value-card bg-white rounded-4 p-4 text-center shadow-lg h-100 transition-all">
                    <div class="value-icon mb-4">
                        <i class="bi bi-award text-info" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold text-primary mb-3">Excellence</h4>
                    <p class="text-muted">
                        Berkomitmen untuk memberikan hasil terbaik dalam setiap program dan layanan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vision Mission Section -->
<div class="vision-mission-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="vision-card bg-white rounded-4 p-5 shadow-lg h-100">
                    <div class="card-icon mb-4">
                        <i class="bi bi-bullseye text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="fw-bold text-primary mb-3">Visi Kepemimpinan</h3>
                    <p class="text-muted" style="line-height: 1.8;">
                        Menjadi tim kepemimpinan yang inspiratif, inovatif, dan berkontribusi aktif dalam membangun HIMAKOM sebagai organisasi mahasiswa yang unggul dan berdaya saing global.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="mission-card bg-white rounded-4 p-5 shadow-lg h-100">
                    <div class="card-icon mb-4">
                        <i class="bi bi-target text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="fw-bold text-primary mb-3">Misi Kepemimpinan</h3>
                    <ul class="text-muted" style="line-height: 1.8;">
                        <li>Mengembangkan program kerja yang inovatif dan berkualitas</li>
                        <li>Membangun tim yang solid dan profesional</li>
                        <li>Meningkatkan kualitas layanan kepada anggota</li>
                        <li>Mengembangkan jaringan kerjasama yang luas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Leadership Section -->
<div class="contact-leadership-section py-5 text-center" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);">
    <div class="container">
        <h2 class="display-5 fw-bold text-white mb-4">Hubungi Tim Kepemimpinan</h2>
        <p class="lead text-white mb-5" style="opacity: 0.9;">
            Ingin berkomunikasi langsung dengan tim kepemimpinan HIMAKOM?
        </p>
        <a href="/kontak" class="btn btn-light btn-lg rounded-pill px-5 py-3 shadow-sm">
            <i class="bi bi-envelope me-2"></i>Kirim Pesan
        </a>
    </div>
</div>

<!-- Profile Details Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-badge me-2"></i>Detail Profil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="profileModalContent">
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

/* Organization Chart Styles */
.org-chart-container {
    transition: all 0.3s ease;
    min-height: 600px;
    overflow: visible;
}

.org-chart {
    position: relative;
    padding: 2rem 0;
    min-height: 500px;
}

.org-level {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 3rem;
    position: relative;
    flex-wrap: wrap;
    gap: 1rem;
}

.org-level::before {
    content: '';
    position: absolute;
    top: -1.5rem;
    left: 50%;
    transform: translateX(-50%);
    width: 3px;
    height: 1.5rem;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 2px;
}

.org-item {
    margin: 0 0.5rem;
    position: relative;
    flex: 1;
    min-width: 200px;
    max-width: 300px;
}

.org-box {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 1rem;
    text-align: center;
    min-width: 200px;
    box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.org-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(25, 118, 210, 0.4);
}

.org-title {
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.org-description {
    font-size: 0.8rem;
    opacity: 0.9;
    margin-bottom: 0;
}

/* Level-specific styles */
.level-1 .org-box {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    min-width: 250px;
}

.level-2 .org-box {
    background: linear-gradient(135deg, #fd7e14 0%, #e55a00 100%);
    min-width: 220px;
}

.level-3 .org-box {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    min-width: 220px;
}

.level-4 .org-box {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    min-width: 180px;
}

.level-5 .org-box {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    min-width: 180px;
}

.level-6 .org-box {
    background: linear-gradient(135deg, #6f42c1 0%, #5a2d82 100%);
    min-width: 300px;
}

/* Clean connection lines */
.org-item::before {
    content: '';
    position: absolute;
    top: -1.5rem;
    left: 50%;
    transform: translateX(-50%);
    width: 3px;
    height: 1.5rem;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 2px;
    z-index: 1;
}

.org-item::after {
    content: '';
    position: absolute;
    bottom: -1.5rem;
    left: 50%;
    transform: translateX(-50%);
    width: 3px;
    height: 1.5rem;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 2px;
    z-index: 1;
}

/* Horizontal connections for level 4 */
.level-4 .org-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -1rem;
    transform: translateY(-50%);
    width: 1rem;
    height: 3px;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 2px;
    z-index: 1;
}

/* Structure Card */
.structure-card {
    transition: all 0.3s ease;
}

.structure-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.structure-image {
    transition: transform 0.3s ease;
}

.structure-card:hover .structure-image {
    transform: scale(1.02);
}

/* Leadership Cards */
.leadership-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    overflow: hidden;
}

.leadership-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(25, 118, 210, 0.15) !important;
}

.profile-image {
    transition: transform 0.3s ease;
}

.leadership-card:hover .profile-image {
    transform: scale(1.1);
}

.profile-image-placeholder {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Value Cards */
.value-card {
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.value-icon {
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

/* Vision Mission Cards */
.vision-card, .mission-card {
    transition: all 0.3s ease;
}

.vision-card:hover, .mission-card:hover {
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

/* Empty State */
.empty-leadership {
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
    
    .org-level {
        flex-direction: column;
        gap: 1rem;
    }
    
    .org-item {
        margin: 0.5rem 0;
        min-width: 100%;
    }
    
    .org-box {
        min-width: 100%;
    }
    
    .org-chart-container {
        min-height: 800px;
    }
}

@media (max-width: 576px) {
    .org-chart {
        padding: 1rem 0;
    }
    
    .org-level {
        margin-bottom: 2rem;
    }
    
    .org-box {
        padding: 1rem;
    }
    
    .org-title {
        font-size: 0.9rem;
    }
    
    .org-description {
        font-size: 0.7rem;
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
function showProfileDetails(name, position, description) {
    const modalContent = document.getElementById('profileModalContent');
    modalContent.innerHTML = `
        <div class="text-center mb-4">
            <div class="profile-icon-large mb-3">
                <i class="bi bi-person-badge text-primary" style="font-size: 4rem;"></i>
            </div>
            <h4 class="fw-bold text-primary mb-2">${name}</h4>
        </div>
        <div class="profile-info-grid">
            <div class="info-item mb-3">
                <i class="bi bi-person text-primary me-2"></i>
                <span class="fw-semibold">Nama:</span> ${name}
            </div>
            <div class="info-item mb-3">
                <i class="bi bi-award text-primary me-2"></i>
                <span class="fw-semibold">Jabatan:</span> ${position}
            </div>
            <div class="info-item mb-3">
                <i class="bi bi-calendar-event text-primary me-2"></i>
                <span class="fw-semibold">Periode:</span> ${new Date().getFullYear()}
            </div>
            <div class="info-item mb-3">
                <i class="bi bi-info-circle text-primary me-2"></i>
                <span class="fw-semibold">Deskripsi:</span>
            </div>
            <div class="profile-description p-3 bg-light rounded-3">
                <p class="mb-0">${description}</p>
            </div>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('profileModal'));
    modal.show();
}
</script>

@endsection
