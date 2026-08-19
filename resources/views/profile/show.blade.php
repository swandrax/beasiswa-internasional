@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Profil Pengguna</h1>
        <p class="text-muted mb-0">Kelola informasi pribadi dan pengaturan akun Anda.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fs-2 fw-bold" style="width: 80px; height: 80px;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="h4 mb-1">{{ $user->name }}</h3>
                        <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                            Role: {{ strtoupper($user->role) }}
                        </span>
                    </div>
                </div>

                <hr class="text-muted mb-4">

                <form action="{{ route('web.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi Baru <span class="text-muted">(Kosongkan jika tidak ingin mengubah)</span></label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
