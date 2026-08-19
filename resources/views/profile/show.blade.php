@extends('layouts.app')

@section('content')
<div class="header-section">
    <div>
        <h1 class="page-title">Profil Pengguna</h1>
        <p class="page-subtitle">Kelola informasi pribadi dan pengaturan akun Anda.</p>
    </div>
</div>

<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="profile-header">
        <div class="avatar">{{ substr($user->name, 0, 1) }}</div>
        <div>
            <h3>{{ $user->name }}</h3>
            <p class="badge {{ $user->role === 'admin' ? 'badge-primary' : 'badge-secondary' }}">
                Role: {{ strtoupper($user->role) }}
            </p>
        </div>
    </div>

    <hr style="border:0; border-top: 1px solid rgba(255,255,255,0.1); margin: 2rem 0;">

    <form action="{{ route('web.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control">
        </div>
        
        <div class="form-group">
            <label for="password">Kata Sandi Baru (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
        
        <div class="form-actions mt-4">
            <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
