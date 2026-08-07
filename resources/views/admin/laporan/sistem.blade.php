@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1100px;">
    <!-- Header Page -->
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">Laporan Sistem</h4>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Laporan</span></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Laporan Sistem</li>
            </ol>
        </nav>
    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
        <div class="row g-3 align-items-center">
            <form id="laporanFilterForm" action="{{ route('admin.laporan.sistem') }}" method="GET" class="row g-3 w-100">
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Periode</label>
                    <select name="periode" class="form-select form-select-sm">
                        <option value="">Semua Periode</option>
                        @foreach($periodeOptions as $value => $label)
                            <option value="{{ $value }}" {{ request('periode') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Skema</label>
                    <select name="skema_id" class="form-select form-select-sm">
                        <option value="">Semua Skema</option>
                        @foreach($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ request('skema_id') == $skema->id ? 'selected' : '' }}>{{ $skema->nama_skema }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Hasil</label>
                    <select name="hasil" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="Kompeten" {{ request('hasil') === 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                        <option value="Belum Kompeten" {{ request('hasil') === 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                    </select>
                </div>
                <div class="col-md-3 text-md-end d-flex align-items-end justify-content-end gap-2">
                    <a href="{{ route('admin.laporan.sistem.export', request()->except('page')) }}" class="btn btn-primary btn-sm px-3 shadow-sm" style="background-color: #2b70c9; border-color: #2b70c9;">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Rekap Hasil Sertifikasi -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <h6 class="fw-bold text-dark mb-3">Rekap Hasil Sertifikasi</h6>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-1 small text-muted">
                Show 
                <select name="per_page" form="laporanFilterForm" class="form-select form-select-sm d-inline-block w-auto mx-1">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select> 
                entries
            </div>
            <div class="d-flex align-items-center gap-1 small text-muted">
                Search: <input type="search" name="search" form="laporanFilterForm" value="{{ request('search') }}" class="form-control form-control-sm d-inline-block w-auto" placeholder="Cari peserta, skema, atau asesor...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle small">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Peserta</th>
                        <th>Skema Sertifikasi</th>
                        <th>Jadwal Uji</th>
                        <th>Asesor</th>
                        <th>Kehadiran</th>
                        <th>Hasil</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaians as $index => $item)
                        @php
                            $attendance = $attendanceMap[$item->user_id . '_' . $item->jadwal_id] ?? null;
                            $attendanceStatus = $attendance->status ?? 'Tidak Hadir';
                            $attendanceClass = strtolower($attendanceStatus) === 'hadir' ? 'bg-success-subtle text-success' : (strtolower($attendanceStatus) === 'tidak hadir' ? 'bg-danger-subtle text-danger' : 'bg-secondary text-dark');
                            $resultClass = strtolower($item->hasil) === 'kompeten' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger';
                        @endphp
                        <tr>
                            <td class="text-center">{{ $penilaians->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ optional($item->user)->name ?? '-' }}</td>
                            <td>{{ optional($item->jadwal->skema)->nama_skema ?? '-' }}</td>
                            <td class="text-center">
                                {{ optional($item->jadwal)->tanggal ? \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d/m/Y') : '-' }}<br>
                                <span class="text-muted small">{{ optional($item->jadwal)->jam_mulai ?? '-' }} - {{ optional($item->jadwal)->jam_selesai ?? '-' }}</span>
                            </td>
                            <td>{{ optional($item->asesor)->name ?? '-' }}</td>
                            <td class="text-center"><span class="badge {{ $attendanceClass }} px-2 py-1">{{ $attendanceStatus }}</span></td>
                            <td class="text-center"><span class="badge {{ $resultClass }} px-2 py-1">{{ $item->hasil }}</span></td>
                            <td class="text-center fw-semibold text-dark">{{ optional($item->sertifikat)->no_sertifikat ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Tidak ada data sertifikasi untuk filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Terpusat (Hanya Menampilkan Previous, 1, Next) -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#" style="background-color: #2b70c9; border-color: #2b70c9;">1</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection