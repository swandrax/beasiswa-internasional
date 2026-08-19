@extends('layouts.app')

@section('content')
<div class="header-section">
    <div>
        <h1 class="page-title">Tambah Beasiswa Baru</h1>
        <p class="page-subtitle">Formulir untuk mempublikasikan program beasiswa baru ke dalam sistem.</p>
    </div>
    <a href="{{ route('web.scholarships.index') }}" class="btn btn-outline-primary">Kembali</a>
</div>

<div class="glass-card">
    <form action="{{ route('web.scholarships.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="title">Judul Beasiswa</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="provider">Nama Penyedia / Instansi</label>
            <input type="text" id="provider" name="provider" value="{{ old('provider') }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="deadline">Tenggat Waktu (Deadline)</label>
            <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="status">Status Pendaftaran</label>
            <select name="status" id="status" class="form-control">
                <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>Buka (Open)</option>
                <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Tutup (Closed)</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="description">Deskripsi Lengkap & Persyaratan</label>
            <textarea id="description" name="description" rows="5" required class="form-control">{{ old('description') }}</textarea>
        </div>
        
        <div class="form-actions mt-4">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
