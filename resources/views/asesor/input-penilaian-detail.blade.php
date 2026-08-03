@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header: Judul, Sub-judul, Breadcrumb Berurutan, dan Tombol Kembali di Kanan -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">
                DETAIL PENILAIAN PESERTA
            </h4>
            <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
            
            <!-- Breadcrumb di Bawah Tulisan LSP, Warna Hitam -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li> 
                    <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-dark text-decoration-none">Input Penilaian</a></li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Detail Penilaian Peserta</li>
                </ol>
            </nav>
        </div>

        <!-- Tombol Kembali di Sebelah Kanan dengan Style yang Sesuai Contoh -->
        <div>
            <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #1E6388">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Informasi Peserta -->
    <div class="card border shadow-sm rounded-3 overflow-hidden bg-white mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-person-badge me-1 text-primary"></i> Informasi Peserta</h6>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4">
                    <span class="text-muted small d-block">NAMA PESERTA</span>
                    <h5 class="fw-bold text-dark mb-0">Shela</h5>
                </div>
                <div class="col-md-4">
                    <span class="text-muted small d-block">SKEMA</span>
                    <h5 class="fw-bold text-dark mb-0">UI/UX Designer</h5>
                </div>
                <div class="col-md-4">
                    <span class="text-muted small d-block">STATUS AKHIR</span>
                    <span class="badge bg-success px-3 py-2 mt-1">Kompeten (K)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Penilaian Unit Kompetensi -->
    <div class="card border shadow-sm rounded-3 overflow-hidden bg-white">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-file-earmark-text me-1 text-primary"></i> Hasil Penilaian Unit Kompetensi</h6>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle m-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 70px;">No</th>
                            <th style="width: 200px;">Kode Unit</th>
                            <th>Judul Unit Kompetensi</th>
                            <th class="text-center" style="width: 150px;">Hasil Penilaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">J.620100.001.01</td>
                            <td>Menerapkan Prinsip Dasar Desain Antarmuka</td>
                            <td class="text-center"><span class="badge bg-success">Kompeten (K)</span></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="fw-semibold">J.620100.002.02</td>
                            <td>Membuat Wireframe dan Prototype</td>
                            <td class="text-center"><span class="badge bg-success">Kompeten (K)</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection