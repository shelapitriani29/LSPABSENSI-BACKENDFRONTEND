@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page -->
    <div class="mb-3">
        <h3 class="fw-bold mb-1" style="color: #212529;">Data Asesor</h3>
        <p class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><span class="text-decoration-none text-muted">Dashboard</span></li>
                <li class="breadcrumb-item"><span class="text-decoration-none text-muted">Referensi</span></li>
                <li class="breadcrumb-item"><span class="text-decoration-none text-muted">Data Asesor</span></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Edit Asesor</li>
            </ol>
        </nav>
    </div>

    <!-- Judul Edit Data Asesor yang Mencolok di Luar Card -->
    <div class="mb-3">
        <h4 class="fw-bold text-dark">Edit Data Asesor</h4>
    </div>

    <form action="#" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Kolom Kiri: Identitas & Keasesoran -->
            <div class="col-lg-8">
                
                <!-- Card Identitas -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-person-lines-fill me-2"></i>1. Identitas Asesor</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control" value="Budi Santoso, M.Kom.">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">NIP / NIPTK</label>
                                <input type="text" name="nip" class="form-control" value="198501102010011002">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">NIK</label>
                                <input type="text" name="nik" class="form-control" value="3205123456780001">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="Garut">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="1985-01-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="L" selected>Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" value="081234567890">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="2">Jl. Cimanuk No. 123, Tarogong Kidul, Garut</textarea>
                        </div>
                    </div>
                </div>

                <!-- Card Keasesoran -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-patch-check-fill me-2"></i>3. Data Keasesoran</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor Registrasi / Sertifikat Asesor</label>
                            <input type="text" name="no_sertifikat" class="form-control" value="ASR-001/LSP-SMKN1GRT/2023">
                        </div>
                        
                        <!-- Skema Kompetensi Dropdown -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Skema Kompetensi</label>
                            <select name="skema_kompetensi" class="form-select">
                                <option value="" disabled>Pilih Skema Kompetensi</option>
                                <option value="Junior Web Developer" selected>Junior Web Developer</option>
                                <option value="Junior Programmer">Junior Programmer</option>
                                <option value="Desainer Grafis Muda">Desainer Grafis Muda</option>
                                <option value="Administrator Jaringan Komputer">Administrator Jaringan Komputer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Status Asesor</label>
                            <select name="status" class="form-select">
                                <option value="aktif" selected>Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Akun Sistem -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-shield-lock-fill me-2"></i>2. Akun Sistem</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Username / ID Login</label>
                            <input type="text" name="username" class="form-control" value="budi_asesor">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="budi.santoso@smkn1garut.sch.id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Baru <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <!-- Tombol diubah menjadi Biru Navy -->
                            <button type="submit" class="btn text-white py-2 shadow-sm fw-semibold" style="background-color: #1e293b; border-color: #1e293b;">
                                <i class="bi bi-arrow-repeat me-1"></i> Perbarui Data Asesor
                            </button>
                            <a href="{{ route('admin.asesor.index') }}" class="btn btn-light py-2 border">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection