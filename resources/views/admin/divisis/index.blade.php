@extends('layouts.admin')
@section('title', 'Kelola Divisi | Admin')
@section('page-title', 'Kelola Divisi')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-diagram-2 me-3"></i>Kelola Divisi
                </h1>
                <p class="lead mb-0">Tambah, edit, dan hapus divisi-divisi HIMAKOM</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin-dashboard') }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="content-section py-5">
    <div class="container">
        <!-- Header Actions -->
        <div class="header-actions mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="stats-info">
                        <h4 class="fw-bold text-primary mb-1">Total Divisi: {{ $divisis->count() }}</h4>
                        <p class="text-muted mb-0">Divisi yang tersedia dalam sistem</p>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('divisis.create') }}" class="btn btn-success btn-lg rounded-pill">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Divisi Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Divisi Table -->
        @if($divisis->count() > 0)
        <div class="divisi-table-card bg-white rounded-4 shadow-lg overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary text-white">
                        <tr>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-hash me-2"></i>No
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-diagram-2 me-2"></i>Divisi
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-image me-2"></i>Foto
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-people me-2"></i>Anggota
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-info-circle me-2"></i>Deskripsi
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($divisis as $divisi)
                        <tr class="divisi-row">
                            <td class="px-4 py-3 fw-bold">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <div class="divisi-info">
                                    <h6 class="fw-bold text-primary mb-1">{{ $divisi->name }}</h6>
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i>Aktif
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($divisi->photo)
                                    <div class="divisi-image-container">
                                        <img src="{{ asset('uploads/'.$divisi->photo) }}" 
                                             class="divisi-thumbnail rounded-3 shadow-sm" 
                                             alt="{{ $divisi->name }}"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal{{ $divisi->id }}"
                                             style="cursor: pointer;">
                                    </div>
                                    
                                    <!-- Image Modal -->
                                    <div class="modal fade" id="imageModal{{ $divisi->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header border-0 bg-primary text-white">
                                                    <h5 class="modal-title fw-bold">{{ $divisi->name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <img src="{{ asset('uploads/'.$divisi->photo) }}" 
                                                         class="img-fluid w-100" 
                                                         alt="{{ $divisi->name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="no-image-placeholder">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="member-count">
                                    <span class="badge bg-info rounded-pill px-3 py-2">
                                        <i class="bi bi-people me-1"></i>{{ $divisi->members->count() }} Anggota
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="divisi-description">
                                    <p class="text-muted small mb-0">{{ Str::limit($divisi->description, 80) }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="action-buttons">
                                    <a href="{{ route('divisis.edit', $divisi) }}" 
                                       class="btn btn-warning btn-sm rounded-pill me-2"
                                       title="Edit Divisi">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{ route('divisi-members.index') }}?divisi_id={{ $divisi->id }}" 
                                       class="btn btn-info btn-sm rounded-pill me-2"
                                       title="Kelola Anggota">
                                        <i class="bi bi-people"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm rounded-pill"
                                            onclick="confirmDelete('{{ $divisi->id }}', '{{ $divisi->name }}')"
                                            title="Hapus Divisi">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    
                                    <!-- Delete Form -->
                                    <form id="deleteForm{{ $divisi->id }}" 
                                          action="{{ route('divisis.destroy', $divisi) }}" 
                                          method="POST" 
                                          class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="empty-state text-center py-5">
            <div class="empty-icon mb-4">
                <i class="bi bi-diagram-2 display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada divisi</h4>
            <p class="text-muted mb-4">Mulai dengan menambahkan divisi pertama untuk HIMAKOM</p>
            <a href="{{ route('divisis.create') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="bi bi-plus-circle me-2"></i>Tambah Divisi Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Quick Stats -->
<div class="quick-stats-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-diagram-2 text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2">{{ $divisis->count() }}</h3>
                    <p class="text-muted mb-0">Total Divisi</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-people text-success display-4 mb-3"></i>
                    <h3 class="fw-bold text-success mb-2">{{ App\Models\DivisiMember::count() }}</h3>
                    <p class="text-muted mb-0">Total Anggota</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-image text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold text-warning mb-2">{{ $divisis->whereNotNull('photo')->count() }}</h3>
                    <p class="text-muted mb-0">Divisi dengan Foto</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-star text-info display-4 mb-3"></i>
                    <h3 class="fw-bold text-info mb-2">{{ $divisis->whereNotNull('logo')->count() }}</h3>
                    <p class="text-muted mb-0">Divisi dengan Logo</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Divisi Overview -->
<div class="divisi-overview-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-primary mb-3">Ringkasan Divisi</h2>
            <p class="lead text-muted">Statistik dan informasi lengkap tentang divisi-divisi HIMAKOM</p>
        </div>
        
        <div class="row g-4">
            @foreach($divisis->take(4) as $divisi)
            <div class="col-lg-6 col-md-6">
                <div class="divisi-overview-card bg-white rounded-4 p-4 shadow-lg">
                    <div class="d-flex align-items-center mb-3">
                        @if($divisi->logo)
                            <img src="{{ asset('uploads/'.$divisi->logo) }}" 
                                 class="divisi-logo me-3" 
                                 alt="{{ $divisi->name }}"
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        @else
                            <div class="divisi-logo-placeholder me-3">
                                <i class="bi bi-diagram-2 text-primary" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="fw-bold text-primary mb-1">{{ $divisi->name }}</h5>
                            <p class="text-muted small mb-0">{{ $divisi->members->count() }} Anggota</p>
                        </div>
                    </div>
                    <p class="text-muted small mb-3">{{ Str::limit($divisi->description, 100) }}</p>
                    <div class="divisi-actions">
                        <a href="{{ route('divisis.edit', $divisi) }}" class="btn btn-outline-primary btn-sm rounded-pill me-2">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('divisi-members.index') }}?divisi_id={{ $divisi->id }}" class="btn btn-outline-success btn-sm rounded-pill">
                            <i class="bi bi-people me-1"></i>Anggota
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Divisi Row */
.divisi-row {
    transition: all 0.3s ease;
}

.divisi-row:hover {
    background: rgba(25, 118, 210, 0.05) !important;
    transform: translateX(5px);
}

/* Divisi Info */
.divisi-info h6 {
    font-size: 1rem;
}

/* Divisi Image */
.divisi-thumbnail {
    width: 60px;
    height: 60px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.divisi-thumbnail:hover {
    transform: scale(1.1);
}

.no-image-placeholder {
    width: 60px;
    height: 60px;
    background: #f8f9fa;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Action Buttons */
.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Stats Cards */
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 1rem;
    border: 2px dashed #dee2e6;
}

/* Table Styles */
.table-primary {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%) !important;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

/* Divisi Overview Cards */
.divisi-overview-card {
    transition: all 0.3s ease;
}

.divisi-overview-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.divisi-logo-placeholder {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.divisi-actions .btn {
    transition: all 0.3s ease;
}

.divisi-actions .btn:hover {
    transform: translateY(-2px);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .header-actions .col-md-6 {
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .divisi-row:hover {
        transform: none;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

<script>
function confirmDelete(divisiId, divisiName) {
    if (confirm(`Apakah Anda yakin ingin menghapus divisi "${divisiName}"?`)) {
        document.getElementById(`deleteForm${divisiId}`).submit();
    }
}
</script>

@endsection
