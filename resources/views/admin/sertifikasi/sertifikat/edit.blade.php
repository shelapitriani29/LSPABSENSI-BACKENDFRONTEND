@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
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

    <div class="card border-0 shadow-sm bg-white mx-auto p-4 p-md-5" style="border-radius: 16px; max-width: 900px;">
        
        <h2 class="fw-bold text-dark text-center mb-5" style="font-size: 2rem; letter-spacing: -0.5px;">Edit Data Sertifikat</h2>

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sertifikasi.sertifikat.update', $sertifikat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">No Sertifikat :</label>
                <div class="col-md-9">
                    <input type="text" name="no_sertifikat" class="form-control form-control-lg bg-light border-secondary-subtle" value="{{ old('no_sertifikat', $sertifikat->no_sertifikat) }}" style="border-radius: 8px; font-size: 0.95rem;" required>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">Peserta :</label>
                <div class="col-md-9">
                    <select name="user_id" class="form-select form-select-lg bg-light border-secondary-subtle" style="border-radius: 8px; font-size: 0.95rem;" required>
                        <option value="">Pilih Peserta</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $sertifikat->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">Skema Sertifikasi :</label>
                <div class="col-md-9">
                    <select name="skema_id" class="form-select form-select-lg bg-light border-secondary-subtle" style="border-radius: 8px; font-size: 0.95rem;">
                        <option value="">Pilih Skema</option>
                        @foreach($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ old('skema_id', $sertifikat->skema_id) == $skema->id ? 'selected' : '' }}>{{ $skema->nama_skema }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">Jadwal Uji :</label>
                <div class="col-md-9">
                    <select name="jadwal_id" class="form-select form-select-lg bg-light border-secondary-subtle" style="border-radius: 8px; font-size: 0.95rem;">
                        <option value="">Pilih Jadwal</option>
                        @foreach($jadwals as $jadwal)
                            <option value="{{ $jadwal->id }}" {{ old('jadwal_id', $sertifikat->jadwal_id) == $jadwal->id ? 'selected' : '' }}>{{ $jadwal->kode_jadwal }} - {{ optional($jadwal->skema)->nama_skema ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">Tanggal Terbit :</label>
                <div class="col-md-9">
                    <input type="date" name="tanggal_terbit" class="form-control form-control-lg bg-light border-secondary-subtle" value="{{ old('tanggal_terbit', $sertifikat->tanggal_terbit ? \Carbon\Carbon::parse($sertifikat->tanggal_terbit)->format('Y-m-d') : '') }}" style="border-radius: 8px; font-size: 0.95rem;">
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <label class="col-md-3 col-form-label fw-bold text-dark" style="font-size: 0.95rem;">Status :</label>
                <div class="col-md-9">
                    <select name="status" class="form-select form-select-lg bg-light border-secondary-subtle" style="border-radius: 8px; font-size: 0.95rem;" required>
                        <option value="Aktif" {{ old('status', $sertifikat->status) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ old('status', $sertifikat->status) === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 pt-2">
                <a href="{{ route('admin.sertifikasi.sertifikat.index') }}" class="btn text-white fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" style="background-color: #ffc107; border-radius: 8px; font-size: 0.95rem;">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn text-white fw-bold px-4 py-2" style="background-color: #20c997; border-radius: 8px; font-size: 0.95rem;">
                    Simpan
                </button>
                <a href="{{ route('admin.sertifikasi.sertifikat.index') }}" class="btn text-white fw-bold px-4 py-2" style="background-color: #ff4d4d; border-radius: 8px; font-size: 0.95rem;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection