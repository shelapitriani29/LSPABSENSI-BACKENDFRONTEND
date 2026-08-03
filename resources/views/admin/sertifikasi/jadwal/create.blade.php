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
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Kode Jadwal</label>
                    <input type="text" name="kode_jadwal" class="form-control" value="JWD-001" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Skema Sertifikasi *</label>
                    <select name="skema_id" class="form-select">
                        <option value="1">Junior Web Developer</option>
                        <option value="2">Junior Programmer</option>
                        <option value="3">UI/UX Designer</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Kelas *</label>
                        <select name="kelas" class="form-select">
                            <option value="XI RPL 1">XI RPL 1</option>
                            <option value="XI RPL 2">XI RPL 2</option>
                            <option value="XI RPL 3">XI RPL 3</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Jumlah Peserta</label>
                        <input type="text" class="form-control-plaintext fw-semibold text-dark" value="36 Peserta" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Asesor *</label>
                    <select name="asesor" class="form-select">
                        <option value="Budi Santoso">Budi Santoso</option>
                        <option value="Andi">Andi</option>
                        <option value="Siti">Siti</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Tanggal Uji *</label>
                        <input type="date" name="tanggal" class="form-control" value="2026-07-30">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Jam Mulai *</label>
                        <input type="time" name="jam_mulai" class="form-control" value="08:00">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold small">Jam Selesai *</label>
                        <input type="time" name="jam_selesai" class="form-control" value="12:00">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Lokasi *</label>
                    <select name="lokasi" class="form-select">
                        <option value="Lab Komputer 1">Lab Komputer 1</option>
                        <option value="Lab Komputer 2">Lab Komputer 2</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan jika ada..."></textarea>
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