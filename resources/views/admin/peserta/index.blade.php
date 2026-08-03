@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Halaman -->
    <div class="mt-4 mb-2">
        <h1 class="h3 fw-bold text-dark">Data Peserta</h1>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Data Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Card Utama -->
    <div class="card border-0 shadow-sm mt-3 mb-4">
        <div class="card-body">
            
            <!-- Judul Tabel di Dalam Card -->
            <h4 class="fw-bold text-dark mb-3">Data Peserta</h4>

            <!-- Baris Kontrol: Show Entries & Search -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">show</span>
                    <select class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-muted small">entries</span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-dark small">Search:</span>
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" class="form-control rounded-2">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" width="100%" cellspacing="0">
                    <thead class="table-light text-dark fw-bold">
                        <tr>
                            <th width="6%" class="text-center py-3">NO.</th>
                            <th class="py-3">NIK</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Instansi</th>
                            <th class="py-3">No.HP</th>
                            <th width="12%" class="text-center py-3">Status</th>
                            <th width="12%" class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris 1 -->
                        <tr>
                            <td class="text-center fw-semibold">1.</td>
                            <td>3201xxxx</td>
                            <td>Haura</td>
                            <td>smkn 1 garut</td>
                            <td>08123xxxx</td>
                            <td class="text-center">
                                <span id="status-badge-1" class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                        <i class="bi bi-list fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="min-width: 160px;">
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', 1) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li> 
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', 1) }}"><i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data</a></li> 
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 2 -->
                        <tr>
                            <td class="text-center fw-semibold">2.</td>
                            <td>3201xxxx</td>
                            <td>Jenisa</td>
                            <td>smkn 1 garut</td>
                            <td>08123xxxx</td>
                            <td class="text-center">
                                <span id="status-badge-2" class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                        <i class="bi bi-list fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="min-width: 160px;">
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', 2) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li>
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', 2) }}"><i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 3 -->
                        <tr>
                            <td class="text-center fw-semibold">3.</td>
                            <td>3201xxxx</td>
                            <td>Shela</td>
                            <td>smkn 1 garut</td>
                            <td>08123xxxx</td>
                            <td class="text-center">
                                <span id="status-badge-3" class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                        <i class="bi bi-list fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="min-width: 160px;">
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', 3) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li>
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', 3) }}"><i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 4 -->
                        <tr>
                            <td class="text-center fw-semibold">4.</td>
                            <td>3201xxxx</td>
                            <td>Aulia</td>
                            <td>smkn 1 garut</td>
                            <td>08123xxxx</td>
                            <td class="text-center">
                                <span id="status-badge-4" class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                        <i class="bi bi-list fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="min-width: 160px;">
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', 4) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li>
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', 4) }}"><i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 5 -->
                        <tr>
                            <td class="text-center fw-semibold">5.</td>
                            <td>3201xxxx</td>
                            <td>Nafis</td>
                            <td>smkn 1 garut</td>
                            <td>08123xxxx</td>
                            <td class="text-center">
                                <span id="status-badge-5" class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                        <i class="bi bi-list fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="min-width: 160px;">
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', 5) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li>
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', 5) }}"><i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 6 -->
                        <tr>
                            <td class="text-center fw-semibold">6.</td>
                            <td>3201xxxx</td>
                            <td>Sinta</td>
                            <td>smkn 1 garut</td>
                            <td>08123xxxx</td>
                            <td class="text-center">
                                <span id="status-badge-6" class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #ff4d4d;">Nonaktif</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                        <i class="bi bi-list fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" style="min-width: 160px;">
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', 6) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li>
                                        <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', 6) }}"><i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bagian Pagination -->
            <div class="d-flex justify-content-center align-items-center mt-3 pt-2">
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link text-white" href="#" style="background-color: #2b6cb0; border-color: #2b6cb0;">1</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection