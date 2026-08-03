@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header: Judul, Sub-judul, Breadcrumb Berurutan -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">RIWAYAT PENILAIAN</h4>
        <small class="text-muted d-block mb-2">LSP P1 - SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb di Bawah Tulisan LSP, Warna Hitam -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Riwayat Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Statistik Cards dengan Desain Menarik (Ikon, Gradasi Elegan, dan Aksen Border Kiri) -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-white rounded-3 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%); border-left: 5px solid #63b3ed !important;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-uppercase tracking-wider opacity-75">TOTAL PESERTA</span>
                        <h2 class="fw-bold mb-0 mt-1">120</h2>
                    </div>
                    <div class="rounded-circle p-3 bg-white bg-opacity-10 text-white">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-white rounded-3 position-relative overflow-hidden" style="background: linear-gradient(135deg, #2b6cb0 0%, #3182ce 100%); border-left: 5px solid #9ae6b4 !important;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-uppercase tracking-wider opacity-75">KOMPETEN</span>
                        <h2 class="fw-bold mb-0 mt-1">105</h2>
                    </div>
                    <div class="rounded-circle p-3 bg-white bg-opacity-10 text-white">
                        <i class="bi bi-patch-check-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-white rounded-3 position-relative overflow-hidden" style="background: linear-gradient(135deg, #2f855a 0%, #38a169 100%); border-left: 5px solid #68d391 !important;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-uppercase tracking-wider opacity-75">BELUM KOMPETEN</span>
                        <h2 class="fw-bold mb-0 mt-1">15</h2>
                    </div>
                    <div class="rounded-circle p-3 bg-white bg-opacity-10 text-white">
                        <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Riwayat Penilaian -->
    <div class="card border shadow-sm rounded-3 overflow-hidden bg-white">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-clock-history me-1 text-primary"></i> DAFTAR RIWAYAT PENILAIAN PESERTA</h6>
        </div>
        <div class="card-body p-4">
            
            <!-- Filter & Search Bar -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">Show</span>
                    <select class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-muted small">entries</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">Search:</span>
                    <input type="text" class="form-control form-control-sm" placeholder="">
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle m-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peserta <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>NIK <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Skema <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Kehadiran <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Status Penilaian <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-semibold">Aulia</td>
                            <td>3201</td>
                            <td>JWD</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td><span class="text-success fw-bold">Kompeten</span></td>
                            <td class="text-center fw-bold">90</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.riwayat-penilaian.detail', 1) }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #1e3a5f; border-color: #1e3a5f;">
                                    <i class="bi bi-eye me-1"></i> [Detail]
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Haura</td>
                            <td>3202</td>
                            <td>JWD</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td><span class="text-muted">Belum Dinilai</span></td>
                            <td class="text-center">-</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.riwayat-penilaian.detail', 2) }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #1e3a5f; border-color: #1e3a5f;">
                                    <i class="bi bi-eye me-1"></i> [Detail]
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Jenisa</td>
                            <td>3203</td>
                            <td>JP</td>
                            <td><span class="badge bg-danger">Tidak Hadir</span></td>
                            <td><span class="text-muted">Belum Dinilai</span></td>
                            <td class="text-center">-</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.riwayat-penilaian.detail', 3) }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #1e3a5f; border-color: #1e3a5f;">
                                    <i class="bi bi-eye me-1"></i> [Detail]
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Shela</td>
                            <td>3204</td>
                            <td>DBA</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td><span class="text-success fw-bold">Kompeten</span></td>
                            <td class="text-center fw-bold">88</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.riwayat-penilaian.detail', 4) }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #1e3a5f; border-color: #1e3a5f;">
                                    <i class="bi bi-eye me-1"></i> [Detail]
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginasi di Tengah -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link text-white" href="#" style="background-color: #1e3a5f; border-color: #1e3a5f;">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" style="color: #1e3a5f;">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection