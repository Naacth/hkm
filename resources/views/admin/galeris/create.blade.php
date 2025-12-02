@extends('layouts.admin')
@section('title', 'Tambah Galeri | Admin')
@section('page-title', 'Tambah Galeri')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Tambah Galeri</h2>
    <form action="{{ route('galeris.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <hr class="my-4">
        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-search me-2"></i>Google SEO</h5>
        <div class="mb-3">
            <label class="form-label">SEO Title</label>
            <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="seo_description" class="form-control" rows="3">{{ old('seo_description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">JSON-LD (Structured Data)</label>
            <textarea name="seo_jsonld" class="form-control" rows="5" placeholder='{"&#64;context":"https://schema.org", ...}'>{{ old('seo_jsonld') }}</textarea>
            <div class="form-text">Jika diisi, script JSON-LD akan ditampilkan di halaman publik.</div>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('galeris.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
</div>
@endsection
