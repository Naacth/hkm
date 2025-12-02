@extends('layouts.admin')
@section('title', 'Kelola Kabinet | Admin')
@section('page-title', 'Kelola Kabinet')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Kelola Kabinet</h2>
        <a href="{{ route('kabinets.create') }}" class="btn btn-primary">Tambah Kabinet</a>
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
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kabinets as $kabinet)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kabinet->name }}</td>
                        <td>{{ $kabinet->position }}</td>
                        <td>
                            @if($kabinet->photo)
                                <img src="{{ asset('uploads/'.$kabinet->photo) }}" width="60" class="rounded shadow">
                            @endif
                        </td>
                        <td>{{ Str::limit($kabinet->description, 50) }}</td>
                        <td>
                            <a href="{{ route('kabinets.edit', $kabinet) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('kabinets.destroy', $kabinet) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
