@extends('layout')
@section('title', 'Daftar Event | HIMAKOM UYM')
@section('content')

<!-- Event Registration Header -->
<div class="registration-header bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-calendar-plus me-3"></i>Daftar Event
                </h1>
                <p class="lead mb-0">Bergabunglah dengan event HIMAKOM UYM</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('event') }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Event
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Event Info Section -->
<div class="event-info-section py-4" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="event-card bg-white rounded-4 shadow-lg p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            @if($event->image)
                                <img src="{{ asset('uploads/' . (str_contains($event->image, 'events/') ? $event->image : 'events/'.basename($event->image))) }}" 
                                     alt="{{ $event->title }}" 
                                     class="img-fluid rounded-3"
                                     style="width: 100%; height: 120px; object-fit: cover;"
                                     onerror="this.src='https://via.placeholder.com/300x120/1976d2/ffffff?text=Event+HIMAKOM'">
                            @else
                                <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" 
                                     style="width: 100%; height: 120px;">
                                    <i class="bi bi-calendar-event" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h3 class="fw-bold text-primary mb-2">{{ $event->title }}</h3>
                            <div class="event-details">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-date text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $event->getFormattedDateAttribute() }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $event->location }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-currency-dollar text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $event->getFormattedPriceAttribute() }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $event->getRegistrationCount() }} Peserta</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="registration-info-card bg-white rounded-4 shadow-lg p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-info-circle me-2"></i>Informasi Pendaftaran
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Pendaftaran akan dikonfirmasi oleh admin</small>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Anda akan mendapat notifikasi via email</small>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Sertifikat akan tersedia setelah event selesai</small>
                        </li>
                        @if($event->is_paid)
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Pembayaran dapat dilakukan via QRIS atau offline</small>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Form Section -->
<div class="registration-form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card bg-white rounded-4 shadow-lg p-5">
                    <div class="form-header text-center mb-4">
                        <div class="form-icon mb-3">
                            <i class="bi bi-person-plus text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">Form Pendaftaran Event</h3>
                        <p class="text-muted">Isi data diri Anda dengan lengkap dan benar</p>
                    </div>

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('event-registrations.register', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Nama Lengkap -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="participant_name" class="form-label fw-semibold">
                                        <i class="bi bi-person text-primary me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" 
                                           name="participant_name" 
                                           id="participant_name"
                                           class="form-control form-control-lg @error('participant_name') is-invalid @enderror" 
                                           placeholder="Masukkan nama lengkap"
                                           value="{{ old('participant_name', Auth::user()->name ?? '') }}"
                                           required>
                                    @error('participant_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="participant_email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope text-primary me-2"></i>Email
                                    </label>
                                    <input type="email" 
                                           name="participant_email" 
                                           id="participant_email"
                                           class="form-control form-control-lg @error('participant_email') is-invalid @enderror" 
                                           placeholder="nama@email.com"
                                           value="{{ old('participant_email', Auth::user()->email ?? '') }}"
                                           required>
                                    @error('participant_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="participant_phone" class="form-label fw-semibold">
                                        <i class="bi bi-telephone text-primary me-2"></i>Nomor Telepon
                                    </label>
                                    <input type="tel" 
                                           name="participant_phone" 
                                           id="participant_phone"
                                           class="form-control form-control-lg @error('participant_phone') is-invalid @enderror" 
                                           placeholder="08xxxxxxxxxx"
                                           value="{{ old('participant_phone') }}"
                                           required>
                                    @error('participant_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NIM -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="participant_nim" class="form-label fw-semibold">
                                        <i class="bi bi-card-text text-primary me-2"></i>NIM
                                        <span class="text-muted small">(Opsional)</span>
                                    </label>
                                    <input type="text" 
                                           name="participant_nim" 
                                           id="participant_nim"
                                           class="form-control form-control-lg @error('participant_nim') is-invalid @enderror" 
                                           placeholder="Masukkan NIM"
                                           value="{{ old('participant_nim') }}">
                                    @error('participant_nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kelas -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="participant_kelas" class="form-label fw-semibold">
                                        <i class="bi bi-mortarboard text-primary me-2"></i>Kelas
                                        <span class="text-muted small">(Opsional)</span>
                                    </label>
                                    <input type="text" 
                                           name="participant_kelas" 
                                           id="participant_kelas"
                                           class="form-control form-control-lg @error('participant_kelas') is-invalid @enderror" 
                                           placeholder="Contoh: 3A, 2B, dll"
                                           value="{{ old('participant_kelas') }}">
                                    @error('participant_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="notes" class="form-label fw-semibold">
                                        <i class="bi bi-chat-text text-primary me-2"></i>Catatan
                                        <span class="text-muted small">(Opsional)</span>
                                    </label>
                                    <textarea name="notes" 
                                              id="notes"
                                              class="form-control form-control-lg @error('notes') is-invalid @enderror" 
                                              rows="3"
                                              placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($event->is_paid)
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-credit-card text-primary me-2"></i>Metode Pembayaran
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="radio" 
                                                       name="payment_method" 
                                                       id="payment_qris" 
                                                       value="qris"
                                                       {{ old('payment_method') == 'qris' ? 'checked' : '' }}
                                                       required
                                                       onchange="togglePaymentDetails()">
                                                <label class="form-check-label" for="payment_qris">
                                                    <i class="bi bi-qr-code me-2"></i>QRIS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="radio" 
                                                       name="payment_method" 
                                                       id="payment_offline" 
                                                       value="offline"
                                                       {{ old('payment_method') == 'offline' ? 'checked' : '' }}
                                                       required
                                                       onchange="togglePaymentDetails()">
                                                <label class="form-check-label" for="payment_offline">
                                                    <i class="bi bi-cash me-2"></i>Offline
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('payment_method')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- QRIS and Proof of Payment Section (Conditional) -->
                            <div class="col-12" id="qrisPaymentSection" style="display: none;">
                                @if($event->qris_image_path)
                                    <div class="form-group mb-4 text-center">
                                        <label class="form-label fw-semibold mb-3">
                                            <i class="bi bi-qr-code text-primary me-2"></i>Pembayaran via QRIS
                                        </label>
                                        <p class="text-muted">Silakan scan QRIS di bawah ini untuk melakukan pembayaran:</p>
                                        <img src="{{ asset('uploads/'.$event->qris_image_path) }}" 
                                             alt="QRIS Pembayaran" 
                                             class="img-fluid rounded-3 shadow-sm mb-4"
                                             style="max-width: 250px;">
                                        <p class="text-danger fw-semibold">Pastikan nominal pembayaran sesuai harga event.</p>
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>Gambar QRIS belum tersedia untuk event ini. Silakan hubungi admin.
                                    </div>
                                @endif
                                
                                <div class="form-group mb-4">
                                    <label for="proof_of_payment_image_path" class="form-label fw-semibold">
                                        <i class="bi bi-receipt text-primary me-2"></i>Bukti Pembayaran
                                    </label>
                                    <input type="file" 
                                           name="proof_of_payment_image_path" 
                                           id="proof_of_payment_image_path"
                                           class="form-control form-control-lg @error('proof_of_payment_image_path') is-invalid @enderror" 
                                           accept="image/*"
                                           onchange="previewProofOfPaymentImage(this)">
                                    @error('proof_of_payment_image_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Upload screenshot bukti pembayaran Anda (JPG, PNG). Maks. 2MB.
                                    </div>
                                    <div class="image-preview mt-3" id="proofOfPaymentImagePreview" style="display: none;">
                                        <img id="previewProofOfPaymentImg" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="voucher_code" class="form-label fw-semibold">
                                        <i class="bi bi-ticket-perforated text-primary me-2"></i>Kode Voucher (Opsional)
                                    </label>
                                    <input type="text" 
                                           name="voucher_code" 
                                           id="voucher_code"
                                           class="form-control form-control-lg @error('voucher_code') is-invalid @enderror" 
                                           placeholder="Masukkan kode voucher"
                                           value="{{ old('voucher_code') }}">
                                    @error('voucher_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Tersedia: 10%, 20%, 30%, 50%, 80%, 100% (sesuai yang diaktifkan admin)</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="notes" class="form-label fw-semibold">
                                        <i class="bi bi-chat-text text-primary me-2"></i>Catatan
                                        <span class="text-muted small">(Opsional)</span>
                                    </label>
                                    <textarea name="notes" 
                                              id="notes"
                                              class="form-control form-control-lg @error('notes') is-invalid @enderror" 
                                              rows="3"
                                              placeholder="Tambahkan catatan atau pertanyaan jika ada">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-actions text-center mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                <i class="bi bi-check-circle me-2"></i>Daftar Event
                            </button>
                            <a href="{{ route('event') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Registration Header */
.registration-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Event Card */
.event-card {
    transition: all 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Registration Info Card */
.registration-info-card {
    transition: all 0.3s ease;
}

.registration-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Form Card */
.form-card {
    transition: all 0.3s ease;
}

.form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.form-icon {
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

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
}

.form-control-lg {
    font-size: 1rem;
}

.form-actions .btn {
    transition: all 0.3s ease;
}

.form-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .registration-header {
        text-align: center;
    }
    
    .registration-header .btn {
        margin-top: 1rem;
    }
    
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        togglePaymentDetails(); // Initial call to set the correct state on page load
    });

    function togglePaymentDetails() {
        const qrisPaymentSection = document.getElementById('qrisPaymentSection');
        const paymentQris = document.getElementById('payment_qris');
        const proofOfPaymentInput = document.getElementById('proof_of_payment_image_path');
        const proofOfPaymentPreview = document.getElementById('proofOfPaymentImagePreview');

        if (paymentQris && paymentQris.checked) {
            qrisPaymentSection.style.display = 'block';
            proofOfPaymentInput.setAttribute('required', 'required');
        } else {
            qrisPaymentSection.style.display = 'none';
            proofOfPaymentInput.removeAttribute('required');
            proofOfPaymentInput.value = ''; // Clear file input
            proofOfPaymentPreview.style.display = 'none'; // Hide preview
            document.getElementById('previewProofOfPaymentImg').src = '';
        }
    }

    function previewProofOfPaymentImage(input) {
        const preview = document.getElementById('proofOfPaymentImagePreview');
        const previewImg = document.getElementById('previewProofOfPaymentImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
            previewImg.src = '';
        }
    }
</script>

@endsection
