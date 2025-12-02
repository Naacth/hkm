
<?php $__env->startSection('title', 'Login | HIMAKOM UYM'); ?>
<?php $__env->startSection('content'); ?>

<div class="auth-section py-5" style="background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card bg-white rounded-4 shadow-lg p-5">
                    <div class="text-center mb-4">
                        <div class="auth-icon mb-3">
                            <i class="bi bi-person-circle text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="fw-bold text-primary mb-2">Login</h2>
                        <p class="text-muted">Masuk ke akun HIMAKOM Anda</p>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope text-primary me-2"></i>Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('email')); ?>"
                                   placeholder="Masukkan email Anda"
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock text-primary me-2"></i>Password
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="Masukkan password Anda"
                                   required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>

                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Belum punya akun? 
                                <a href="<?php echo e(route('register')); ?>" class="text-primary fw-semibold text-decoration-none">
                                    Daftar di sini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-card {
    transition: all 0.3s ease;
}

.auth-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.auth-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin: 0 auto;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
}

.form-control-lg {
    font-size: 1rem;
}

.form-check-input:checked {
    background-color: #1976d2;
    border-color: #1976d2;
}

.form-check-input:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/auth/login.blade.php ENDPATH**/ ?>