
<?php $__env->startSection('title', 'Sertifikat Saya | HIMAKOM UYM'); ?>
<?php $__env->startSection('content'); ?>

<!-- Certificates Header -->
<div class="certificates-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-award me-3"></i>Sertifikat Saya
                </h1>
                <p class="lead mb-0">Download sertifikat dari event yang telah Anda ikuti</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?php echo e(route('event-registrations.history')); ?>" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-clock-history me-2"></i>Riwayat Pendaftaran
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="content-section py-5">
    <div class="container">
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if($registrations->count() > 0): ?>
        <!-- Certificates List -->
        <div class="certificates-list">
            <?php $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="certificate-card bg-white rounded-4 shadow-lg mb-4 overflow-hidden">
                <div class="card-header bg-light p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="fw-bold text-primary mb-1"><?php echo e($registration->event->title); ?></h4>
                            <div class="certificate-meta">
                                <span class="badge bg-success fs-6 px-3 py-2 me-2">
                                    <i class="bi bi-check-circle me-1"></i>Sertifikat Tersedia
                                </span>
                                <?php if($registration->certificate_downloaded): ?>
                                <span class="badge bg-info fs-6 px-3 py-2">
                                    <i class="bi bi-download me-1"></i>Sudah Didownload
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="certificate-number">
                                <small class="text-muted">No. Pendaftaran:</small>
                                <p class="fw-bold text-primary mb-0"><?php echo e($registration->registration_number); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Event Info -->
                        <div class="col-lg-6">
                            <div class="event-info">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-calendar-event me-2"></i>Informasi Event
                                </h6>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <i class="bi bi-calendar-date text-primary me-2"></i>
                                        <span class="fw-semibold"><?php echo e($registration->event->getFormattedDateAttribute()); ?></span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <span><?php echo e($registration->event->location); ?></span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-person-check text-primary me-2"></i>
                                        <span class="fw-semibold text-success">Status: Hadir</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Info -->
                        <div class="col-lg-6">
                            <div class="certificate-info">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-award me-2"></i>Informasi Sertifikat
                                </h6>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <i class="bi bi-file-earmark-pdf text-primary me-2"></i>
                                        <span>Format: PDF</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="bi bi-calendar text-primary me-2"></i>
                                        <span>Tersedia sejak: <?php echo e($registration->updated_at->format('d M Y')); ?></span>
                                    </div>
                                    <?php if($registration->certificate_downloaded): ?>
                                    <div class="info-item">
                                        <i class="bi bi-download text-primary me-2"></i>
                                        <span class="text-info">Terakhir didownload: <?php echo e($registration->updated_at->format('d M Y, H:i')); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="certificate-status">
                                <?php if($registration->certificate_downloaded): ?>
                                    <span class="text-success">
                                        <i class="bi bi-check-circle me-1"></i>Sertifikat sudah didownload
                                    </span>
                                <?php else: ?>
                                    <span class="text-primary">
                                        <i class="bi bi-award me-1"></i>Sertifikat siap didownload
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="action-buttons">
                                <a href="<?php echo e(route('events.certificate.download', $registration->id)); ?>" 
                                   class="btn btn-success btn-lg rounded-pill px-4 me-2">
                                    <i class="bi bi-download me-2"></i>Download Sertifikat
                                </a>
                                
                                <a href="<?php echo e(route('event-registrations.show', $registration->id)); ?>" 
                                   class="btn btn-outline-primary btn-lg rounded-pill px-4">
                                    <i class="bi bi-eye me-2"></i>Detail Pendaftaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <!-- Empty State -->
        <div class="empty-state text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-award display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada sertifikat tersedia</h4>
            <p class="text-muted mb-4">Sertifikat akan muncul di sini setelah Anda mengikuti event dan status berubah menjadi "Hadir"</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="<?php echo e(route('event-registrations.history')); ?>" class="btn btn-primary btn-lg rounded-pill">
                    <i class="bi bi-clock-history me-2"></i>Lihat Riwayat Pendaftaran
                </a>
                <a href="<?php echo e(route('event')); ?>" class="btn btn-outline-primary btn-lg rounded-pill">
                    <i class="bi bi-calendar-event me-2"></i>Lihat Event Tersedia
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Certificates Header */
.certificates-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Certificate Card */
.certificate-card {
    transition: all 0.3s ease;
}

.certificate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.certificate-meta .badge {
    transition: all 0.3s ease;
}

.certificate-meta .badge:hover {
    transform: scale(1.05);
}

/* Info Grid */
.info-grid {
    display: grid;
    gap: 0.75rem;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item i {
    width: 20px;
    text-align: center;
}

/* Action Buttons */
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
    .certificates-header {
        text-align: center;
    }
    
    .certificates-header .btn {
        margin-top: 1rem;
    }
    
    .certificate-number {
        text-align: center !important;
        margin-top: 1rem;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/certificates/index.blade.php ENDPATH**/ ?>