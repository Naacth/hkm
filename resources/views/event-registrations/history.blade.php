@extends('layout')
@section('title', 'Riwayat Pendaftaran Event | HIMAKOM UYM')
@section('content')

<!-- History Header -->
<div class="history-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-clock-history me-3"></i>Riwayat Pendaftaran Event
                </h1>
                <p class="lead mb-0">Lihat semua pendaftaran event yang pernah Anda ikuti</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('event') }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-calendar-event me-2"></i>Lihat Event
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="content-section py-5">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($registrations->count() > 0)
        <!-- Registrations List -->
        <div class="registrations-list">
            @foreach($registrations as $registration)
            <div class="registration-card bg-white rounded-4 shadow-lg mb-4 overflow-hidden">
                <div class="card-header bg-light p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="fw-bold text-primary mb-1">{{ $registration->event->title }}</h4>
                            <div class="registration-meta">
                                <span class="badge {{ $registration->getStatusBadgeClass() }} fs-6 px-3 py-2 me-2">
                                    {{ $registration->getStatusLabel() }}
                                </span>
                                @if($registration->event->is_paid)
                                <span class="badge {{ $registration->getPaymentStatusBadgeClass() }} fs-6 px-3 py-2">
                                    {{ $registration->getPaymentStatusLabel() }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="registration-number">
                                <small class="text-muted">No. Pendaftaran:</small>
                                <p class="fw-bold text-primary mb-0">{{ $registration->registration_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Event Info -->
                        <div class="col-lg-6">
                            <div class="event-info">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-calendar-event me-2"></i>Informasi Event
                                </h6>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <i class="bi bi-calendar-date text-primary me-2"></i>
                                        <span class="fw-semibold">{{ $registration->event->getFormattedDateAttribute() }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <span>{{ $registration->event->location }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-currency-dollar text-primary me-2"></i>
                                        <span class="fw-semibold text-success">{{ $registration->event->getFormattedPriceAttribute() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Info -->
                        <div class="col-lg-6">
                            <div class="registration-info">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-person me-2"></i>Data Pendaftaran
                                </h6>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <i class="bi bi-person text-primary me-2"></i>
                                        <span>{{ $registration->participant_name }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-envelope text-primary me-2"></i>
                                        <span>{{ $registration->participant_email }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-telephone text-primary me-2"></i>
                                        <span>{{ $registration->participant_phone }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-clock text-primary me-2"></i>
                                        <span>{{ $registration->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($registration->notes)
                    <div class="notes-section mt-4">
                        <h6 class="fw-bold text-primary mb-2">
                            <i class="bi bi-chat-text me-2"></i>Catatan
                        </h6>
                        <div class="notes-content bg-light rounded-3 p-3">
                            <p class="mb-0">{{ $registration->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="card-footer bg-light p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="certificate-info">
                                @if($registration->canDownloadCertificate())
                                    @if($registration->certificate_downloaded)
                                        <span class="text-success">
                                            <i class="bi bi-download me-1"></i>Sertifikat sudah didownload
                                        </span>
                                    @else
                                        <span class="text-primary">
                                            <i class="bi bi-award me-1"></i>Sertifikat tersedia
                                        </span>
                                    @endif
                                @else
                                    <span class="text-muted">
                                        <i class="bi bi-clock me-1"></i>Sertifikat belum tersedia
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="action-buttons">
                                <a href="{{ route('event-registrations.show', $registration->id) }}" 
                                   class="btn btn-outline-primary btn-sm rounded-pill me-2">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                                
                                @if($registration->event->whatsapp_group_link)
                                    @if($registration->canAccessWhatsAppGroup())
                                        <a href="{{ route('events.whatsapp.join', $registration->id) }}" 
                                           class="btn btn-outline-success btn-sm rounded-pill me-2">
                                            <i class="bi bi-whatsapp me-1"></i>Grup WhatsApp
                                        </a>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm rounded-pill me-2" 
                                                disabled 
                                                title="Selesaikan pembayaran terlebih dahulu untuk bergabung ke grup WhatsApp">
                                            <i class="bi bi-whatsapp me-1"></i>Grup WhatsApp
                                        </button>
                                    @endif
                                @endif
                                
                                @if($registration->canDownloadCertificate())
                                <a href="{{ route('events.certificate.download', $registration->id) }}" 
                                   class="btn btn-success btn-sm rounded-pill me-2">
                                    <i class="bi bi-download me-1"></i>Download Sertifikat
                                </a>
                                @endif

                                @if($registration->status === 'registered')
                                <form action="{{ route('event-registrations.cancel', $registration->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i>Batalkan
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="empty-state text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-calendar-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada pendaftaran event</h4>
            <p class="text-muted mb-4">Mulai dengan mendaftar event HIMAKOM pertama Anda</p>
            <a href="{{ route('event') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="bi bi-calendar-plus me-2"></i>Lihat Event Tersedia
            </a>
        </div>
        @endif
    </div>
</div>

<style>
/* History Header */
.history-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Registration Card */
.registration-card {
    transition: all 0.3s ease;
}

.registration-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.registration-meta .badge {
    transition: all 0.3s ease;
}

.registration-meta .badge:hover {
    transform: scale(1.05);
}

/* Info Grid */
.info-grid {
    display: grid;
    gap: 0.75rem;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item i {
    width: 20px;
    text-align: center;
}

/* Notes Section */
.notes-content {
    border-left: 4px solid #1976d2;
}

/* Action Buttons */
.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Empty State */
.empty-state {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 1rem;
    margin: 2rem 0;
}

.empty-icon {
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
    .history-header {
        text-align: center;
    }
    
    .history-header .btn {
        margin-top: 1rem;
    }
    
    .registration-number {
        text-align: center !important;
        margin-top: 1rem;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

@endsection
