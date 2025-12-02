@extends('layouts.admin')
@section('title', 'Detail Pendaftaran Event | Admin')
@section('page-title', 'Detail Pendaftaran Event')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-person-badge me-3"></i>Detail Pendaftaran Event
                </h1>
                <p class="lead mb-0">Informasi lengkap pendaftaran peserta</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-light btn-lg rounded-pill">
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

        <div class="row g-4">
            <!-- Registration Details -->
            <div class="col-lg-8">
                <div class="details-card bg-white rounded-4 shadow-lg p-5">
                    <div class="card-header text-center mb-4">
                        <h3 class="fw-bold text-primary mb-2">
                            <i class="bi bi-receipt me-2"></i>Detail Pendaftaran
                        </h3>
                        <p class="text-muted">Informasi lengkap pendaftaran event</p>
                    </div>

                    <div class="row g-4">
                        <!-- Registration Info -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Pendaftaran
                                </h5>
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
                                    <label class="fw-semibold text-muted">Tanggal Daftar:</label>
                                    <p class="mb-0">{{ $registration->created_at->format('d F Y, H:i') }}</p>
                                </div>
                                @if($registration->event->is_paid)
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Status Pembayaran:</label>
                                    <span class="badge {{ $registration->getPaymentStatusBadgeClass() }} fs-6 px-3 py-2">
                                        {{ $registration->getPaymentStatusLabel() }}
                                    </span>
                                </div>
                                @if($registration->voucher_code)
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Voucher:</label>
                                    <p class="mb-0">{{ $registration->voucher_code }} ({{ $registration->voucher_discount_percent }}%) — Potongan Rp {{ number_format($registration->discount_amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Total Akhir:</label>
                                    <p class="mb-0 fw-bold">Rp {{ number_format($registration->final_price, 0, ',', '.') }}</p>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>

                        <!-- Proof of Payment Section -->
                        @if($registration->payment_method === 'qris' && $registration->proof_of_payment_image_path)
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-receipt-cutoff me-2"></i>Bukti Pembayaran
                                </h5>
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted">Metode:</label>
                                    <p class="mb-0"><i class="bi bi-qr-code me-1"></i>QRIS</p>
                                </div>
                                <div class="mb-3 text-center">
                                    <a href="{{ asset('uploads/' . $registration->proof_of_payment_image_path) }}" target="_blank">
                                        <img src="{{ asset('uploads/' . $registration->proof_of_payment_image_path) }}"
                                             alt="Bukti Pembayaran"
                                             class="img-fluid rounded-3 shadow-sm"
                                             style="max-height: 250px;">
                                    </a>
                                    <p class="text-muted small mt-2">Klik gambar untuk melihat ukuran penuh</p>
                                </div>
                                @if($registration->payment_status === 'pending' && $registration->status !== 'cancelled')
                                <form action="{{ route('admin.event-registrations.update-status', $registration->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="status" value="paid">
                                    <button type="submit" class="btn btn-success w-100 rounded-pill">
                                        <i class="bi bi-check-circle me-2"></i>Konfirmasi Pembayaran
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Event Info -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-calendar-event me-2"></i>Informasi Event
                                </h5>
                                <div class="info-item mb-3">
                                    <label class="fw-semibold text-muted">Nama Event:</label>
                                    <p class="mb-0 fw-bold">{{ $registration->event->title }}</p>
                                </div>
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

                        <!-- Participant Info -->
                        <div class="col-12">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-person me-2"></i>Data Peserta
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">Nama Lengkap:</label>
                                            <p class="mb-0 fw-bold">{{ $registration->participant_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">Email:</label>
                                            <p class="mb-0">{{ $registration->participant_email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">Nomor Telepon:</label>
                                            <p class="mb-0">{{ $registration->participant_phone }}</p>
                                        </div>
                                    </div>
                                    @if($registration->participant_nim)
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">NIM:</label>
                                            <p class="mb-0">{{ $registration->participant_nim }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($registration->participant_kelas)
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">Kelas:</label>
                                            <p class="mb-0">{{ $registration->participant_kelas }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($registration->notes)
                                    <div class="col-12">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">Catatan:</label>
                                            <p class="mb-0">{{ $registration->notes }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($registration->payment_method)
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="fw-semibold text-muted">Metode Pembayaran:</label>
                                            <p class="mb-0">
                                                @if($registration->payment_method == 'qris')
                                                    <i class="bi bi-qr-code me-1"></i>QRIS
                                                @else
                                                    <i class="bi bi-cash me-1"></i>Offline
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @if($registration->notes)
                                <div class="info-item mt-3">
                                    <label class="fw-semibold text-muted">Catatan:</label>
                                    <div class="notes-content bg-light rounded-3 p-3">
                                        <p class="mb-0">{{ $registration->notes }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Sidebar -->
            <div class="col-lg-4">
                <div class="actions-card bg-white rounded-4 shadow-lg p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-gear me-2"></i>Kelola Status
                    </h5>
                    
                    <form action="{{ route('admin.event-registrations.update-status', $registration->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status Pendaftaran:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="registered" {{ $registration->status === 'registered' ? 'selected' : '' }}>
                                    Terdaftar
                                </option>
                                <option value="confirmed" {{ $registration->status === 'confirmed' ? 'selected' : '' }}>
                                    Dikonfirmasi
                                </option>
                                <option value="paid" {{ $registration->getEffectiveStatus() === 'paid' ? 'selected' : '' }}>
                                    Sudah Bayar
                                </option>
                                <option value="attended" {{ $registration->status === 'attended' ? 'selected' : '' }}>
                                    Hadir
                                </option>
                                <option value="cancelled" {{ $registration->status === 'cancelled' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">
                            <i class="bi bi-check-circle me-2"></i>Update Status
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="certificate-section">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-award me-2"></i>Sertifikat
                        </h6>
                        
                        @if($registration->event->certificate_template)
                            @if($registration->status === 'attended')
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Sertifikat tersedia untuk didownload
                                </div>
                                @if($registration->certificate_downloaded)
                                    <div class="alert alert-info">
                                        <i class="bi bi-download me-2"></i>
                                        Sertifikat sudah didownload
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    <i class="bi bi-clock me-2"></i>
                                    Sertifikat akan tersedia setelah peserta hadir
                                </div>
                            @endif
                        @else
                            <div class="alert alert-secondary">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Template sertifikat belum diupload
                            </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div class="quick-actions">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-lightning me-2"></i>Aksi Cepat
                        </h6>
                        
                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $registration->participant_email }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="bi bi-envelope me-2"></i>Kirim Email
                            </a>
                            <a href="tel:{{ $registration->participant_phone }}" class="btn btn-outline-success btn-sm rounded-pill">
                                <i class="bi bi-telephone me-2"></i>Hubungi
                            </a>
                            <a href="{{ route('admin.event-registrations.index') }}?event_id={{ $registration->event->id }}" class="btn btn-outline-info btn-sm rounded-pill">
                                <i class="bi bi-list me-2"></i>Lihat Event Lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Details Card */
.details-card {
    transition: all 0.3s ease;
}

.details-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.info-section {
    background: #f8f9fa;
    border-radius: 1rem;
    padding: 1.5rem;
    height: 100%;
}

.info-item {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 0.75rem;
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.notes-content {
    border-left: 4px solid #1976d2;
}

/* Actions Card */
.actions-card {
    transition: all 0.3s ease;
}

.actions-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.actions-card .btn {
    transition: all 0.3s ease;
}

.actions-card .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .admin-header .btn {
        margin-top: 1rem;
    }
}
</style>

@endsection
