@extends('layouts.admin')
@section('title', 'Edit About | Admin')
@section('page-title', 'Edit About')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Edit About</h2>
    <form action="{{ route('abouts.update', $about) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $about->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ $about->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control">
            @if($about->image)
                <img src="{{ asset('uploads/'.$about->image) }}" width="100" class="mt-2 rounded shadow">
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai Utama</label>
            <div id="values-list">
                @if(is_array($about->values))
                    @foreach($about->values as $value)
                        <input type="text" name="values[]" class="form-control mb-2" value="{{ $value }}" placeholder="Nilai utama">
                    @endforeach
                @else
                    <input type="text" name="values[]" class="form-control mb-2" placeholder="Nilai utama">
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-success" onclick="addValueInput()">Tambah Nilai</button>
        </div>
        <div class="mb-3">
            <label class="form-label">Sejarah Singkat</label>
            <textarea name="history" class="form-control" rows="3">{{ $about->history }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Milestone</label>
            <div id="milestones-list">
                @if(is_array($about->milestones))
                    @foreach($about->milestones as $milestone)
                        <input type="text" name="milestones[]" class="form-control mb-2" value="{{ $milestone }}" placeholder="Milestone">
                    @endforeach
                @else
                    <input type="text" name="milestones[]" class="form-control mb-2" placeholder="Milestone">
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-success" onclick="addMilestoneInput()">Tambah Milestone</button>
        </div>
        <button class="btn btn-primary">Update</button>
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
