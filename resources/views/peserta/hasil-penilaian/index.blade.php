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

    <!-- Card Utama Hasil Penilaian (Desain Abu-abu Elegan ala Figma) -->
    <div class="card border-0 shadow-sm rounded-4 bg-secondary bg-opacity-25 mb-5 p-4 p-md-4">
        <div class="card-body p-2">
            
            <!-- Bagian Atas Card: Skema Sertifikasi & Badge Kompeten -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pb-3 mb-4 border-bottom border-secondary border-opacity-50 gap-3">
                <div>
                    <span class="text-muted small d-block mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Skema Sertifikasi</span>
                    <h4 class="fw-bold text-dark mb-0" style="font-size: 1.5rem;">Junior Web Developer</h4>
                </div>
                <div>
                    <span class="badge bg-success bg-opacity-25 text-success border border-success px-4 py-2 fw-bold shadow-sm" style="font-size: 0.95rem;">
                        Kompeten
                    </span>
                </div>
            </div>

            <!-- Detail Informasi Penilaian -->
            <div class="row g-3 mb-4" style="font-size: 0.95rem;">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-sm-3 col-4 text-dark fw-semibold">Asesor</div>
                        <div class="col-sm-9 col-8 text-dark fw-bold">: Budi Santoso</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-3 col-4 text-dark fw-semibold">Tanggal Penilaian</div>
                        <div class="col-sm-9 col-8 text-dark fw-bold">: 20 Agustus 2026</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-3 col-4 text-dark fw-semibold">Hasil</div>
                        <div class="col-sm-9 col-8 text-success fw-bold">: KOMPETEN</div>
                    </div>
                </div>
            </div>

            <hr class="text-secondary opacity-50 mb-4">

            <!-- Bagian Catatan Asesor -->
            <div>
                <span class="fw-bold text-dark small d-block mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">Catatan</span>
                <div class="card border-0 shadow-sm rounded-3 bg-white p-3">
                    <p class="text-dark mb-0" style="font-size: 0.9rem;">
                        Peserta dinyatakan kompeten dan telah memenuhi seluruh kriteria penilaian.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection