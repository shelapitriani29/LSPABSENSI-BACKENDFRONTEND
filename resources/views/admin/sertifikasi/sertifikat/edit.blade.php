@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Top Header & Breadcrumb -->
    <div class="mb-4">
        <small class="text-secondary d-block fw-medium mb-1" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Sertifikasi</li>
                <li class="breadcrumb-item text-muted">Sertifikat</li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Edit Sertifikat</li>
            </ol>
        </nav>
    </div>

    <!-- Main Card Container -->
    <div class="card border-0 shadow-sm bg-white mx-auto p-4 p-md-5" style="border-radius: 16px; max-width: 900px;">
        
        <!-- Judul Halaman di Tengah -->
        <h2 class="fw-bold text-dark text-center mb-5" style="font-size: 2rem; letter-spacing: -0.5px;">
            Edit Data Sertifikat
        </h2>

        <!-- Form Edit Data -->
        <form action="#" method="POST">
            @csrf
            @method('PUT')

            <!-- No Sertifikat -->
            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">
                    No Sertifikat :
                </label>
                <div class="col-md-9">
                    <input type="text" name="no_sertifikat" class="form-control form-control-lg bg-light border-secondary-subtle" 
                           value="LSP-001-2026" style="border-radius: 8px; font-size: 0.95rem;" required>
                </div>
            </div>

            <!-- Nama Peserta -->
            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">
                    Nama Peserta :
                </label>
                <div class="col-md-9">
                    <input type="text" name="peserta" class="form-control form-control-lg bg-light border-secondary-subtle" 
                           value="Haura" style="border-radius: 8px; font-size: 0.95rem;" required>
                </div>
            </div>

            <!-- Skema Sertifikasi -->
            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">
                    Skema Sertifikasi :
                </label>
                <div class="col-md-9">
                    <input type="text" name="skema" class="form-control form-control-lg bg-light border-secondary-subtle" 
                           value="Graphic Design" style="border-radius: 8px; font-size: 0.95rem;" required>
                </div>
            </div>

            <!-- Tanggal Terbit -->
            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">
                    Tanggal Terbit :
                </label>
                <div class="col-md-9">
                    <input type="date" name="tanggal_terbit" class="form-control form-control-lg bg-light border-secondary-subtle" 
                           value="2026-06-15" style="border-radius: 8px; font-size: 0.95rem;" required>
                </div>
            </div>

            <!-- Status -->
            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">
                    Status :
                </label>
                <div class="col-md-9">
                    <select name="status" class="form-select form-select-lg bg-light border-secondary-subtle" style="border-radius: 8px; font-size: 0.95rem;">
                        <option value="Aktif" selected>Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Catatan / Keterangan (Opsional) -->
            <div class="row mb-5">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">
                    Catatan :
                </label>
                <div class="col-md-9">
                    <textarea name="catatan" class="form-control bg-light border-secondary-subtle" rows="3" 
                              placeholder="Keterangan atau alasan (opsional)..." style="border-radius: 8px; font-size: 0.95rem;"></textarea>
                </div>
            </div>

            <!-- Tombol Action di Bagian Kanan Bawah -->
            <div class="d-flex justify-content-end align-items-center gap-3 pt-2">
                <!-- Tombol Kembali (Kuning) -->
                <a href="#" onclick="window.history.back();" class="btn text-white fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" 
                   style="background-color: #ffc107; border-radius: 8px; font-size: 0.95rem;">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <!-- Tombol Simpan (Teal / Hijau Toska) -->
                <button type="submit" class="btn text-white fw-bold px-4 py-2" 
                        style="background-color: #20c997; border-radius: 8px; font-size: 0.95rem;">
                    Simpan
                </button>

                <!-- Tombol Batal (Merah) -->
                <a href="#" onclick="window.history.back();" class="btn text-white fw-bold px-4 py-2" 
                   style="background-color: #ff4d4d; border-radius: 8px; font-size: 0.95rem;">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection