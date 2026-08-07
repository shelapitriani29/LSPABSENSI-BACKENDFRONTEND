@extends('layouts.peserta')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="mt-2 mb-3">
        <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Hasil Penilaian</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Hasil Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Informasi -->
    <div class="alert border-0 bg-primary bg-opacity-10 text-primary d-flex align-items-center mb-4 rounded-3 py-3 px-3 shadow-sm" role="alert" style="font-size: 0.9rem;">
        <i class="bi bi-info-circle fs-5 me-2"></i>
        <div>
            Berikut adalah hasil penilaian sertifikasi Anda.
        </div>
    </div>

    <!-- Card Hasil Penilaian -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            
            @if($penilaian)
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center pb-3 mb-4 border-bottom gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; font-size: 1.75rem;">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div>
                            <span class="text-muted d-block" style="font-size: 0.8rem;">Skema Sertifikasi</span>
                            <h4 class="fw-bold text-dark mb-0">{{ optional($penilaian->jadwal->skema)->nama_skema ?? 'Skema tidak tersedia' }}</h4>
                        </div>
                    </div>
                    <div>
                        <span class="badge {{ $penilaian->hasil === 'Kompeten' ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }} px-3 py-2 rounded-pill fw-bold d-inline-flex align-items-center gap-1" style="font-size: 0.85rem;">
                            <i class="bi bi-check-circle-fill"></i> {{ strtoupper($penilaian->hasil ?? 'Selesai') }}
                        </span>
                    </div>
                </div>

                <div class="mb-4" style="font-size: 0.95rem;">
                    <div class="row mb-2">
                        <div class="col-md-3 col-4 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-person fs-5 text-secondary"></i> Asesor
                        </div>
                        <div class="col-md-9 col-8 fw-semibold text-dark">
                            : {{ optional($penilaian->asesor)->name ?? 'Belum ditentukan' }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-4 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-calendar-event fs-5 text-secondary"></i> Tanggal Penilaian
                        </div>
                        <div class="col-md-9 col-8 fw-semibold text-dark">
                            : {{ $penilaian->tanggal ? \Carbon\Carbon::parse($penilaian->tanggal)->translatedFormat('j F Y') : '-' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-4 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-award fs-5 text-secondary"></i> Hasil
                        </div>
                        <div class="col-md-9 col-8 fw-semibold {{ $penilaian->hasil === 'Kompeten' ? 'text-success' : 'text-danger' }}">
                            : {{ strtoupper($penilaian->hasil ?? '-') }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="mb-2 fw-semibold">Belum ada hasil penilaian.</p>
                    <p class="text-muted small mb-0">Hasil penilaian akan ditampilkan setelah asesor menginput data penilaian.</p>
                </div>
            @endif

            <!-- Bagian Catatan -->
            <div class="border-top pt-3">
                <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-semibold" style="font-size: 0.9rem;">
                    <i class="bi bi-journal-text text-secondary"></i> Catatan
                </div>
                <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-secondary" style="font-size: 0.85rem;">
                    Peserta dinyatakan kompeten setelah mengikuti seluruh proses uji kompetensi sesuai dengan skema sertifikasi.
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Footer -->
<div class="text-center text-muted small mt-5 pt-3 border-top">
    &copy; 2026 LSP P1 SMK NEGERI 1 GARUT. All rights reserved.
</div>
@endsection