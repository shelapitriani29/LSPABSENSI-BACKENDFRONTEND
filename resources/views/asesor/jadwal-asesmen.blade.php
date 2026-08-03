@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Judul Halaman & Sub-judul -->
    <div class="mb-3">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Jadwal Asesmen</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-dark">Sertifikasi</li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Jadwal asesmen</li>
            </ol>
        </nav>
    </div>

    <!-- Tabel Jadwal Asesmen -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">
            <!-- Judul di Atas Tabel -->
            <h6 class="fw-bold text-dark mb-3">Jadwal Asesmen</h6>

            <!-- Show Entries & Search Bar -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-1 small text-muted">
                    Show 
                    <select class="form-select form-select-sm d-inline-block w-auto mx-1">
                        <option selected>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select> 
                    entries
                </div>
                <div class="d-flex align-items-center gap-1 small text-muted">
                    Search: <input type="text" class="form-control form-control-sm d-inline-block w-auto" placeholder="">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Kode</th>
                            <th>Skema</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lokasi</th>
                            <th>Peserta</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-semibold">SK001</td>
                            <td>Junior Web Developer (JWD)</td>
                            <td class="text-center">20-07-2026</td>
                            <td class="text-center">08.00 - 10.00</td>
                            <td>Lab 1</td>
                            <td class="text-center">20 Orang</td>
                            <td class="text-center"><span class="badge bg-secondary">Selesai</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-2 py-1 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="font-size: 0.85rem;">
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route('asesor.jadwal-asesmen.detail', 1) }}">
                                                <i class="bi bi-list-ul me-2 text-primary"></i> Detail Asesmen
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">SK003</td>
                            <td>Network Administrator (NA)</td>
                            <td class="text-center">27-07-2026</td>
                            <td class="text-center">09.00 - 11.00</td>
                            <td>Lab 3</td>
                            <td class="text-center">28 Orang</td>
                            <td class="text-center"><span class="badge bg-success">Aktif</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm px-2 py-1 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2b70c9; border-color: #2b70c9;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="font-size: 0.85rem;">
                                        <li>
                                            <a class="dropdown-item py-2" href="{{ route('asesor.jadwal-asesmen.detail', 3) }}">
                                                <i class="bi bi-list-ul me-2 text-primary"></i> Detail Asesmen
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Terpusat -->
            <div class="d-flex justify-content-center mt-4 mb-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#" style="background-color: #2b70c9; border-color: #2b70c9;">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link text-dark" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection