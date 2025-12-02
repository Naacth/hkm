@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-credit-card me-2"></i>
                        Manajemen Pembayaran QRIS
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Event Payments -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="text-primary">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Pembayaran Event ({{ $pendingEventRegistrations->count() }})
                            </h4>
                        </div>
                    </div>

                    @if($pendingEventRegistrations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Event</th>
                                        <th>Peserta</th>
                                        <th>Email</th>
                                        <th>Harga</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingEventRegistrations as $index => $registration)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $registration->event->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $registration->event->getFormattedDateAttribute() }}</small>
                                        </td>
                                        <td>
                                            {{ $registration->participant_name ?: $registration->user->name }}
                                            <br>
                                            <small class="text-muted">{{ $registration->user->name }}</small>
                                        </td>
                                        <td>{{ $registration->user->email }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ $registration->event->getFormattedPriceAttribute() }}
                                            </span>
                                        </td>
                                        <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="approveEventPayment({{ $registration->id }})">
                                                    <i class="fas fa-check me-1"></i>
                                                    Setujui
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm"
                                                        onclick="rejectPayment('event', {{ $registration->id }})">
                                                    <i class="fas fa-times me-1"></i>
                                                    Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Tidak ada pembayaran event yang menunggu persetujuan.
                        </div>
                    @endif

                    <!-- Product Payments -->
                    <div class="row mb-4 mt-5">
                        <div class="col-12">
                            <h4 class="text-primary">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Pembayaran Produk ({{ $pendingOrders->count() }})
                            </h4>
                        </div>
                    </div>

                    @if($pendingOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Pembeli</th>
                                        <th>Email</th>
                                        <th>Total</th>
                                        <th>Tanggal Order</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingOrders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $order->produk->name }}</strong>
                                            <br>
                                            <small class="text-muted">Qty: {{ $order->quantity }}</small>
                                        </td>
                                        <td>
                                            {{ $order->customer_name }}
                                            <br>
                                            <small class="text-muted">{{ $order->customer_phone }}</small>
                                        </td>
                                        <td>{{ $order->customer_email }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ 'Rp ' . number_format($order->total_price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="approveProductPayment({{ $order->id }})">
                                                    <i class="fas fa-check me-1"></i>
                                                    Setujui
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm"
                                                        onclick="rejectPayment('product', {{ $order->id }})">
                                                    <i class="fas fa-times me-1"></i>
                                                    Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Tidak ada pembayaran produk yang menunggu persetujuan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memproses...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function showLoading() {
    $('#loadingModal').modal('show');
}

function hideLoading() {
    $('#loadingModal').modal('hide');
}

function approveEventPayment(registrationId) {
    if (confirm('Apakah Anda yakin ingin menyetujui pembayaran event ini?')) {
        showLoading();
        
        $.ajax({
            url: `/admin/payments/event/${registrationId}/approve`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    alert('Pembayaran berhasil disetujui!');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                const response = xhr.responseJSON;
                alert('Error: ' + (response?.message || 'Terjadi kesalahan'));
            }
        });
    }
}

function approveProductPayment(orderId) {
    if (confirm('Apakah Anda yakin ingin menyetujui pembayaran produk ini?')) {
        showLoading();
        
        $.ajax({
            url: `/admin/payments/product/${orderId}/approve`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    alert('Pembayaran berhasil disetujui!');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                const response = xhr.responseJSON;
                alert('Error: ' + (response?.message || 'Terjadi kesalahan'));
            }
        });
    }
}

function rejectPayment(type, id) {
    if (confirm('Apakah Anda yakin ingin menolak pembayaran ini?')) {
        showLoading();
        
        $.ajax({
            url: `/admin/payments/${type}/${id}/reject`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                hideLoading();
                if (response.success) {
                    alert('Pembayaran berhasil ditolak!');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                hideLoading();
                const response = xhr.responseJSON;
                alert('Error: ' + (response?.message || 'Terjadi kesalahan'));
            }
        });
    }
}
</script>
@endsection
