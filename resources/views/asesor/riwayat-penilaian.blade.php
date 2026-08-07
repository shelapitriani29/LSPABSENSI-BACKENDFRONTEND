@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Riwayat Penilaian</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Riwayat Penilaian</li>
            </ol>
        </nav>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 text-white" style="background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);">
                <span class="small text-white-50 text-uppercase">Total Penilaian</span>
                <h2 class="fw-bold mt-3">{{ $total }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 text-white" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <span class="small text-white-50 text-uppercase">Kompeten</span>
                <h2 class="fw-bold mt-3">{{ $kompetenCount }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 text-white" style="background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);">
                <span class="small text-white-50 text-uppercase">Belum Kompeten</span>
                <h2 class="fw-bold mt-3">{{ $belumCount }}</h2>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-4">
            <form action="{{ route('asesor.riwayat-penilaian') }}" method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Show</label>
                    <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small text-muted">Search</label>
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari nama peserta atau kode jadwal...">
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('asesor.riwayat-penilaian') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th>Nama Peserta</th>
                            <th>NIK / Username</th>
                            <th>Skema</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penilaians as $penilaian)
                            <tr>
                                <td class="fw-semibold text-dark">{{ $penilaian->user->name ?? '-' }}</td>
                                <td>{{ $penilaian->user->username ?? $penilaian->user->email ?? '-' }}</td>
                                <td>{{ $penilaian->jadwal->skema->nama_skema ?? '-' }}</td>
                                <td>
                                    <span class="badge px-3 py-2 text-white" style="background-color: {{ $penilaian->hasil === 'Kompeten' ? '#198754' : '#dc3545' }};">
                                        {{ $penilaian->hasil ?? 'Belum Dinilai' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('asesor.riwayat-penilaian.detail', $penilaian->id) }}" class="btn btn-sm btn-secondary px-3">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada data penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $penilaians->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection