@extends('layouts.peserta')

@section('content')
@php
    $soals = $jadwal->soals;
    $jumlahSoal = $soals->count();
    $jumlahPilihanGanda = $soals->where('tipe_soal', 'Pilihan Ganda')->count();
    $jumlahEssay = $soals->where('tipe_soal', 'Essay')->count();
    $jumlahPraktik = $soals->where('tipe_soal', 'Praktik')->count();
    $durasiUjian = (int) ($jadwal->durasi_ujian ?? 120);
    $passingGrade = (int) ($jadwal->passing_grade ?? 75);
@endphp
<div class="container-fluid px-4 py-4">
    <!-- Breadcrumb / Header Title -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-1 text-dark" style="font-weight: 700 !important; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">Ujikom</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0 small" style="font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                    <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-dark fw-bold" aria-current="page" style="font-weight: 600 !important; color: #212529 !important;">Ujikom</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Informasi Ujian Kompetensi Card -->
    <div class="card shadow-sm mb-4 border-0 rounded-lg">
        <div class="card-body p-4">
            <h4 class="font-weight-bold text-dark mb-4" style="font-weight: 700 !important; font-size: 1.25rem;">Informasi Ujian Kompetensi</h4>
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-6 mb-3 pr-sm-4" style="border-right: 1px solid #dee2e6;">
                            <div class="mb-4 d-flex align-items-start">
                                <div class="text-primary" style="margin-top: 2px; margin-right: 16px; min-width: 22px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <div style="flex: 1;">
                                    <span class="text-muted d-block small mb-1">Skema Sertifikasi</span>
                                    <strong class="text-dark font-weight-bold" style="font-size: 1rem;">{{ $jadwal->skema->nama_skema ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="mb-4 d-flex align-items-start">
                                <div class="text-primary" style="margin-top: 2px; margin-right: 16px; min-width: 22px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                </div>
                                <div style="flex: 1;">
                                    <span class="text-muted d-block small mb-1">Tanggal Uji</span>
                                    <strong class="text-dark font-weight-bold" style="font-size: 1rem;">{{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : '-' }}</strong>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="text-primary" style="margin-top: 2px; margin-right: 16px; min-width: 22px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                                <div style="flex: 1;">
                                    <span class="text-muted d-block small mb-1">Waktu Ujian</span>
                                    <strong class="text-dark font-weight-bold" style="font-size: 1rem;">{{ $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') : '-' }} – {{ $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') : '-' }} WIB</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3 pl-sm-4">
                            <div class="mb-4 d-flex align-items-start">
                                <div class="text-primary" style="margin-top: 2px; margin-right: 16px; min-width: 22px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <div style="flex: 1;">
                                    <span class="text-muted d-block small mb-1">Asesor</span>
                                    <strong class="text-dark font-weight-bold" style="font-size: 1rem;">{{ $jadwal->asesor->name ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="text-primary" style="margin-top: 2px; margin-right: 16px; min-width: 22px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                </div>
                                <div style="flex: 1;">
                                    <span class="text-muted d-block small mb-1">Lokasi</span>
                                    <strong class="text-dark font-weight-bold" style="font-size: 1rem;">Lab Komputer 1<br><span class="text-muted font-weight-normal" style="font-size: 0.9rem;">SMK NEGERI 1 GARUT</span></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center mt-3 mt-md-0">
                    <div class="p-4 rounded-lg border" style="background-color: #f4fbf7; border-color: #d1e7dd !important;">
                        <span class="text-muted small d-block font-weight-bold text-uppercase mb-2"><strong>Passing Grade</strong></span>
                        <h2 class="text-success font-weight-bold mb-2" style="font-size: 2.25rem;">{{ $passingGrade }} <span class="text-muted" style="font-size: 1.1rem; font-weight: normal;">/ 100</span></h2>
                        <p class="text-muted mb-0" style="font-size: 11.5px; line-height: 1.4;">Anda dinyatakan kompeten<br>jika nilai akhir &ge; passing grade.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Check-in Alert -->
    <div class="alert border-0 shadow-sm d-flex align-items-center py-3 mb-4 rounded-lg" role="alert" style="background-color: #e8f8f0; color: #1e7e34;">
        <div class="text-success d-flex align-items-center" style="margin-right: 16px; min-width: 26px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        </div>
        <div class="grow">
            <strong style="font-size: 1rem;">Anda sudah Check-in pada 07:34 WIB</strong>
            <div class="small mt-1" style="color: #28a745 !important;">Silakan mulai ujian sebelum waktu berakhir.</div>
        </div>
    </div>

    <!-- Detail Ujian Card -->
    <div class="card shadow-sm mb-4 border-0 rounded-lg">
        <div class="card-body p-4">
            <h4 class="font-weight-bold text-dark mb-4" style="font-weight: 700 !important; font-size: 1.25rem;">Detail Ujian</h4>
            
            <div class="row mb-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="p-3 bg-light rounded border d-flex align-items-center">
                        <div class="text-primary" style="margin-right: 16px; min-width: 28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <div style="flex: 1;">
                            <span class="text-muted small d-block mb-1">Jumlah soal</span>
                            <h5 class="font-weight-bold text-dark mb-0">{{ $jumlahSoal }} Soal</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="p-3 bg-light rounded border d-flex align-items-center">
                        <div class="text-primary" style="margin-right: 16px; min-width: 28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div style="flex: 1;">
                            <span class="text-muted small d-block mb-1">Durasi</span>
                            <h5 class="font-weight-bold text-dark mb-0">{{ $durasiUjian }} Menit</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded border d-flex align-items-center">
                        <div class="text-primary" style="margin-right: 16px; min-width: 28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        </div>
                        <div style="flex: 1;">
                            <span class="text-muted small d-block mb-1">Status</span>
                            <h5 class="font-weight-bold text-success mb-0">Belum Dikerjakan</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3 bg-light rounded border">
                <div class="row align-items-center">
                    <div class="col-md-7 mb-3 mb-md-0 pr-md-4" style="border-right: 1px solid #dee2e6;">
                        <strong class="text-dark d-block mb-2 small font-weight-bold d-flex align-items-center">
                            <span class="text-primary" style="margin-right: 8px; min-width: 16px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            </span>
                            Informasi Pengerjaan Ujian
                        </strong>
                        <ul class="list-unstyled text-muted small mb-0 pl-3" style="list-style-type: disc; line-height: 1.6;">
                            <li>Pastikan koneksi internet stabil sebelum memulai ujian.</li>
                            <li>Jangan menutup halaman ujian selama pengerjaan berlangsung.</li>
                            <li>Ujian akan otomatis tersimpan setiap jawaban yang dipilih atau diketik.</li>
                        </ul>
                    </div>
                    <div class="col-md-5 pl-md-4">
                        <strong class="text-dark d-block mb-2 small font-weight-bold">Komposisi Soal</strong>
                        <div class="row small text-muted mb-1">
                            <div class="col-7">• Pilihan Ganda</div>
                            <div class="col-5 font-weight-bold text-dark">: {{ $jumlahPilihanGanda }} Soal</div>
                        </div>
                        <div class="row small text-muted mb-1">
                            <div class="col-7">• Essay</div>
                            <div class="col-5 font-weight-bold text-dark">: {{ $jumlahEssay }} Soal</div>
                        </div>
                        <div class="row small text-muted">
                            <div class="col-7">• Praktik</div>
                            <div class="col-5 font-weight-bold text-dark">: {{ $jumlahPraktik }} Soal</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center">
            <button type="button" class="btn btn-primary btn-lg px-5 py-3 font-weight-bold shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #2563eb; border-color: #2563eb; width: 100%; max-width: 500px; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modalMulaiUjian">
                MULAI UJIAN
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Mulai Ujian -->
<div class="modal fade" id="modalMulaiUjian" tabindex="-1" aria-labelledby="modalMulaiUjianLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-body text-center p-4 p-sm-5">
                <div class="d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 72px; height: 72px; background-color: #f0f5ff; border-radius: 50%;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h4 class="font-weight-bold text-dark mb-2" style="font-weight: 700 !important; font-size: 1.25rem;">Mulai Ujikom</h4>
                <p class="text-muted small mb-4" style="line-height: 1.5; font-size: 0.9rem;">
                    Pastikan Anda sudah siap. Setelah ujikom dimulai, waktu akan berjalan dan tidak dapat dijeda.
                </p>
                <div class="mb-4 d-flex justify-content-center">
                    <div style="width: 250px; text-align: left;">
                        <!-- Baris 1: Jumlah Soal -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="d-flex align-items-center" style="width: 135px;">
                                <span class="text-primary" style="display: flex; align-items: center; margin-right: 12px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                </span>
                                <span class="text-dark font-weight-bold" style="font-size: 0.95rem;">Jumlah Soal</span>
                            </div>
                            <span class="text-muted font-weight-normal" style="font-size: 0.95rem; margin-right: 6px;">:</span>
                            <span class="text-dark" style="font-size: 0.95rem; font-weight: 700 !important;">{{ $jumlahSoal }} Soal</span>
                        </div>
                        <!-- Baris 2: Durasi -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center" style="width: 135px;">
                                <span class="text-primary" style="display: flex; align-items: center; margin-right: 12px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </span>
                                <span class="text-dark font-weight-bold" style="font-size: 0.95rem;">Durasi</span>
                            </div>
                            <span class="text-muted font-weight-normal" style="font-size: 0.95rem; margin-right: 6px;">:</span>
                            <span class="text-dark" style="font-size: 0.95rem; font-weight: 700 !important;">{{ $durasiUjian }} Menit</span>
                        </div>
                    </div>
                </div>
                <div class="row gx-2">
                    <div class="col-6 pr-1">
                        <button type="button" class="btn btn-outline-secondary btn-block font-weight-bold py-2 w-100" data-bs-dismiss="modal" style="border-radius: 8px;">
                            Batal
                        </button>
                    </div>
                    <div class="col-6 pl-1">
                        <a href="/peserta/ujikom/soal" class="btn btn-primary btn-block font-weight-bold py-2 shadow-sm w-100" style="background-color: #2563eb; border-color: #2563eb; border-radius: 8px;">
    Mulai Ujikom
</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection