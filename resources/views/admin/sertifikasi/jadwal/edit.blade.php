@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page dengan Tombol Kembali di Kanan -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Jadwal Uji</h3>
            <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Sertifikasi</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Edit Jadwal Uji</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="btn text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1" style="background-color: #337ab7;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Edit Jadwal Uji -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4">Edit Jadwal Uji</h5>
            <form action="{{ route('admin.sertifikasi.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Kode Jadwal</label>
                    <input type="text" name="kode_jadwal" class="form-control" value="{{ old('kode_jadwal', $jadwal->kode_jadwal) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Skema Sertifikasi *</label>
                    <select name="skema_id" class="form-select" required>
                        <option value="" disabled {{ old('skema_id', $jadwal->skema_id) ? '' : 'selected' }}>Pilih skema</option>
                        @foreach($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ old('skema_id', $jadwal->skema_id) == $skema->id ? 'selected' : '' }}>{{ $skema->nama_skema }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Asesor *</label>
                    <select name="asesor_id" class="form-select" required>
                        <option value="" disabled {{ old('asesor_id', $jadwal->asesor_id) ? '' : 'selected' }}>Pilih asesor</option>
                        @foreach($asesors as $asesor)
                            <option value="{{ $asesor->id }}" {{ old('asesor_id', $jadwal->asesor_id) == $asesor->id ? 'selected' : '' }}>{{ $asesor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Tanggal Uji *</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Jam Mulai *</label>
                        <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Jam Selesai *</label>
                        <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Lokasi *</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $jadwal->lokasi) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan jika ada...">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="btn btn-danger text-white px-4">Batal</a>
                    <button type="submit" class="btn text-white px-4" style="background-color: #28a745;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
