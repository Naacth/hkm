@extends('layout')
@section('title', 'Order Berhasil | HIMAKOM UYM')
@section('content')

<!-- Success Hero Section -->
<div class="success-hero position-relative overflow-hidden" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); min-height: 50vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="success-content text-white">
                    <div class="success-icon mb-4">
                        <i class="bi bi-check-circle-fill" style="font-size: 5rem;"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">
                        Pesanan Berhasil Dibuat!
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.3rem;">
                        Terima kasih telah memesan produk HIMAKOM. Tim kami akan segera menghubungi Anda.
                    </p>
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

<!-- Order Details Section -->
<div class="order-details-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="order-details-card bg-white rounded-4 shadow-lg p-5">
                    <div class="order-header text-center mb-5">
                        <h3 class="fw-bold text-primary mb-3">
                            <i class="bi bi-receipt me-2"></i>Detail Pesanan
                        </h3>
                        <p class="text-muted">Simpan informasi pesanan ini untuk referensi</p>
                    </div>
                    
                    <div class="row g-4">
                        <!-- Order Info -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Pesanan
                                </h5>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">No. Pesanan:</span>
                                    <span class="ms-2 fw-bold text-primary">{{ $order->order_number }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Tanggal Pesanan:</span>
                                    <span class="ms-2">{{ $order->created_at->format('d F Y, H:i') }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Status:</span>
                                    <span class="ms-2 badge {{ $order->getStatusBadgeClass() }}">{{ $order->getStatusLabel() }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Metode Pembayaran:</span>
                                    <span class="ms-2">
                                        @if($order->payment_method == 'qris')
                                            <i class="bi bi-qr-code me-1"></i>QRIS
                                        @else
                                            <i class="bi bi-cash me-1"></i>Offline
                                        @endif
                                    </span>
                                </div>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Metode Pengiriman:</span>
                                    <span class="ms-2">
                                        @if($order->delivery_method == 'pickup')
                                            <i class="bi bi-box-seam me-1"></i>Ambil Sendiri
                                        @else
                                            <i class="bi bi-truck me-1"></i>Dikirim
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Customer Info -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-person me-2"></i>Data Pelanggan
                                </h5>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Nama:</span>
                                    <span class="ms-2">{{ $order->customer_name }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Email:</span>
                                    <span class="ms-2">{{ $order->customer_email }}</span>
                                </div>
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">WhatsApp:</span>
                                    <span class="ms-2">{{ $order->customer_phone }}</span>
                                </div>
                                @if($order->customer_nim)
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">NIM:</span>
                                    <span class="ms-2">{{ $order->customer_nim }}</span>
                                </div>
                                @endif
                                @if($order->customer_kelas)
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Kelas:</span>
                                    <span class="ms-2">{{ $order->customer_kelas }}</span>
                                </div>
                                @endif
                                @if($order->customer_address)
                                <div class="info-item mb-3">
                                    <span class="fw-semibold text-muted">Alamat:</span>
                                    <span class="ms-2">{{ $order->customer_address }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="product-details-section mt-5">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="bi bi-box-seam me-2"></i>Produk yang Dipesan
                        </h5>
                        
                        <div class="product-card bg-light rounded-4 p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    @if($order->produk->image)
                                        <img src="{{ asset('uploads/'.$order->produk->image) }}" 
                                             class="product-image w-100 rounded-3" 
                                             style="height: 120px; object-fit: cover;" 
                                             alt="{{ $order->produk->name }}"
                                             onerror="this.src='https://via.placeholder.com/300x120/1976d2/ffffff?text=Produk+HIMAKOM'">
                                    @else
                                        <div class="product-image-placeholder w-100 d-flex align-items-center justify-content-center bg-primary rounded-3"
                                             style="height: 120px;">
                                            <i class="bi bi-box-seam text-white" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary mb-2">{{ $order->produk->name }}</h6>
                                    <p class="text-muted small mb-2">{{ Str::limit($order->produk->description, 100) }}</p>
                                    
                                    <!-- Product Features -->
                                    @if($order->produk->quality_guaranteed || $order->produk->periodic_support || $order->produk->support_24_7)
                                    <div class="d-flex flex-wrap gap-1">
                                        @if($order->produk->quality_guaranteed)
                                            <span class="badge bg-success small">Kualitas Terjamin</span>
                                        @endif
                                        @if($order->produk->periodic_support)
                                            <span class="badge bg-info small">Support Berkala</span>
                                        @endif
                                        @if($order->produk->support_24_7)
                                            <span class="badge bg-warning small">24/7 Support</span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-3 text-md-end">
                                    <div class="quantity-info mb-2">
                                        <span class="text-muted small">Jumlah:</span>
                                        <span class="fw-bold">{{ $order->quantity }}</span>
                                    </div>
                                    <div class="price-info">
                                        <span class="text-muted small">Harga Satuan:</span>
                                        <div class="fw-bold text-success">
                                            @if($order->produk->price)
                                                Rp {{ number_format($order->produk->price, 0, ',', '.') }}
                                            @else
                                                <span class="text-primary">Gratis</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Price -->
                    <div class="total-section mt-4">
                        <div class="total-card bg-primary text-white rounded-4 p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="fw-bold mb-1">Total Pembayaran</h5>
                                    <p class="mb-0 small opacity-75">Harga sudah termasuk semua biaya</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <div class="text-end">
                                        @if($order->voucher_code)
                                            <div class="small">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                            <div class="small">Voucher {{ $order->voucher_code }} ({{ $order->voucher_discount_percent }}%): -Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</div>
                                            <h3 class="fw-bold mb-0">Rp {{ number_format($order->final_price, 0, ',', '.') }}</h3>
                                        @else
                                            <h3 class="fw-bold mb-0">
                                                @if($order->total_price > 0)
                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                @else
                                                    <span class="text-warning">Gratis</span>
                                                @endif
                                            </h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    @if($order->notes)
                    <div class="notes-section mt-4">
                        <h6 class="fw-bold text-primary mb-2">Catatan Tambahan:</h6>
                        <div class="notes-card bg-light rounded-3 p-3">
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons text-center mt-5">
                        <a href="{{ route('orders.history') }}" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                            <i class="bi bi-list-ul me-2"></i>Lihat Riwayat Pesanan
                        </a>
                        <a href="{{ route('produk') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Next Steps Section -->
<div class="next-steps-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h3 class="fw-bold text-primary mb-3">Langkah Selanjutnya</h3>
                    <p class="text-muted">Apa yang akan terjadi setelah Anda membuat pesanan?</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="step-card bg-white rounded-4 p-4 text-center shadow-sm">
                            <div class="step-icon mb-3">
                                <i class="bi bi-clock text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="fw-bold text-primary mb-2">1. Konfirmasi</h6>
                            <p class="text-muted small mb-0">Admin akan memverifikasi dan mengkonfirmasi pesanan Anda dalam 1x24 jam</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="step-card bg-white rounded-4 p-4 text-center shadow-sm">
                            <div class="step-icon mb-3">
                                <i class="bi bi-telephone text-success" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="fw-bold text-success mb-2">2. Kontak</h6>
                            <p class="text-muted small mb-0">Tim kami akan menghubungi Anda via WhatsApp untuk detail pembayaran</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="step-card bg-white rounded-4 p-4 text-center shadow-sm">
                            <div class="step-icon mb-3">
                                <i class="bi bi-check-circle text-info" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="fw-bold text-info mb-2">3. Selesai</h6>
                            <p class="text-muted small mb-0">Setelah pembayaran, produk akan diproses sesuai metode pengiriman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Success Hero */
.success-hero {
    position: relative;
    overflow: hidden;
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

/* Order Details Card */
.order-details-card {
    transition: all 0.3s ease;
}

.order-details-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Info Sections */
.info-section {
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 1.5rem;
    border: 2px solid #e9ecef;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

/* Product Card */
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

/* Total Card */
.total-card {
    transition: all 0.3s ease;
}

.total-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
}

/* Step Cards */
.step-card {
    transition: all 0.3s ease;
}

.step-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.step-icon {
    width: 60px;
    height: 60px;
    background: rgba(25, 118, 210, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

/* Action Buttons */
.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .success-hero {
        min-height: 40vh;
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
