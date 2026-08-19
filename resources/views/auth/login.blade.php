@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="glass-card auth-card">
        <h2 class="auth-title">Selamat Datang Kembali</h2>
        <p class="auth-subtitle">Masuk untuk melihat daftar beasiswa terbaru.</p>
        
        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
            </div>
            
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Masuk Sekarang</button>
            
            <div class="auth-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
