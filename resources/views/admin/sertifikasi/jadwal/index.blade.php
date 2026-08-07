@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #212529;">Jadwal Uji</h3>
        <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-secondary">Sertifikasi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Jadwal Uji</li>
            </ol>
        </nav>
    </div>

    <!-- Card Tabel Jadwal Uji -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <!-- Judul Tabel & Tombol Tambah (Sejajar) -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0">Jadwal Uji</h5>
                <a href="{{ route('admin.sertifikasi.jadwal.create') }}" class="btn text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1" style="background-color: #1b6ca8;">
                    <i class="bi bi-plus-lg"></i> Tambah Jadwal
                </a>
            </div>

            <!-- Filter Status & Search Bar (Sejajar) -->
            <form action="{{ route('admin.sertifikasi.jadwal.index') }}" method="GET" class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2 small text-secondary">
                    <span>Filter Status:</span>
                    <select name="status" class="form-select form-select-sm" style="width: 180px;" onchange="this.form.submit()">
                        <option value="" {{ !request()->filled('status') ? 'selected' : '' }}>Semua</option>
                        <option value="Akan Mendatang" {{ request('status') == 'Akan Mendatang' ? 'selected' : '' }}>Akan Mendatang</option>
                        <option value="Mulai" {{ request('status') == 'Mulai' ? 'selected' : '' }}>Mulai</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <span class="small text-secondary">Search:</span>
                    <div class="input-group input-group-sm" style="width: 260px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari kode, skema, asesor..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>

            <!-- Tabel dengan Garis Border -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th scope="col" class="py-3 px-3" style="width: 5%;">No.</th>
                            <th scope="col" class="py-3" style="width: 15%;">Kode Jadwal</th>
                            <th scope="col" class="py-3">Skema</th>
                            <th scope="col" class="py-3" style="width: 12%;">Kelas</th>
                            <th scope="col" class="py-3" style="width: 18%;">Asesor</th>
                            <th scope="col" class="py-3 text-center" style="width: 12%;">Status</th>
                            <th scope="col" class="py-3 text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($jadwals as $key => $jadwal)
                        <tr>
                            <td class="px-3">{{ $jadwals->firstItem() + $key }}.</td>
                            <td><span class="badge bg-light text-dark border px-2 py-1">{{ $jadwal->kode_jadwal }}</span></td>
                            <td class="fw-bold text-dark">{{ $jadwal->skema->nama_skema ?? '-' }}</td>
                            <td>{{ $jadwal->kelas ?? '-' }}</td>
                            <td>{{ $jadwal->asesor->name ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge {{ $jadwal->status == 'Akan Mendatang' ? 'bg-warning text-dark' : ($jadwal->status == 'Mulai' ? 'bg-success' : 'bg-secondary') }} text-white px-3 py-1 rounded-pill">{{ $jadwal->status }}</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #337ab7;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.sertifikasi.jadwal.show', $jadwal->id) }}"><i class="bi bi-eye me-2 text-info"></i> Detail</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.sertifikasi.jadwal.edit', $jadwal->id) }}"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit</a></li>
                                        <li>
                                            <form action="{{ route('admin.sertifikasi.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-trash me-2"></i> Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada jadwal uji.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center pt-3">
                {{ $jadwals->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection