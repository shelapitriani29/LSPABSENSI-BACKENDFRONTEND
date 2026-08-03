@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Judul Halaman, Sub-judul, dan Breadcrumb Sesuai Contoh Data Asesor -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Daftar Peserta</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-dark text-decoration-none">Sertifikasi</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Daftar Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Tabel Daftar Peserta -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
        <!-- Card Header Diubah Menjadi Putih -->
        <div class="card-header bg-white py-3 border-bottom">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-people-fill me-1 text-primary"></i> Daftar Peserta Asesmen</h6>
        </div>
        <div class="card-body p-4">
            
            <!-- Filter & Search Bar -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">show</span>
                    <select class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-muted small">antrian</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">Search:</span>
                    <input type="text" class="form-control form-control-sm" placeholder="">
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peserta <i class="bi bi-arrow-down-up small text-muted"></i></th>
                            <th>Nik <i class="bi bi-arrow-down-up small text-muted"></i></th>
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
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="font-size: 0.85rem;">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.daftar-peserta.detail', 1) }}"><i class="bi bi-eye me-2 text-primary"></i> Detail Peserta</a></li>
                                    </ul>
                                </div>
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
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="font-size: 0.85rem;">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.daftar-peserta.detail', 2) }}"><i class="bi bi-eye me-2 text-primary"></i> Detail Peserta</a></li>
                                    </ul>
                                </div>
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
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="font-size: 0.85rem;">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.daftar-peserta.detail', 3) }}"><i class="bi bi-eye me-2 text-primary"></i> Detail Peserta</a></li>
                                    </ul>
                                </div>
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
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="font-size: 0.85rem;">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.daftar-peserta.detail', 4) }}"><i class="bi bi-eye me-2 text-primary"></i> Detail Peserta</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Nafis</td>
                            <td>3205</td>
                            <td>NA</td>
                            <td><span class="badge bg-success">Hadir</span></td>
                            <td><span class="text-danger fw-bold">Belum Kompeten</span></td>
                            <td class="text-center fw-bold">70</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="font-size: 0.85rem;">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.daftar-peserta.detail', 5) }}"><i class="bi bi-eye me-2 text-primary"></i> Detail Peserta</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Sinta</td>
                            <td>3206</td>
                            <td>DM</td>
                            <td><span class="badge bg-warning text-dark">Terlambat</span></td>
                            <td><span class="text-muted">Belum Dinilai</span></td>
                            <td class="text-center">-</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow border-0" style="font-size: 0.85rem;">
                                        <li><a class="dropdown-item py-2" href="{{ route('asesor.daftar-peserta.detail', 6) }}"><i class="bi bi-eye me-2 text-primary"></i> Detail Peserta</a></li>
                                    </ul>
                                </div>
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
                        <li class="page-item active"><a class="page-link text-white" href="#" style="background-color: #2b70c9; border-color: #2b70c9;">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" style="color: #2b70c9;">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection