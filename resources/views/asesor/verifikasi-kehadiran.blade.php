@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-2">
    
    <!-- Judul Header -->
    <div class="mb-4 border-bottom pb-3">
        <h3 class="fw-bold text-dark mb-1" style="font-size: 1.4rem;">Verifikasi Kehadiran</h3>
        <p class="text-muted mb-2" style="font-size: 0.8rem;">LSP P1 - SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Verifikasi Kehadiran</li>
            </ol>
        </nav>
    </div>

    <!-- Card Kotak Pembungkus Tabel -->
    <div class="card border shadow-sm rounded-3">
        <div class="card-body p-4">
            
            <h5 class="fw-bold text-dark mb-3">Verifikasi Kehadiran</h5>

            <!-- Baris Show & Search -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="d-flex align-items-center text-secondary" style="font-size: 0.9rem;">
                    <span>show</span>
                    <select class="form-select form-select-sm mx-2" style="width: 70px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>antrian</span>
                </div>
                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                    <label class="me-2 text-dark fw-semibold">Search:</label>
                    <input type="text" class="form-control form-control-sm border-secondary" style="width: 200px;">
                </div>
            </div>

            <!-- Tabel Data Peserta -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center mb-4" style="border-color: #dee2e6;">
                    <thead class="table-light">
                        <tr class="fw-bold text-dark" style="font-size: 0.95rem;">
                            <th class="py-3 text-start ps-4" style="width: 35%;">Nama Peserta</th>
                            <th class="py-3" style="width: 20%;">Check In</th>
                            <th class="py-3" style="width: 20%;">Status</th>
                            <th class="py-3" style="width: 25%;">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
                        <!-- Baris 1: Jenisa -->
                        <tr>
                            <td class="text-start ps-4 fw-semibold text-dark">Jenisa Nurfadilah</td>
                            <td>08.05</td>
                            <td class="text-secondary">Menunggu</td>
                            <td>
                                <!-- Tombol yang memicu Popup Modal (Titik Dihilangkan) -->
                                <button type="button" class="btn btn-primary btn-sm px-3 rounded-pill fw-semibold" style="background-color: #1E6388; border-color: #1E6388; font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#modalVerifikasiJenisa">
                                    Verifikasi
                                </button>
                            </td>
                        </tr>
                        <!-- Baris 2: Haura -->
                        <tr>
                            <td class="text-start ps-4 fw-semibold text-dark">Haura Salsabil</td>
                            <td>07.58</td>
                            <td class="text-secondary">Menunggu</td>
                            <td>
                                <!-- Tombol yang memicu Popup Modal (Titik Dihilangkan) -->
                                <button type="button" class="btn btn-primary btn-sm px-3 rounded-pill fw-semibold" style="background-color: #1E6388; border-color: #1E6388; font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#modalVerifikasiHaura">
                                    Verifikasi
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Navigasi Pagination -->
            <div class="d-flex justify-content-center mt-3">
                <div class="btn-group shadow-sm" role="group" aria-label="Pagination">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" style="font-size: 0.85rem;">Previous</button>
                    <button type="button" class="btn btn-primary btn-sm px-3 fw-bold" style="font-size: 0.85rem; background-color: #1E6388; border-color: #1E6388;">1</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" style="font-size: 0.85rem;">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================================================= -->
<!-- MODAL / POPUP VERIFIKASI UNTUK JENISA NURFADILAH -->
<!-- ================================================= -->
<div class="modal fade" id="modalVerifikasiJenisa" tabindex="-1" aria-labelledby="modalJenisaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="modalJenisaLabel" style="font-size: 1.1rem;">Verifikasi Kehadiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3" style="font-size: 0.9rem;">
                <div class="mb-2">
                    <span class="text-muted d-block" style="font-size: 0.75rem;">Nama</span>
                    <span class="fw-bold text-dark">Jenisa Nurfadilah</span>
                </div>
                <div class="mb-2">
                    <span class="text-muted d-block" style="font-size: 0.75rem;">Jadwal</span>
                    <span class="fw-semibold text-dark">Junior Web Developer</span>
                </div>
                <div class="mb-3">
                    <span class="text-muted d-block" style="font-size: 0.75rem;">Jam Scan</span>
                    <span class="fw-semibold text-dark">08.05</span>
                </div>

                <div class="mb-2">
                    <label class="text-muted d-block mb-2" style="font-size: 0.75rem;">Status</label>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusJenisa" id="hadirJenisa" checked>
                            <label class="form-check-label text-dark" for="hadirJenisa">Hadir</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusJenisa" id="terlambatJenisa">
                            <label class="form-check-label text-dark" for="terlambatJenisa">Terlambat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusJenisa" id="izinJenisa">
                            <label class="form-check-label text-dark" for="izinJenisa">Izin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusJenisa" id="tidakHadirJenisa">
                            <label class="form-check-label text-dark" for="tidakHadirJenisa">Tidak Hadir</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 pb-3">
                <button type="button" class="btn btn-outline-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm px-4 rounded-pill" style="background-color: #1E6388; border-color: #1E6388;" data-bs-dismiss="modal" onclick="alert('Berhasil disimpan!')">Simpan</button>
            </div>
        </div>
    </div>
</div>

@endsection