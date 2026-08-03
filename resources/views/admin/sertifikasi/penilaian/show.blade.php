@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 900px;">
    <!-- Header Page dengan Breadcrumb hitam & Subtitle LSP -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Detail Hasil Asesmen</h4>
            <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-decoration-none text-muted">Sertifikasi</span></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="text-decoration-none text-muted">Penilaian</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Detail Hasil Asesmen</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="btn btn-primary px-3 shadow-sm" style="background-color: #2b70c9; border-color: #2b70c9;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Informasi Peserta Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark text-uppercase small mb-3">Informasi Peserta</h6>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Nama Peserta</div>
                <div class="col-md-8 fw-semibold text-dark">: Jenisa Nurfadillah</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">NISN</div>
                <div class="col-md-8 fw-semibold text-dark">: 123456789</div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 text-muted small">Kelas</div>
                <div class="col-md-8 fw-semibold text-dark">: XI RPL 1</div>
            </div>
        </div>
    </div>

    <!-- Informasi Asesmen Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark text-uppercase small mb-3">Informasi Asesmen</h6>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Skema</div>
                <div class="col-md-8 fw-semibold text-dark">: Junior Web Developer</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Kode Jadwal</div>
                <div class="col-md-8 fw-semibold text-dark">: JWD-001</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Tanggal</div>
                <div class="col-md-8 fw-semibold text-dark">: 30 Juli 2026</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Waktu</div>
                <div class="col-md-8 fw-semibold text-dark">: 08.00 - 12.00</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Lokasi</div>
                <div class="col-md-8 fw-semibold text-dark">: Lab Komputer 1</div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 text-muted small">Asesor</div>
                <div class="col-md-8 fw-semibold text-dark">: Budi Santoso</div>
            </div>
        </div>
    </div>

    <!-- Hasil Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark text-uppercase small mb-3">Hasil</h6>
            <div class="row mb-3">
                <div class="col-md-4 text-muted small">Status</div>
                <div class="col-md-8">
                    <span class="badge px-3 py-2 text-success fw-semibold" style="background-color: #d1e7dd;">KOMPETEN</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted small">Catatan Asesor</div>
                <div class="col-md-8">
                    <div class="p-3 bg-light rounded-3 text-secondary small border">
                        Peserta memenuhi kompetensi yang dipersyaratkan.
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Tanggal Penilaian</div>
                <div class="col-md-8 fw-semibold text-dark">: 30 Juli 2026</div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 text-muted small">Status Sertifikat</div>
                <div class="col-md-8 fw-semibold text-muted">: Belum Diterbitkan</div>
            </div>
        </div>
    </div>
</div>
@endsection