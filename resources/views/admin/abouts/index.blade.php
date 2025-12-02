@extends('layouts.admin')
@section('title', 'Kelola About | Admin')
@section('page-title', 'Kelola About')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Kelola About</h2>
        <a href="{{ route('abouts.create') }}" class="btn btn-primary">Tambah About</a>
    </div>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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
                    @foreach($abouts as $about)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $about->title }}</td>
                        <td>{{ Str::limit($about->description, 50) }}</td>
                        <td>
                            @if($about->image)
                                <img src="{{ asset('uploads/'.$about->image) }}" width="60" class="rounded shadow">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('abouts.edit', $about) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('abouts.destroy', $about) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
