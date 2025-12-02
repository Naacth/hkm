@extends('layouts.admin')
@section('title', 'Tambah About | Admin')
@section('page-title', 'Tambah About')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Tambah About</h2>
    <form action="{{ route('abouts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai Utama</label>
            <div id="values-list">
                <input type="text" name="values[]" class="form-control mb-2" placeholder="Nilai utama">
            </div>
            <button type="button" class="btn btn-sm btn-success" onclick="addValueInput()">Tambah Nilai</button>
        </div>
        <div class="mb-3">
            <label class="form-label">Sejarah Singkat</label>
            <textarea name="history" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Milestone</label>
            <div id="milestones-list">
                <input type="text" name="milestones[]" class="form-control mb-2" placeholder="Milestone">
            </div>
            <button type="button" class="btn btn-sm btn-success" onclick="addMilestoneInput()">Tambah Milestone</button>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('abouts.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-dark mb-3">Kembali ke Dashboard</a>
</div>
<script>
function addValueInput() {
    const list = document.getElementById('values-list');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'values[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Nilai utama';
    list.appendChild(input);
}
function addMilestoneInput() {
    const list = document.getElementById('milestones-list');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'milestones[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Milestone';
    list.appendChild(input);
}
</script>
@endsection
