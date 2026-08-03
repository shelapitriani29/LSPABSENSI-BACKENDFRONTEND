@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    
    <div class="mt-4 mb-2">
        <h1 class="h3 fw-bold text-dark">Detail User</h1>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}" class="text-muted text-decoration-none">Manajemen User</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm mt-3 mb-4">
        <div class="card-body p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h4 class="fw-bold text-dark mb-0">Informasi Lengkap User</h4>
                <a href="{{ route('admin.user.index') }}" class="btn btn-warning btn-sm text-dark px-3 fw-semibold d-flex align-items-center gap-1 text-decoration-none">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="row">

                <div class="col-md-4 text-center border-end mb-4 mb-md-0">
                    <div class="mb-3">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm text-secondary" style="width: 100px; height: 100px; font-size: 2.5rem;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Jenisa</h5>
                    <p class="text-muted small mb-2">NISN: 2310012345</p>
                    <span class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                </div>

                <div class="col-md-8 ps-md-4">
                    <h5 class="fw-bold text-dark mb-3">Biodata Akademik & Akun</h5>
                    
                    <table class="table table-borderless align-middle small mb-0">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 35%;">Nama Lengkap</td>
                            <td class="text-dark fw-bold">: Jenisa</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">NISN (Username)</td>
                            <td class="text-dark">: 2310012345</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Role Akun</td>
                            <td class="text-dark"><span class="badge bg-primary px-2 py-1">Peserta</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Kelas</td>
                            <td class="text-dark">: XI RPL 1</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Jurusan</td>
                            <td class="text-dark">: Rekayasa Perangkat Lunak</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">No HP</td>
                            <td class="text-dark">: 081234567890</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Status Akun</td>
                            <td class="text-dark">: <span class="text-success fw-bold">Aktif</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Terdaftar Sejak</td>
                            <td class="text-dark">: 15 Juli 2025</td>
                        </tr>
                    </table>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <a href="{{ route('admin.user.edit', $id ?? 1) }}" class="btn btn-sm text-white fw-semibold px-3 text-decoration-none d-inline-flex align-items-center" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                            <i class="fas fa-edit me-1"></i> Edit Data
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection