<?php $__env->startSection('title', 'Manajemen Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
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
                                Pembayaran Event (<?php echo e($pendingEventRegistrations->count()); ?>)
                            </h4>
                        </div>
                    </div>

                    <?php if($pendingEventRegistrations->count() > 0): ?>
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
                                    <?php $__currentLoopData = $pendingEventRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td>
                                            <strong><?php echo e($registration->event->title); ?></strong>
                                            <br>
                                            <small class="text-muted"><?php echo e($registration->event->getFormattedDateAttribute()); ?></small>
                                        </td>
                                        <td>
                                            <?php echo e($registration->participant_name ?: $registration->user->name); ?>

                                            <br>
                                            <small class="text-muted"><?php echo e($registration->user->name); ?></small>
                                        </td>
                                        <td><?php echo e($registration->user->email); ?></td>
                                        <td>
                                            <span class="badge bg-success">
                                                <?php echo e($registration->event->getFormattedPriceAttribute()); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($registration->created_at->format('d/m/Y H:i')); ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="approveEventPayment(<?php echo e($registration->id); ?>)">
                                                    <i class="fas fa-check me-1"></i>
                                                    Setujui
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm"
                                                        onclick="rejectPayment('event', <?php echo e($registration->id); ?>)">
                                                    <i class="fas fa-times me-1"></i>
                                                    Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Tidak ada pembayaran event yang menunggu persetujuan.
                        </div>
                    <?php endif; ?>

                    <!-- Product Payments -->
                    <div class="row mb-4 mt-5">
                        <div class="col-12">
                            <h4 class="text-primary">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Pembayaran Produk (<?php echo e($pendingOrders->count()); ?>)
                            </h4>
                        </div>
                    </div>

                    <?php if($pendingOrders->count() > 0): ?>
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
                                    <?php $__currentLoopData = $pendingOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td>
                                            <strong><?php echo e($order->produk->name); ?></strong>
                                            <br>
                                            <small class="text-muted">Qty: <?php echo e($order->quantity); ?></small>
                                        </td>
                                        <td>
                                            <?php echo e($order->customer_name); ?>

                                            <br>
                                            <small class="text-muted"><?php echo e($order->customer_phone); ?></small>
                                        </td>
                                        <td><?php echo e($order->customer_email); ?></td>
                                        <td>
                                            <span class="badge bg-success">
                                                <?php echo e('Rp ' . number_format($order->total_price, 0, ',', '.')); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" 
                                                        class="btn btn-success btn-sm"
                                                        onclick="approveProductPayment(<?php echo e($order->id); ?>)">
                                                    <i class="fas fa-check me-1"></i>
                                                    Setujui
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm"
                                                        onclick="rejectPayment('product', <?php echo e($order->id); ?>)">
                                                    <i class="fas fa-times me-1"></i>
                                                    Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Tidak ada pembayaran produk yang menunggu persetujuan.
                        </div>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>