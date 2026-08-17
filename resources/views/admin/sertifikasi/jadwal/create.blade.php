@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Jadwal Uji</h4>
            <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-dark">Sertifikasi</span></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="text-dark text-decoration-none">Jadwal Uji</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Tambah Jadwal Uji</li>
                </ol>
            </nav>
        </div>
        <div>
            <!-- Tombol Kembali menggunakan btn-primary agar warnanya biru seperti contoh -->
            <a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="btn text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1" style="background-color: #337ab7;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4">Tambah Jadwal Uji</h5>

            <form action="{{ route('admin.sertifikasi.jadwal.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger p-3 mb-4">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Kode Jadwal</label>
                    <input type="text" name="kode_jadwal" class="form-control" value="{{ old('kode_jadwal') }}" placeholder="Masukkan kode jadwal" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Skema Sertifikasi *</label>
                    <select name="skema_id" class="form-select" required>
                        <option value="" disabled {{ old('skema_id') ? '' : 'selected' }}>Pilih skema</option>
                        @foreach($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>{{ $skema->nama_skema }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Kelas *</label>
                    <select name="kelas" class="form-select" required>
                        <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>Pilih kelas</option>
                        @foreach($kelasOptions as $kelas)
                            <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Asesor *</label>
                    <select name="asesor_id" class="form-select" required>
                        <option value="" disabled {{ old('asesor_id') ? '' : 'selected' }}>Pilih asesor</option>
                        @foreach($asesors as $asesor)
                            <option value="{{ $asesor->id }}" {{ old('asesor_id') == $asesor->id ? 'selected' : '' }}>{{ $asesor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Tanggal Uji *</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Jam Mulai *</label>
                        <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Jam Selesai *</label>
                        <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Lokasi *</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Masukkan lokasi" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan jika ada...">{{ old('keterangan') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="btn btn-danger px-4">Batal</a>
                    <button type="submit" class="btn btn-success px-4" style="background-color: #28a745; border-color: #28a745;">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection