@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Verifikasi Kehadiran</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Verifikasi Kehadiran</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
        <div class="card-body p-4">
            <form action="{{ route('asesor.verifikasi-kehadiran') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label small text-muted">Pilih Jadwal</label>
                        <select name="jadwal_id" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Semua Jadwal</option>
                            @foreach($jadwals as $jadwalItem)
                                <option value="{{ $jadwalItem->id }}" {{ request('jadwal_id') == $jadwalItem->id ? 'selected' : '' }}>
                                    {{ $jadwalItem->kode_jadwal }} - {{ $jadwalItem->skema->nama_skema ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label small text-muted">Search</label>
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari peserta, kelas, username...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label small text-muted">Show</label>
                        <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <!-- Tombol 'Terapkan' dihilangkan sesuai permintaan -->
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="text-center" style="width: 5%;">No.</th>
                            <th>Peserta</th>
                            <th>NIK / Username</th>
                            <th>Kelas</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas as $key => $peserta)
                            @php
                                $attendance = $peserta->absensis->first();
                                $status = $attendance->status ?? 'Belum Absen';
                                $badgeClass = match(strtolower($status)) {
                                    'hadir' => 'bg-success',
                                    'terlambat' => 'bg-warning text-dark',
                                    'izin', 'sakit' => 'bg-info text-dark',
                                    'tidak hadir' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <tr>
                                <td class="text-center">{{ $pesertas->firstItem() + $key }}.</td>
                                <td class="fw-semibold text-dark">{{ $peserta->name ?? '-' }}</td>
                                <td>{{ $peserta->username ?? $peserta->nik ?? '-' }}</td>
                                <td>{{ $peserta->kelas ?? '-' }}</td>
                                <td>{{ optional($attendance)->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H.i') : '-' }}</td>
                                <td>{{ optional($attendance)->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H.i') : '-' }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $badgeClass }} px-3 py-2">{{ $status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Tidak ada data peserta.</td>
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