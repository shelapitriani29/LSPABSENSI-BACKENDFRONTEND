@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Halaman & Tombol Kembali Disejajarkan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Detail Asesor</h3>
            <p class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small" style="background: transparent; padding: 0;">
                    <li class="breadcrumb-item"><span class="text-secondary">Dashboard</span></li>
                    <li class="breadcrumb-item"><span class="text-secondary">Referensi</span></li>
                    <li class="breadcrumb-item"><span class="text-secondary">Data Asesor</span></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Detail Asesor</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.asesor.index') }}" class="btn text-white fw-semibold px-3 shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Identitas -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-person-fill me-2" style="color: #1b6ca8;"></i>1. Identitas Asesor</h5>
                    <table class="table table-borderless align-middle small">
                        <tr>
                            <td width="30%" class="text-muted">Nama Lengkap</td>
                            <td width="2%">:</td>
                            <td class="fw-bold text-dark">Budi Santoso, M.Kom.</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIP / NIPTK</td>
                            <td>:</td>
                            <td>198501102010011002</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIK</td>
                            <td>:</td>
                            <td>3205123456780001</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td>Garut, 10 Januari 1985</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jenis Kelamin</td>
                            <td>:</td>
                            <td>Laki-laki</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Alamat</td>
                            <td>:</td>
                            <td>Jl. Cimanuk No. 123, Tarogong Kidul, Garut</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. HP</td>
                            <td>:</td>
                            <td>081234567890</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Data Akun Sistem -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-shield-lock-fill me-2" style="color: #1b6ca8;"></i>2. Data Akun Sistem</h5>
                    <table class="table table-borderless align-middle small mb-3">
                        <tr>
                            <td width="40%" class="text-muted">Username</td>
                            <td width="5%">:</td>
                            <td class="fw-bold">budi_asesor</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>:</td>
                            <td>budi.santoso@...</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Role</td>
                            <td>:</td>
                            <td><span class="badge bg-secondary">Asesor</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status Akun</td>
                            <td>:</td>
                            <td><span class="badge bg-success px-3 py-1">Aktif</span></td>
                        </tr>
                    </table>
                    <div class="d-grid">
                        <button class="btn btn-outline-secondary text-dark btn-sm fw-semibold shadow-sm">
                            <i class="bi bi-key me-1"></i> Reset Password Akun
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Bawah: Data Keasesoran -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-patch-check-fill me-2" style="color: #1b6ca8;"></i>3. Data Keasesoran</h5>
            <table class="table table-borderless align-middle small">
                <tr>
                    <td width="20%" class="text-muted">No. Registrasi / Sertifikat</td>
                    <td width="2%">:</td>
                    <td><span class="badge bg-dark text-white px-2 py-1">ASR-001/LSP-SMKN1GRT/2023</span></td>
                </tr>
                <tr>
                    <td class="text-muted">Skema Kompetensi</td>
                    <td>:</td>
                    <td>
                        <ul class="mb-0 ps-3">
                            <li>Junior Web Developer</li>
                            <li>Junior Programmer</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Status Asesor</td>
                    <td>:</td>
                    <td><span class="badge bg-success px-3 py-1">Aktif</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection