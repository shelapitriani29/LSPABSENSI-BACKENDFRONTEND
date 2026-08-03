@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Header & Breadcrumb -->
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">Detail Peserta</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}" class="text-decoration-none text-muted">Data Peserta</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Detail Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
        <div class="row g-4">
            
            <!-- Kolom Kiri: Profil, Jadwal, Hasil Penilaian -->
            <div class="col-lg-6 d-flex flex-column gap-4">
                
                <!-- Profil Peserta -->
                <div>
                    <h5 class="fw-bold text-dark mb-3" style="letter-spacing: 0.5px;">PROFIL PESERTA</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Nama Lengkap</th>
                                    <td>Aulia Novia Shuandhari</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">NIK</th>
                                    <td>320xxxxxxxxxxx</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Jenis Kelamin</th>
                                    <td>Perempuan</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Tanggal Lahir</th>
                                    <td>30 November 2008</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">No Ponsel</th>
                                    <td>08xxxxxxxxxx</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Email</th>
                                    <td>aulia@gmail.com</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Alamat</th>
                                    <td>Tanjung</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Jadwal Uji -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Jadwal Uji</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Skema</th>
                                    <td>Junior Web Developer</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Tanggal</th>
                                    <td>10 Agustus 2026</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Jam</th>
                                    <td>08.00 – 16.00</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Lokasi</th>
                                    <td>Lab Komputer 1</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Asesor</th>
                                    <td>Budi Santoso</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Hasil Penilaian -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Hasil Penilaian</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Asesor</th>
                                    <td>Budi Santoso</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Nilai Akhir</th>
                                    <td class="fw-bold">85</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Status</th>
                                    <td>
                                        <span class="badge px-3 py-2 text-white fw-medium" style="background-color: #20c997; border-radius: 20px;">
                                            Kompeten
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Catatan</th>
                                    <td>Peserta memenuhi seluruh unit kompetensi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Data Instansi, Data Sertifikasi, Riwayat Absensi, Sertifikat -->
            <div class="col-lg-6 d-flex flex-column gap-4">
                
                <!-- Data Instansi -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Data Instansi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Instansi</th>
                                    <td>SMK Negeri 1 Garut</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Jurusan/Kelas</th>
                                    <td>Rekayasa Perangkat Lunak</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Data Sertifikasi -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Data Sertifikasi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Skema Sertifikasi</th>
                                    <td class="fw-bold">Junior Web Developer</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Kode Skema</th>
                                    <td>SKM-JWD-001</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Tanggal Pendaftaran</th>
                                    <td>01 Agustus 2026</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Status Peserta</th>
                                    <td>
                                        <span class="badge px-3 py-1-5 text-white fw-medium" style="background-color: #20c997; border-radius: 20px;">
                                            Aktif
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Riwayat Absensi -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Riwayat Absensi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center mb-0">
                            <thead class="bg-light text-dark fw-bold">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01-06-2026</td>
                                    <td>07.00</td>
                                    <td>16.00</td>
                                    <td><span class="badge px-3 py-1-5 text-white fw-medium" style="background-color: #20c997; border-radius: 20px;">Hadir</span></td>
                                </tr>
                                <tr>
                                    <td>28-05-2026</td>
                                    <td>07.00</td>
                                    <td>16.00</td>
                                    <td><span class="badge px-3 py-1-5 text-white fw-medium" style="background-color: #20c997; border-radius: 20px;">Hadir</span></td>
                                </tr>
                                <tr>
                                    <td>18-05-2026</td>
                                    <td>07.00</td>
                                    <td>16.00</td>
                                    <td><span class="badge px-3 py-1-5 text-white fw-medium" style="background-color: #ffb703; border-radius: 20px;">Telat</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Sertifikat -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Sertifikat</h5>
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Nomor Sertifikat</th>
                                    <td class="fw-bold">CERT-001234</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Tanggal Terbit</th>
                                    <td>20 Agustus 2026</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Status</th>
                                    <td>
                                        <span class="badge px-3 py-1-5 text-white fw-medium" style="background-color: #20c997; border-radius: 20px;">
                                            Terbit
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons (Kembali & Download Sertifikat) -->
        <div class="d-flex justify-content-end align-items-center gap-3 mt-4 pt-3 border-top">
            <a href="{{ route('admin.peserta.index') }}" class="btn text-white fw-bold px-4 py-2-5 shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="background-color: #ffb703; border-radius: 8px; border: none; min-width: 140px;">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <a href="#" class="btn btn-primary fw-bold px-4 py-2-5 shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="background-color: #3b82f6; border-radius: 8px; border: none;">
                <i class="bi bi-download"></i>
                <span>Download Sertifikat</span>
            </a>
        </div>

    </div>
</div>
@endsection