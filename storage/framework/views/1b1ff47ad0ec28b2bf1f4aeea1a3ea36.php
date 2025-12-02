
<?php $__env->startSection('title', 'Kelola About | Admin'); ?>
<?php $__env->startSection('page-title', 'Kelola About'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Kelola About</h2>
        <a href="<?php echo e(route('abouts.create')); ?>" class="btn btn-primary">Tambah About</a>
    </div>
    <a href="<?php echo e(route('admin-dashboard')); ?>" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($about->title); ?></td>
                        <td><?php echo e(Str::limit($about->description, 50)); ?></td>
                        <td>
                            <?php if($about->image): ?>
                                <img src="<?php echo e(asset('uploads/'.$about->image)); ?>" width="60" class="rounded shadow">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('abouts.edit', $about)); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?php echo e(route('abouts.destroy', $about)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/abouts/index.blade.php ENDPATH**/ ?>