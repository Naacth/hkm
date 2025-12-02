@extends('layouts.admin')
@section('title', 'Edit Kabinet | Admin')
@section('page-title', 'Edit Kabinet')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Edit Kabinet</h2>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
    <form action="{{ route('kabinets.update', $kabinet) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $kabinet->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="position" class="form-control" value="{{ $kabinet->position }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
            @if($kabinet->photo)
                <img src="{{ asset('uploads/'.$kabinet->photo) }}" width="100" class="mt-2 rounded shadow">
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ $kabinet->description }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('kabinets.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
