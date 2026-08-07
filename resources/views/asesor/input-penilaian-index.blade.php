@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Input Penilaian</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Input Penilaian</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-4">
            <form action="{{ route('asesor.input-penilaian.index') }}" method="GET" class="row g-3 align-items-end mb-4">
                @if(request('jadwal_id'))
                    <input type="hidden" name="jadwal_id" value="{{ request('jadwal_id') }}">
                @endif
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
                    <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-outline-secondary btn-sm mt-1">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Peserta</th>
                            <th>Kelas</th>
                            <th>Status Kehadiran</th>
                            <th>Status Penilaian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas as $peserta)
                            @php
                                $attendance = $peserta->absensis->first();
                                $penilaian = $peserta->penilaians->first();
                                $attendanceStatus = $attendance->status ?? 'Belum Hadir';
                                $hasAttendance = strtolower($attendanceStatus) === 'hadir';
                                $penilaianStatus = $penilaian->hasil ?? 'Belum Dinilai';
                                $attendanceClass = $hasAttendance ? 'bg-success text-white' : ($attendanceStatus === 'Belum Hadir' ? 'bg-secondary text-white' : 'bg-warning text-dark');
                                $penilaianClass = $penilaian ? ($penilaian->hasil === 'Kompeten' ? 'bg-success text-white' : 'bg-danger text-white') : 'bg-secondary text-white';
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ($pesertas->firstItem() ? $pesertas->firstItem() - 1 : 0) }}</td>
                                <td class="fw-semibold text-dark">{{ $peserta->name ?? '-' }}</td>
                                <td>{{ $peserta->kelas ?? '-' }}</td>
                                <td>
                                    <span class="badge px-3 py-2 {{ $attendanceClass }}">
                                        {{ $attendanceStatus }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge px-3 py-2 {{ $penilaianClass }}">
                                        {{ $penilaianStatus }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($penilaian)
                                        <a href="{{ route('asesor.input-penilaian.detail', $penilaian->id) }}" class="btn btn-sm btn-secondary px-3">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                    @else
                                        <a href="{{ $hasAttendance ? route('asesor.input-penilaian.create', ['id' => $peserta->id, 'jadwal_id' => request('jadwal_id')]) : 'javascript:void(0)' }}"
                                           class="btn btn-sm {{ $hasAttendance ? 'btn-primary' : 'btn-secondary disabled' }} px-3"
                                           aria-disabled="{{ $hasAttendance ? 'false' : 'true' }}">
                                            <i class="bi bi-pencil-square me-1"></i> Input
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada peserta yang tersedia untuk jadwal ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $pesertas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection