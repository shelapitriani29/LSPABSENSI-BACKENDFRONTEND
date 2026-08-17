@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    
    <!-- Header Title & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold mb-0" style="color: #212529;">Prinsip Animasi</h2>
        <a href="javascript:history.back()" class="btn rounded-3 px-3 py-2 small shadow-sm d-flex align-items-center gap-1 text-white border-0 text-decoration-none" style="background-color: #1b6ca8;">
            <i class="bi bi-arrow-left"></i> Kembali ke Kategori
        </a>
    </div>

    <!-- Breadcrumb Sesuai Permintaan -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0 small text-muted">
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Kelola Soal</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Prinsip Animasi</li>
        </ol>
    </nav>

    <!-- CARD 1: Informasi Ringkasan Jadwal & Progress Soal -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center g-3">
                
                <!-- Skema & Tanggal Uji -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-calendar text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Skema</div>
                            <div class="fw-bold text-dark fs-6">Junior Animator</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-calendar-check text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Tanggal Uji</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">07 Agustus 2026</div>
                        </div>
                    </div>
                </div>

                <!-- Kode Skema & Jam Uji -->
                <div class="col-md-2 border-end">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-scissors text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Kode Skema</div>
                            <div class="fw-bold text-dark fs-6">JA001</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-stopwatch text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Jam Uji</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">08:00 - 12:00</div>
                        </div>
                    </div>
                </div>

                <!-- Lokasi & Jumlah Peserta -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-geo-alt text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Lokasi</div>
                            <div class="fw-bold text-dark fs-6">Lab Komputer 1</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-people text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Jumlah Peserta</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">1 Orang</div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Soal di Kategori Ini & Progress Bar -->
                <div class="col-md-4">
                    <div class="text-secondary" style="font-size: 11px;">Jumlah Soal di Kategori Ini</div>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="fw-bold text-dark fs-5">8 / 8 soal</span>
                        <span class="fw-bold text-success" style="font-size: 13px;">100%</span>
                    </div>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: 100%;" aria-valuenow="8" aria-valuemin="0" aria-valuemax="8"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- CARD 2: Passing Grade & Durasi Ujian -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            
            <div class="row align-items-center g-3">
                <div class="col-lg-4">
                    <label class="form-label text-dark fw-semibold small mb-1">Passing Grade <span class="text-muted fw-normal">(Minimum Lulus)</span></label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-0 px-3" style="font-size: 1.25rem;"><i class="bi bi-trophy text-primary"></i></span>
                            <input type="number" class="form-control border-0 bg-light fw-bold fs-5 shadow-none" value="75">
                            <span class="input-group-text bg-light border-0 fw-semibold">%</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <label class="form-label text-dark fw-semibold small mb-1">Durasi Ujian</label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-0 px-3" style="font-size: 1.25rem;"><i class="bi bi-clock text-primary"></i></span>
                            <input type="number" class="form-control border-0 bg-light fw-bold fs-5 shadow-none" value="120">
                            <span class="input-group-text bg-light border-0 fw-semibold">menit</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 d-flex flex-column justify-content-center">
                    <!-- Badge "Tersimpan" diposisikan di tengah secara horizontal di atas alert -->
                    <div class="d-flex justify-content-center mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 small d-inline-flex align-items-center gap-1">
                            <i class="bi bi-check-circle-fill"></i> Tersimpan
                        </span>
                    </div>

                    <div class="alert alert-primary bg-primary bg-opacity-10 border-0 text-primary small p-2 mb-0 d-flex align-items-center gap-2 rounded-3">
                        <i class="bi bi-info-circle-fill fs-5 flex-shrink-0"></i>
                        <span style="font-size: 11px;">Peserta dinyatakan kompeten jika nilai akhir &ge; passing grade.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- NOTIFIKASI DI BAWAH CARD KEDUA -->
    <div class="alert alert-success alert-dismissible fade show bg-success bg-opacity-10 border border-success border-opacity-25 text-success small p-3 mb-4 d-flex align-items-center justify-content-between rounded-4 shadow-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5 flex-shrink-0"></i>
            <span class="fw-medium">Pengaturan ujian berhasil disimpan.</span>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="font-size: 11px;"></button>
    </div>

    <!-- Tabel Daftar Soal -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            
            <!-- Baris Filter Show Entries & Tombol Tambah Soal -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2 small text-secondary">
                    Show
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    entries
                </div>
                <a href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/tambah') }}" class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1 text-decoration-none" style="background-color: #1b6ca8;">
                    <i class="bi bi-plus-lg"></i> Tambah Soal
                </a>
            </div>

            <!-- Tabel Data Soal -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small">
                        <tr>
                            <th scope="col" class="text-center" style="width: 5%;">No</th>
                            <th scope="col" style="width: 45%;">Pertanyaan</th>
                            <th scope="col" class="text-center" style="width: 15%;">Tipe Soal</th>
                            <th scope="col" class="text-center" style="width: 15%;">Tingkat Kesulitan</th>
                            <th scope="col" class="text-center" style="width: 10%;">Poin</th>
                            <th scope="col" class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Baris 1 -->
                        <tr>
                            <td class="text-center fw-semibold">1.</td>
                            <td>Apa yang dimaksud dengan squash and stretch dalam animasi?</td>
                            <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">Pilihan Ganda</span></td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success px-3 py-1 fw-semibold">Mudah</span></td>
                            <td class="text-center fw-bold">5</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/1/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 2 -->
                        <tr>
                            <td class="text-center fw-semibold">2.</td>
                            <td>Fungsi anticipation dalam prinsip animasi adalah...</td>
                            <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">Pilihan Ganda</span></td>
                            <td class="text-center"><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 fw-semibold">Sedang</span></td>
                            <td class="text-center fw-bold">5</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/2/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 3 -->
                        <tr>
                            <td class="text-center fw-semibold">3.</td>
                            <td>Sebutkan 3 prinsip dasar animasi menurut Disney!</td>
                            <td class="text-center"><span class="badge bg-purple bg-opacity-10 text-purple border border-purple border-opacity-25 px-2 py-1" style="color: #6f42c1; background-color: rgba(111, 66, 193, 0.1);">Essay</span></td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success px-3 py-1 fw-semibold">Mudah</span></td>
                            <td class="text-center fw-bold">10</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/3/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 4 -->
                        <tr>
                            <td class="text-center fw-semibold">4.</td>
                            <td>Urutkan tahapan produksi animasi berikut! (pra-produksi, produksi, pasca-produksi)</td>
                            <td class="text-center"><span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1">Isian Singkat</span></td>
                            <td class="text-center"><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 fw-semibold">Sedang</span></td>
                            <td class="text-center fw-bold">5</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/4/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 5 -->
                        <tr>
                            <td class="text-center fw-semibold">5.</td>
                            <td>Perhatikan gambar berikut! Prinsip animasi apa yang ditunjukkan pada gambar tersebut?</td>
                            <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">Pilihan Ganda</span></td>
                            <td class="text-center"><span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 fw-semibold">Sulit</span></td>
                            <td class="text-center fw-bold">5</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/5/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 6 -->
                        <tr>
                            <td class="text-center fw-semibold">6.</td>
                            <td>Tool apa yang digunakan untuk rig karakter 2D di Adobe Animate?</td>
                            <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">Pilihan Ganda</span></td>
                            <td class="text-center"><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 fw-semibold">Sedang</span></td>
                            <td class="text-center fw-bold">5</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/6/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 7 -->
                        <tr>
                            <td class="text-center fw-semibold">7.</td>
                            <td>Jelaskan perbedaan frame by frame dan tweening!</td>
                            <td class="text-center"><span class="badge bg-purple bg-opacity-10 text-purple border border-purple border-opacity-25 px-2 py-1" style="color: #6f42c1; background-color: rgba(111, 66, 193, 0.1);">Essay</span></td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success px-3 py-1 fw-semibold">Mudah</span></td>
                            <td class="text-center fw-bold">10</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/7/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Baris 8 -->
                        <tr>
                            <td class="text-center fw-semibold">8.</td>
                            <td>Sebutkan 2 software yang biasa digunakan untuk membuat animasi 2D!</td>
                            <td class="text-center"><span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1">Isian Singkat</span></td>
                            <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success px-3 py-1 fw-semibold">Mudah</span></td>
                            <td class="text-center fw-bold">5</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ url('/admin/sertifikasi/jadwal/1/kategori/1/soal/8/edit-soal') }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger" href="#"><i class="bi bi-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection