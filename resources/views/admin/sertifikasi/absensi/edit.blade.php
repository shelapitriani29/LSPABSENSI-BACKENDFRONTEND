@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Top Header & Breadcrumb -->
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">Absensi Peserta</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Sertifikasi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.absensi.index') }}" class="text-decoration-none text-muted">Absensi Peserta</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Edit Absensi</li>
            </ol>
        </nav>
    </div>

    <!-- Container Form Center -->
    <div class="d-flex justify-content-center">
        <div class="card border-0 shadow-sm p-4 bg-white w-100" style="max-width: 800px; border-radius: 12px;">
            
            <!-- Judul Form -->
            <h2 class="fw-bold text-dark mb-4 text-center" style="font-size: 1.75rem;">Edit Data Absensi</h2>

            <!-- Form Edit Absensi -->
            <form action="{{ route('admin.sertifikasi.absensi.index') }}" method="GET">
                @csrf
                
                <div class="row align-items-center mb-4">
                    <label for="nama" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Nama Peserta :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" id="nama" class="form-control bg-light border-secondary-subtle py-2 px-3" value="Haura" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="jadwal" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Jadwal Uji :</label>
                    <div class="col-sm-9">
                        <input type="text" name="jadwal" id="jadwal" class="form-control bg-light border-secondary-subtle py-2 px-3" value="JWD-01" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="check_in" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Check In :</label>
                    <div class="col-sm-9">
                        <input type="text" name="check_in" id="check_in" class="form-control bg-light border-secondary-subtle py-2 px-3" value="08.00" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="check_out" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Check Out :</label>
                    <div class="col-sm-9">
                        <input type="text" name="check_out" id="check_out" class="form-control bg-light border-secondary-subtle py-2 px-3" value="09.00" style="border-radius: 8px;">
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <label for="status" class="col-sm-3 col-form-label fw-bold text-dark fs-6">Status :</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-select bg-light border-secondary-subtle py-2 px-3" style="border-radius: 8px;">
                            <option value="Hadir" selected>Hadir</option>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                            <option value="Terlambat">Terlambat</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Belum Absen">Belum Absen</option>
                        </select>
                    </div>
                </div>

                <div class="row align-items-start mb-4">
                    <label for="catatan" class="col-sm-3 col-form-label fw-bold text-dark fs-6 pt-2">Catatan :</label>
                    <div class="col-sm-9">
                        <textarea name="catatan" id="catatan" class="form-control bg-light border-secondary-subtle py-2 px-3" rows="3" placeholder="Keterangan atau alasan (opsional)..." style="border-radius: 8px;"></textarea>
                    </div>
                </div>

                <!-- Action Buttons (Sejajar) -->
                <div class="d-flex justify-content-end align-items-center gap-3 mt-4">
                    <a href="{{ route('admin.sertifikasi.absensi.index') }}" class="btn text-white fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="background-color: #ffb703; border-radius: 8px; border: none; min-width: 110px;">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <button type="submit" class="btn text-white fw-bold px-4 py-2 shadow-sm" style="background-color: #20c997; border-radius: 8px; border: none; min-width: 110px;">
                        Simpan
                    </button>
                    <a href="{{ route('admin.sertifikasi.absensi.index') }}" class="btn text-white fw-bold px-4 py-2 shadow-sm" style="background-color: #ff4d4d; border-radius: 8px; border: none; min-width: 110px;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection