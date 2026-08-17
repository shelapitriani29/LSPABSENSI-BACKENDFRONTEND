@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title & Breadcrumb -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.75rem;">Penilaian Peserta</h3>
            <small class="text-muted d-block mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-muted text-decoration-none">Input Penilaian</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.jadwal-asesmen.lihat-peserta', 1) }}" class="text-muted text-decoration-none">Pilih Peserta</a></li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Penilaian Peserta</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Card Informasi Peserta -->
    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
        <div class="card-body p-4">
            <div class="row g-3" style="font-size: 0.9rem;">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-4 text-muted fw-semibold">Nama Lengkap</div>
                        <div class="col-8 text-dark fw-bold">: Jenisa Nurfadillah</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted fw-semibold">NISN</div>
                        <div class="col-8 text-dark">: 0054321876</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-4 text-muted fw-semibold">Kelas</div>
                        <div class="col-8 text-dark">: XI DKV 1</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-4 text-muted fw-semibold">Skema Sertifikasi</div>
                        <div class="col-8 text-dark">: Junior Animator</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted fw-semibold">Jadwal Uji</div>
                        <div class="col-8 text-dark">: JA001 - Junior Animator</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted fw-semibold">Tanggal Uji</div>
                        <div class="col-8 text-dark">: 25 Agustus 2026</div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-4 text-muted fw-semibold">Lokasi Uji</div>
                        <div class="col-8 text-dark">: Lab Komputer 2</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Tabel Input Nilai -->
    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-3">Input Nilai</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light text-dark">
                        <tr>
                            <th class="text-center" style="width: 60px;">No.</th>
                            <th>Jenis Penilaian</th>
                            <th class="text-center" style="width: 180px;">Nilai</th>
                            <th>Catatan</th>
                            <th class="text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td class="fw-semibold text-dark">Pilihan Ganda (Otomatis)</td>
                            <td class="text-center fw-bold text-dark">85.00 <span class="text-muted fw-normal small">/ 100</span></td>
                            <td class="text-muted">Nilai Otomatis Dari Sistem</td>
                            <td class="text-center text-muted">-</td>
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td class="fw-semibold text-dark">Essay (Perlu Penilaian)</td>
                            <td class="text-center">
                                <input type="text" class="form-control form-control-sm text-center fw-bold text-dark shadow-sm py-1 mx-auto" value="85,00" style="max-width: 90px;">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm text-muted shadow-sm" placeholder="Isi Catatan (Opsional)">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('asesor.penilaian-essay-demo') }}" class="btn btn-sm text-white px-3 fw-semibold rounded-2 shadow-sm" style="background-color: #1b6ca8; font-size: 0.8rem;">
                                    Nilai Essay
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Card Hasil Akhir -->
    <div class="card border-0 shadow-sm rounded-3 bg-white mb-5">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4">Hasil Akhir</h5>
            <div class="row align-items-center g-3">
                <div class="col-md-4">
                    <span class="text-muted small d-block mb-1">Nilai Akhir</span>
                    <h3 class="fw-bold text-dark mb-0">85.00 <span class="text-muted fs-6 fw-normal">/ 100</span></h3>
                </div>
                <div class="col-md-4">
                    <span class="text-muted small d-block mb-1">Passing Grade</span>
                    <h4 class="fw-bold text-secondary mb-0">75 <span class="text-muted fs-6 fw-normal">/ 100</span></h4>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="text-muted small d-block mb-1">Status Kelulusan</span>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 fw-bold" style="font-size: 0.95rem;">KOMPETEN</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi Bawah -->
    <div class="d-flex justify-content-end gap-2 mb-5">
        <a href="{{ route('asesor.jadwal-asesmen.lihat-peserta', 1) }}" class="btn btn-outline-secondary px-4 fw-semibold shadow-sm rounded-2 bg-white text-secondary py-2" style="font-size: 0.9rem;">
            &times; Batal
        </a>
        <!-- Tombol pemicu modal pop-up -->
        <button type="button" class="btn text-white px-4 fw-semibold shadow-sm rounded-2 py-2" data-bs-toggle="modal" data-bs-target="#successModal" style="background-color: #1b6ca8; border-color: #1b6ca8; font-size: 0.9rem;">
            Simpan Penilaian
        </button>
    </div>
</div>

<!-- Modal Pop-up Berhasil Simpan Penilaian (Mirip Figma) -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content border-0 shadow-lg rounded-4 p-4 text-center bg-white">
            <div class="modal-body px-2 py-3">
                
                <!-- Icon Centang Hijau Besar -->
                <div class="mb-4 d-flex justify-content-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 85px; height: 85px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                        <i class="bi bi-check-lg text-white" style="font-size: 3rem;"></i>
                    </div>
                </div>

                <!-- Judul Pesan Sukses -->
                <h4 class="fw-bold text-dark mb-4" style="font-size: 1.35rem;">Penilaian Berhasil Disimpan!</h4>

                <!-- Kotak Informasi Nilai & Status di dalam Pop-up -->
                <div class="bg-light rounded-3 p-3 mb-4 border-0">
                    <div class="mb-2">
                        <span class="text-muted small d-block mb-1">Nilai akhir peserta:</span>
                        <h4 class="fw-bold text-dark mb-0" style="font-size: 1.25rem;">85.00 / 100</h4>
                    </div>
                    <hr class="my-2 text-muted opacity-25">
                    <div>
                        <span class="text-muted small d-block mb-1">Status Kelulusan :</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-1 fw-bold" style="font-size: 0.9rem;">KOMPETEN</span>
                    </div>
                </div>

                <!-- Tombol Aksi Pop-up -->
                <div class="d-grid gap-2">
                    <a href="{{ route('asesor.jadwal-asesmen.lihat-peserta', 1) }}" class="btn btn-outline-primary py-2 fw-semibold rounded-2 shadow-sm bg-white" style="border-color: #1b6ca8; color: #1b6ca8; font-size: 0.9rem;">
                        Kembali ke Daftar Peserta
                    </a>
                    <button type="button" class="btn text-white py-2 fw-semibold rounded-2 shadow-sm" data-bs-dismiss="modal" style="background-color: #1b6ca8; border-color: #1b6ca8; font-size: 0.9rem;">
                        Lihat Detail Penilaian
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection