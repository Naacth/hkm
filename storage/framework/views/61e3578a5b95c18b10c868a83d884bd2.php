
<?php $__env->startSection('title', 'Kelola Kontak | Admin'); ?>
<?php $__env->startSection('page-title', 'Kelola Kontak'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Kelola Kontak</h2>
        <a href="<?php echo e(route('kontaks.create')); ?>" class="btn btn-primary">Tambah Kontak</a>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <a href="<?php echo e(route('admin-dashboard')); ?>" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Instagram</th>
                        <th>Facebook</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kontaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($kontak->email); ?></td>
                        <td><?php echo e($kontak->phone); ?></td>
                        <td><?php echo e($kontak->address); ?></td>
                        <td><?php echo e($kontak->instagram); ?></td>
                        <td><?php echo e($kontak->facebook); ?></td>
                        <td>
                            <a href="<?php echo e(route('kontaks.edit', $kontak)); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?php echo e(route('kontaks.destroy', $kontak)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/kontaks/index.blade.php ENDPATH**/ ?>