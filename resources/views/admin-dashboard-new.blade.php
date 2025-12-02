@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row g-4">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon bg-primary">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Total Events</div>
                    <div class="h4 fw-bold mb-0">{{ $totalEvents }}</div>
                    <div class="text-success small">
                        <i class="bi bi-arrow-up"></i> Active
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon bg-success">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Total Registrations</div>
                    <div class="h4 fw-bold mb-0">{{ $totalRegistrations }}</div>
                    <div class="text-info small">
                        <i class="bi bi-person-plus"></i> Participants
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon bg-warning">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Total Orders</div>
                    <div class="h4 fw-bold mb-0">{{ $totalOrders }}</div>
                    <div class="text-primary small">
                        <i class="bi bi-bag"></i> Products
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon bg-info">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ms-3">
                    <div class="text-muted small">Total Revenue</div>
                    <div class="h4 fw-bold mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div class="text-success small">
                        <i class="bi bi-graph-up"></i> Income
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Recent Events -->
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header bg-transparent border-0 p-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-calendar-event text-primary me-2"></i>
                        Recent Events
                    </h5>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye me-1"></i>View All
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                @if($recentEvents->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>Participants</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentEvents as $event)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($event->image)
                                                <img src="{{ asset('uploads/'.$event->image) }}" 
                                                     class="rounded me-3" 
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-primary rounded me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-calendar-event text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $event->title }}</div>
                                                <small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $event->formatted_date }}</div>
                                        <small class="text-muted">{{ $event->location ?? 'TBA' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $event->registrations->count() }} peserta</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $event->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">No recent events</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header bg-transparent border-0 p-4 pb-0">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-graph-up text-primary me-2"></i>
                    Quick Stats
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <div class="h5 fw-bold text-primary mb-1">{{ $recentDivisis->count() }}</div>
                            <small class="text-muted">Divisi</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <div class="h5 fw-bold text-success mb-1">{{ $recentOrders->where('status', 'confirmed')->count() }}</div>
                            <small class="text-muted">Confirmed Orders</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <div class="h5 fw-bold text-warning mb-1">{{ $recentOrders->where('status', 'pending')->count() }}</div>
                            <small class="text-muted">Pending Orders</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <div class="h5 fw-bold text-info mb-1">Rp {{ number_format($cancelledRevenue, 0, ',', '.') }}</div>
                            <small class="text-muted">Cancelled</small>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="d-grid gap-2">
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Create Event
                    </a>
                    <a href="{{ route('produks.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Recent Orders -->
    <div class="col-12">
        <div class="content-card">
            <div class="card-header bg-transparent border-0 p-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-cart text-primary me-2"></i>
                        Recent Orders
                    </h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye me-1"></i>View All
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>
                                        <span class="fw-semibold text-primary">#{{ $order->order_number }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="fw-semibold">{{ $order->customer_name }}</div>
                                            <small class="text-muted">{{ $order->customer_email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($order->produk->image)
                                                <img src="{{ asset('uploads/'.$order->produk->image) }}" 
                                                     class="rounded me-2" 
                                                     style="width: 30px; height: 30px; object-fit: cover;">
                                            @endif
                                            <span>{{ $order->produk->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">Rp {{ number_format($order->final_price ?? $order->total_price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $order->status === 'confirmed' ? 'bg-success' : ($order->status === 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $order->created_at->format('d M Y') }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">No recent orders</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection