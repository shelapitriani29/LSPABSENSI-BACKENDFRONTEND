@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Judul Halaman & Sub-judul -->
    <div class="mb-3">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Jadwal Asesmen</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-dark">Sertifikasi</li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Jadwal asesmen</li>
            </ol>
        </nav>
    </div>

    <!-- Tabel Jadwal Asesmen -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">
            <!-- Judul di Atas Tabel -->
            <h6 class="fw-bold text-dark mb-3">Jadwal Asesmen</h6>

            <!-- Filter Status, Show Entries & Search Bar -->
            <form action="{{ route('asesor.jadwal-asesmen') }}" method="GET" class="row g-3 align-items-center mb-3">
                <div class="col-auto d-flex align-items-center gap-1 small text-muted">
                    <span>Show</span>
                    <select name="per_page" class="form-select form-select-sm d-inline-block w-auto mx-1">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span>entries</span>
                </div>
                <div class="col-auto d-flex align-items-center gap-2 small text-muted">
                    <span>Status:</span>
                    <select name="status" class="form-select form-select-sm">
                        <option value="" {{ !request()->filled('status') ? 'selected' : '' }}>Semua</option>
                        <option value="Akan Mendatang" {{ request('status') == 'Akan Mendatang' ? 'selected' : '' }}>Akan Mendatang</option>
                        <option value="Mulai" {{ request('status') == 'Mulai' ? 'selected' : '' }}>Mulai</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-auto d-flex align-items-center gap-2">
                    <span class="small text-muted">Search:</span>
                    <input type="text" name="search" class="form-control form-control-sm d-inline-block w-auto" placeholder="Cari kode, skema, asesor..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase text-center">
                        <tr>
                            <th class="py-3 px-3" style="width: 5%;">No.</th>
                            <th class="py-3" style="width: 15%;">Kode</th>
                            <th class="py-3">Skema</th>
                            <th class="py-3" style="width: 12%;">Kelas</th>
                            <th class="py-3" style="width: 18%;">Asesor</th>
                            <th class="py-3 text-center" style="width: 10%;">Peserta</th>
                            <th class="py-3 text-center" style="width: 12%;">Status</th>
                            <th class="py-3 text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse ($jadwals as $key => $jadwal)
                        <tr>
                            <td class="px-3 text-center">{{ $jadwals->firstItem() + $key }}.</td>
                            <td><span class="badge bg-light text-dark border px-2 py-1">{{ $jadwal->kode_jadwal }}</span></td>
                            <td class="fw-bold text-dark">{{ $jadwal->skema->nama_skema ?? '-' }}</td>
                            <td class="text-center">{{ $jadwal->kelas ?? '-' }}</td>
                            <td>{{ $jadwal->asesor->name ?? '-' }}</td>
                            <td class="text-center">{{ $jadwal->pesertas_count }} Orang</td>
                            <td class="text-center">
                                <span class="badge {{ $jadwal->status == 'Akan Mendatang' ? 'bg-warning text-dark' : ($jadwal->status == 'Mulai' ? 'bg-success' : 'bg-secondary') }} text-white px-3 py-1 rounded-pill">{{ $jadwal->status }}</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.jadwal-asesmen.detail', $jadwal->id) }}"><i class="bi bi-list-ul me-2 text-primary"></i> Detail Asesmen</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada jadwal asesmen.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center pt-3">
                {{ $jadwals->links('pagination::bootstrap-5') }}
            </div>

            <!-- Pagination Terpusat -->
            <div class="d-flex justify-content-center mt-4 mb-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#" style="background-color: #2b70c9; border-color: #2b70c9;">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link text-dark" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection