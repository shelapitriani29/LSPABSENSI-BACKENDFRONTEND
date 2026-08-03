@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 900px;">
    <!-- Header Page -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.3rem;">Data Skema Sertifikasi</h3>
            <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Referensi</li>
                    <li class="breadcrumb-item text-secondary">Data Skema Sertifikasi</li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Tambah Skema</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.skema.index') }}" class="btn text-white fw-semibold px-3 shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h4 class="fw-bold text-dark mb-4">Tambah Skema Sertifikasi</h4>
            <form>
                <!-- Informasi Skema -->
                <h6 class="fw-bold text-dark mb-3 text-uppercase fs-7">Informasi Skema</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Skema *</label>
                    <input type="text" class="form-control" placeholder="Contoh: Junior Web Developer">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Kode Skema *</label>
                        <input type="text" class="form-control" placeholder="Contoh: JWD">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Status</label>
                        <select class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Deskripsi singkat mengenai skema..."></textarea>
                </div>

                <hr class="my-4 text-muted">

                <!-- Kelas yang Mengikuti Skema -->
                <h6 class="fw-bold text-dark mb-3 text-uppercase fs-7">Kelas & Peserta yang Mengikuti Skema</h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Pilih Kelas *</label>
                    <select class="form-select">
                        <option value="">-- Pilih Kelas --</option>
                        <option value="xi_rpl_1">XI RPL 1</option>
                        <option value="xi_rpl_2">XI RPL 2</option>
                        <option value="xi_rpl_3">XI RPL 3</option>
                    </select>
                </div>

                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-dark fw-semibold">Peserta dari kelas ini: <span class="text-dark">36 orang</span></small>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" checked style="background-color: #1b6ca8; border-color: #1b6ca8;">
                            <label class="form-check-label small fw-semibold text-dark" for="selectAll">Pilih Semua Peserta</label>
                        </div>
                    </div>
                    
                    <div class="row g-2 ps-2 pt-2 border-top" style="max-height: 150px; overflow-y: auto;">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="p1" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                <label class="form-check-label small text-dark" for="p1">Jenisa Nurfadillah</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="p2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                <label class="form-check-label small text-dark" for="p2">Aulia</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="p3" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                <label class="form-check-label small text-dark" for="p3">Siti</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="p4" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                <label class="form-check-label small text-dark" for="p4">Raka</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.skema.index') }}" class="btn text-white px-4 fw-semibold shadow-sm" style="background-color: #dc3545; border-color: #dc3545;">Batal</a>
                    <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm" style="background-color: #28a745; border-color: #28a745;">Simpan Skema</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection