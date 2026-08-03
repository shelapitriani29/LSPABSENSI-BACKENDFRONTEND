@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header: Judul, Sub-judul, Breadcrumb Berurutan, dan Tombol Kembali di Kanan -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">
                INPUT PENILAIAN PESERTA
            </h4>
            <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
            
            <!-- Breadcrumb di Bawah Tulisan LSP, Warna Hitam -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li> 
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Input Penilaian</li>
                </ol>
            </nav>
        </div>

        <!-- Tombol Kembali di Sebelah Kanan -->
        <div>
            <a href="{{ route('asesor.jadwal-asesmen.detail', 'SK003') }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #1e3a5f; border-color: #1e3a5f;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Tabel Input Penilaian dengan Header Warna Putih (Latar Belakang Biru Dihilangkan) -->
    <div class="card border shadow-sm rounded-3 overflow-hidden bg-white">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-file-earmark-text me-1 text-primary"></i> Input Penilaian Peserta</h6>
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

            <!-- Tabel Data dengan Garis Pemisah Lengkap (table-bordered) -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle m-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 70px;">No <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Nama Peserta <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Skema <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Kehadiran <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Status Penilaian <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="fw-semibold">Jenisa</td>
                            <td>JWD</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td>Belum Dinilai</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.input-penilaian.create', 1) }}" class="btn btn-sm px-3 text-white" style="background-color: #1e3a5f;">
                                    <i class="bi bi-pencil-square me-1"></i> [Input]
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="fw-semibold">Haura</td>
                            <td>JWD</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td>Belum Dinilai</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.input-penilaian.create', 2) }}" class="btn btn-sm px-3 text-white" style="background-color: #1e3a5f;">
                                    <i class="bi bi-pencil-square me-1"></i> [Input]
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="fw-semibold">Shela</td>
                            <td>UIUX</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td><span class="text-success fw-bold">Sudah Dinilai</span></td>
                            <td class="text-center">
                                <a href="{{ route('asesor.input-penilaian.detail', 3) }}" class="btn btn-secondary btn-sm px-3">
                                    <i class="bi bi-eye me-1"></i> [Detail]
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="fw-semibold">Aulia</td>
                            <td>JWD</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td>Belum Dinilai</td>
                            <td class="text-center">
                                <a href="{{ route('asesor.input-penilaian.create', 4) }}" class="btn btn-sm px-3 text-white" style="background-color: #1e3a5f;">
                                    <i class="bi bi-pencil-square me-1"></i> [Input]
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