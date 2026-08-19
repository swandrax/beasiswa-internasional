@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Tambah Beasiswa Baru</h1>
        <p class="text-muted mb-0">Formulir untuk mempublikasikan program beasiswa baru ke dalam sistem.</p>
    </div>
    <a href="{{ route('web.scholarships.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('web.scholarships.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul Beasiswa</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="provider" class="form-label">Nama Penyedia / Instansi</label>
                <input type="text" id="provider" name="provider" class="form-control" value="{{ old('provider') }}" required>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="deadline" class="form-label">Tenggat Waktu (Deadline)</label>
                    <input type="date" id="deadline" name="deadline" class="form-control" value="{{ old('deadline') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status Pendaftaran</label>
                    <select name="status" id="status" class="form-select">
                        <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>Buka (Open)</option>
                        <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Tutup (Closed)</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="description" class="form-label">Deskripsi Lengkap & Persyaratan</label>
                <textarea id="description" name="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</div>
@endsection
