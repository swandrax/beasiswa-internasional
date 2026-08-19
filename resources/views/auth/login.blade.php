@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: calc(100vh - 200px);">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center fw-bold mb-1">Selamat Datang Kembali</h2>
                <p class="text-center text-muted mb-4">Masuk untuk melihat daftar beasiswa terbaru.</p>
                
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Masuk Sekarang</button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
