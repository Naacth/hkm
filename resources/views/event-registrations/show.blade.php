@extends('layout')
@section('title', 'Detail Pendaftaran Event | HIMAKOM')
@section('content')

<!-- Header Section -->
<div class="header-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-receipt me-3"></i>Detail Pendaftaran Event
                </h1>
                <p class="lead mb-0">Informasi lengkap pendaftaran event Anda</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('event-registrations.history') }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="content-section py-5">
    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <!-- Registration Details -->
            <div class="col-lg-8">
                <div class="registration-detail-card bg-white rounded-4 shadow-lg p-4">
                    <div class="card-header bg-light rounded-3 p-3 mb-4">
                        <h4 class="fw-bold text-primary mb-0">
                            <i class="bi bi-calendar-event me-2"></i>{{ $registration->event->title }}
                        </h4>
                    </div>

                    <div class="row">
                        <!-- Event Information -->
                        <div class="col-md-6">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-info-circle me-2"></i>Informasi Event
                            </h5>
                            <div class="info-list">
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Tanggal:</label>
                                    <p class="mb-0">{{ $registration->event->getFormattedDateAttribute() }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Lokasi:</label>
                                    <p class="mb-0">{{ $registration->event->location }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Biaya:</label>
                                    <p class="mb-0 fw-bold text-success">{{ $registration->event->getFormattedPriceAttribute() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Information -->
                        <div class="col-md-6">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-person me-2"></i>Informasi Pendaftaran
                            </h5>
                            <div class="info-list">
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">No. Pendaftaran:</label>
                                    <p class="mb-0 fw-bold text-primary">{{ $registration->registration_number }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Status:</label>
                                    <span class="badge {{ $registration->getEffectiveStatusBadgeClass() }} fs-6 px-3 py-2">
                                        {{ $registration->getEffectiveStatusLabel() }}
                                    </span>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Status Pembayaran:</label>
                                    @if($registration->event->is_paid)
                                        <span class="badge {{ $registration->getPaymentStatusBadgeClass() }} fs-6 px-3 py-2">
                                            {{ $registration->getPaymentStatusLabel() }}
                                        </span>
                                    @else
                                        <span class="badge bg-success fs-6 px-3 py-2">Gratis</span>
                                    @endif
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Tanggal Daftar:</label>
                                    <p class="mb-0">{{ $registration->created_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participant Details -->
                    <div class="participant-details mt-4">
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="bi bi-person-badge me-2"></i>Data Peserta
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Nama Lengkap:</label>
                                    <p class="mb-0 fw-bold">{{ $registration->participant_name }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Email:</label>
                                    <p class="mb-0">{{ $registration->participant_email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">No. Telepon:</label>
                                    <p class="mb-0">{{ $registration->participant_phone }}</p>
                                </div>
                                @if($registration->participant_nim)
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">NIM:</label>
                                    <p class="mb-0">{{ $registration->participant_nim }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($registration->notes)
                    <div class="notes-section mt-4">
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="bi bi-chat-text me-2"></i>Catatan
                        </h5>
                        <div class="alert alert-light border">
                            <p class="mb-0">{{ $registration->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Certificate Section -->
                @if($registration->canDownloadCertificate())
                <div class="certificate-card bg-white rounded-4 shadow-lg p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-award me-2"></i>Sertifikat
                    </h5>
                    <p class="text-muted mb-3">Download sertifikat partisipasi Anda</p>
                    <a href="{{ route('events.certificate.download', $registration->id) }}" 
                       class="btn btn-success btn-lg w-100 rounded-pill">
                        <i class="bi bi-download me-2"></i>Download Sertifikat
                    </a>
                </div>
                @else
                <div class="certificate-card bg-white rounded-4 shadow-lg p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-award me-2"></i>Sertifikat
                    </h5>
                    <div class="alert alert-warning">
                        <i class="bi bi-info-circle me-2"></i>
                        Sertifikat akan tersedia setelah Anda hadir di event atau status pembayaran dikonfirmasi.
                    </div>
                </div>
                @endif

                <!-- WhatsApp Group Section -->
                @if($registration->event->whatsapp_group_link)
                <div class="whatsapp-card bg-white rounded-4 shadow-lg p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-whatsapp me-2"></i>Grup WhatsApp
                    </h5>
                    @if($registration->canAccessWhatsAppGroup())
                        <p class="text-muted mb-3">Bergabunglah dengan grup WhatsApp untuk mendapatkan informasi terbaru</p>
                        <a href="{{ route('events.whatsapp.join', $registration->id) }}" 
                           class="btn btn-success btn-lg w-100 rounded-pill">
                            <i class="bi bi-whatsapp me-2"></i>Bergabung ke Grup
                        </a>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-info-circle me-2"></i>
                            Selesaikan pembayaran terlebih dahulu untuk bergabung ke grup WhatsApp.
                        </div>
                        <button class="btn btn-outline-secondary btn-lg w-100 rounded-pill" disabled>
                            <i class="bi bi-whatsapp me-2"></i>Bergabung ke Grup
                        </button>
                    @endif
                </div>
                @endif

                <!-- Actions -->
                <div class="actions-card bg-white rounded-4 shadow-lg p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-gear me-2"></i>Aksi
                    </h5>
                    <div class="d-grid gap-2">
                        @if($registration->status === 'registered')
                        <form action="{{ route('event-registrations.cancel', $registration->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg w-100 rounded-pill" 
                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran?')">
                                <i class="bi bi-x-circle me-2"></i>Batalkan Pendaftaran
                            </button>
                        </form>
                        @endif
                        
                        <a href="{{ route('event-registrations.history') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                            <i class="bi bi-list me-2"></i>Lihat Semua Pendaftaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Header Section */
.header-section {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Cards */
.registration-detail-card,
.certificate-card,
.whatsapp-card,
.actions-card {
    transition: all 0.3s ease;
}

.registration-detail-card:hover,
.certificate-card:hover,
.whatsapp-card:hover,
.actions-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

/* Info Items */
.info-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    display: block;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.info-item p {
    font-size: 1rem;
}

/* Badges */
.badge {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .header-section {
        text-align: center;
    }
    
    .header-section .btn {
        margin-top: 1rem;
    }
}
</style>

@endsection
