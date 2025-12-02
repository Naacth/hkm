@extends('layout')
@section('title', 'Riwayat Pesanan | HIMAKOM UYM')
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 40vh; display: flex; align-items: center;">
    <div class="container position-relative z-3">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content text-white">
                    <h1 class="display-5 fw-bold mb-4 animate__animated animate__fadeInUp">
                        <i class="bi bi-list-ul me-3"></i>Riwayat Pesanan
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.2rem;">
                        Lihat dan kelola semua pesanan Anda
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Orders History Section -->
<div class="orders-history-section py-5">
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

        @if($orders->count() > 0)
        <div class="orders-list">
            @foreach($orders as $order)
            <div class="order-card bg-white rounded-4 shadow-sm mb-4 overflow-hidden">
                <div class="order-header p-4 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="order-info">
                                <h5 class="fw-bold text-primary mb-1">{{ $order->order_number }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-calendar me-1"></i>{{ $order->created_at->format('d F Y, H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="order-status">
                                <span class="badge {{ $order->getStatusBadgeClass() }} fs-6 px-3 py-2">
                                    {{ $order->getStatusLabel() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-content p-4">
                    <div class="row g-4">
                        <!-- Product Info -->
                        <div class="col-lg-4">
                            <div class="product-info">
                                <div class="product-image-container mb-3">
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
                                
                                <h6 class="fw-bold text-primary mb-2">{{ $order->produk->name }}</h6>
                                <p class="text-muted small mb-2">{{ Str::limit($order->produk->description, 80) }}</p>
                                
                                <!-- Product Features -->
                                @if($order->produk->quality_guaranteed || $order->produk->periodic_support || $order->produk->support_24_7)
                                <div class="d-flex flex-wrap gap-1">
                                    @if($order->produk->quality_guaranteed)
                                        <span class="badge bg-success small">Kualitas</span>
                                    @endif
                                    @if($order->produk->periodic_support)
                                        <span class="badge bg-info small">Berkala</span>
                                    @endif
                                    @if($order->produk->support_24_7)
                                        <span class="badge bg-warning small">24/7</span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Order Details -->
                        <div class="col-lg-4">
                            <div class="order-details">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Detail Pesanan
                                </h6>
                                
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Jumlah:</span>
                                    <span class="fw-semibold ms-2">{{ $order->quantity }}</span>
                                </div>
                                
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Harga Satuan:</span>
                                    <span class="fw-semibold ms-2">
                                        @if($order->produk->price)
                                            Rp {{ number_format($order->produk->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-primary">Gratis</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Total:</span>
                                    <span class="fw-bold text-success ms-2">
                                        @if($order->total_price > 0)
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        @else
                                            <span class="text-primary">Gratis</span>
                                        @endif
                                    </span>
                                </div>
                                @if($order->voucher_code)
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Voucher:</span>
                                    <span class="fw-semibold ms-2">{{ $order->voucher_code }} ({{ $order->voucher_discount_percent }}%)</span>
                                </div>
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Potongan:</span>
                                    <span class="fw-semibold ms-2">-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Total Akhir:</span>
                                    <span class="fw-bold ms-2">Rp {{ number_format($order->final_price, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Pembayaran:</span>
                                    <span class="fw-semibold ms-2">
                                        @if($order->payment_method == 'qris')
                                            <i class="bi bi-qr-code me-1"></i>QRIS
                                        @else
                                            <i class="bi bi-cash me-1"></i>Offline
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="detail-item mb-2">
                                    <span class="text-muted small">Pengiriman:</span>
                                    <span class="fw-semibold ms-2">
                                        @if($order->delivery_method == 'pickup')
                                            <i class="bi bi-box-seam me-1"></i>Ambil Sendiri
                                        @else
                                            <i class="bi bi-truck me-1"></i>Dikirim
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Customer Info & Actions -->
                        <div class="col-lg-4">
                            <div class="customer-info">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-person me-2"></i>Data Pelanggan
                                </h6>
                                
                                <div class="customer-details mb-4">
                                    <div class="detail-item mb-2">
                                        <span class="text-muted small">Nama:</span>
                                        <span class="fw-semibold ms-2">{{ $order->customer_name }}</span>
                                    </div>
                                    
                                    <div class="detail-item mb-2">
                                        <span class="text-muted small">Email:</span>
                                        <span class="fw-semibold ms-2">{{ $order->customer_email }}</span>
                                    </div>
                                    
                                    <div class="detail-item mb-2">
                                        <span class="text-muted small">WhatsApp:</span>
                                        <span class="fw-semibold ms-2">{{ $order->customer_phone }}</span>
                                    </div>
                                    
                                    @if($order->customer_nim)
                                    <div class="detail-item mb-2">
                                        <span class="text-muted small">NIM:</span>
                                        <span class="fw-semibold ms-2">{{ $order->customer_nim }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($order->customer_kelas)
                                    <div class="detail-item mb-2">
                                        <span class="text-muted small">Kelas:</span>
                                        <span class="fw-semibold ms-2">{{ $order->customer_kelas }}</span>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="action-buttons">
                                    <a href="{{ route('orders.show', $order->id) }}" 
                                       class="btn btn-outline-primary btn-sm rounded-pill me-2">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                    
                                    @if($order->status == 'pending')
                                    <form action="{{ route('orders.cancel', $order->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                            <i class="bi bi-x-circle me-1"></i>Batal
                                        </button>
                                    </form>
                                    @endif
                                </div>
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
                <i class="bi bi-cart-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada pesanan</h4>
            <p class="text-muted mb-4">Mulai dengan memesan produk HIMAKOM pertama Anda</p>
            <a href="{{ route('produk') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="bi bi-cart-plus me-2"></i>Lihat Produk
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Quick Stats -->
@if($orders->count() > 0)
<div class="quick-stats-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-list-ul text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2">{{ $orders->count() }}</h3>
                    <p class="text-muted mb-0">Total Pesanan</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-clock text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold text-warning mb-2">{{ $orders->where('status', 'pending')->count() }}</h3>
                    <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-check-circle text-success display-4 mb-3"></i>
                    <h3 class="fw-bold text-success mb-2">{{ $orders->whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->count() }}</h3>
                    <p class="text-muted mb-0">Dikonfirmasi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-currency-dollar text-info display-4 mb-3"></i>
                    <h3 class="fw-bold text-info mb-2">Rp {{ number_format($orders->whereNotIn('status', ['cancelled'])->sum(function($o){ return (float)($o->final_price ?? $o->total_price); }), 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Total Pembelian</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<style>
/* Hero Section */
.hero-section {
    position: relative;
    overflow: hidden;
}

/* Order Card */
.order-card {
    transition: all 0.3s ease;
}

.order-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

/* Product Image */
.product-image {
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

/* Detail Items */
.detail-item {
    display: flex;
    align-items: center;
    padding: 0.25rem 0;
}

/* Action Buttons */
.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Stats Cards */
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 1rem;
    border: 2px dashed #dee2e6;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .hero-section {
        min-height: 30vh;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

@endsection
