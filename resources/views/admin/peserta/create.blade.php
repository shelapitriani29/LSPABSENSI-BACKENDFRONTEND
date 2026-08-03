@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <!-- Header Title & Subtitle -->
    <div class="mb-3">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">Data Peserta</h1>
        <small class="text-muted d-block fw-semibold mb-2" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.95rem;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}" class="text-decoration-none text-muted">Data Peserta</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Tambah Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Form Container Card -->
    <div class="card border border-2 p-4 bg-white mx-auto" style="border-color: #d1d5db !important; border-radius: 4px; max-width: 800px;">
        <h4 class="fw-bold mb-4 text-center text-dark">Tambah Peserta</h4>
        
        <form action="{{ route('admin.peserta.index') }}" method="GET">
            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">NIK :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control border-secondary" placeholder="Masukkan NIK . . ." required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Nama :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control border-secondary" placeholder="Masukkan Nama . . ." required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Instansi :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control border-secondary" placeholder="Masukkan Instansi . . ." required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">No Ponsel :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control border-secondary" placeholder="Masukkan nomor ponsel . . ." required>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Status :</label>
                <div class="col-sm-9">
                    <select class="form-select border-secondary" required>
                        <option value="" selected disabled>Pilih Opsi</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn text-white fw-bold px-4 py-2" style="background-color: #20C997; border-radius: 6px;">
                    Tambah
                </button>
                <a href="{{ route('admin.peserta.index') }}" class="btn text-white fw-bold px-4 py-2" style="background-color: #FF4D4D; border-radius: 6px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection