@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1100px;">
    <!-- Header Page -->
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">Laporan Sistem</h4>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Laporan</span></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Laporan Sistem</li>
            </ol>
        </nav>
    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Periode</label>
                <select class="form-select form-select-sm">
                    <option selected>Agustus 2026</option>
                    <option>Juli 2026</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Skema</label>
                <select class="form-select form-select-sm">
                    <option selected>Semua Skema</option>
                    <option>Junior Web Developer</option>
                    <option>Database Programmer</option>
                    <option>Multimedia</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Hasil</label>
                <select class="form-select form-select-sm">
                    <option selected>Semua</option>
                    <option>Kompeten</option>
                    <option>Belum Kompeten</option>
                </select>
            </div>
            <div class="col-md-3 text-md-end mt-4">
                <button class="btn btn-primary btn-sm px-3 shadow-sm" style="background-color: #2b70c9; border-color: #2b70c9;">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Tabel Rekap Hasil Sertifikasi -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <h6 class="fw-bold text-dark mb-3">Rekap Hasil Sertifikasi</h6>
        
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
            <table class="table table-bordered align-middle small">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Peserta</th>
                        <th>Skema Sertifikasi</th>
                        <th>Jadwal Uji</th>
                        <th>Asesor</th>
                        <th>Kehadiran</th>
                        <th>Hasil</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="fw-semibold">Jenisa Nurfadillah</td>
                        <td>Junior Web Developer</td>
                        <td class="text-center">20/08/2026<br><span class="text-muted small">08.00 - 16.00</span></td>
                        <td>Budi Santoso</td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Hadir</span></td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Kompeten</span></td>
                        <td class="text-center fw-semibold text-dark">
                            LSP-2026-001<br>
                            <span class="text-muted fw-normal small">Terbit</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="fw-semibold">Aulia Rahma</td>
                        <td>Junior Web Developer</td>
                        <td class="text-center">20/08/2026<br><span class="text-muted small">08.00 - 16.00</span></td>
                        <td>Budi Santoso</td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Hadir</span></td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Kompeten</span></td>
                        <td class="text-center fw-semibold text-dark">
                            LSP-2026-002<br>
                            <span class="text-muted fw-normal small">Terbit</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td class="fw-semibold">Siti Nurhaliza</td>
                        <td>Junior Web Developer</td>
                        <td class="text-center">20/08/2026<br><span class="text-muted small">08.00 - 16.00</span></td>
                        <td>Budi Santoso</td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Hadir</span></td>
                        <td class="text-center"><span class="badge bg-danger-subtle text-danger px-2 py-1">Belum Kompeten</span></td>
                        <td class="text-center text-muted">-</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td class="fw-semibold">Raka Pratama</td>
                        <td>Database Programmer</td>
                        <td class="text-center">21/08/2026<br><span class="text-muted small">08.00 - 16.00</span></td>
                        <td>Siti Rahma</td>
                        <td class="text-center"><span class="badge bg-danger-subtle text-danger px-2 py-1">Tidak Hadir</span></td>
                        <td class="text-center text-muted">-</td>
                        <td class="text-center text-muted">-</td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td class="fw-semibold">Dinda Aulia</td>
                        <td>Database Programmer</td>
                        <td class="text-center">21/08/2026<br><span class="text-muted small">08.00 - 16.00</span></td>
                        <td>Siti Rahma</td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Hadir</span></td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Kompeten</span></td>
                        <td class="text-center fw-semibold text-dark">
                            LSP-2026-003<br>
                            <span class="text-muted fw-normal small">Terbit</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td class="fw-semibold">Farhan Maulana</td>
                        <td>Multimedia</td>
                        <td class="text-center">22/08/2026<br><span class="text-muted small">08.00 - 16.00</span></td>
                        <td>Rudi Hermawan</td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Hadir</span></td>
                        <td class="text-center"><span class="badge bg-success-subtle text-success px-2 py-1">Kompeten</span></td>
                        <td class="text-center fw-semibold text-dark">
                            LSP-2026-004<br>
                            <span class="text-muted fw-normal small">Terbit</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Terpusat (Hanya Menampilkan Previous, 1, Next) -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#" style="background-color: #2b70c9; border-color: #2b70c9;">1</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection