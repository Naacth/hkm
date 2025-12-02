@extends('layout')
@section('title', 'Custom Sertifikat | HIMAKOM UYM')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-gear me-2"></i>Custom Sertifikat - Hanya Nama
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Preview Section -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-eye me-2"></i>Preview Sertifikat
                            </h5>
                            <div class="preview-container border rounded p-3" style="background: #f8f9fa; min-height: 400px;">
                                @if($registration->event->certificate_template)
                                    <div class="text-center mb-3">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="showTemplate">
                                                <i class="bi bi-image me-1"></i>Template Asli
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" id="showPreview">
                                                <i class="bi bi-eye me-1"></i>Preview Custom
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Template Preview -->
                                    <div id="templatePreview" class="preview-image">
                                        <img src="{{ asset('uploads/' . $registration->event->certificate_template) }}" 
                                             alt="Template Preview" 
                                             class="img-fluid rounded shadow"
                                             style="max-width: 100%; height: auto;">
                                    </div>
                                    
                                    <!-- Custom Preview -->
                                    <div id="customPreview" class="preview-image" style="display: none;">
                                        <div class="text-center">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2">Memuat preview...</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted py-5">
                                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Template tidak tersedia</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Customization Form -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-sliders me-2"></i>Pengaturan Posisi
                            </h5>
                            
                            <form id="customForm">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Peserta:</label>
                                    <input type="text" class="form-control" value="{{ $registration->participant_name ?: $registration->user->name }}" readonly>
                                    <small class="text-muted">Nama ini akan ditambahkan ke template sertifikat</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Posisi X (Horizontal):</label>
                                            <input type="number" class="form-control" id="positionX" name="x" value="700" min="0" max="2000" required>
                                            <small class="text-muted">0 = kiri, 1000 = tengah, 2000 = kanan</small>
                                            <div class="invalid-feedback" id="positionXError"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Posisi Y (Vertikal):</label>
                                            <input type="number" class="form-control" id="positionY" name="y" value="980" min="0" max="2000" required>
                                            <small class="text-muted">0 = atas, 1000 = tengah, 2000 = bawah</small>
                                            <div class="invalid-feedback" id="positionYError"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Ukuran Font:</label>
                                            <input type="number" class="form-control" id="fontSize" name="font_size" value="64" min="20" max="200" required>
                                            <small class="text-muted">20 = kecil, 64 = sedang, 200 = besar</small>
                                            <div class="invalid-feedback" id="fontSizeError"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Warna Teks:</label>
                                            <input type="color" class="form-control form-control-color" id="textColor" name="color" value="#003399" required>
                                            <small class="text-muted">Pilih warna untuk nama</small>
                                            <div class="invalid-feedback" id="textColorError"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary">Preset Posisi:</h6>
                                    <div class="btn-group w-100" role="group">
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPreset('center')">
                                            <i class="bi bi-align-center me-1"></i>Tengah
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPreset('top')">
                                            <i class="bi bi-align-top me-1"></i>Atas
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPreset('bottom')">
                                            <i class="bi bi-align-bottom me-1"></i>Bawah
                                        </button>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <h6 class="fw-bold">
                                        <i class="bi bi-info-circle me-2"></i>Catatan:
                                    </h6>
                                    <p class="mb-0">Sertifikat ini hanya akan menambahkan nama peserta ke template yang sudah diupload admin. Tidak ada teks lain yang ditambahkan.</p>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-success btn-lg" id="generateBtn" onclick="generateCertificate()">
                                        <i class="bi bi-download me-2"></i>Generate & Download Sertifikat
                                    </button>
                                    <button type="button" class="btn btn-info btn-lg" id="previewBtn" onclick="showPreview()">
                                        <i class="bi bi-eye me-2"></i>Lihat Preview
                                    </button>
                                    <a href="{{ route('certificates.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Sertifikat
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <h6 class="fw-bold">
                                    <i class="bi bi-info-circle me-2"></i>Petunjuk Penggunaan:
                                </h6>
                                <ul class="mb-0">
                                    <li><strong>Posisi X:</strong> Mengatur posisi horizontal nama (0 = kiri, 1000 = tengah)</li>
                                    <li><strong>Posisi Y:</strong> Mengatur posisi vertikal nama (0 = atas, 1000 = tengah)</li>
                                    <li><strong>Ukuran Font:</strong> Mengatur besar kecilnya tulisan nama</li>
                                    <li><strong>Warna:</strong> Mengatur warna tulisan nama</li>
                                    <li><strong>Preset:</strong> Gunakan tombol preset untuk posisi yang umum digunakan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.preview-container {
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.preview-image {
    width: 100%;
    text-align: center;
}

.form-control-color {
    height: 38px;
}

.btn-group .btn {
    border-radius: 0.375rem;
}

.btn-group .btn:not(:last-child) {
    margin-right: 0.25rem;
}

.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.spinner-border {
    width: 2rem;
    height: 2rem;
}

.preview-container .spinner-border {
    width: 3rem;
    height: 3rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .preview-container {
        min-height: 300px;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin-right: 0;
        margin-bottom: 0.25rem;
    }
}
</style>

<script>
// Preset positions based on common template sizes
const presets = {
    center: { x: 700, y: 500, fontSize: 64 },
    top: { x: 700, y: 300, fontSize: 64 },
    bottom: { x: 700, y: 700, fontSize: 64 }
};

let previewTimeout;

function setPreset(presetName) {
    const preset = presets[presetName];
    if (preset) {
        document.getElementById('positionX').value = preset.x;
        document.getElementById('positionY').value = preset.y;
        document.getElementById('fontSize').value = preset.fontSize;
        updatePreview();
    }
}

function generateCertificate() {
    // Validate form first
    if (!validateForm()) {
        return;
    }
    
    const form = document.getElementById('customForm');
    const formData = new FormData(form);
    
    // Get registration ID from URL
    const urlParts = window.location.pathname.split('/');
    const registrationId = urlParts[urlParts.length - 1];
    
    // Build query string
    const params = new URLSearchParams();
    params.append('x', formData.get('x'));
    params.append('y', formData.get('y'));
    params.append('font_size', formData.get('font_size'));
    params.append('color', formData.get('color'));
    
    // Show loading state
    const generateBtn = document.getElementById('generateBtn');
    const originalText = generateBtn.innerHTML;
    generateBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Generating...';
    generateBtn.disabled = true;
    
    // Redirect to generate endpoint
    const generateUrl = `/events/name-only/${registrationId}?${params.toString()}`;
    window.location.href = generateUrl;
}

function validateForm() {
    let isValid = true;
    
    // Clear previous errors
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    
    // Validate position X
    const positionX = document.getElementById('positionX');
    const x = parseInt(positionX.value);
    if (isNaN(x) || x < 0 || x > 2000) {
        positionX.classList.add('is-invalid');
        document.getElementById('positionXError').textContent = 'Posisi X harus antara 0-2000';
        isValid = false;
    }
    
    // Validate position Y
    const positionY = document.getElementById('positionY');
    const y = parseInt(positionY.value);
    if (isNaN(y) || y < 0 || y > 2000) {
        positionY.classList.add('is-invalid');
        document.getElementById('positionYError').textContent = 'Posisi Y harus antara 0-2000';
        isValid = false;
    }
    
    // Validate font size
    const fontSize = document.getElementById('fontSize');
    const size = parseInt(fontSize.value);
    if (isNaN(size) || size < 20 || size > 200) {
        fontSize.classList.add('is-invalid');
        document.getElementById('fontSizeError').textContent = 'Ukuran font harus antara 20-200';
        isValid = false;
    }
    
    // Validate color
    const textColor = document.getElementById('textColor');
    if (!textColor.value || !/^#[0-9A-F]{6}$/i.test(textColor.value)) {
        textColor.classList.add('is-invalid');
        document.getElementById('textColorError').textContent = 'Warna tidak valid';
        isValid = false;
    }
    
    return isValid;
}

function showPreview() {
    // Switch to preview mode
    document.getElementById('showPreview').click();
}

function updatePreview() {
    // Clear existing timeout
    if (previewTimeout) {
        clearTimeout(previewTimeout);
    }
    
    // Debounce the preview update
    previewTimeout = setTimeout(() => {
        const x = document.getElementById('positionX').value;
        const y = document.getElementById('positionY').value;
        const fontSize = document.getElementById('fontSize').value;
        const color = document.getElementById('textColor').value;
        
        // Get registration ID from URL
        const urlParts = window.location.pathname.split('/');
        const registrationId = urlParts[urlParts.length - 1];
        
        // Build preview URL
        const params = new URLSearchParams();
        params.append('x', x);
        params.append('y', y);
        params.append('font_size', fontSize);
        params.append('color', color);
        
        const previewUrl = `/events/preview-certificate/${registrationId}?${params.toString()}`;
        
        // Show loading state
        const customPreview = document.getElementById('customPreview');
        customPreview.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat preview...</p>
            </div>
        `;
        
        // Load preview image
        const img = new Image();
        img.onload = function() {
            customPreview.innerHTML = `
                <img src="${previewUrl}" 
                     alt="Custom Preview" 
                     class="img-fluid rounded shadow"
                     style="max-width: 100%; height: auto;">
            `;
        };
        img.onerror = function() {
            customPreview.innerHTML = `
                <div class="text-center text-danger">
                    <i class="bi bi-exclamation-triangle" style="font-size: 2rem;"></i>
                    <p class="mt-2">Gagal memuat preview</p>
                </div>
            `;
        };
        img.src = previewUrl;
    }, 500); // 500ms delay
}

// Auto-update preview when values change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['positionX', 'positionY', 'fontSize', 'textColor'];
    inputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('input', function() {
                // Clear validation errors on input
                this.classList.remove('is-invalid');
                const errorElement = document.getElementById(inputId + 'Error');
                if (errorElement) {
                    errorElement.textContent = '';
                }
                updatePreview();
            });
            
            // Add validation on blur
            input.addEventListener('blur', function() {
                validateForm();
            });
        }
    });
    
    // Preview toggle buttons
    document.getElementById('showTemplate').addEventListener('click', function() {
        document.getElementById('templatePreview').style.display = 'block';
        document.getElementById('customPreview').style.display = 'none';
        this.classList.add('btn-primary');
        this.classList.remove('btn-outline-primary');
        document.getElementById('showPreview').classList.add('btn-outline-primary');
        document.getElementById('showPreview').classList.remove('btn-primary');
    });
    
    document.getElementById('showPreview').addEventListener('click', function() {
        document.getElementById('templatePreview').style.display = 'none';
        document.getElementById('customPreview').style.display = 'block';
        this.classList.add('btn-primary');
        this.classList.remove('btn-outline-primary');
        document.getElementById('showTemplate').classList.add('btn-outline-primary');
        document.getElementById('showTemplate').classList.remove('btn-primary');
        
        // Update preview when switching to custom view
        updatePreview();
    });
    
    // Initial preview update
    updatePreview();
});
</script>

@endsection
