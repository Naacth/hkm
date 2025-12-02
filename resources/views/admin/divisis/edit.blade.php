@extends('layouts.admin')
@section('title', 'Edit Divisi | Admin')
@section('page-title', 'Edit Divisi')
@section('content')

<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-pencil-square me-3"></i>Edit Divisi
                </h1>
                <p class="lead mb-0">Perbarui informasi divisi "{{ $divisi->name }}"</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('divisis.index') }}" class="btn btn-light btn-lg rounded-pill">
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
                            <i class="bi bi-people text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">Form Edit Divisi</h3>
                        <p class="text-muted">Perbarui informasi divisi yang dipilih</p>
                    </div>

                    <form action="{{ route('divisis.update', $divisi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-building text-primary me-2"></i>Nama Divisi
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control form-control-lg" 
                                   value="{{ old('name', $divisi->name) }}"
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="photo" class="form-label fw-semibold">
                                <i class="bi bi-image text-primary me-2"></i>Foto Divisi
                            </label>
                            <input type="file" 
                                   name="photo" 
                                   id="photo"
                                   class="form-control form-control-lg" 
                                   accept="image/*">
                            @if($divisi->photo)
                                <div class="mt-3">
                                    <img src="{{ asset('uploads/'.$divisi->photo) }}" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         style="max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="bi bi-text-paragraph text-primary me-2"></i>Deskripsi Divisi
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      class="form-control" 
                                      rows="5"
                                      required>{{ old('description', $divisi->description) }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="logo" class="form-label fw-semibold">
                                <i class="bi bi-emoji-smile text-primary me-2"></i>Logo Divisi
                            </label>
                            <input type="file" 
                                   name="logo" 
                                   id="logo"
                                   class="form-control form-control-lg" 
                                   accept="image/*">
                            @if($divisi->logo)
                                <div class="mt-3">
                                    <img src="{{ asset('uploads/'.$divisi->logo) }}" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label for="group_photo" class="form-label fw-semibold">
                                <i class="bi bi-people-fill text-primary me-2"></i>Foto Anggota Lengkap
                            </label>
                            <input type="file" 
                                   name="group_photo" 
                                   id="group_photo"
                                   class="form-control form-control-lg" 
                                   accept="image/*">
                            @if($divisi->group_photo)
                                <div class="mt-3">
                                    <img src="{{ asset('uploads/'.$divisi->group_photo) }}" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         style="max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                <i class="bi bi-check-circle me-2"></i>Update Divisi
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

<div class="members-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="members-card bg-white rounded-4 shadow-lg p-5">
                    <div class="members-header d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold text-primary mb-2">
                                <i class="bi bi-people-fill me-2"></i>Kelola Anggota Divisi
                            </h3>
                            <p class="text-muted mb-0">Kelola anggota divisi "{{ $divisi->name }}"</p>
                        </div>
                        <a href="{{ route('divisi-members.create', ['divisi_id' => $divisi->id]) }}" 
                           class="btn btn-success btn-lg rounded-pill">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Anggota
                        </a>
                    </div>

                    @if($divisi->members->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="fw-semibold">Nama</th>
                                        <th class="fw-semibold">Jabatan</th>
                                        <th class="fw-semibold">Batch</th>
                                        <th class="fw-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($divisi->members as $member)
                                    <tr>
                                        <td class="align-middle">{{ $member->name }}</td>
                                        <td class="align-middle">
                                            <span class="badge bg-primary">{{ $member->position }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-muted">{{ $member->batch ?? '-' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('divisi-members.edit', $member) }}" 
                                               class="btn btn-warning btn-sm rounded-pill me-2">
                                                <i class="bi bi-pencil me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('divisi-members.destroy', $member) }}" 
                                                  method="POST" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Yakin hapus anggota ini?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm rounded-pill">
                                                    <i class="bi bi-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">Belum ada anggota</h5>
                            <p class="text-muted">Mulai dengan menambahkan anggota pertama ke divisi ini.</p>
                        </div>
                    @endif
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

.members-card {
    transition: all 0.3s ease;
}

.members-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
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
    
    .members-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}
</style>

@endsection 