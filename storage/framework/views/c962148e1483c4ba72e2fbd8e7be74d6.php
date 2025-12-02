
<?php $__env->startSection('title', 'Kelola Pendaftaran Event | Admin'); ?>
<?php $__env->startSection('page-title', 'Kelola Pendaftaran Event'); ?>
<?php $__env->startSection('content'); ?>

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-calendar-check me-3"></i>Kelola Pendaftaran Event
                </h1>
                <p class="lead mb-0">
                    <?php if($event): ?>
                        Pendaftaran Event: <?php echo e($event->title); ?>

                    <?php else: ?>
                        Kelola semua pendaftaran event HIMAKOM
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?php echo e(route('admin-dashboard')); ?>" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Dashboard
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

        <!-- Filter Section -->
        <div class="filter-section mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-funnel me-2"></i>Filter by Event
                                </div>
                                <a href="<?php echo e(route('admin.event-registrations.export-all-registrations', ['event_id' => request('event_id')])); ?>" class="btn btn-success btn-sm rounded-pill">
                                    <i class="bi bi-file-earmark-excel me-2"></i>Export Excel
                                </a>
                            </h5>
                            <form method="GET" action="<?php echo e(route('admin.event-registrations.index')); ?>">
                                <div class="row g-2">
                                    <div class="col-md-8">
                                        <select name="event_id" class="form-select">
                                            <option value="">Semua Event</option>
                                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($e->id); ?>" <?php echo e(request('event_id') == $e->id ? 'selected' : ''); ?>>
                                                    <?php echo e($e->title); ?> (<?php echo e($e->getFormattedDateAttribute()); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-search me-1"></i>Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if($event): ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-calendar-event me-2"></i>Event Terpilih
                            </h5>
                            <div class="event-info">
                                <h6 class="fw-bold text-primary mb-1"><?php echo e($event->title); ?></h6>
                                <p class="text-muted small mb-2"><?php echo e($event->getFormattedDateAttribute()); ?> - <?php echo e($event->location); ?></p>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-info"><?php echo e($registrations->count()); ?> Peserta</span>
                                    <span class="badge bg-success"><?php echo e($event->getFormattedPriceAttribute()); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-people text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2"><?php echo e($registrations->count()); ?></h3>
                    <p class="text-muted mb-0">Total Pendaftaran</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-clock text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold text-warning mb-2"><?php echo e($registrations->where('status', 'registered')->count()); ?></h3>
                    <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-check-circle text-success display-4 mb-3"></i>
                    <h3 class="fw-bold text-success mb-2"><?php echo e($registrations->whereIn('status', ['confirmed', 'paid', 'attended'])->count()); ?></h3>
                    <p class="text-muted mb-0">Dikonfirmasi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-currency-dollar text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold text-warning mb-2"><?php echo e($registrations->where('status', 'paid')->count()); ?></h3>
                    <p class="text-muted mb-0">Sudah Bayar</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-lg">
                    <i class="bi bi-award text-info display-4 mb-3"></i>
                    <h3 class="fw-bold text-info mb-2"><?php echo e($registrations->where('status', 'attended')->count()); ?></h3>
                    <p class="text-muted mb-0">Sudah Hadir</p>
                </div>
            </div>
        </div>

        <!-- Registrations Table -->
        <?php if($registrations->count() > 0): ?>
        <div class="registrations-table-card bg-white rounded-4 shadow-lg overflow-hidden">
            <div class="table-header bg-light p-4">
                <h4 class="fw-bold text-primary mb-0">
                    <i class="bi bi-list-ul me-2"></i>Daftar Pendaftaran
                </h4>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary text-white">
                        <tr>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-hash me-2"></i>No
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-receipt me-2"></i>No. Pendaftaran
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-person me-2"></i>Peserta
                            </th>
                            <?php if(!$event): ?>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-calendar-event me-2"></i>Event
                            </th>
                            <?php endif; ?>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-flag me-2"></i>Status
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-currency-dollar me-2"></i>Pembayaran
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-calendar me-2"></i>Tanggal Daftar
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="registration-row">
                            <td class="px-4 py-3 fw-bold"><?php echo e($loop->iteration); ?></td>
                            <td class="px-4 py-3">
                                <span class="fw-bold text-primary"><?php echo e($registration->registration_number); ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="participant-info">
                                    <h6 class="fw-bold text-dark mb-1"><?php echo e($registration->participant_name); ?></h6>
                                    <p class="text-muted small mb-0"><?php echo e($registration->participant_email); ?></p>
                                    <p class="text-muted small mb-0"><?php echo e($registration->participant_phone); ?></p>
                                </div>
                            </td>
                            <?php if(!$event): ?>
                            <td class="px-4 py-3">
                                <div class="event-info">
                                    <h6 class="fw-bold text-primary mb-1"><?php echo e($registration->event->title); ?></h6>
                                    <p class="text-muted small mb-0"><?php echo e($registration->event->getFormattedDateAttribute()); ?></p>
                                    <p class="text-muted small mb-0"><?php echo e($registration->event->location); ?></p>
                                </div>
                            </td>
                            <?php endif; ?>
                            <td class="px-4 py-3">
                                <span class="badge <?php echo e($registration->getEffectiveStatusBadgeClass()); ?> fs-6 px-3 py-2">
                                    <?php echo e($registration->getEffectiveStatusLabel()); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <?php if($registration->event->is_paid): ?>
                                    <span class="badge <?php echo e($registration->getPaymentStatusBadgeClass()); ?> fs-6 px-3 py-2">
                                        <?php echo e($registration->getPaymentStatusLabel()); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success fs-6 px-3 py-2">Gratis</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-muted small">
                                    <?php echo e($registration->created_at->format('d M Y')); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('admin.event-registrations.show', $registration->id)); ?>" 
                                       class="btn btn-sm btn-outline-primary rounded-pill me-2">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                    
                                    <!-- Status Update Dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="bi bi-gear me-1"></i>Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="<?php echo e(route('admin.event-registrations.update-status', $registration->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="registered">
                                                    <button type="submit" class="dropdown-item <?php echo e($registration->status === 'registered' ? 'active' : ''); ?>">
                                                        <i class="bi bi-clock me-2"></i>Terdaftar
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.event-registrations.update-status', $registration->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="dropdown-item <?php echo e($registration->status === 'confirmed' ? 'active' : ''); ?>">
                                                        <i class="bi bi-check-circle me-2"></i>Dikonfirmasi
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.event-registrations.update-status', $registration->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="paid">
                                                    <button type="submit" class="dropdown-item <?php echo e($registration->getEffectiveStatus() === 'paid' ? 'active' : ''); ?>">
                                                        <i class="bi bi-currency-dollar me-2"></i>Sudah Bayar
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="<?php echo e(route('admin.event-registrations.update-status', $registration->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="attended">
                                                    <button type="submit" class="dropdown-item <?php echo e($registration->status === 'attended' ? 'active' : ''); ?>">
                                                        <i class="bi bi-person-check me-2"></i>Hadir
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="<?php echo e(route('admin.event-registrations.update-status', $registration->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item text-danger <?php echo e($registration->status === 'cancelled' ? 'active' : ''); ?>">
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
                <i class="bi bi-calendar-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada pendaftaran event</h4>
            <p class="text-muted">Pendaftaran event akan muncul di sini setelah ada yang mendaftar.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Filter Section */
.filter-section .card {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.filter-section .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.event-info .badge {
    transition: all 0.3s ease;
}

.event-info .badge:hover {
    transform: scale(1.05);
}

/* Statistics Cards */
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Table Styles */
.registrations-table-card {
    transition: all 0.3s ease;
}

.registrations-table-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.registration-row {
    transition: all 0.3s ease;
}

.registration-row:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Empty State */
.empty-state {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 1rem;
    margin: 2rem 0;
}

.empty-icon {
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .admin-header .btn {
        margin-top: 1rem;
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/event-registrations/index.blade.php ENDPATH**/ ?>