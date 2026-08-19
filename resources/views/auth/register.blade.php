@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: calc(100vh - 200px);">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center fw-bold mb-1">Buat Akun Baru</h2>
                <p class="text-center text-muted mb-4">Bergabunglah untuk akses informasi beasiswa.</p>
                
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Cth: Budi Santoso">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="nama@email.com">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Ulangi kata sandi">
                    </div>
                    
                    <div class="mb-4">
                        <label for="role" class="form-label">Pilih Peran (Demonstrasi RBAC)</label>
                        <select name="role" id="role" class="form-select">
                            <option value="user">User Biasa (Hanya Lihat)</option>
                            <option value="admin">Administrator (Bisa Tambah/Edit/Hapus)</option>
                        </select>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
