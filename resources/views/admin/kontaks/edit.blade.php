@extends('layouts.admin')
@section('title', 'Edit Kontak | Admin')
@section('page-title', 'Edit Kontak')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Edit Kontak</h2>
    <form action="{{ route('kontaks.update', $kontak) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $kontak->email }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $kontak->phone }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control" value="{{ $kontak->address }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Instagram</label>
            <input type="text" name="instagram" class="form-control" value="{{ $kontak->instagram }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Facebook</label>
            <input type="text" name="facebook" class="form-control" value="{{ $kontak->facebook }}">
        </div>
        <div class="mb-3">
            <label class="form-label">LinkedIn</label>
            <input type="text" name="linkedin" class="form-control" value="{{ $kontak->linkedin }}">
        </div>
        <div class="mb-3">
            <label class="form-label">YouTube</label>
            <input type="text" name="youtube" class="form-control" value="{{ $kontak->youtube }}">
        </div>
        <div class="mb-3">
            <label class="form-label">TikTok</label>
            <input type="text" name="tiktok" class="form-control" value="{{ $kontak->tiktok }}">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('kontaks.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
</div>
@endsection
