@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Profil Saya</h2>
        <p class="text-muted mb-1">Informasi profil akun Anda.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Informasi Profil Card -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Informasi Profil</h5>
                <hr class="text-muted opacity-25">
                
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4 text-muted fw-semibold">Nama Lengkap</div>
                    <div class="col-md-8 text-dark fw-bold">: {{ $user->name ?? 'Administrator' }}</div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4 text-muted fw-semibold">Email</div>
                    <div class="col-md-8 text-dark">: {{ $user->email ?? 'admin@smkn1garut.sch.id' }}</div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4 text-muted fw-semibold">Role</div>
                    <div class="col-md-8">
                        <span class="badge px-3 py-2 text-white" style="background-color: #1b6ca8;">Administrator</span>
                    </div>
                </div>
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4 text-muted fw-semibold">Bergabung Sejak</div>
                    <div class="col-md-8 text-dark">: {{ $user->created_at ? $user->created_at->format('d F Y') : '15 Januari 2023' }}</div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Samping (Edit Profil & Ubah Password) -->
        <div class="col-lg-4">
            <!-- Box Edit Profil -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-3 rounded-3 me-3" style="color: #1b6ca8;">
                        <i class="bi bi-person-gear fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Edit Profil</h6>
                        <small class="text-muted">Perbarui informasi profil akun Anda.</small>
                    </div>
                </div>
                <a href="{{ route('admin.profil.edit') }}" class="btn text-white w-100 fw-semibold" style="background-color: #1b6ca8;" onmouseover="this.style.backgroundColor='#145380'" onmouseout="this.style.backgroundColor='#1b6ca8'">
                    <i class="bi bi-pencil-square me-2"></i> Edit Profil
                </a>
            </div>

            <!-- Box Ubah Password -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-3 rounded-3 me-3 text-warning">
                        <i class="bi bi-shield-lock fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Ubah Password</h6>
                        <small class="text-muted">Ganti password akun secara berkala.</small>
                    </div>
                </div>
                <a href="{{ route('admin.profil.ubah-password') }}" class="btn btn-outline-secondary w-100 fw-semibold">
                    <i class="bi bi-key me-2"></i> Ubah Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection