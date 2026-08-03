@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Edit Profil</h2>
        <p class="text-secondary mb-2" style="font-size: 0.9rem;">Perbarui informasi data diri akun Anda.</p>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-decoration-none" style="color: #1E6388;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.profil') }}" class="text-decoration-none" style="color: #1E6388;">Profil</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Edit Profil</li>
            </ol>
        </nav>
    </div>

    <!-- Form Edit Profil -->
    <div class="card border-0 shadow-sm rounded-3 p-4 mb-5" style="max-width: 800px;">
        <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">Informasi Akun</h5>
        <p class="text-secondary mb-4" style="font-size: 0.85rem;">Perbarui informasi akun Anda pada form di bawah ini.</p>

        <form action="{{ route('asesor.profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="Budi Santoso" style="font-size: 0.9rem; padding: 10px 15px;">
            </div>

            <div class="mb-3">
                <label for="met" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">No. Registrasi / MET</label>
                <input type="text" class="form-control" id="met" name="met" value="MET.000.123456 2023" style="font-size: 0.9rem; padding: 10px 15px;">
            </div>

            <div class="mb-3">
                <label for="kompetensi" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Bidang / Kompetensi</label>
                <input type="text" class="form-control" id="kompetensi" name="kompetensi" value="Junior Web Developer & Software Engineering" style="font-size: 0.9rem; padding: 10px 15px;">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="budi.santoso@lsp1.sch.id" style="font-size: 0.9rem; padding: 10px 15px;">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Role</label>
                <input type="text" class="form-control bg-light text-secondary" id="role" value="Asesor" disabled style="font-size: 0.9rem; padding: 10px 15px;">
            </div>

            <div class="mb-4">
                <label for="tanggal_bergabung" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Tanggal Bergabung</label>
                <input type="text" class="form-control bg-light text-secondary" id="tanggal_bergabung" value="15 Januari 2023" disabled style="font-size: 0.9rem; padding: 10px 15px;">
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('asesor.profil') }}" class="btn btn-outline-secondary px-4 py-2" style="font-size: 0.9rem; font-weight: 500;">Batal</a>
                <button type="submit" class="btn text-white px-4 py-2 shadow-sm" style="font-size: 0.9rem; font-weight: 500; background-color: #1E6388;">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection