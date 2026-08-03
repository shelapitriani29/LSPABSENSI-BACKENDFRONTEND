@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header: Judul, Sub-judul, Breadcrumb Berurutan (Mirip Contoh Referensi) -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">DETAIL RIWAYAT PENILAIAN</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb di Bawah Tulisan LSP, Warna Hitam -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.riwayat-penilaian') }}" class="text-dark text-decoration-none">Riwayat Penilaian</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Detail Riwayat Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Card Utama -->
    <div class="card border shadow-sm rounded-3 overflow-hidden mb-4 bg-white">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-info-circle me-1 text-primary"></i> INFORMASI JADWAL & ASESMEN</h6>
        </div>
        <div class="card-body p-4">
            
            <div class="row g-4">
                <!-- Kolom Kiri: Informasi Jadwal & Asesor -->
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Informasi Jadwal</h5>
                    <table class="table table-borderless table-sm mb-4">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 140px;">Kode Jadwal</td>
                            <td>: JDW-001</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Skema</td>
                            <td>: Junior Web Developer</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Kelas</td>
                            <td>: XI RPL 1</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Tanggal</td>
                            <td>: 27 Juli 2026</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Jam</td>
                            <td>: 08.00 - 10.00</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Lokasi</td>
                            <td>: Lab Komputer 1</td>
                        </tr>
                    </table>

                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Informasi Asesor</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 140px;">Nama Asesor</td>
                            <td>: Budi Santoso</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">No. Registrasi</td>
                            <td>: ASR-001</td>
                        </tr>
                    </table>
                </div>

                <!-- Kolom Kanan: Ringkasan Hasil & Status -->
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Ringkasan Hasil Asesmen</h5>
                    <table class="table table-borderless table-sm mb-4">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 170px;">Jumlah Peserta</td>
                            <td>: 36 Orang</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Hadir</td>
                            <td>: 36 Orang</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Tidak Hadir</td>
                            <td>: 0 Orang</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Kompeten</td>
                            <td>: <span class="text-success fw-bold">34 Orang</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Belum Kompeten</td>
                            <td>: <span class="text-danger fw-bold">2 Orang</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Persentase Kelulusan</td>
                            <td>: <span class="fw-bold">94%</span></td>
                        </tr>
                    </table>

                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Status Asesmen</h5>
                    <div class="mb-3">
                        <span class="badge bg-success fs-6 px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i> SELESAI
                        </span>
                    </div>

                    <div class="text-muted small">
                        <i class="bi bi-clock me-1"></i> Diselesaikan pada: <strong>27 Juli 2026, 10.15 WIB</strong>
                    </div>
                </div>
            </div>

            <!-- Catatan Asesor (Full Width di Bawah) -->
            <div class="mt-4 pt-3 border-top">
                <h5 class="fw-bold text-dark mb-2">Catatan Asesor</h5>
                <div class="p-3 bg-light rounded-3 text-secondary" style="font-size: 0.95rem; line-height: 1.6;">
                    Seluruh proses asesmen berjalan dengan baik.<br>
                    Peserta mengikuti asesmen sesuai jadwal.<br>
                    Terdapat 2 peserta yang dinyatakan <strong>Belum Kompeten</strong> dan memerlukan asesmen ulang.
                </div>
            </div>

        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mb-4">
        <a href="{{ route('asesor.riwayat-penilaian') }}" class="btn text-white px-4 py-2 shadow-sm" style="background-color: #1e3a5f;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

</div>
@endsection