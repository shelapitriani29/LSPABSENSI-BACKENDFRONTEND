@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header dengan Judul, Sub-judul LSP, dan Breadcrumb Hitam -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">
            Input Penilaian Asesi
        </h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-dark text-decoration-none">Input Penilaian</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Input Penilaian Asesi</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark d-flex align-items-center">
                <i class="bi bi-pencil-square me-2 fs-4" style="color: #1E6388;"></i> Form Input Penilaian Asesi
            </h5>
            <span class="badge bg-light text-secondary border px-3 py-2" style="font-size: 0.8rem;">Session ID: #ASW-2026</span>
        </div>

        <div class="card-body p-4">
            <form action="#" method="POST">
                @csrf
                <div class="row g-4">
                    <!-- Kolom Kiri: Data Asesi -->
                    <div class="col-lg-5">
                        <div class="card border rounded-3 h-100 bg-light bg-opacity-25">
                            <div class="card-header bg-white fw-bold border-bottom py-3">
                                <i class="bi bi-person-badge me-2" style="color: #1E6388;"></i> Data Asesi
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Nama Lengkap</label>
                                    <span class="fw-bold text-dark fs-6">Aulia Novia Shuandhari</span>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small d-block">NIK</label>
                                    <span class="fw-semibold text-dark">320xxxxxxxxxxxxx</span>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Skema Sertifikasi</label>
                                    <span class="fw-semibold text-dark">Junior Web Developer</span>
                                </div>
                                <div class="mb-0">
                                    <label class="text-muted small d-block">Tanggal Asesmen</label>
                                    <span class="fw-semibold text-dark">25 Juli 2026</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Elemen Unit Kompetensi -->
                    <div class="col-lg-7">
                        <div class="card border rounded-3 h-100 bg-light bg-opacity-25">
                            <div class="card-header bg-white fw-bold border-bottom py-3">
                                <i class="bi bi-check2-square me-2" style="color: #1E6388;"></i> Elemen Unit Kompetensi
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="border-bottom">
                                            <tr>
                                                <th class="text-secondary small fw-semibold">Unit Kompetensi</th>
                                                <th class="text-end text-secondary small fw-semibold" style="width: 140px;">Nilai (0-100)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom">
                                                <td class="py-3">Menerapkan prinsip K3</td>
                                                <td class="py-3 text-end">
                                                    <input type="number" name="nilai[]" class="form-control form-control-sm text-center fw-bold" value="90" min="0" max="100">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="py-3">Membuat struktur halaman web</td>
                                                <td class="py-3 text-end">
                                                    <input type="number" name="nilai[]" class="form-control form-control-sm text-center fw-bold" value="88" min="0" max="100">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="py-3">Mendesain tampilan website</td>
                                                <td class="py-3 text-end">
                                                    <input type="number" name="nilai[]" class="form-control form-control-sm text-center fw-bold" value="92" min="0" max="100">
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="py-3">Menggunakan JavaScript</td>
                                                <td class="py-3 text-end">
                                                    <input type="number" name="nilai[]" class="form-control form-control-sm text-center fw-bold" value="92" min="0" max="100">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-3">Menguji aplikasi web</td>
                                                <td class="py-3 text-end">
                                                    <input type="number" name="nilai[]" class="form-control form-control-sm text-center fw-bold" value="90" min="0" max="100">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian Bawah: Kesimpulan & Tombol -->
                <div class="card border rounded-3 mt-4 bg-light bg-opacity-25">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center gy-3">
                            <div class="col-lg-7">
                                <span class="fw-bold text-dark d-block mb-2">Kesimpulan Status Kelulusan:</span>
                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Pilihan Kompeten -->
                                    <div class="form-check custom-radio-box border px-3 py-2 rounded bg-white shadow-sm mb-0">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="status_kelulusan" id="kompeten" value="kompeten" checked style="position: static;">
                                        <label class="form-check-label fw-bold mb-0" for="kompeten" style="color: #1E6388; cursor: pointer;">
                                            Kompeten
                                        </label>
                                    </div>
                                    <!-- Pilihan Belum Kompeten -->
                                    <div class="form-check custom-radio-box border px-3 py-2 rounded bg-white shadow-sm mb-0">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="status_kelulusan" id="belum_kompeten" value="belum_kompeten" style="position: static;">
                                        <label class="form-check-label fw-bold text-danger mb-0" for="belum_kompeten" style="cursor: pointer;">
                                            Belum Kompeten
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 d-flex justify-content-lg-end gap-2">
                                <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" class="btn text-white px-4 d-flex align-items-center justify-content-center" style="background-color: #1E6388;">
                                    <i class="bi bi-save me-2"></i> Simpan Penilaian
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection