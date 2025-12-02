@extends('layout')
@section('title', $divisi->name . ' | HIMAKOM UYM')
@section('content')

<!-- Hero Section -->
<div class="hero-detail position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 70vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white">
                <div class="hero-content animate__animated animate__fadeInLeft">
                    <div class="divisi-logo mb-4">
                        @if($divisi->logo)
                            <img src="{{ asset('uploads/'.$divisi->logo) }}" 
                                 class="logo-image shadow-lg" 
                                 style="max-width: 120px; max-height: 120px; object-fit: contain; background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 1rem;">
                        @else
                            <div class="logo-placeholder shadow-lg d-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px; background: rgba(255,255,255,0.1); border-radius: 1rem;">
                                <i class="bi bi-people-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    <h1 class="display-4 fw-bold mb-3">{{ $divisi->name }}</h1>
                    <p class="lead mb-4" style="font-size: 1.2rem; line-height: 1.6;">
                        {{ $divisi->description }}
                    </p>
                    
                    <!-- Divisi Stats -->
                    <div class="divisi-stats mb-4">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="stat-card">
                                    <div class="stat-number fw-bold">{{ $divisi->members->count() }}</div>
                                    <div class="stat-label">Anggota</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-card">
                                    <div class="stat-number fw-bold">{{ $divisi->members->where('position', 'like', '%ketua%')->count() }}</div>
                                    <div class="stat-label">Ketua</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-card">
                                    <div class="stat-number fw-bold">{{ $divisi->members->where('position', 'like', '%wakil%')->count() }}</div>
                                    <div class="stat-label">Wakil</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ url('/divisi') }}" class="btn btn-light btn-lg rounded-pill shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center animate__animated animate__fadeInRight">
                @if($divisi->group_photo)
                    <div class="group-photo-container">
                        <img src="{{ asset('uploads/'.$divisi->group_photo) }}" 
                             class="group-photo shadow-2xl" 
                             style="max-width: 500px; max-height: 400px; object-fit: cover; border-radius: 1.5rem; border: 4px solid rgba(255,255,255,0.3);">
                    </div>
                @else
                    <div class="group-photo-placeholder shadow-2xl d-flex align-items-center justify-content-center"
                         style="width: 500px; height: 400px; background: rgba(255,255,255,0.1); border-radius: 1.5rem; border: 4px solid rgba(255,255,255,0.3); margin: 0 auto;">
                        <i class="bi bi-people-fill text-white" style="font-size: 5rem;"></i>
                    </div>
                @endif
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

<!-- Members Section -->
<div class="members-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">
                <i class="bi bi-person-badge me-3"></i>Anggota Divisi
            </h2>
            <p class="lead text-muted">Tim yang berdedikasi untuk menjalankan visi dan misi divisi</p>
        </div>
        
        @if($divisi->members->count() > 0)
        <div class="row g-4 justify-content-center">
            @foreach($divisi->members as $index => $member)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="member-card card border-0 shadow-lg h-100 text-center bg-white rounded-4 overflow-hidden transition-all animate__animated animate__fadeInUp" 
                     style="animation-delay: {{ $index * 0.1 }}s; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                    
                    <!-- Member Photo Section -->
                    <div class="member-photo-section position-relative" style="height: 200px; background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            @if($member->photo)
                                <img src="{{ asset('uploads/'.$member->photo) }}" 
                                     alt="Foto {{ $member->name }}" 
                                     class="member-photo border-4 border-white shadow-lg"
                                     style="width: 140px; height: 140px; object-fit: cover; border-radius: 0;">
                            @else
                                <div class="member-photo-placeholder border-4 border-white shadow-lg d-flex align-items-center justify-content-center bg-white"
                                     style="width: 140px; height: 140px; border-radius: 0;">
                                    <span class="text-primary fw-bold" style="font-size: 3rem;">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body pt-4">
                        <h5 class="fw-bold mb-1 text-primary">{{ $member->name }}</h5>
                        <p class="text-muted mb-3">{{ $member->position }}</p>
                        
                        @if($member->batch)
                        <div class="batch-badge mb-3">
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                <i class="bi bi-calendar-event me-1"></i>{{ $member->batch }}
                            </span>
                        </div>
                        @endif
                        
                        <!-- Member Details -->
                        <div class="member-details">
                            <div class="detail-item">
                                <i class="bi bi-person-circle text-primary me-2"></i>
                                <span class="text-muted">Anggota {{ $divisi->name }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Footer with Hover Effect -->
                    <div class="card-footer border-0 bg-transparent pb-3">
                        <div class="member-actions">
                            <button class="btn btn-outline-primary btn-sm rounded-pill" onclick="showMemberDetails('{{ $member->name }}', '{{ $member->position }}', '{{ $member->batch ?? 'N/A' }}')">
                                <i class="bi bi-info-circle me-1"></i>Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-members text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-people display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada anggota divisi</h4>
            <p class="text-muted">Anggota divisi akan ditampilkan di sini setelah data tersedia.</p>
        </div>
        @endif
    </div>
</div>

<!-- Back to List Section -->
<div class="back-section py-4 text-center" style="background: #fff;">
    <div class="container">
        <a href="{{ url('/divisi') }}" class="btn btn-outline-primary btn-lg rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Divisi
        </a>
    </div>
</div>

<!-- Member Details Modal -->
<div class="modal fade" id="memberModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-circle me-2"></i>Detail Anggota
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="memberModalContent">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Detail Styles */
.hero-detail {
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

/* Divisi Stats */
.divisi-stats {
    margin-top: 2rem;
}

.stat-card {
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

/* Group Photo */
.group-photo-container {
    position: relative;
}

.group-photo {
    transition: transform 0.3s ease;
}

.group-photo:hover {
    transform: scale(1.05);
}

/* Member Card Styles */
.member-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    overflow: hidden;
}

.member-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(25, 118, 210, 0.15) !important;
}

.member-photo-section {
    overflow: hidden;
}

.member-photo {
    transition: all 0.35s ease;
    border-radius: 0 !important;
}

/* On hover: expand photo to full size and remove round shape */
.member-card:hover .member-photo-section > .position-absolute {
    top: 0 !important;
    left: 0 !important;
    transform: none !important;
    width: 100% !important;
    height: 100% !important;
}

.member-card:hover .member-photo {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    border-radius: 0 !important;
    box-shadow: none !important;
}

.member-photo-placeholder {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 0 !important;
}

/* Member Details */
.member-details {
    margin-top: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

/* Batch Badge */
.batch-badge .badge {
    font-size: 0.8rem;
    font-weight: 500;
}

/* Member Actions */
.member-actions {
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

.member-card:hover .member-actions {
    opacity: 1;
    transform: translateY(0);
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

.btn-outline-primary {
    border-color: #1976d2;
    color: #1976d2;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #1976d2;
    border-color: #1976d2;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(25, 118, 210, 0.3);
}

/* Empty State */
.empty-members {
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
    .hero-detail {
        min-height: 60vh;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
    
    .display-5 {
        font-size: 2rem;
    }
    
    .stat-card {
        padding: 0.75rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .group-photo, .group-photo-placeholder {
        max-width: 100% !important;
        height: auto !important;
    }
}

/* Animation Classes */
.animate__fadeInLeft {
    animation-duration: 0.8s;
}

.animate__fadeInRight {
    animation-duration: 0.8s;
}

.animate__fadeInUp {
    animation-duration: 0.8s;
}
</style>

<script>
function showMemberDetails(name, position, batch) {
    const modalContent = document.getElementById('memberModalContent');
    modalContent.innerHTML = `
        <div class="text-center mb-4">
            <div class="member-avatar-large mb-3">
                <span class="text-primary fw-bold" style="font-size: 4rem;">${name.charAt(0).toUpperCase()}</span>
            </div>
            <h4 class="fw-bold text-primary mb-2">${name}</h4>
            <p class="text-muted mb-3">${position}</p>
            ${batch !== 'N/A' ? `<div class="batch-info mb-3"><span class="badge bg-primary rounded-pill px-3 py-2">Batch ${batch}</span></div>` : ''}
        </div>
        <div class="member-info-grid">
            <div class="info-item">
                <i class="bi bi-person-circle text-primary me-2"></i>
                <span class="fw-semibold">Nama:</span> ${name}
            </div>
            <div class="info-item">
                <i class="bi bi-briefcase text-primary me-2"></i>
                <span class="fw-semibold">Jabatan:</span> ${position}
            </div>
            ${batch !== 'N/A' ? `
            <div class="info-item">
                <i class="bi bi-calendar-event text-primary me-2"></i>
                <span class="fw-semibold">Batch:</span> ${batch}
            </div>
            ` : ''}
            <div class="info-item">
                <i class="bi bi-people text-primary me-2"></i>
                <span class="fw-semibold">Divisi:</span> {{ $divisi->name }}
            </div>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('memberModal'));
    modal.show();
}
</script>

@endsection 