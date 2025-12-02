
<?php $__env->startSection('title', 'Peserta Event | Admin'); ?>
<?php $__env->startSection('page-title', 'Peserta Event'); ?>
<?php $__env->startSection('content'); ?>

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-people me-3"></i>Peserta Event
                </h1>
                <p class="lead mb-0"><?php echo e($event->title); ?></p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex gap-2 justify-content-md-end">
                    <a href="<?php echo e(route('admin.event-registrations.index')); ?>" class="btn btn-light btn-lg rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Semua Event
                    </a>
                    <a href="<?php echo e(route('admin-dashboard')); ?>" class="btn btn-outline-light btn-lg rounded-pill">
                        <i class="bi bi-house me-2"></i>Dashboard
                    </a>
                </div>
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
                            <?php if($event->image): ?>
                                <img src="<?php echo e(asset('uploads/' . $event->image)); ?>" 
                                     alt="<?php echo e($event->title); ?>" 
                                     class="img-fluid rounded-3"
                                     style="width: 100%; height: 120px; object-fit: cover;"
                                     onerror="this.src='https://via.placeholder.com/300x120/1976d2/ffffff?text=Event+HIMAKOM'">
                            <?php else: ?>
                                <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" 
                                     style="width: 100%; height: 120px;">
                                    <i class="bi bi-calendar-event" style="font-size: 2rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <h3 class="fw-bold text-primary mb-2"><?php echo e($event->title); ?></h3>
                            <div class="event-details">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-date text-primary me-2"></i>
                                            <span class="fw-semibold"><?php echo e($event->getFormattedDateAttribute()); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt text-primary me-2"></i>
                                            <span class="fw-semibold"><?php echo e($event->location); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-currency-dollar text-primary me-2"></i>
                                            <span class="fw-semibold"><?php echo e($event->getFormattedPriceAttribute()); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people text-primary me-2"></i>
                                            <span class="fw-semibold"><?php echo e($registrations->count()); ?> Peserta</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-card bg-white rounded-4 shadow-lg p-4">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="bi bi-graph-up me-2"></i>Statistik Peserta
                    </h5>
                    <div class="stats-grid">
                        <div class="stat-item text-center">
                            <div class="stat-number text-warning fw-bold fs-4"><?php echo e($registrations->where('status', 'registered')->count()); ?></div>
                            <div class="stat-label text-muted small">Menunggu</div>
                        </div>
                        <div class="stat-item text-center">
                            <div class="stat-number text-info fw-bold fs-4"><?php echo e($registrations->whereIn('status', ['confirmed', 'paid'])->count()); ?></div>
                            <div class="stat-label text-muted small">Dikonfirmasi</div>
                        </div>
                        <div class="stat-item text-center">
                            <div class="stat-number text-success fw-bold fs-4"><?php echo e($registrations->where('status', 'attended')->count()); ?></div>
                            <div class="stat-label text-muted small">Hadir</div>
                        </div>
                        <div class="stat-item text-center">
                            <div class="stat-number text-danger fw-bold fs-4"><?php echo e($registrations->where('status', 'cancelled')->count()); ?></div>
                            <div class="stat-label text-muted small">Dibatalkan</div>
                        </div>
                    </div>
                </div>
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

        <?php if($registrations->count() > 0): ?>
        <!-- Participants Table -->
        <div class="participants-table-card bg-white rounded-4 shadow-lg overflow-hidden">
            <div class="table-header bg-light p-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-primary mb-0">
                    <i class="bi bi-list-ul me-2"></i>Daftar Peserta
                    <span class="badge bg-primary ms-2"><?php echo e($registrations->count()); ?></span>
                </h4>
                <div>
                    <a href="<?php echo e(route('admin.event-registrations.export-participants', $event->id)); ?>" class="btn btn-success btn-sm rounded-pill">
                        <i class="bi bi-file-earmark-excel me-2"></i>Export ke Excel
                    </a>
                </div>
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
                        <tr class="participant-row">
                            <td class="px-4 py-3 fw-bold"><?php echo e($loop->iteration); ?></td>
                            <td class="px-4 py-3">
                                <span class="fw-bold text-primary"><?php echo e($registration->registration_number); ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="participant-info">
                                    <h6 class="fw-bold text-dark mb-1"><?php echo e($registration->participant_name); ?></h6>
                                    <p class="text-muted small mb-0"><?php echo e($registration->participant_email); ?></p>
                                    <p class="text-muted small mb-0"><?php echo e($registration->participant_phone); ?></p>
                                    <?php if($registration->participant_nim): ?>
                                        <p class="text-muted small mb-0">NIM: <?php echo e($registration->participant_nim); ?></p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge <?php echo e($registration->getEffectiveStatusBadgeClass()); ?> fs-6 px-3 py-2">
                                    <?php echo e($registration->getEffectiveStatusLabel()); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <?php if($event->is_paid): ?>
                                    <span class="badge <?php echo e($registration->getPaymentStatusBadgeClass()); ?> fs-6 px-3 py-2">
                                        <?php echo e($registration->getPaymentStatusLabel()); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success fs-6 px-3 py-2">Gratis</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-muted small">
                                    <?php echo e($registration->created_at->format('d M Y, H:i')); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="action-buttons d-flex align-items-center">
                                    <a href="<?php echo e(route('admin.event-registrations.show', $registration->id)); ?>" 
                                       class="btn btn-sm btn-outline-primary rounded-pill me-2"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <!-- Status Update Dropdown -->
                                    <div class="btn-group me-2">
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

                                    <!-- Manual Upload Button -->
                                    <button type="button" class="btn btn-sm <?php echo e($registration->certificate_path ? 'btn-info text-white' : 'btn-outline-secondary'); ?> rounded-pill" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#uploadCertificateModal<?php echo e($registration->id); ?>"
                                            title="<?php echo e($registration->certificate_path ? 'Ganti Sertifikat' : 'Upload Sertifikat'); ?>">
                                        <i class="bi bi-upload"></i>
                                    </button>
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
                <i class="bi bi-people-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada peserta untuk event ini</h4>
            <p class="text-muted">Peserta akan muncul di sini setelah ada yang mendaftar.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Upload Certificate Modals -->
<?php $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="uploadCertificateModal<?php echo e($registration->id); ?>" tabindex="-1" aria-labelledby="uploadCertificateModalLabel<?php echo e($registration->id); ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold" id="uploadCertificateModalLabel<?php echo e($registration->id); ?>">
                    <i class="bi bi-cloud-upload me-2"></i>Upload Sertifikat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.event-registrations.upload-certificate', $registration->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="avatar-initial rounded-circle bg-light text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; font-size: 24px;">
                            <i class="bi bi-file-earmark-person"></i>
                        </div>
                        <h5 class="fw-bold mb-1"><?php echo e($registration->participant_name); ?></h5>
                        <p class="text-muted small mb-0"><?php echo e($registration->registration_number); ?></p>
                    </div>

                    <?php if($registration->certificate_path): ?>
                        <div class="alert alert-success d-flex align-items-center p-3 mb-4 rounded-3 border-0">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold">Sertifikat Tersedia</div>
                                <div class="small">Mengupload file baru akan menggantikan sertifikat yang sudah ada.</div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info d-flex align-items-center p-3 mb-4 rounded-3 border-0">
                            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold">Belum Ada Sertifikat</div>
                                <div class="small">Silakan upload file sertifikat untuk peserta ini.</div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="certFile<?php echo e($registration->id); ?>" class="form-label fw-semibold">Pilih File Sertifikat</label>
                        <input type="file" name="certificate_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required id="certFile<?php echo e($registration->id); ?>">
                        <div class="form-text mt-2">
                            <i class="bi bi-exclamation-circle me-1"></i>Format: PDF, JPG, PNG (Max: 5MB)
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-upload me-2"></i>Upload Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<style>
/* Admin Header */
.admin-header {
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

/* Stats Card */
.stats-card {
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.stat-item {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.stat-item:hover {
    background: #e9ecef;
    transform: scale(1.05);
}

/* Table Styles */
.participants-table-card {
    transition: all 0.3s ease;
}

.participants-table-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.participant-row {
    transition: all 0.3s ease;
}

.participant-row:hover {
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
    
    .admin-header .d-flex {
        justify-content: center !important;
        margin-top: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/events/participants.blade.php ENDPATH**/ ?>