@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Detail Penilaian</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-dark text-decoration-none">Input Penilaian</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Detail Penilaian</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
        <div class="card-body p-4">
            <div class="row gy-4">
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3">Informasi Peserta</h5>
                    <div class="row mb-2">
                        <div class="col-5 text-muted small">Nama Peserta</div>
                        <div class="col-7 fw-semibold text-dark">: {{ $penilaian->user->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted small">Username</div>
                        <div class="col-7 fw-semibold text-dark">: {{ $penilaian->user->username ?? $penilaian->user->email ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted small">Skema</div>
                        <div class="col-7 fw-semibold text-dark">: {{ $penilaian->jadwal->skema->nama_skema ?? '-' }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-5 text-muted small">Asesor</div>
                        <div class="col-7 fw-semibold text-dark">: {{ $penilaian->asesor->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3">Hasil Penilaian</h5>
                    <div class="row mb-2">
                        <div class="col-5 text-muted small">Hasil</div>
                        <div class="col-7 fw-semibold text-dark">: {{ $penilaian->hasil ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted small">Tanggal</div>
                        <div class="col-7 fw-semibold text-dark">: {{ $penilaian->tanggal ? \Carbon\Carbon::parse($penilaian->tanggal)->translatedFormat('d F Y') : '-' }}</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-5 text-muted small">Catatan</div>
                        <div class="col-7 text-dark">: {{ $penilaian->catatan ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-end mb-4">
        <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-secondary px-4 py-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection