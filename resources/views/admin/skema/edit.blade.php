@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 900px;">
    <!-- Header Page -->
    <div class="mb-4">
        <a href="{{ route('admin.skema.index') }}" class="text-decoration-none small mb-2 d-inline-block fw-semibold text-dark">
            <i class="bi bi-arrow-left"></i> Kembali ke Data Skema
        </a>
        <h4 class="fw-bold mb-1 text-dark">Edit Skema Sertifikasi</h4>
        <p class="text-secondary small mb-0">Perbarui informasi skema sertifikasi dan penetapan pesertanya</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form>
                <!-- Informasi Skema -->
                <h6 class="fw-bold mb-3 text-uppercase fs-7" style="color: #1b6ca8;">Informasi Skema</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Nama Skema *</label>
                    <input type="text" class="form-control" value="Junior Web Developer">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-dark">Kode Skema *</label>
                        <input type="text" class="form-control" value="JWD">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-dark">Status</label>
                        <select class="form-select">
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-dark">Deskripsi</label>
                    <textarea class="form-control" rows="3">Membuat dan mengembangkan aplikasi web...</textarea>
                </div>

                <hr class="my-4 text-muted">

                <!-- Kelas yang Mengikuti Skema -->
                <h6 class="fw-bold mb-3 text-uppercase fs-7" style="color: #1b6ca8;">Kelas & Peserta yang Mengikuti Skema</h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Pilih Kelas *</label>
                    <select class="form-select">
                        <option value="xi_rpl_1" selected>XI RPL 1</option>
                        <option value="xi_rpl_2">XI RPL 2</option>
                        <option value="xi_rpl_3">XI RPL 3</option>
                    </select>
                </div>

                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted fw-semibold">Peserta dari kelas ini: <span class="text-dark">36 orang</span></small>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" checked>
                            <label class="form-check-label small fw-semibold text-dark" for="selectAll">Pilih Semua Peserta</label>
                        </div>
                    </div>
                    
                    <div class="row g-2 ps-2 pt-2 border-top" style="max-height: 150px; overflow-y: auto;">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="p1">
                                <label class="form-check-label small text-dark" for="p1">Jenisa Nurfadillah</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="p2">
                                <label class="form-check-label small text-dark" for="p2">Aulia</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.skema.index') }}" class="btn btn-light px-4 border fw-semibold text-secondary">Batal</a>
                    <button type="submit" class="btn px-4 text-white fw-semibold shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection