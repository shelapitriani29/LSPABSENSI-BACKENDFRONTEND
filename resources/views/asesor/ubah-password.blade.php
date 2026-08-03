@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Ubah Password</h2>
        <p class="text-secondary mb-2" style="font-size: 0.9rem;">Pastikan password Anda kuat dan tidak mudah ditebak.</p>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-decoration-none" style="color: #1E6388;">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.profil') }}" class="text-decoration-none" style="color: #1E6388;">Profil</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Ubah Password</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Success / Error jika ada -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 0.9rem;">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Ubah Password dengan Layout 2 Kolom -->
    <div class="row g-4">
        <!-- Kolom Form Utama -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">Ubah Password</h5>
                <p class="text-secondary mb-4" style="font-size: 0.85rem;">Pastikan password Anda kuat dan tidak mudah ditebak.</p>

                <form action="{{ route('asesor.profil.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Password Saat Ini</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Masukkan password saat ini" style="font-size: 0.9rem; padding: 10px 15px;">
                            <span class="input-group-text bg-white text-secondary" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru" style="font-size: 0.9rem; padding: 10px 15px;">
                            <span class="input-group-text bg-white text-secondary" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="new_password_confirmation" class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi password baru" style="font-size: 0.9rem; padding: 10px 15px;">
                            <span class="input-group-text bg-white text-secondary" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('asesor.profil') }}" class="btn btn-outline-secondary px-4 py-2" style="font-size: 0.9rem; font-weight: 500;">Batal</a>
                        <button type="submit" class="btn text-white px-4 py-2 shadow-sm" style="font-size: 0.9rem; font-weight: 500; background-color: #1E6388;">
                            <i class="bi bi-shield-lock me-1"></i> Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kolom Tips Keamanan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="text-primary me-2" style="font-size: 1.2rem;">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Tips Keamanan</h6>
                </div>
                <ul class="text-secondary ps-3 mb-0" style="font-size: 0.85rem; line-height: 1.6;">
                    <li>Gunakan minimal 8 karakter.</li>
                    <li>Kombinasikan huruf besar, kecil, angka, dan simbol.</li>
                    <li>Jangan gunakan informasi pribadi.</li>
                    <li>Ganti password secara berkala.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection