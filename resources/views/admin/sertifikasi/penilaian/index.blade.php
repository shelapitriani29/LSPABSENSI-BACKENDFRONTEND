@extends('layouts.app')

@section('content')
<div class="container-fluid px-2">
    <!-- Header Page dengan Breadcrumb hitam & Subtitle LSP -->
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">Hasil Asesmen</h4>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Sertifikasi</span></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Statistik Cards dengan Background Keren -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase">Total Peserta</span>
                        <h2 class="fw-bold mt-1 mb-0">36</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase">Kompeten</span>
                        <h2 class="fw-bold mt-1 mb-0">30</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-patch-check"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase">Belum Kompeten</span>
                        <h2 class="fw-bold mt-1 mb-0">6</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-exclamation-triangle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Filter & Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-3">Filter Hasil</h5>
            
            <!-- Filter Bar -->
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Skema</label>
                    <select class="form-select form-select-sm">
                        <option value="">Semua Skema</option>
                        <option value="1">Junior Web Developer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Jadwal</label>
                    <select class="form-select form-select-sm">
                        <option value="">Semua Jadwal</option>
                        <option value="1">JWD-001</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Asesor</label>
                    <select class="form-select form-select-sm">
                        <option value="">Semua Asesor</option>
                        <option value="1">Budi Santoso</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Hasil</label>
                    <select class="form-select form-select-sm">
                        <option value="">Semua Hasil</option>
                        <option value="kompeten">Kompeten</option>
                        <option value="belum">Belum Kompeten</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama peserta...">
                    </div>
                </div>
                <div class="col-md-auto">
                    <button class="btn btn-light btn-sm text-secondary border">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
                    </button>
                </div>
            </div>

            <!-- Entries Option -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="small text-muted">Show</span>
                    <select class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                    <span class="small text-muted">Entries</span>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-secondary">
                        <tr>
                            <th class="py-3" style="width: 5%;">No</th>
                            <th class="py-3">Peserta</th>
                            <th class="py-3">Skema</th>
                            <th class="py-3">Asesor</th>
                            <th class="py-3" style="width: 15%;">Hasil</th>
                            <th class="py-3 text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="fw-semibold text-dark">Jenisa</td>
                            <td>Junior Web Developer</td>
                            <td>Budi Santoso</td>
                            <td><span class="badge px-3 py-2 text-success fw-semibold" style="background-color: #d1e7dd;">Kompeten</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary px-3 shadow-sm rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list text-white"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow-sm border-0">
                                        <li><a class="dropdown-item small" href="{{ route('admin.sertifikasi.penilaian.show', 1) }}"><i class="bi bi-eye text-info me-2"></i> Detail</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="fw-semibold text-dark">Aulia</td>
                            <td>Junior Web Developer</td>
                            <td>Budi Santoso</td>
                            <td><span class="badge px-3 py-2 text-success fw-semibold" style="background-color: #d1e7dd;">Kompeten</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary px-3 shadow-sm rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list text-white"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow-sm border-0">
                                        <li><a class="dropdown-item small" href="{{ route('admin.sertifikasi.penilaian.show', 2) }}"><i class="bi bi-eye text-info me-2"></i> Detail</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="fw-semibold text-dark">Siti</td>
                            <td>Junior Web Developer</td>
                            <td>Budi Santoso</td>
                            <td><span class="badge px-3 py-2 text-danger fw-semibold" style="background-color: #f8d7da;">Belum</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary px-3 shadow-sm rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list text-white"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow-sm border-0">
                                        <li><a class="dropdown-item small" href="{{ route('admin.sertifikasi.penilaian.show', 3) }}"><i class="bi bi-eye text-info me-2"></i> Detail</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="fw-semibold text-dark">Raka</td>
                            <td>Junior Web Developer</td>
                            <td>Budi Santoso</td>
                            <td><span class="badge px-3 py-2 text-success fw-semibold" style="background-color: #d1e7dd;">Kompeten</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary px-3 shadow-sm rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list text-white"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow-sm border-0">
                                        <li><a class="dropdown-item small" href="{{ route('admin.sertifikasi.penilaian.show', 4) }}"><i class="bi bi-eye text-info me-2"></i> Detail</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination di Tengah ala Contoh -->
            <div class="d-flex justify-content-center align-items-center mt-4 pt-3 border-top">
                <nav>
                    <ul class="pagination pagination-sm mb-0 shadow-sm rounded-3 overflow-hidden">
                        <li class="page-item"><a class="page-link text-secondary bg-light border-0 px-3 py-2" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link text-white border-0 px-3 py-2" href="#" style="background-color: #2b70c9;">1</a></li>
                        <li class="page-item"><a class="page-link text-secondary bg-light border-0 px-3 py-2" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection