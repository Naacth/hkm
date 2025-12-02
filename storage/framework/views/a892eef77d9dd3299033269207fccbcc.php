<?php $__env->startSection('title', 'Kelola Pesanan | Admin'); ?>
<?php $__env->startSection('page-title', 'Kelola Pesanan'); ?>
<?php $__env->startSection('content'); ?>

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-cart-check me-3"></i>Kelola Pesanan
                </h1>
                <p class="lead mb-0">Kelola semua pesanan dari pelanggan HIMAKOM</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?php echo e(route('admin-dashboard')); ?>" class="btn btn-light btn-lg rounded-pill">
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
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Quick Stats -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-list-ul text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2"><?php echo e($orders->count()); ?></h3>
                    <p class="text-muted mb-0">Total Pesanan</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-clock text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold text-warning mb-2"><?php echo e($orders->where('status', 'pending')->count()); ?></h3>
                    <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-check-circle text-success display-4 mb-3"></i>
                    <h3 class="fw-bold text-success mb-2"><?php echo e($orders->whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->count()); ?></h3>
                    <p class="text-muted mb-0">Dikonfirmasi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-currency-dollar text-info display-4 mb-3"></i>
                    <h3 class="fw-bold text-info mb-2">Rp <?php echo e(number_format($orders->whereNotIn('status', ['cancelled'])->sum(function($o){ return (float)($o->final_price ?? $o->total_price); }), 0, ',', '.')); ?></h3>
                    <p class="text-muted mb-0">Total Pendapatan</p>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <?php if($orders->count() > 0): ?>
        <div class="orders-table-card bg-white rounded-4 shadow-lg overflow-hidden">
            <div class="table-header bg-light p-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-primary mb-0">
                    <i class="bi bi-list-ul me-2"></i>Daftar Pesanan
                </h4>
                <a href="<?php echo e(route('admin.orders.export-orders')); ?>" class="btn btn-success btn-sm rounded-pill">
                    <i class="bi bi-file-earmark-excel me-2"></i>Export ke Excel
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary text-white">
                        <tr>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-hash me-2"></i>No
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-receipt me-2"></i>No. Pesanan
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-person me-2"></i>Pelanggan
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-box-seam me-2"></i>Produk
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-currency-dollar me-2"></i>Total
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-flag me-2"></i>Status
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-calendar me-2"></i>Tanggal
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="order-row">
                            <td class="px-4 py-3 fw-bold"><?php echo e($loop->iteration); ?></td>
                            <td class="px-4 py-3">
                                <span class="fw-bold text-primary"><?php echo e($order->order_number); ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="customer-info">
                                    <h6 class="fw-bold text-dark mb-1"><?php echo e($order->customer_name); ?></h6>
                                    <p class="text-muted small mb-0"><?php echo e($order->customer_email); ?></p>
                                    <p class="text-muted small mb-0"><?php echo e($order->customer_phone); ?></p>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="product-info">
                                    <h6 class="fw-bold text-primary mb-1"><?php echo e($order->produk->name); ?></h6>
                                    <p class="text-muted small mb-0">Qty: <?php echo e($order->quantity); ?></p>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="fw-bold text-success">
                                    <?php if($order->total_price > 0): ?>
                                        Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                                    <?php else: ?>
                                        <span class="text-primary">Gratis</span>
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge <?php echo e($order->getStatusBadgeClass()); ?> fs-6 px-3 py-2">
                                    <?php echo e($order->getStatusLabel()); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-muted small">
                                    <?php echo e($order->created_at->format('d M Y')); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" 
                                       class="btn btn-info btn-sm rounded-pill me-2"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <!-- Status Update Dropdown -->
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-warning btn-sm rounded-pill dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown"
                                                title="Update Status">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="dropdown-item <?php echo e($order->status == 'pending' ? 'active' : ''); ?>">
                                                        <i class="bi bi-clock me-2"></i>Menunggu Konfirmasi
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="dropdown-item <?php echo e($order->status == 'confirmed' ? 'active' : ''); ?>">
                                                        <i class="bi bi-check-circle me-2"></i>Dikonfirmasi
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="processing">
                                                    <button type="submit" class="dropdown-item <?php echo e($order->status == 'processing' ? 'active' : ''); ?>">
                                                        <i class="bi bi-gear me-2"></i>Diproses
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="shipped">
                                                    <button type="submit" class="dropdown-item <?php echo e($order->status == 'shipped' ? 'active' : ''); ?>">
                                                        <i class="bi bi-truck me-2"></i>Dikirim
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="delivered">
                                                    <button type="submit" class="dropdown-item <?php echo e($order->status == 'delivered' ? 'active' : ''); ?>">
                                                        <i class="bi bi-check-circle-fill me-2"></i>Diterima
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item text-danger <?php echo e($order->status == 'cancelled' ? 'active' : ''); ?>">
                                                        <i class="bi bi-x-circle me-2"></i>Dibatalkan
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
        <!-- Empty State -->
        <div class="empty-state text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-cart-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada pesanan</h4>
            <p class="text-muted">Pesanan pelanggan akan muncul di sini setelah ada yang memesan.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Stat Cards */
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

/* Orders Table Card */
.orders-table-card {
    transition: all 0.3s ease;
}

.orders-table-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Order Row */
.order-row {
    transition: all 0.3s ease;
}

.order-row:hover {
    background: rgba(25, 118, 210, 0.05) !important;
    transform: translateX(5px);
}

/* Table Header */
.table-primary {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%) !important;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

/* Action Buttons */
.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Dropdown */
.dropdown-menu {
    border-radius: 0.75rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    border: 1px solid rgba(0,0,0,0.1);
}

.dropdown-item {
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.dropdown-item:hover {
    background: rgba(25, 118, 210, 0.1);
    color: #1976d2;
}

.dropdown-item.active {
    background: rgba(25, 118, 210, 0.2);
    color: #1976d2;
}

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 1rem;
    border: 2px dashed #dee2e6;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .order-row:hover {
        transform: none;
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>