@extends('layouts.app')

@section('content')
<div class="header-section">
    <div>
        <h1 class="page-title">Daftar Beasiswa</h1>
        <p class="page-subtitle">Jelajahi peluang beasiswa internasional terbaik untuk Anda.</p>
    </div>
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('web.scholarships.create') }}" class="btn btn-primary">+ Tambah Beasiswa</a>
    @endif
</div>

<div class="glass-card">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul Beasiswa</th>
                    <th>Penyedia</th>
                    <th>Tenggat Waktu</th>
                    <th>Status</th>
                    @if(auth()->user()->role === 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($scholarships as $scholarship)
                    <tr>
                        <td>
                            <strong>{{ $scholarship->title }}</strong>
                            <div class="text-sm text-muted">{{ Str::limit($scholarship->description, 50) }}</div>
                        </td>
                        <td>{{ $scholarship->provider }}</td>
                        <td>{{ \Carbon\Carbon::parse($scholarship->deadline)->translatedFormat('d F Y') }}</td>
                        <td>
                            <span class="badge {{ $scholarship->status === 'open' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($scholarship->status) }}
                            </span>
                        </td>
                        @if(auth()->user()->role === 'admin')
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('web.scholarships.edit', $scholarship) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('web.scholarships.destroy', $scholarship) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}" class="text-center py-4">
                            Belum ada data beasiswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination-wrapper">
        {{ $scholarships->links('pagination::bootstrap-4') }} <!-- Menggunakan markup Bootstrap-like atau kustom CSS kita -->
    </div>
</div>
@endsection
