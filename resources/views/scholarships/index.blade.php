@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Daftar Beasiswa</h1>
        <p class="text-muted mb-0">Jelajahi peluang beasiswa internasional terbaik untuk Anda.</p>
    </div>
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('web.scholarships.create') }}" class="btn btn-primary">+ Tambah Beasiswa</a>
    @endif
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Judul Beasiswa</th>
                        <th>Penyedia</th>
                        <th>Tenggat Waktu</th>
                        <th>Status</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="pe-4 text-end">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($scholarships as $scholarship)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $scholarship->title }}</div>
                                <div class="small text-muted">{{ Str::limit($scholarship->description, 50) }}</div>
                            </td>
                            <td>{{ $scholarship->provider }}</td>
                            <td>{{ \Carbon\Carbon::parse($scholarship->deadline)->translatedFormat('d F Y') }}</td>
                            <td>
                                <span class="badge {{ $scholarship->status === 'open' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($scholarship->status) }}
                                </span>
                            </td>
                            @if(auth()->user()->role === 'admin')
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
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
                            <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}" class="text-center py-5 text-muted">
                                Belum ada data beasiswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($scholarships->hasPages())
    <div class="card-footer bg-white border-0 pt-4 pb-2">
        {{ $scholarships->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
