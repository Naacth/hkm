@extends('layouts.admin')
@section('title', 'Tambah Anggota Divisi | Admin')
@section('page-title', 'Tambah Anggota Divisi')
@section('content')

<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-person-plus me-3"></i>Tambah Anggota Divisi
                </h1>
                <p class="lead mb-0">Tambah anggota baru ke divisi</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ url()->previous() }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card bg-white rounded-4 shadow-lg p-5">
                    <div class="form-header text-center mb-4">
                        <div class="form-icon mb-3">
                            <i class="bi bi-person text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">Form Tambah Anggota</h3>
                        <p class="text-muted">Isi informasi lengkap anggota yang akan ditambahkan</p>
                    </div>

                    <form action="{{ route('divisi-members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="divisi_id" value="{{ request('divisi_id') }}">
                        
                        <div class="form-group mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-person text-primary me-2"></i>Nama Anggota
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control form-control-lg" 
                                   placeholder="Masukkan nama lengkap anggota"
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="position" class="form-label fw-semibold">
                                <i class="bi bi-briefcase text-primary me-2"></i>Jabatan/Posisi
                            </label>
                            <input type="text" 
                                   name="position" 
                                   id="position"
                                   class="form-control form-control-lg" 
                                   placeholder="Contoh: Ketua, Sekretaris, Anggota"
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="batch" class="form-label fw-semibold">
                                <i class="bi bi-calendar text-primary me-2"></i>Batch
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="batch" 
                                   id="batch"
                                   class="form-control form-control-lg" 
                                   placeholder="Contoh: 2023, 2024, dll">
                        </div>

                        <div class="form-group mb-4">
                            <label for="photo" class="form-label fw-semibold">
                                <i class="bi bi-image text-primary me-2"></i>Foto Anggota
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="file" 
                                   name="photo" 
                                   id="photo"
                                   class="form-control form-control-lg" 
                                   accept="image/*">
                        </div>

                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                <i class="bi bi-check-circle me-2"></i>Simpan Anggota
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

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

.form-actions .btn {
    transition: all 0.3s ease;
}

.form-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

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

@endsection
