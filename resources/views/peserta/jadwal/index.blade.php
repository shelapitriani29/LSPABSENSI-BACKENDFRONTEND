@extends('layouts.peserta')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="mt-2 mb-3">
        <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Jadwal Uji</h3>
        <div class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Jadwal Uji</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Informasi Atas -->
    <div class="alert border-0 bg-primary bg-opacity-10 text-primary d-flex align-items-center mb-4 rounded-3 py-3 px-3 shadow-sm" role="alert" style="font-size: 0.9rem;">
        <i class="bi bi-info-circle-fill fs-5 me-2"></i>
        <div>
            Berikut adalah jadwal uji sertifikasi Anda.
        </div>
    </div>

    <!-- Card Detail Jadwal Uji -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            
            <!-- Header Kartu: Skema & Status -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center pb-4 mb-4 border-bottom gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 55px; height: 55px; background-color: #e6f0fa; flex-shrink: 0;">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block mb-1">Skema Sertifikasi Anda</span>
                        <h4 class="fw-bold text-dark mb-0">Junior Web Developer</h4>
                    </div>
                </div>
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill d-flex align-items-center gap-1 fw-semibold" style="font-size: 0.85rem;">
                        <i class="bi bi-calendar-event"></i> Terjadwal
                    </span>
                </div>
            </div>

            <!-- Detail Informasi Baris -->
            <div class="row g-3" style="font-size: 0.95rem;">
                
                <div class="col-12">
                    <div class="row py-2">
                        <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-calendar-event text-primary fs-5"></i> Tanggal Uji
                        </div>
                        <div class="col-md-9 fw-semibold text-dark d-flex align-items-center">
                            : 20 Agustus 2026 (Kamis)
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row py-2">
                        <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-clock text-primary fs-5"></i> Waktu
                        </div>
                        <div class="col-md-9 fw-semibold text-dark d-flex align-items-center">
                            : 08.00 – 16.00 WIB
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row py-2">
                        <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-geo-alt text-primary fs-5"></i> Lokasi
                        </div>
                        <div class="col-md-9 fw-semibold text-dark">
                            <div>: Lab Komputer 1</div>
                            <div class="text-muted fw-normal ms-3">SMK NEGERI 1 GARUT</div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row py-2">
                        <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-person text-primary fs-5"></i> Asesor
                        </div>
                        <div class="col-md-9 fw-semibold text-dark d-flex align-items-center">
                            : Budi Santoso
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row py-2">
                        <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-journal-text text-primary fs-5"></i> Keterangan
                        </div>
                        <div class="col-md-9 text-dark d-flex align-items-center">
                            : Uji kompetensi sesuai jadwal yang telah ditentukan.
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Alert Informasi Bawah -->
    <div class="alert border-0 bg-primary bg-opacity-10 text-primary d-flex align-items-center mb-4 rounded-3 py-3 px-3 shadow-sm" role="alert" style="font-size: 0.9rem;">
        <i class="bi bi-info-circle-fill fs-5 me-2"></i>
        <div>
            Pastikan Anda hadir sesuai jadwal dan membawa kelengkapan yang diperlukan.
        </div>
    </div>

</div>

<!-- Footer -->
<div class="text-center text-muted small mt-5 pt-3 border-top">
    &copy; 2026 LSP P1 SMK NEGERI 1 GARUT. All rights reserved.
</div>
@endsection