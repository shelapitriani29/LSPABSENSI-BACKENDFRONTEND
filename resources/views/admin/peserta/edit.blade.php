@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Top Header & Breadcrumb -->
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">Data Peserta</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}" class="text-decoration-none text-muted">Data Peserta</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Edit Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Container Form Center -->
    <div class="d-flex justify-content-center">
        <div class="card border-0 shadow-sm p-4 bg-white w-100" style="max-width: 800px; border-radius: 12px;">
            
            <!-- Judul Form -->
            <h2 class="fw-bold text-dark mb-4 text-center" style="font-size: 1.75rem;">Edit Data Peserta</h2>

            <!-- Form Edit Peserta -->
            <form action="{{ route('admin.peserta.index') }}" method="GET">
                @csrf
                
                <div class="row align-items-center mb-4">
                    <label for="nik" class="col-sm-3 col-form-label fw-bold text-dark fs-6">NIK :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nik" id="nik" class="form-control bg-light border-secondary-subtle py-2 px-3" value="3201234567890001" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="nama" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Nama :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" id="nama" class="form-control bg-light border-secondary-subtle py-2 px-3" value="Haura" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="instansi" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Instansi :</label>
                    <div class="col-sm-9">
                        <input type="text" name="instansi" id="instansi" class="form-control bg-light border-secondary-subtle py-2 px-3" value="smkn 1 garut" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="no_hp" class="col-sm-3 col-form-label fw-bold text-dark fs-6">No Ponsel :</label>
                    <div class="col-sm-9">
                        <input type="text" name="no_hp" id="no_hp" class="form-control bg-light border-secondary-subtle py-2 px-3" value="081234567890" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="status" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Status :</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-select bg-light border-secondary-subtle py-2 px-3" style="border-radius: 8px;">
                            <option value="Aktif" selected>Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons (Sejajar) -->
                <div class="d-flex justify-content-end align-items-center gap-3 mt-4">
                    <a href="{{ route('admin.peserta.index') }}" class="btn text-white fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="background-color: #ffb703; border-radius: 8px; border: none; min-width: 110px;">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <button type="submit" class="btn text-white fw-bold px-4 py-2 shadow-sm" style="background-color: #20c997; border-radius: 8px; border: none; min-width: 110px;">
                        Simpan
                    </button>
                    <a href="{{ route('admin.peserta.index') }}" class="btn text-white fw-bold px-4 py-2 shadow-sm" style="background-color: #ff4d4d; border-radius: 8px; border: none; min-width: 110px;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection