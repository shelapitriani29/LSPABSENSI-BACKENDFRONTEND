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
        
        <form action="{{ route('admin.peserta.store') }}" method="POST">
            @csrf
            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Username *</label>
                <div class="col-sm-9">
                    <input type="text" name="username" class="form-control border-secondary" placeholder="Username unik" value="{{ old('username') }}" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Email *</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control border-secondary" placeholder="email@domain.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Password *</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control border-secondary" placeholder="Min. 6 karakter" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Nama *</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control border-secondary" placeholder="Masukkan Nama . . ." value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Instansi</label>
                <div class="col-sm-9">
                    <input type="text" name="instansi" class="form-control border-secondary" placeholder="Masukkan Instansi . . ." value="{{ old('instansi') }}">
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">No Ponsel</label>
                <div class="col-sm-9">
                    <input type="text" name="no_hp" class="form-control border-secondary" placeholder="Masukkan nomor ponsel . . ." value="{{ old('no_hp') }}">
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Kelas</label>
                <div class="col-sm-9">
                    <input type="text" name="kelas" class="form-control border-secondary" placeholder="Masukkan Kelas . . ." value="{{ old('kelas') }}">
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Jurusan</label>
                <div class="col-sm-9">
                    <input type="text" name="jurusan" class="form-control border-secondary" placeholder="Masukkan Jurusan . . ." value="{{ old('jurusan') }}">
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <label class="col-sm-3 col-form-label fw-bold text-dark">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-select border-secondary" required>
                        <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
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