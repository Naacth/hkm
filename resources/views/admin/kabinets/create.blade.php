@extends('layouts.admin')
@section('title', 'Tambah Kabinet | Admin')
@section('page-title', 'Tambah Kabinet')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Tambah Kabinet</h2>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
    <form action="{{ route('kabinets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="position" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kabinets.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
