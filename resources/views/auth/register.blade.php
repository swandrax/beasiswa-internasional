@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="glass-card auth-card">
        <h2 class="auth-title">Buat Akun Baru</h2>
        <p class="auth-subtitle">Bergabunglah untuk akses informasi beasiswa.</p>
        
        <form action="{{ route('register') }}" method="POST" class="auth-form">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Cth: Budi Santoso">
            </div>
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com">
            </div>
            
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter">
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi kata sandi">
            </div>
            
            <div class="form-group">
                <label for="role">Pilih Peran (Demonstrasi RBAC)</label>
                <select name="role" id="role" class="form-control">
                    <option value="user">User Biasa (Hanya Lihat)</option>
                    <option value="admin">Administrator (Bisa Tambah/Edit/Hapus)</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
            
            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
