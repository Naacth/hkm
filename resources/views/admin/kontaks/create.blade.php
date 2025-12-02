@extends('layouts.admin')
@section('title', 'Tambah Kontak | Admin')
@section('page-title', 'Tambah Kontak')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Tambah Kontak</h2>
    <form action="{{ route('kontaks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Instagram</label>
            <input type="text" name="instagram" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Facebook</label>
            <input type="text" name="facebook" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">LinkedIn</label>
            <input type="text" name="linkedin" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">YouTube</label>
            <input type="text" name="youtube" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">TikTok</label>
            <input type="text" name="tiktok" class="form-control">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kontaks.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
</div>
@endsection
