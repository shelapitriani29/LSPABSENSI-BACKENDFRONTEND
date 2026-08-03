@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #212529;">Data Asesor</h3>
        <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-secondary">Referensi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Data Asesor</li>
            </ol>
        </nav>
    </div>

    <!-- Card Tabel Data Asesor -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-3">Data Asesor</h5>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2 small text-secondary">
                    <span>show</span>
                    <select class="form-select form-select-sm" style="width: 70px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entries</span>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <span class="small text-secondary">Search:</span>
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th scope="col" class="py-3 px-3" style="width: 5%;">No.</th>
                            <th scope="col" class="py-3">Nama Asesor</th>
                            <th scope="col" class="py-3">No. MET / Email</th>
                            <th scope="col" class="py-3">Bidang Keahlian / Skema</th>
                            <th scope="col" class="py-3 text-center" style="width: 10%;">Status</th>
                            <th scope="col" class="py-3 text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <tr>
                            <td class="px-3">1.</td>
                            <td>
                                <span class="fw-bold text-dark">Drs. H. Asep Saepudin, M.T.</span>
                            </td>
                            <td>
                                <div class="text-dark">MET.001.002341 2020</div>
                                <div class="text-secondary small">asep@smkn1garut.sch.id</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">Pemrograman Perangkat Lunak</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success px-3 py-1 rounded-pill">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #337ab7;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.asesor.show', 1) }}"><i class="bi bi-eye me-2 text-info"></i> Detail</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.asesor.edit', 1) }}"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3">2.</td>
                            <td>
                                <span class="fw-bold text-dark">Siti Nurhayati, S.Kom., M.Pd.</span>
                            </td>
                            <td>
                                <div class="text-dark">MET.001.002342 2021</div>
                                <div class="text-secondary small">siti@smkn1garut.sch.id</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">Jaringan Komputer & Server</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success px-3 py-1 rounded-pill">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #337ab7;">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.asesor.show', 2) }}"><i class="bi bi-eye me-2 text-info"></i> Detail</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('admin.asesor.edit', 2) }}"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Posisi Tengah -->
            <div class="d-flex justify-content-center align-items-center mt-4">
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        <li class="page-item active"><span class="page-link text-white border-0" style="background-color: #1b6ca8;">1</span></li>
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection