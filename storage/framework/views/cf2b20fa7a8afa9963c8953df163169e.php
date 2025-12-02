
<?php $__env->startSection('title', 'Admin Login | HIMAKOM UYM'); ?>
<?php $__env->startSection('page-title', 'Admin Login'); ?>
<?php $__env->startSection('content'); ?>

<div class="auth-section d-flex align-items-center justify-content-center">
    <div class="auth-card bg-white rounded-4 shadow-lg p-5">
        
        <div class="text-center mb-4">
            <div class="auth-icon mb-3">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h3 class="fw-bold text-primary mb-1">Admin Login</h3>
            <p class="text-muted mb-0">Masuk ke panel admin HIMAKOM</p>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.login')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username"
                    class="form-control form-control-lg"
                    placeholder="Username" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                    class="form-control form-control-lg"
                    placeholder="Password" required>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">
                Login Admin
            </button>
        </form>

    </div>
</div>

<style>
.auth-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #1976d2, #3F3F9C);
}

.auth-card {
    width: 100%;
    max-width: 420px;
}

.auth-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #1976d2, #3F3F9C);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
    margin: auto;
}

.form-control {
    border-radius: 12px;
    padding: 12px;
}

.btn {
    transition: 0.3s;
}

.btn:hover {
    transform: translateY(-2px);
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>