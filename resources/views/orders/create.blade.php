@extends('layout')
@section('title', 'Order ' . $produk->name . ' | HIMAKOM UYM')
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 40vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <h1 class="display-5 fw-bold mb-4 animate__animated animate__fadeInUp">
                        <i class="bi bi-cart-plus me-3"></i>Order Produk
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.2rem;">
                        Lengkapi data diri Anda untuk memesan produk HIMAKOM
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Form Section -->
<div class="order-form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-4">
                    <!-- Product Info Card -->
                    <div class="col-lg-4">
                        <div class="product-info-card bg-white rounded-4 shadow-lg p-4 sticky-top" style="top: 2rem;">
                            <div class="product-image-container mb-4">
                                @if($produk->image)
                                    <img src="{{ asset('uploads/'.$produk->image) }}" 
                                         class="product-image w-100 rounded-3" 
                                         style="height: 200px; object-fit: cover;" 
                                         alt="{{ $produk->name }}"
                                         onerror="this.src='https://via.placeholder.com/400x200/1976d2/ffffff?text=Produk+HIMAKOM'">
                                @else
                                    <div class="product-image-placeholder w-100 d-flex align-items-center justify-content-center bg-primary rounded-3"
                                         style="height: 200px;">
                                        <i class="bi bi-box-seam text-white" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="product-details">
                                <h4 class="fw-bold text-primary mb-3">{{ $produk->name }}</h4>
                                <p class="text-muted mb-3">{{ $produk->description }}</p>
                                
                                <div class="price-section mb-4">
                                    <h3 class="fw-bold text-success mb-0">
                                        @if($produk->price)
                                            Rp {{ number_format($produk->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-primary">Gratis</span>
                                        @endif
                                    </h3>
                                </div>
                                
                                <!-- Product Features -->
                                @if($produk->quality_guaranteed || $produk->periodic_support || $produk->support_24_7)
                                <div class="features-section">
                                    <h6 class="fw-bold text-primary mb-3">Fitur Produk:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @if($produk->quality_guaranteed)
                                            <span class="badge bg-success">
                                                <i class="bi bi-shield-check me-1"></i>Kualitas Terjamin
                                            </span>
                                        @endif
                                        @if($produk->periodic_support)
                                            <span class="badge bg-info">
                                                <i class="bi bi-calendar-check me-1"></i>Support Berkala
                                            </span>
                                        @endif
                                        @if($produk->support_24_7)
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock me-1"></i>24/7 Support
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Form Card -->
                    <div class="col-lg-8">
                        <div class="order-form-card bg-white rounded-4 shadow-lg p-5">
                            <div class="form-header text-center mb-4">
                                <div class="form-icon mb-3">
                                    <i class="bi bi-person-check text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h3 class="fw-bold text-primary mb-2">Form Pemesanan</h3>
                                <p class="text-muted">Isi data diri Anda dengan lengkap dan benar</p>
                            </div>

                            <form action="{{ route('orders.store', $produk->id) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Customer Information -->
                                <div class="form-section mb-5">
                                    <h5 class="fw-bold text-primary mb-4">
                                        <i class="bi bi-person me-2"></i>Data Diri
                                    </h5>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="customer_name" class="form-label fw-semibold">Nama Lengkap *</label>
                                            <input type="text" 
                                                   name="customer_name" 
                                                   id="customer_name"
                                                   class="form-control @error('customer_name') is-invalid @enderror" 
                                                   placeholder="Masukkan nama lengkap"
                                                   value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                                   required>
                                            @error('customer_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="customer_email" class="form-label fw-semibold">Email *</label>
                                            <input type="email" 
                                                   name="customer_email" 
                                                   id="customer_email"
                                                   class="form-control @error('customer_email') is-invalid @enderror" 
                                                   placeholder="contoh@email.com"
                                                   value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                                                   required>
                                            @error('customer_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="customer_phone" class="form-label fw-semibold">No. WhatsApp *</label>
                                            <input type="tel" 
                                                   name="customer_phone" 
                                                   id="customer_phone"
                                                   class="form-control @error('customer_phone') is-invalid @enderror" 
                                                   placeholder="08xxxxxxxxxx"
                                                   value="{{ old('customer_phone') }}"
                                                   required>
                                            @error('customer_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="customer_nim" class="form-label fw-semibold">NIM (Opsional)</label>
                                            <input type="text" 
                                                   name="customer_nim" 
                                                   id="customer_nim"
                                                   class="form-control @error('customer_nim') is-invalid @enderror" 
                                                   placeholder="Masukkan NIM"
                                                   value="{{ old('customer_nim') }}">
                                            @error('customer_nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="customer_kelas" class="form-label fw-semibold">Kelas (Opsional)</label>
                                            <input type="text" 
                                                   name="customer_kelas" 
                                                   id="customer_kelas"
                                                   class="form-control @error('customer_kelas') is-invalid @enderror" 
                                                   placeholder="Contoh: TI-21-A"
                                                   value="{{ old('customer_kelas') }}">
                                            @error('customer_kelas')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="customer_address" class="form-label fw-semibold">Alamat Lengkap (Opsional)</label>
                                            <textarea name="customer_address" 
                                                      id="customer_address"
                                                      class="form-control @error('customer_address') is-invalid @enderror" 
                                                      rows="3"
                                                      placeholder="Masukkan alamat lengkap untuk pengiriman">{{ old('customer_address') }}</textarea>
                                            @error('customer_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Order Details -->
                                <div class="form-section mb-5">
                                    <h5 class="fw-bold text-primary mb-4">
                                        <i class="bi bi-cart me-2"></i>Detail Pesanan
                                    </h5>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label fw-semibold">Jumlah *</label>
                                            <input type="number" 
                                                   name="quantity" 
                                                   id="quantity"
                                                   class="form-control @error('quantity') is-invalid @enderror" 
                                                   min="1"
                                                   value="{{ old('quantity', 1) }}"
                                                   onchange="updateTotalPrice()"
                                                   required>
                                            @error('quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="voucher_code" class="form-label fw-semibold">Kode Voucher (Opsional)</label>
                                            <input type="text"
                                                   name="voucher_code"
                                                   id="voucher_code"
                                                   class="form-control @error('voucher_code') is-invalid @enderror"
                                                   placeholder="Masukkan kode voucher"
                                                   value="{{ old('voucher_code') }}">
                                            @error('voucher_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Tersedia: 10%, 20%, 30%, 50%, 80%, 100% (jika diaktifkan admin)</div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Total Harga</label>
                                            <div class="total-price-display p-3 bg-light rounded-3">
                                                <h4 class="fw-bold text-success mb-0" id="totalPrice">
                                                    @if($produk->price)
                                                        Rp {{ number_format($produk->price, 0, ',', '.') }}
                                                    @else
                                                        <span class="text-primary">Gratis</span>
                                                    @endif
                                                </h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="payment_method" class="form-label fw-semibold">Metode Pembayaran *</label>
                                            <select name="payment_method" 
                                                    id="payment_method"
                                                    class="form-select @error('payment_method') is-invalid @enderror" 
                                                    required
                                                    onchange="togglePaymentDetails()">
                                                <option value="">Pilih metode pembayaran</option>
                                                <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                                <option value="offline" {{ old('payment_method') == 'offline' ? 'selected' : '' }}>Pembayaran Offline</option>
                                            </select>
                                            @error('payment_method')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- QRIS and Proof of Payment Section (Conditional) -->
                                        <div class="col-12" id="qrisPaymentSection" style="display: none;">
                                            @if($produk->qris_image_path)
                                                <div class="form-group mb-4 text-center">
                                                    <label class="form-label fw-semibold mb-3">
                                                        <i class="bi bi-qr-code text-primary me-2"></i>Pembayaran via QRIS
                                                    </label>
                                                    <p class="text-muted">Silakan scan QRIS di bawah ini untuk melakukan pembayaran:</p>
                                                    <img src="{{ asset('uploads/'.$produk->qris_image_path) }}" 
                                                         alt="QRIS Pembayaran" 
                                                         class="img-fluid rounded-3 shadow-sm mb-4"
                                                         style="max-width: 250px;">
                                                    <p class="text-danger fw-semibold">Pastikan nominal pembayaran sesuai harga produk.</p>
                                                </div>
                                            @else
                                                <div class="alert alert-warning text-center" role="alert">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>Gambar QRIS belum tersedia untuk produk ini. Silakan hubungi admin.
                                                </div>
                                            @endif
                                            
                                            <div class="form-group mb-4">
                                                <label for="proof_of_payment_image_path" class="form-label fw-semibold">
                                                    <i class="bi bi-receipt text-primary me-2"></i>Bukti Pembayaran
                                                </label>
                                                <input type="file" 
                                                       name="proof_of_payment_image_path" 
                                                       id="proof_of_payment_image_path"
                                                       class="form-control @error('proof_of_payment_image_path') is-invalid @enderror" 
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
                                        
                                        <div class="col-md-6">
                                            <label for="delivery_method" class="form-label fw-semibold">Metode Pengiriman *</label>
                                            <select name="delivery_method" 
                                                    id="delivery_method"
                                                    class="form-select @error('delivery_method') is-invalid @enderror" 
                                                    required>
                                                <option value="">Pilih metode pengiriman</option>
                                                <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Ambil Sendiri</option>
                                                <option value="delivery" {{ old('delivery_method') == 'delivery' ? 'selected' : '' }}>Dikirim</option>
                                            </select>
                                            @error('delivery_method')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="notes" class="form-label fw-semibold">Catatan Tambahan (Opsional)</label>
                                            <textarea name="notes" 
                                                      id="notes"
                                                      class="form-control @error('notes') is-invalid @enderror" 
                                                      rows="3"
                                                      placeholder="Masukkan catatan atau permintaan khusus">{{ old('notes') }}</textarea>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Form Actions -->
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                        <i class="bi bi-check-circle me-2"></i>Buat Pesanan
                                    </button>
                                    <a href="{{ route('produk') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section */
.hero-section {
    position: relative;
    overflow: hidden;
}

/* Product Info Card */
.product-info-card {
    transition: all 0.3s ease;
}

.product-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Order Form Card */
.order-form-card {
    transition: all 0.3s ease;
}

.order-form-card:hover {
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

/* Form Controls */
.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
}

/* Form Sections */
.form-section {
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 2rem;
}

.form-section:last-of-type {
    border-bottom: none;
}

/* Total Price Display */
.total-price-display {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

/* Form Actions */
.form-actions .btn {
    transition: all 0.3s ease;
}

.form-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        min-height: 30vh;
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
function updateTotalPrice() {
    const quantity = document.getElementById('quantity').value;
    const price = {{ $produk->price ?? 0 }};
    const total = quantity * price;
    
    const totalPriceElement = document.getElementById('totalPrice');
    
    if (price > 0) {
        totalPriceElement.innerHTML = 'Rp ' + total.toLocaleString('id-ID');
    } else {
        totalPriceElement.innerHTML = '<span class="text-primary">Gratis</span>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    togglePaymentDetails(); // Initial call to set the correct state on page load
});

function togglePaymentDetails() {
    const qrisPaymentSection = document.getElementById('qrisPaymentSection');
    const paymentMethodSelect = document.getElementById('payment_method');
    const proofOfPaymentInput = document.getElementById('proof_of_payment_image_path');
    const proofOfPaymentPreview = document.getElementById('proofOfPaymentImagePreview');

    if (paymentMethodSelect.value === 'qris') {
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

// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

@endsection
