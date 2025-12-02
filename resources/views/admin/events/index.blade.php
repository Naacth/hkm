@extends('layouts.admin')
@section('title', 'Kelola Event | Admin')
@section('page-title', 'Kelola Event')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-calendar-event me-3"></i>Kelola Event
                </h1>
                <p class="lead mb-0">Tambah, edit, dan hapus event kegiatan HIMAKOM</p>
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
                        <h4 class="fw-bold text-primary mb-1">Total Event: {{ $events->count() }}</h4>
                        <p class="text-muted mb-0">Event yang tersedia dalam sistem</p>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('events.create') }}" class="btn btn-success btn-lg rounded-pill">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Event Baru
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

        <!-- Events Table -->
        @if($events->count() > 0)
        <div class="events-table-card bg-white rounded-4 shadow-lg overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary text-white">
                        <tr>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-hash me-2"></i>No
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-calendar-event me-2"></i>Event
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-calendar-date me-2"></i>Tanggal
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-geo-alt me-2"></i>Lokasi
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-image me-2"></i>Gambar
                            </th>
                            <th class="border-0 px-4 py-3">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr class="event-row">
                            <td class="px-4 py-3 fw-bold">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <div class="event-info">
                                    <h6 class="fw-bold text-primary mb-1">{{ $event->title }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($event->description, 60) }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="date-info">
                                    <span class="badge bg-primary rounded-pill px-3 py-2">
                                        <i class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($event->location)
                                    <span class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($event->location, 30) }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($event->image)
                                    <div class="event-image-container">
                                        <img src="{{ asset('uploads/'.$event->image) }}" 
                                             class="event-thumbnail rounded-3 shadow-sm" 
                                             alt="{{ $event->title }}"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal{{ $event->id }}"
                                             style="cursor: pointer;">
                                    </div>
                                    
                                    <!-- Image Modal -->
                                    <div class="modal fade" id="imageModal{{ $event->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header border-0 bg-primary text-white">
                                                    <h5 class="modal-title fw-bold">{{ $event->title }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <img src="{{ asset('uploads/'.$event->image) }}" 
                                                         class="img-fluid w-100" 
                                                         alt="{{ $event->title }}">
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
                                <div class="action-buttons">
                                    <a href="{{ route('admin.events.participants', $event) }}" 
                                       class="btn btn-primary btn-sm rounded-pill me-2"
                                       title="Kelola Peserta">
                                        <i class="bi bi-people"></i>
                                    </a>
                                    <a href="{{ route('events.edit', $event) }}" 
                                       class="btn btn-warning btn-sm rounded-pill me-2"
                                       title="Edit Event">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm rounded-pill"
                                            onclick="confirmDelete('{{ $event->id }}', '{{ $event->title }}')"
                                            title="Hapus Event">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    
                                    <!-- Delete Form -->
                                    <form id="deleteForm{{ $event->id }}" 
                                          action="{{ route('events.destroy', $event) }}" 
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
                <i class="bi bi-calendar-x display-1 text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum ada event</h4>
            <p class="text-muted mb-4">Mulai dengan menambahkan event pertama untuk HIMAKOM</p>
            <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="bi bi-plus-circle me-2"></i>Tambah Event Pertama
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
                    <i class="bi bi-calendar-event text-primary display-4 mb-3"></i>
                    <h3 class="fw-bold text-primary mb-2">{{ $events->count() }}</h3>
                    <p class="text-muted mb-0">Total Event</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-calendar-check text-success display-4 mb-3"></i>
                    <h3 class="fw-bold text-success mb-2">{{ $events->where('date', '>=', now())->count() }}</h3>
                    <p class="text-muted mb-0">Event Mendatang</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-calendar-x text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold text-warning mb-2">{{ $events->where('date', '<', now())->count() }}</h3>
                    <p class="text-muted mb-0">Event Selesai</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bg-white rounded-4 p-4 text-center shadow-sm">
                    <i class="bi bi-image text-info display-4 mb-3"></i>
                    <h3 class="fw-bold text-info mb-2">{{ $events->whereNotNull('image')->count() }}</h3>
                    <p class="text-muted mb-0">Event dengan Gambar</p>
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

/* Event Row */
.event-row {
    transition: all 0.3s ease;
}

.event-row:hover {
    background: rgba(25, 118, 210, 0.05) !important;
    transform: translateX(5px);
}

/* Event Info */
.event-info h6 {
    font-size: 1rem;
}

/* Event Image */
.event-thumbnail {
    width: 60px;
    height: 60px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-thumbnail:hover {
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

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .header-actions .col-md-6 {
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .event-row:hover {
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
function confirmDelete(eventId, eventTitle) {
    if (confirm(`Apakah Anda yakin ingin menghapus event "${eventTitle}"?`)) {
        document.getElementById(`deleteForm${eventId}`).submit();
    }
}
</script>

@endsection
