@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title & Breadcrumb -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.75rem;">Pilih Jadwal</h3>
        <small class="text-muted d-block mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Input Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Informasi Instruksi -->
    <div class="alert alert-primary bg-primary bg-opacity-10 border-0 text-primary small p-3 mb-4 rounded-3 d-flex align-items-center gap-2">
        <i class="bi bi-info-circle-fill fs-5 flex-shrink-0"></i>
        <span>Pilih jadwal uji untuk melihat daftar peserta dan melakukan penilaian.</span>
    </div>

    <!-- Card Container Utama -->
    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-4">
            
            <!-- Header Card & Search Bar -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <h5 class="fw-bold text-dark mb-0">Daftar Jadwal Uji</h5>
                <form action="{{ route('asesor.input-penilaian.index') }}" method="GET" class="w-auto" style="min-width: 280px;">
                    <div class="input-group input-group-sm">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari skema, kelas, lokasi...">
                        @if(request('search'))
                            <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Tabel Daftar Jadwal Uji -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Skema Sertifikasi</th>
                            <th>Kelas</th>
                            <th>Tanggal Uji</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th class="text-center">Peserta</th>
                            <th>Status Penilaian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals ?? [] as $jadwal)
                            <tr>
                                <td class="text-center">
                                    {{ method_exists($jadwals, 'firstItem') && $jadwals->firstItem() ? $loop->iteration + $jadwals->firstItem() - 1 : $loop->iteration }}
                                </td>
                                <td class="fw-semibold text-dark">{{ $jadwal->skema->nama ?? $jadwal->nama_skema ?? 'JWD' }}</td>
                                <td>{{ $jadwal->kelas ?? 'XI PPL 1' }}</td>
                                <td>{{ $jadwal->tanggal_uji ?? '07-08-2026' }}</td>
                                <td>{{ $jadwal->waktu ?? '08.00-12.00' }}</td>
                                <td>{{ $jadwal->lokasi ?? 'Lab Komputer 1' }}</td>
                                <td class="text-center fw-semibold">{{ $jadwal->peserta_count ?? 15 }}</td>
                                <td>
                                    <span class="badge text-dark fw-semibold px-2 py-2 rounded-2 border border-warning" style="background-color: #fff3cd !important;">
                                        {{ $jadwal->status_penilaian ?? '10 / 15 Dinilai' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('asesor.jadwal-asesmen.lihat-peserta', $jadwal->id ?? 1) }}" class="btn btn-sm text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                        Lihat Peserta
                                    </a>
                                </td>
                            </tr>
                        @empty
                            {{-- Data dummy persis seperti tampilan referensi Figma --}}
                            <tr>
                                <td class="text-center">1.</td>
                                <td class="fw-semibold text-dark">JWD</td>
                                <td>XI PPL 1</td>
                                <td>07-08-2026</td>
                                <td>08.00-12.00</td>
                                <td>Lab Komputer 1</td>
                                <td class="text-center fw-semibold">15</td>
                                <td>
                                    <span class="badge text-dark fw-semibold px-2 py-2 rounded-2 border border-warning" style="background-color: #fff3cd !important;">
                                        10 / 15 Dinilai
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                        Lihat Peserta
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2.</td>
                                <td class="fw-semibold text-dark">JWD</td>
                                <td>XI PPL 2</td>
                                <td>07-08-2026</td>
                                <td>08.00-12.00</td>
                                <td>Lab Komputer 1</td>
                                <td class="text-center fw-semibold">14</td>
                                <td>
                                    <span class="badge text-dark fw-semibold px-2 py-2 rounded-2 border border-warning" style="background-color: #fff3cd !important;">
                                        8 / 14 Dinilai
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                        Lihat Peserta
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3.</td>
                                <td class="fw-semibold text-dark">JA</td>
                                <td>XI DKV 1</td>
                                <td>08-08-2026</td>
                                <td>08.00-12.00</td>
                                <td>Lab Komputer 2</td>
                                <td class="text-center fw-semibold">12</td>
                                <td>
                                    <span class="badge text-dark fw-semibold px-2 py-2 rounded-2 border border-warning" style="background-color: #fff3cd !important;">
                                        0 / 12 Dinilai
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                        Lihat Peserta
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4.</td>
                                <td class="fw-semibold text-dark">DG</td>
                                <td>XI DKV 2</td>
                                <td>09-08-2026</td>
                                <td>09.00-13.00</td>
                                <td>Lab Komputer 3</td>
                                <td class="text-center fw-semibold">16</td>
                                <td>
                                    <span class="badge text-dark fw-semibold px-2 py-2 rounded-2 border border-warning" style="background-color: #fff3cd !important;">
                                        5 / 16 Dinilai
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                        Lihat Peserta
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination jika tersedia -->
            @if(isset($jadwals) && method_exists($jadwals, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $jadwals->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection