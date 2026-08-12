@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Halaman & Breadcrumb Tetap -->
    <div class="mt-2 mb-3">
        <h2 class="fw-bold text-dark">Dashboard</h2>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                <li class="breadcrumb-item"><a href="#" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Ucapan Selamat Datang -->
    <div class="card border-0 shadow-sm mt-3 mb-4 rounded-4">
        <div class="card-body py-3 px-4">
            <h5 class="fw-bold text-dark mb-1">Halo, {{ Auth::user()->name ?? 'User' }}</h5>
            <p class="text-muted small mb-0">Selamat Datang di Sistem Sertifikasi LSP</p>
        </div>
    </div>

    <!-- Kotak Statistik / Grid 4 Kartu Asesor -->
    <div class="row g-4 mb-4">
        
        <!-- Card 1: Jadwal Uji -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 55px; height: 55px; background-color: #e6f0fa; flex-shrink: 0;">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Jadwal Uji</span>
                            <h3 class="fw-bold text-dark mb-1">{{ $jadwalHariIniCount }}</h3>
                            <span class="text-muted small d-block mb-2">Jadwal Hari Ini</span>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top text-secondary small d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-calendar-event text-primary"></i> 20 Agustus 2026</span>
                        <span class="d-flex align-items-center gap-1"><i class="bi bi-clock text-primary"></i> 08.00 - 16.00 WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Peserta -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 55px; height: 55px; background-color: #e8f8f0; flex-shrink: 0;">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Peserta</span>
                            <h3 class="fw-bold text-dark mb-1">{{ $totalPeserta }}</h3>
                            <span class="text-muted small d-block mb-2">Peserta Terdaftar</span>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top text-secondary small">
                        Terdaftar pada jadwal uji hari ini
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Absensi -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 55px; height: 55px; background-color: #fef3c7; flex-shrink: 0;">
                            <i class="bi bi-clipboard-check fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Absensi</span>
                            <h3 class="fw-bold text-dark mb-1">{{ $absensiHadir }}</h3>
                            <span class="text-muted small d-block mb-2">Peserta Hadir</span>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top text-secondary small d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center gap-1 text-success fw-semibold"><span class="badge bg-success rounded-circle p-1" style="width: 6px; height: 6px;"></span> {{ $absensiHadir }} Hadir</span>
                        <span class="d-flex align-items-center gap-1 text-danger fw-semibold"><span class="badge bg-danger rounded-circle p-1" style="width: 6px; height: 6px;"></span> {{ $absensiBelum }} Belum Hadir</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Penilaian -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background-color: #f3e8ff; color: #6f42c1; flex-shrink: 0;">
                            <i class="bi bi-journal-check fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block mb-1">Penilaian</span>
                            <h3 class="fw-bold text-dark mb-1">{{ $penilaianDone }}</h3>
                            <span class="text-muted small d-block mb-2">Sudah Dinilai</span>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top text-secondary small d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center gap-1 fw-semibold" style="color: #6f42c1;"><span class="badge rounded-circle p-1" style="width: 6px; height: 6px; background-color: #6f42c1;"></span> {{ $penilaianDone }} Sudah Dinilai</span>
                        <span class="d-flex align-items-center gap-1 text-muted fw-semibold"><span class="badge bg-secondary rounded-circle p-1" style="width: 6px; height: 6px;"></span> {{ $penilaianPending }} Belum Dinilai</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="text-center text-muted small mt-5 pt-3 border-top">
    &copy; 2026 LSP P1 SMK NEGERI 1 GARUT. All rights reserved.
</div>
@endsection