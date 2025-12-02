@extends('layouts.admin')
@section('title', 'Kelola Anggota Divisi | Admin')
@section('page-title', 'Kelola Anggota Divisi')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-person-badge me-3"></i>Kelola Anggota Divisi
                </h1>
                <p class="lead mb-0">
                    @if($divisi)
                        Anggota Divisi: {{ $divisi->name }}
                    @else
                        Semua Anggota Divisi HIMAKOM
                    @endif
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex gap-2 justify-content-md-end">
                    @if($divisi)
                        <a href="{{ route('divisi-members.create', ['divisi_id' => $divisi->id]) }}" class="btn btn-light btn-lg rounded-pill">
                            <i class="bi bi-person-plus me-2"></i>Tambah Anggota
                        </a>
                    @else
                        <a href="{{ route('divisi-members.create') }}" class="btn btn-light btn-lg rounded-pill">
                            <i class="bi bi-person-plus me-2"></i>Tambah Anggota
                        </a>
                    @endif
                    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-light btn-lg rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="content-section py-5">
    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Filter Section -->
        @if(!$divisi)
        <div class="filter-section mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-funnel me-2"></i>Filter by Divisi
                            </h5>
                            <form method="GET" action="{{ route('divisi-members.index') }}">
                                <div class="row g-2">
                                    <div class="col-md-8">
                                        <select name="divisi_id" class="form-select">
                                            <option value="">Semua Divisi</option>
                                            @foreach(App\Models\Divisi::all() as $d)
                                                <option value="{{ $d->id }}" {{ request('divisi_id') == $d->id ? 'selected' : '' }}>
                                                    {{ $d->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-search me-1"></i>Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Members Table -->
        @if($members->count() > 0)
        <div class="members-table-card bg-white rounded-4 shadow-lg overflow-hidden">
            <div class="table-header bg-light p-4">
                <h4 class="fw-bold text-primary mb-0">
                    <i class="bi bi-people me-2"></i>Daftar Anggota
                    <span class="badge bg-primary ms-2">{{ $members->count() }}</span>
                </h4>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary text-white">
                        <tr>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-hash me-2"></i>No
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-person me-2"></i>Foto
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-person-badge me-2"></i>Nama
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-briefcase me-2"></i>Jabatan
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-calendar me-2"></i>Batch
                            </th>
                            @if(!$divisi)
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-diagram-2 me-2"></i>Divisi
                            </th>
                            @endif
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr class="member-row">
                            <td class="px-4 py-3 fw-bold">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <div class="member-photo">
                                    @if($member->photo)
                                        <img src="{{ asset('uploads/' . $member->photo) }}" 
                                             alt="{{ $member->name }}" 
                                             class="rounded-circle" 
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             onerror="this.src='https://via.placeholder.com/50x50/1976d2/ffffff?text={{ substr($member->name, 0, 1) }}'">
                                    @else
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <h6 class="fw-bold text-dark mb-1">{{ $member->name }}</h6>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge bg-info fs-6 px-3 py-2">{{ $member->position }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-muted">
                                    {{ $member->batch ?? '-' }}
                                </span>
                            </td>
                            @if(!$divisi)
                            <td class="px-4 py-3">
                                <span class="badge bg-secondary fs-6 px-3 py-2">
                                    {{ $member->divisi->name ?? 'Divisi tidak ditemukan' }}
                                </span>
                            </td>
                            @endif
                            <td class="px-4 py-3">
                                <div class="action-buttons">
                                    <a href="{{ route('divisi-members.edit', $member) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-pill me-2">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('divisi-members.destroy', $member) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </button>
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
                <i class="bi bi-people-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">
                @if($divisi)
                    Belum ada anggota di divisi {{ $divisi->name }}
                @else
                    Belum ada anggota divisi
                @endif
            </h4>
            <p class="text-muted mb-4">
                @if($divisi)
                    Mulai dengan menambahkan anggota pertama ke divisi ini
                @else
                    Mulai dengan menambahkan anggota divisi pertama
                @endif
            </p>
            @if($divisi)
                <a href="{{ route('divisi-members.create', ['divisi_id' => $divisi->id]) }}" class="btn btn-primary btn-lg rounded-pill">
                    <i class="bi bi-person-plus me-2"></i>Tambah Anggota Pertama
                </a>
            @else
                <a href="{{ route('divisi-members.create') }}" class="btn btn-primary btn-lg rounded-pill">
                    <i class="bi bi-person-plus me-2"></i>Tambah Anggota Pertama
                </a>
            @endif
        </div>
        @endif
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Table Styles */
.members-table-card {
    transition: all 0.3s ease;
}

.members-table-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.member-row {
    transition: all 0.3s ease;
}

.member-row:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

.member-photo img {
    transition: all 0.3s ease;
}

.member-photo img:hover {
    transform: scale(1.1);
}

.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Filter Section */
.filter-section .card {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.filter-section .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Empty State */
.empty-state {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 1rem;
    margin: 2rem 0;
}

.empty-icon {
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .admin-header .d-flex {
        justify-content: center !important;
        margin-top: 1rem;
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

@endsection
