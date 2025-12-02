@extends('layout')
@section('title', 'Pendaftaran Berhasil | HIMAKOM UYM')
@section('content')

<!-- Success Header -->
<div class="success-header bg-success text-white py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="success-icon mb-4">
                    <i class="bi bi-check-circle-fill" style="font-size: 5rem;"></i>
                </div>
                <h1 class="display-5 fw-bold mb-3">Pendaftaran Berhasil!</h1>
                <p class="lead mb-0">Terima kasih telah mendaftar untuk event HIMAKOM UYM</p>
            </div>
        </div>
    </div>
</div>

<!-- Registration Details Section -->
<div class="registration-details-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="details-card bg-white rounded-4 shadow-lg p-5">
                    <div class="card-header text-center mb-4">
                        <h3 class="fw-bold text-primary mb-2">
                            <i class="bi bi-receipt me-2"></i>Detail Pendaftaran
                        </h3>
                        <p class="text-muted">Simpan informasi ini untuk referensi Anda</p>
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
                                    <span class="badge {{ $registration->getStatusBadgeClass() }} fs-6 px-3 py-2">
                                        {{ $registration->getStatusLabel() }}
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
                                    <p class="mb-0">{{ $registration->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps Section -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="next-steps-card bg-light rounded-4 p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-list-check me-2"></i>Langkah Selanjutnya
                    </h5>
                    <div class="steps-list">
                        <div class="step-item d-flex align-items-center mb-3">
                            <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">1</div>
                            <div class="step-content">
                                <p class="mb-0 fw-semibold">Tunggu Konfirmasi</p>
                                <small class="text-muted">Admin akan mengkonfirmasi pendaftaran Anda dalam 1x24 jam</small>
                            </div>
                        </div>
                        @if($registration->event->is_paid)
                        <div class="step-item d-flex align-items-center mb-3">
                            <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">2</div>
                            <div class="step-content">
                                <p class="mb-0 fw-semibold">Lakukan Pembayaran</p>
                                <small class="text-muted">Lakukan pembayaran sesuai metode yang dipilih</small>
                            </div>
                        </div>
                        
                        <!-- QRIS Payment Section -->
                        @if($registration->payment_method == 'qris' && $registration->event->qris_image)
                        <div class="qris-payment-section mt-4 mb-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="bi bi-qr-code me-2"></i>Pembayaran QRIS
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-primary mb-3">Scan QR Code untuk Pembayaran</h6>
                                            <div class="qris-image-container">
                                                <img src="{{ $registration->event->qris_url }}" 
                                                     alt="QRIS Payment" 
                                                     class="img-fluid rounded shadow"
                                                     style="max-width: 300px; max-height: 300px;">
                                            </div>
                                            <p class="text-muted mt-2 small">
                                                Gunakan aplikasi e-wallet atau mobile banking untuk scan QR code
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-primary mb-3">Detail Pembayaran</h6>
                                            <div class="payment-details">
                                                <div class="detail-item d-flex justify-content-between mb-2">
                                                    <span class="text-muted">Event:</span>
                                                    <span class="fw-semibold">{{ $registration->event->title }}</span>
                                                </div>
                                                <div class="detail-item d-flex justify-content-between mb-2">
                                                    <span class="text-muted">No. Pendaftaran:</span>
                                                    <span class="fw-semibold">{{ $registration->registration_number }}</span>
                                                </div>
                                                <div class="detail-item d-flex justify-content-between mb-2">
                                                    <span class="text-muted">Peserta:</span>
                                                    <span class="fw-semibold">{{ $registration->participant_name }}</span>
                                                </div>
                                                <hr>
                                                <div class="detail-item d-flex justify-content-between mb-2">
                                                    <span class="text-muted">Harga:</span>
                                                    <span class="fw-semibold">Rp {{ number_format($registration->event->price, 0, ',', '.') }}</span>
                                                </div>
                                                @if($registration->voucher_code)
                                                <div class="detail-item d-flex justify-content-between mb-2">
                                                    <span class="text-muted">Diskon ({{ $registration->voucher_discount_percent }}%):</span>
                                                    <span class="text-success">-Rp {{ number_format($registration->discount_amount, 0, ',', '.') }}</span>
                                                </div>
                                                @endif
                                                <hr>
                                                <div class="detail-item d-flex justify-content-between">
                                                    <span class="fw-bold text-primary">Total Bayar:</span>
                                                    <span class="fw-bold text-primary fs-5">Rp {{ number_format($registration->final_price, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="step-item d-flex align-items-center mb-3">
                            <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">3</div>
                            <div class="step-content">
                                <p class="mb-0 fw-semibold">Konfirmasi Pembayaran</p>
                                <small class="text-muted">Admin akan mengkonfirmasi pembayaran Anda</small>
                            </div>
                        </div>
                        <div class="step-item d-flex align-items-center mb-3">
                            <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">4</div>
                            <div class="step-content">
                                <p class="mb-0 fw-semibold">Hadir di Event</p>
                                <small class="text-muted">Datang tepat waktu sesuai jadwal yang telah ditentukan</small>
                            </div>
                        </div>
                        @else
                        <div class="step-item d-flex align-items-center mb-3">
                            <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">2</div>
                            <div class="step-content">
                                <p class="mb-0 fw-semibold">Hadir di Event</p>
                                <small class="text-muted">Datang tepat waktu sesuai jadwal yang telah ditentukan</small>
                            </div>
                        </div>
                        @endif
                        <div class="step-item d-flex align-items-center">
                            <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="step-content">
                                <p class="mb-0 fw-semibold">Download Sertifikat</p>
                                <small class="text-muted">Sertifikat akan tersedia setelah event selesai</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 text-center">
                <div class="action-buttons">
                    <a href="{{ route('event-registrations.history') }}" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                        <i class="bi bi-list-ul me-2"></i>Lihat Riwayat Pendaftaran
                    </a>
                    <a href="{{ route('event') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                        <i class="bi bi-calendar-event me-2"></i>Lihat Event Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Success Header */
.success-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.success-icon {
    animation: bounceIn 1s ease-out;
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
        opacity: 0;
    }
    50% {
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
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

/* Next Steps Card */
.next-steps-card {
    transition: all 0.3s ease;
}

.next-steps-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.step-item {
    transition: all 0.3s ease;
}

.step-item:hover {
    transform: translateX(10px);
}

.step-number {
    transition: all 0.3s ease;
}

.step-item:hover .step-number {
    transform: scale(1.1);
}

/* Action Buttons */
.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .success-header {
        text-align: center;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

@endsection
