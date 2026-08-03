@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header: Judul, Sub-judul, dan Breadcrumb Berurutan ke Bawah, serta Tombol Kembali di Kanan -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">DETAIL PESERTA</h4>
            <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
            
            <!-- Breadcrumb di Bawah Tulisan LSP -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.daftar-peserta') }}" class="text-dark text-decoration-none">Sertifikasi</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.daftar-peserta') }}" class="text-dark text-decoration-none">Daftar Peserta</a></li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Detail Peserta</li>
                </ol>
            </nav>
        </div>

        <!-- Tombol Kembali di Sebelah Kanan -->
        <div>
            <a href="{{ route('asesor.daftar-peserta') }}" class="btn btn-sm px-3 shadow-sm text-white" style="background-color: #1e3a5f; border-color: #1e3a5f;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Card Detail Peserta -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header text-white py-3" style="background-color: #1e3a5f !important;">
            <h6 class="mb-0 fw-bold"><i class="bi bi-person-badge me-1"></i> INFORMASI DETAIL PESERTA</h6>
        </div>
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">Nama</div>
                <div class="col-md-9 text-dark fw-bold">: Jenisa</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">NISN / NIK</div>
                <div class="col-md-9 text-dark">: 23100001</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">Jenis Kelamin</div>
                <div class="col-md-9 text-dark">: Perempuan</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">Kelas</div>
                <div class="col-md-9 text-dark">: XI RPL 1</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">Skema</div>
                <div class="col-md-9 text-dark">: Junior Web Developer</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">Status Kehadiran</div>
                <div class="col-md-9">: <span class="badge bg-success">Hadir</span></div>
            </div>
            <div class="row mb-0">
                <div class="col-md-3 fw-semibold text-muted">Status Penilaian</div>
                <div class="col-md-9 text-success fw-bold">: Sudah Dinilai</div>
            </div>
        </div>
    </div>
</div>
@endsection