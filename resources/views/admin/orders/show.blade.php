@extends('layouts.admin')
@section('title', 'Detail Pesanan ' . $order->order_number . ' | Admin')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-receipt me-3"></i>Detail Pesanan
                </h1>
                <p class="lead mb-0">{{ $order->order_number }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Order Detail Section -->
<div class="order-detail-section py-5">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-4">
            <!-- Order Information -->
            <div class="col-lg-8">
                <div class="order-info-card bg-white rounded-4 shadow-lg p-5">
                    <!-- Order Header -->
                    <div class="order-header text-center mb-5">
                        <div class="order-status-badge mb-3">
                            <span class="badge {{ $order->getStatusBadgeClass() }} fs-4 px-4 py-3">
                                {{ $order->getStatusLabel() }}
                            </span>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">{{ $order->order_number }}</h3>
                        <p class="text-muted">Dibuat pada {{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    
                    <div class="row g-4">
                        <!-- Customer Information -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-4">
                                    <i class="bi bi-person me-2"></i>Data Pelanggan
                                </h5>
                                
                                <div class="info-grid">
                                    <div class="info-item">
                                        <span class="label">Nama Lengkap:</span>
                                        <span class="value fw-bold">{{ $order->customer_name }}</span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Email:</span>
                                        <span class="value">{{ $order->customer_email }}</span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">WhatsApp:</span>
                                        <span class="value">
                                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $order->customer_phone) }}" 
                                               target="_blank" 
                                               class="text-success text-decoration-none">
                                                <i class="bi bi-whatsapp me-1"></i>{{ $order->customer_phone }}
                                            </a>
                                        </span>
                                    </div>
                                    
                                    @if($order->customer_nim)
                                    <div class="info-item">
                                        <span class="label">NIM:</span>
                                        <span class="value">{{ $order->customer_nim }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($order->customer_kelas)
                                    <div class="info-item">
                                        <span class="label">Kelas:</span>
                                        <span class="value">{{ $order->customer_kelas }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($order->customer_address)
                                    <div class="info-item">
                                        <span class="label">Alamat:</span>
                                        <span class="value">{{ $order->customer_address }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Order Details -->
                        <div class="col-md-6">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-4">
                                    <i class="bi bi-info-circle me-2"></i>Detail Pesanan
                                </h5>
                                
                                <div class="info-grid">
                                    <div class="info-item">
                                        <span class="label">No. Pesanan:</span>
                                        <span class="value fw-bold text-primary">{{ $order->order_number }}</span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Tanggal Pesanan:</span>
                                        <span class="value">{{ $order->created_at->format('d F Y, H:i') }}</span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Status:</span>
                                        <span class="value">
                                            <span class="badge {{ $order->getStatusBadgeClass() }}">{{ $order->getStatusLabel() }}</span>
                                        </span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Metode Pembayaran:</span>
                                        <span class="value">
                                            @if($order->payment_method == 'qris')
                                                <i class="bi bi-qr-code me-1"></i>QRIS
                                            @else
                                                <i class="bi bi-cash me-1"></i>Offline
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Metode Pengiriman:</span>
                                        <span class="value">
                                            @if($order->delivery_method == 'pickup')
                                                <i class="bi bi-box-seam me-1"></i>Ambil Sendiri
                                            @else
                                                <i class="bi bi-truck me-1"></i>Dikirim
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Jumlah:</span>
                                        <span class="value fw-bold">{{ $order->quantity }}</span>
                                    </div>
                                    
                                    <div class="info-item">
                                        <span class="label">Total Harga:</span>
                                        <span class="value fw-bold text-success fs-5">
                                            @if($order->total_price > 0)
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            @else
                                                <span class="text-primary">Gratis</span>
                                            @endif
                                        </span>
                                    </div>
                                    @if($order->voucher_code)
                                    <div class="info-item">
                                        <span class="label">Voucher:</span>
                                        <span class="value">{{ $order->voucher_code }} ({{ $order->voucher_discount_percent }}%)</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Potongan:</span>
                                        <span class="value">-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="label">Total Akhir:</span>
                                        <span class="value fw-bold">Rp {{ number_format($order->final_price, 0, ',', '.') }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Proof of Payment Section -->
                        @if($order->payment_method === 'qris' && $order->proof_of_payment_image_path)
                        <div class="col-12 mt-4">
                            <div class="info-section">
                                <h5 class="fw-bold text-primary mb-4">
                                    <i class="bi bi-receipt-cutoff me-2"></i>Bukti Pembayaran
                                </h5>
                                <div class="mb-3">
                                    <label class="fw-semibold text-muted">Metode:</label>
                                    <p class="mb-0"><i class="bi bi-qr-code me-1"></i>QRIS</p>
                                </div>
                                <div class="mb-3 text-center">
                                    <a href="{{ asset('uploads/' . $order->proof_of_payment_image_path) }}" target="_blank">
                                        <img src="{{ asset('uploads/' . $order->proof_of_payment_image_path) }}"
                                             alt="Bukti Pembayaran"
                                             class="img-fluid rounded-3 shadow-sm"
                                             style="max-height: 250px;">
                                    </a>
                                    <p class="text-muted small mt-2">Klik gambar untuk melihat ukuran penuh</p>
                                </div>
                                @if($order->status === 'pending')
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn btn-success w-100 rounded-pill">
                                        <i class="bi bi-check-circle me-2"></i>Konfirmasi Pembayaran
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endif

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
                                             style="height: 150px; object-fit: cover;" 
                                             alt="{{ $order->produk->name }}"
                                             onerror="this.src='https://via.placeholder.com/300x150/1976d2/ffffff?text=Produk+HIMAKOM'">
                                    @else
                                        <div class="product-image-placeholder w-100 d-flex align-items-center justify-content-center bg-primary rounded-3"
                                             style="height: 150px;">
                                            <i class="bi bi-box-seam text-white" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary mb-2">{{ $order->produk->name }}</h6>
                                    <p class="text-muted mb-3">{{ $order->produk->description }}</p>
                                    
                                    <!-- Product Features -->
                                    @if($order->produk->quality_guaranteed || $order->produk->periodic_support || $order->produk->support_24_7)
                                    <div class="d-flex flex-wrap gap-2">
                                        @if($order->produk->quality_guaranteed)
                                            <span class="badge bg-success">
                                                <i class="bi bi-shield-check me-1"></i>Kualitas Terjamin
                                            </span>
                                        @endif
                                        @if($order->produk->periodic_support)
                                            <span class="badge bg-info">
                                                <i class="bi bi-calendar-check me-1"></i>Support Berkala
                                            </span>
                                        @endif
                                        @if($order->produk->support_24_7)
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock me-1"></i>24/7 Support
                                            </span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-3 text-md-end">
                                    <div class="price-breakdown">
                                        <div class="price-item mb-2">
                                            <span class="text-muted small">Harga Satuan:</span>
                                            <div class="fw-bold">
                                                @if($order->produk->price)
                                                    Rp {{ number_format($order->produk->price, 0, ',', '.') }}
                                                @else
                                                    <span class="text-primary">Gratis</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="price-item mb-2">
                                            <span class="text-muted small">Jumlah:</span>
                                            <div class="fw-bold">{{ $order->quantity }}</div>
                                        </div>
                                        
                                        <hr class="my-3">
                                        
                                        <div class="price-item">
                                            <span class="fw-bold text-primary">Total:</span>
                                            <div class="fw-bold text-success fs-5">
                                                @if($order->total_price > 0)
                                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                @else
                                                    <span class="text-primary">Gratis</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    @if($order->notes)
                    <div class="notes-section mt-5">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="bi bi-chat-text me-2"></i>Catatan Tambahan
                        </h6>
                        <div class="notes-card bg-light rounded-3 p-4">
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Status Update Panel -->
            <div class="col-lg-4">
                <div class="status-update-card bg-white rounded-4 shadow-lg p-4">
                    <h5 class="fw-bold text-primary mb-4">
                        <i class="bi bi-arrow-repeat me-2"></i>Update Status
                    </h5>
                    
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold">Status Pesanan</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Diterima</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">
                            <i class="bi bi-check-circle me-2"></i>Update Status
                        </button>
                    </form>
                    
                    <!-- Quick Actions -->
                    <div class="quick-actions mt-4">
                        <h6 class="fw-bold text-primary mb-3">Aksi Cepat</h6>
                        
                        <div class="d-grid gap-2">
                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $order->customer_phone) }}" 
                               target="_blank" 
                               class="btn btn-success rounded-pill">
                                <i class="bi bi-whatsapp me-2"></i>Hubungi WhatsApp
                            </a>
                            
                            <a href="mailto:{{ $order->customer_email }}" 
                               class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-envelope me-2"></i>Kirim Email
                            </a>
                            
                            <button type="button" 
                                    class="btn btn-outline-info rounded-pill"
                                    onclick="copyOrderNumber()">
                                <i class="bi bi-copy me-2"></i>Copy No. Pesanan
                            </button>
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

/* Order Info Card */
.order-info-card {
    transition: all 0.3s ease;
}

.order-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Status Update Card */
.status-update-card {
    transition: all 0.3s ease;
    position: sticky;
    top: 2rem;
}

.status-update-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Info Sections */
.info-section {
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 1.5rem;
    border: 2px solid #e9ecef;
    height: 100%;
}

.info-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item .label {
    font-weight: 600;
    color: #6c757d;
    min-width: 120px;
}

.info-item .value {
    text-align: right;
    flex: 1;
}

/* Product Card */
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.product-image {
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

/* Price Breakdown */
.price-breakdown {
    background: white;
    border-radius: 0.5rem;
    padding: 1rem;
    border: 1px solid #e9ecef;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Notes Card */
.notes-card {
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.notes-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Quick Actions */
.quick-actions .btn {
    transition: all 0.3s ease;
}

.quick-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .info-item .value {
        text-align: left;
    }
    
    .status-update-card {
        position: static;
        margin-top: 2rem;
    }
}
</style>

<script>
function copyOrderNumber() {
    const orderNumber = '{{ $order->order_number }}';
    navigator.clipboard.writeText(orderNumber).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="bi bi-check me-2"></i>Copied!';
        button.classList.remove('btn-outline-info');
        button.classList.add('btn-success');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-info');
        }, 2000);
    });
}
</script>

@endsection
