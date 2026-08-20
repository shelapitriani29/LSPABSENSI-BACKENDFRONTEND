@extends('layouts.peserta')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title & Breadcrumb -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.75rem;">Hasil Penilaian</h3>
        <small class="text-muted d-block mb-2" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Hasil Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Alert / Banner Informasi -->
    <div class="alert border-0 shadow-sm rounded-3 mb-4 py-3 px-4" style="background-color: #e4edf8; color: #1b6ca8; font-size: 0.9rem;">
        Berikut adalah hasil penilaian sertifikasi Anda.
    </div>

    @php
        $latestPenilaian = $penilaian instanceof \Illuminate\Database\Eloquent\Collection
            ? $penilaian->sortByDesc('tanggal')->first()
            : ($penilaian ?? null);
    @endphp

    <!-- Card Utama Hasil Penilaian -->
    <div class="card border-0 shadow-sm rounded-4 bg-secondary bg-opacity-25 mb-5 p-4 p-md-4">
        <div class="card-body p-2">
            @if($latestPenilaian)
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pb-3 mb-4 border-bottom border-secondary border-opacity-50 gap-3">
                    <div>
                        <span class="text-muted small d-block mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Skema Sertifikasi</span>
                        <h4 class="fw-bold text-dark mb-0" style="font-size: 1.5rem;">{{ optional($latestPenilaian->jadwal->skema)->nama_skema ?? 'Skema tidak tersedia' }}</h4>
                    </div>
                    <div>
                        <span class="badge {{ $latestPenilaian->hasil === 'Kompeten' ? 'bg-success bg-opacity-25 text-success border border-success' : 'bg-danger bg-opacity-25 text-danger border border-danger' }} px-4 py-2 fw-bold shadow-sm" style="font-size: 0.95rem;">
                            {{ strtoupper($latestPenilaian->hasil ?? 'Selesai') }}
                        </span>
                    </div>
                </div>

                <div class="row g-3 mb-4" style="font-size: 0.95rem;">
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <div class="col-sm-3 col-4 text-dark fw-semibold">Asesor</div>
                            <div class="col-sm-9 col-8 text-dark fw-bold">: {{ optional($latestPenilaian->asesor)->name ?? 'Belum ditentukan' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3 col-4 text-dark fw-semibold">Tanggal Penilaian</div>
                            <div class="col-sm-9 col-8 text-dark fw-bold">: {{ $latestPenilaian->tanggal ? \Carbon\Carbon::parse($latestPenilaian->tanggal)->translatedFormat('j F Y') : '-' }}</div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-sm-3 col-4 text-dark fw-semibold">Hasil</div>
                            <div class="col-sm-9 col-8 {{ $latestPenilaian->hasil === 'Kompeten' ? 'text-success' : 'text-danger' }} fw-bold">: {{ strtoupper($latestPenilaian->hasil ?? '-') }}</div>
                        </div>
                    </div>
                </div>

                <hr class="text-secondary opacity-50 mb-4">

                <div>
                    <span class="fw-bold text-dark small d-block mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">Catatan</span>
                    <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                        <p class="text-dark mb-0" style="font-size: 0.9rem;">
                            {{ $latestPenilaian->catatan ?: 'Peserta dinyatakan kompeten dan telah memenuhi seluruh kriteria penilaian.' }}
                        </p>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="mb-2 fw-semibold text-dark">Belum ada hasil penilaian.</p>
                    <p class="text-muted small mb-0">Hasil penilaian akan ditampilkan setelah asesor menginput data penilaian.</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
