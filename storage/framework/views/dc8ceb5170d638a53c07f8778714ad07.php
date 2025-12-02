<?php $__env->startSection('title', 'Tambah Event | Admin'); ?>
<?php $__env->startSection('page-title', 'Tambah Event'); ?>
<?php $__env->startSection('content'); ?>

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-calendar-plus me-3"></i>Tambah Event Baru
                </h1>
                <p class="lead mb-0">Buat event baru untuk kegiatan HIMAKOM</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?php echo e(route('events.index')); ?>" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card bg-white rounded-4 shadow-lg p-5">
                    <div class="form-header text-center mb-4">
                        <div class="form-icon mb-3">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">Form Tambah Event</h3>
                        <p class="text-muted">Isi informasi lengkap event yang akan ditambahkan</p>
                    </div>

                    <form action="<?php echo e(route('events.store')); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <?php echo csrf_field(); ?>
                        
                        <!-- Event Title -->
                        <div class="form-group mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="bi bi-calendar-event text-primary me-2"></i>Judul Event
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   class="form-control form-control-lg <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="Masukkan judul event"
                                   value="<?php echo e(old('title')); ?>"
                                   required>
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Event Date -->
                        <div class="form-group mb-4">
                            <label for="date" class="form-label fw-semibold">
                                <i class="bi bi-calendar-date text-primary me-2"></i>Tanggal Event
                            </label>
                            <input type="date" 
                                   name="date" 
                                   id="date"
                                   class="form-control form-control-lg <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('date')); ?>"
                                   required>
                            <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Google Form Link -->
                        <div class="form-group mb-4">
                            <label for="google_form_link" class="form-label fw-semibold">
                                <i class="bi bi-link-45deg text-success me-2"></i>Link Google Form Pendaftaran
                                <span class="text-muted small">(Opsional, contoh: https://forms.gle/xxxx)</span>
                            </label>
                            <input type="url" 
                                   name="google_form_link" 
                                   id="google_form_link"
                                   class="form-control form-control-lg"
                                   placeholder="Masukkan link Google Form untuk pendaftaran event"
                                   value="<?php echo e(old('google_form_link')); ?>">
                        </div>

                        <!-- Event Location -->
                        <div class="form-group mb-4">
                            <label for="location" class="form-label fw-semibold">
                                <i class="bi bi-geo-alt text-primary me-2"></i>Lokasi Event
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="location" 
                                   id="location"
                                   class="form-control form-control-lg <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="Contoh: Aula Kampus, Ruang Lab, Auditorium"
                                   value="<?php echo e(old('location')); ?>">
                            <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Event Payment Type -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-currency-dollar text-primary me-2"></i>Tipe Event
                            </label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="event_type" 
                                               id="event_free" 
                                               value="free"
                                               <?php echo e(old('event_type', 'free') == 'free' ? 'checked' : ''); ?>

                                               onchange="toggleEventTypeFields()"
                                               required>
                                        <label class="form-check-label" for="event_free">
                                            <i class="bi bi-gift me-2"></i>Gratis
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="event_type" 
                                               id="event_paid" 
                                               value="paid"
                                               <?php echo e(old('event_type') == 'paid' ? 'checked' : ''); ?>

                                               onchange="toggleEventTypeFields()"
                                               required>
                                        <label class="form-check-label" for="event_paid">
                                            <i class="bi bi-currency-dollar me-2"></i>Berbayar
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="event_type" 
                                               id="event_public" 
                                               value="public"
                                               <?php echo e(old('event_type') == 'public' ? 'checked' : ''); ?>

                                               onchange="toggleEventTypeFields()"
                                               required>
                                        <label class="form-check-label" for="event_public">
                                            <i class="bi bi-globe me-2"></i>Publik
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php $__errorArgs = ['event_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-text mt-2">
                                <strong>Gratis:</strong> Event gratis dengan pendaftaran internal<br>
                                <strong>Berbayar:</strong> Event berbayar dengan sistem pembayaran<br>
                                <strong>Publik:</strong> Event publik, pendaftaran via Google Form (tanpa sistem internal)
                            </div>
                        </div>

                        <!-- Event Price (only show if paid) -->
                        <div class="form-group mb-4" id="priceField" style="display: none;">
                            <label for="price" class="form-label fw-semibold">
                                <i class="bi bi-tag text-primary me-2"></i>Harga Event
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       class="form-control form-control-lg <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       placeholder="Masukkan harga event"
                                       value="<?php echo e(old('price')); ?>"
                                       min="0"
                                       step="1000">
                            </div>
                            <div class="form-text">
                                Masukkan harga dalam rupiah (contoh: 50000 untuk Rp 50.000)
                            </div>
                            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- QRIS Image -->
                        <div class="form-group mb-4" id="qrisField" style="display: none;">
                            <label for="qris_image_path" class="form-label fw-semibold">
                                <i class="bi bi-qr-code text-success me-2"></i>Gambar QRIS
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="file" 
                                   name="qris_image_path" 
                                   id="qris_image_path"
                                   class="form-control form-control-lg <?php $__errorArgs = ['qris_image_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   accept="image/*"
                                   onchange="previewQrisImage(this)">
                            <div class="form-text">
                                Upload gambar QRIS untuk pembayaran. Format yang didukung: JPG, PNG
                            </div>
                            <?php $__errorArgs = ['qris_image_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="image-preview mt-3" id="qrisImagePreview" style="display: none;">
                                <img id="previewQrisImg" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                            </div>
                        </div>

                        <!-- Event Image -->
                        <div class="form-group mb-4">
                            <label for="image" class="form-label fw-semibold">
                                <i class="bi bi-image text-primary me-2"></i>Gambar Event
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="image-upload-container">
                                <input type="file" 
                                       name="image" 
                                       id="image"
                                       class="form-control form-control-lg <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <div class="image-preview mt-3" id="imagePreview" style="display: none;">
                                    <img id="previewImg" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Event Description -->
                        <div class="form-group mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="bi bi-text-paragraph text-primary me-2"></i>Deskripsi Event
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="5"
                                      placeholder="Jelaskan detail event, tujuan, dan informasi penting lainnya..."
                                      required><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Certificate Template -->
                        <div class="form-group mb-4">
                            <label for="certificate_template" class="form-label fw-semibold">
                                <i class="bi bi-award text-primary me-2"></i>Template Sertifikat
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="file" 
                                   name="certificate_template" 
                                   id="certificate_template"
                                   class="form-control form-control-lg <?php $__errorArgs = ['certificate_template'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   accept="image/*,.pdf">
                            <div class="form-text">
                                Upload template sertifikat untuk event ini. Format yang didukung: JPG, PNG, PDF
                            </div>
                            <?php $__errorArgs = ['certificate_template'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Certificate Settings -->
                        <div class="form-group mb-4" id="certificateSettings" style="display: none;">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-gear text-primary me-2"></i>Konfigurasi Sertifikat
                            </label>
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="cert_x" class="form-label small">Posisi X (Horizontal)</label>
                                            <input type="number" name="cert_x" id="cert_x" class="form-control" placeholder="Default: Center" value="<?php echo e(old('cert_x')); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cert_y" class="form-label small">Posisi Y (Vertikal)</label>
                                            <input type="number" name="cert_y" id="cert_y" class="form-control" placeholder="Default: Center" value="<?php echo e(old('cert_y')); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cert_font_size" class="form-label small">Ukuran Font</label>
                                            <input type="number" name="cert_font_size" id="cert_font_size" class="form-control" placeholder="Default: 60" value="<?php echo e(old('cert_font_size')); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cert_color" class="form-label small">Warna Teks</label>
                                            <input type="color" name="cert_color" id="cert_color" class="form-control form-control-color w-100" value="<?php echo e(old('cert_color', '#000000')); ?>" title="Pilih warna teks">
                                        </div>
                                    </div>
                                    <div class="form-text mt-2">
                                        Atur posisi dan gaya teks nama peserta pada sertifikat. Biarkan kosong untuk menggunakan default.
                                    </div>
                                </div>
                            </div>

                        <!-- WhatsApp Group Link -->
                        <div class="form-group mb-4">
                            <label for="whatsapp_group_link" class="form-label fw-semibold">
                                <i class="bi bi-whatsapp text-success me-2"></i>Link Grup WhatsApp
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="url" 
                                   name="whatsapp_group_link" 
                                   id="whatsapp_group_link"
                                   class="form-control form-control-lg <?php $__errorArgs = ['whatsapp_group_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="https://chat.whatsapp.com/..."
                                   value="<?php echo e(old('whatsapp_group_link')); ?>">
                            <div class="form-text">
                                Link grup WhatsApp untuk peserta event. Peserta dapat bergabung untuk mendapatkan informasi terkini.
                            </div>
                            <?php $__errorArgs = ['whatsapp_group_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- SEO Fields -->
                        <hr class="my-4">
                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-search me-2"></i>Google SEO</h5>
                        <div class="form-group mb-3">
                            <label for="seo_title" class="form-label fw-semibold">SEO Title</label>
                            <input type="text" name="seo_title" id="seo_title" class="form-control form-control-lg" placeholder="Judul SEO (opsional)" value="<?php echo e(old('seo_title')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_description" class="form-label fw-semibold">Meta Description</label>
                            <textarea name="seo_description" id="seo_description" class="form-control" rows="3" placeholder="Deskripsi singkat untuk meta description (opsional)"><?php echo e(old('seo_description')); ?></textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label for="seo_jsonld" class="form-label fw-semibold">JSON-LD (Structured Data)</label>
                            <textarea name="seo_jsonld" id="seo_jsonld" class="form-control" rows="5" placeholder='Tempelkan JSON-LD valid, mis: {"&#64;context":"https://schema.org", ...} (opsional)'><?php echo e(old('seo_jsonld')); ?></textarea>
                            <div class="form-text">Jika diisi, script JSON-LD akan ditampilkan di halaman publik.</div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                <i class="bi bi-check-circle me-2"></i>Simpan Event
                            </button>
                            <a href="<?php echo e(route('events.index')); ?>" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Tips Section -->
<div class="tips-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="tip-card bg-white rounded-4 p-4 shadow-sm">
                    <div class="tip-icon mb-3">
                        <i class="bi bi-lightbulb text-warning" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Tips Judul Event</h5>
                    <p class="text-muted small mb-0">Gunakan judul yang menarik dan informatif untuk menarik perhatian peserta.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="tip-card bg-white rounded-4 p-4 shadow-sm">
                    <div class="tip-icon mb-3">
                        <i class="bi bi-calendar-check text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Pilih Tanggal yang Tepat</h5>
                    <p class="text-muted small mb-0">Pastikan tanggal event tidak bentrok dengan kegiatan lain dan memberikan waktu persiapan yang cukup.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="tip-card bg-white rounded-4 p-4 shadow-sm">
                    <div class="tip-icon mb-3">
                        <i class="bi bi-image text-info" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Gambar yang Berkualitas</h5>
                    <p class="text-muted small mb-0">Upload gambar dengan resolusi tinggi dan format yang sesuai untuk tampilan yang optimal.</p>
                </div>
            </div>
        </div>
        </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Form Card */
.form-card {
    transition: all 0.3s ease;
}

.form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.form-icon {
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

/* Form Controls */
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

/* Image Upload */
.image-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 0.75rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: #1976d2;
    background: rgba(25, 118, 210, 0.05);
}

.image-preview {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
    background: #f8f9fa;
}

/* Tip Cards */
.tip-card {
    transition: all 0.3s ease;
}

.tip-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.tip-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 193, 7, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

/* Form Actions */
.form-actions .btn {
    transition: all 0.3s ease;
}

.form-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>

<script>
// Toggle fields based on event type
function toggleEventTypeFields() {
    const eventType = document.querySelector('input[name="event_type"]:checked')?.value;
    const priceField = document.getElementById('priceField');
    const qrisField = document.getElementById('qrisField');
    const certificateSettings = document.getElementById('certificateSettings');
    
    if (eventType === 'paid') {
        // Paid event: show price, QRIS, certificate, WhatsApp
        priceField.style.display = 'block';
        qrisField.style.display = 'block';
        if (certificateField) certificateField.style.display = 'block';
        if (certificateSettings) certificateSettings.style.display = 'block';
        if (whatsappField) whatsappField.style.display = 'block';
        if (googleFormField) {
            googleFormField.style.display = 'block';
            const googleFormInput = document.getElementById('google_form_link');
            if (googleFormInput) googleFormInput.removeAttribute('required');
        }
        // Make price required
        document.getElementById('price').setAttribute('required', 'required');
    } else if (eventType === 'public') {
        // Public event: hide price, QRIS, certificate, WhatsApp; show and require Google Form
        priceField.style.display = 'none';
        qrisField.style.display = 'none';
        if (certificateField) certificateField.style.display = 'none';
        if (certificateSettings) certificateSettings.style.display = 'none';
        if (whatsappField) whatsappField.style.display = 'none';
        if (googleFormField) {
            googleFormField.style.display = 'block';
            const googleFormInput = document.getElementById('google_form_link');
            if (googleFormInput) googleFormInput.setAttribute('required', 'required');
        }
        // Clear and remove required from price
        document.getElementById('price').value = '';
        document.getElementById('price').removeAttribute('required');
        document.getElementById('qris_image_path').value = '';
    } else {
        // Free event: hide price and QRIS, show certificate and Google Form (optional)
        priceField.style.display = 'none';
        qrisField.style.display = 'none';
        if (certificateField) certificateField.style.display = 'block';
        if (certificateSettings) certificateSettings.style.display = 'block';
        if (whatsappField) whatsappField.style.display = 'none';
        if (googleFormField) {
            googleFormField.style.display = 'block';
            const googleFormInput = document.getElementById('google_form_link');
            if (googleFormInput) googleFormInput.removeAttribute('required');
        }
        // Clear values and remove required
        document.getElementById('price').value = '';
        document.getElementById('price').removeAttribute('required');
        document.getElementById('qris_image_path').value = '';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleEventTypeFields();
});

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}

// Preview QRIS image
function previewQrisImage(input) {
    const preview = document.getElementById('qrisImagePreview');
    const previewImg = document.getElementById('previewQrisImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}

// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Nacht\Downloads\Himakom (4) (1)\Himakom\resources\views/admin/events/create.blade.php ENDPATH**/ ?>