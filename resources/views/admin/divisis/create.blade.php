@extends('layouts.admin')
@section('title', 'Tambah Divisi | Admin')
@section('page-title', 'Tambah Divisi')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-plus-circle me-3"></i>Tambah Divisi Baru
                </h1>
                <p class="lead mb-0">Buat divisi baru untuk struktur organisasi HIMAKOM</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('divisis.index') }}" class="btn btn-light btn-lg rounded-pill">
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
                            <i class="bi bi-people text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">Form Tambah Divisi</h3>
                        <p class="text-muted">Isi informasi lengkap divisi yang akan ditambahkan</p>
                    </div>

                    <form action="{{ route('divisis.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Divisi Name -->
                        <div class="form-group mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-building text-primary me-2"></i>Nama Divisi
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   placeholder="Contoh: Divisi Humas, Divisi Acara, dll"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Divisi Photo -->
                        <div class="form-group mb-4">
                            <label for="photo" class="form-label fw-semibold">
                                <i class="bi bi-image text-primary me-2"></i>Foto Divisi
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="image-upload-container">
                                <input type="file" 
                                       name="photo" 
                                       id="photo"
                                       class="form-control form-control-lg @error('photo') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(this, 'photoPreview', 'previewPhoto')">
                                <div class="image-preview mt-3" id="photoPreview" style="display: none;">
                                    <img id="previewPhoto" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Divisi Description -->
                        <div class="form-group mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="bi bi-text-paragraph text-primary me-2"></i>Deskripsi Divisi
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="5"
                                      placeholder="Jelaskan tugas, tanggung jawab, dan fungsi divisi ini..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Divisi Logo -->
                        <div class="form-group mb-4">
                            <label for="logo" class="form-label fw-semibold">
                                <i class="bi bi-emoji-smile text-primary me-2"></i>Logo Divisi
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="image-upload-container">
                                <input type="file" 
                                       name="logo" 
                                       id="logo"
                                       class="form-control form-control-lg @error('logo') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(this, 'logoPreview', 'previewLogo')">
                                <div class="image-preview mt-3" id="logoPreview" style="display: none;">
                                    <img id="previewLogo" class="img-fluid rounded-3 shadow-sm" style="max-height: 150px;">
                                </div>
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Group Photo -->
                        <div class="form-group mb-4">
                            <label for="group_photo" class="form-label fw-semibold">
                                <i class="bi bi-people-fill text-primary me-2"></i>Foto Anggota Lengkap
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="image-upload-container">
                                <input type="file" 
                                       name="group_photo" 
                                       id="group_photo"
                                       class="form-control form-control-lg @error('group_photo') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(this, 'groupPhotoPreview', 'previewGroupPhoto')">
                                <div class="image-preview mt-3" id="groupPhotoPreview" style="display: none;">
                                    <img id="previewGroupPhoto" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                            @error('group_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                <i class="bi bi-check-circle me-2"></i>Simpan Divisi
                            </button>
                            <a href="{{ route('divisis.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
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
                    <h5 class="fw-bold text-primary mb-2">Tips Nama Divisi</h5>
                    <p class="text-muted small mb-0">Gunakan nama yang jelas dan mudah dipahami untuk memudahkan pengorganisasian.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="tip-card bg-white rounded-4 p-4 shadow-sm">
                    <div class="tip-icon mb-3">
                        <i class="bi bi-image text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Foto yang Berkualitas</h5>
                    <p class="text-muted small mb-0">Upload foto dengan resolusi tinggi dan komposisi yang baik untuk tampilan optimal.</p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="tip-card bg-white rounded-4 p-4 shadow-sm">
                    <div class="tip-icon mb-3">
                        <i class="bi bi-text-paragraph text-info" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold text-primary mb-2">Deskripsi yang Jelas</h5>
                    <p class="text-muted small mb-0">Jelaskan dengan detail tugas dan tanggung jawab divisi untuk pemahaman yang baik.</p>
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
function previewImage(input, previewId, imgId) {
    const preview = document.getElementById(previewId);
    const previewImg = document.getElementById(imgId);
    
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

@endsection
