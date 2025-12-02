@extends('layouts.admin')
@section('title', 'Kelola Galeri | Admin')
@section('page-title', 'Kelola Galeri')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Kelola Galeri</h2>
        <a href="{{ route('galeris.create') }}" class="btn btn-primary">Tambah Galeri</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galeris as $galeri)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $galeri->title }}</td>
                        <td>
                            @if($galeri->image)
                                <img src="{{ asset('uploads/'.$galeri->image) }}" width="60" class="rounded shadow">
                            @endif
                        </td>
                        <td>{{ Str::limit($galeri->description, 50) }}</td>
                        <td>
                            <a href="{{ route('galeris.edit', $galeri) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('galeris.destroy', $galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
