@extends('layouts.peserta')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    <!-- Header Title & Subtitle -->
    <div class="mb-3">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -0.5px;">Ubah Password</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">Pastikan password Anda kuat dan tidak mudah ditebak.</small>

        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('peserta.profil') }}" class="text-decoration-none text-secondary">Profil</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Ubah Password</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <div class="card border p-4 bg-white shadow-sm mb-4" style="border-color: #cbd5e1 !important; border-radius: 8px;">
                <div class="row">
                    <!-- Form Ubah Password -->
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.25rem;">Ubah Password</h2>
                        <p class="text-secondary small mb-4">Pastikan password Anda kuat dan tidak mudah ditebak.</p>

                        <form action="{{ route('peserta.profil.update-password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Password Saat Ini</label>
                                <div class="input-group">
                                    <input type="password" name="current_password" class="form-control border-secondary-subtle" placeholder="Masukkan password saat ini" required>
                                    <span class="input-group-text bg-white border-secondary-subtle text-secondary" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" name="new_password" class="form-control border-secondary-subtle" placeholder="Masukkan password baru" required>
                                    <span class="input-group-text bg-white border-secondary-subtle text-secondary" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-secondary small">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <input type="password" name="new_password_confirmation" class="form-control border-secondary-subtle" placeholder="Konfirmasi password baru" required>
                                    <span class="input-group-text bg-white border-secondary-subtle text-secondary" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn text-white px-4 py-2 fw-semibold shadow-sm d-flex align-items-center gap-1" style="background-color: #0d6efd; border-radius: 6px; font-size: 0.9rem;">
                                    <i class="bi bi-lock"></i> Ubah Password
                                </button>
                                <a href="{{ route('peserta.profil') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 6px; font-size: 0.9rem;">Batal</a>
                            </div>
                        </form>
                    </div>

                    <!-- Kotak Tips Keamanan -->
                    <div class="col-lg-5">
                        <div class="p-4 rounded" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex align-items-center gap-2 mb-3 text-primary fw-bold">
                                <i class="bi bi-shield-check fs-5"></i>
                                <span>Tips Keamanan</span>
                            </div>
                            <ul class="list-unstyled text-secondary small mb-0 d-flex flex-column gap-2" style="line-height: 1.5;">
                                <li class="d-flex align-items-start gap-2">
                                    <span style="font-size: 6px; margin-top: 6px;" class="text-primary">■</span>
                                    <span>Gunakan minimal 6 karakter</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <span style="font-size: 6px; margin-top: 6px;" class="text-primary">■</span>
                                    <span>Kombinasikan huruf besar, kecil, angka, dan simbol</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <span style="font-size: 6px; margin-top: 6px;" class="text-primary">■</span>
                                    <span>Jangan gunakan informasi pribadi</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <span style="font-size: 6px; margin-top: 6px;" class="text-primary">■</span>
                                    <span>Ganti password secara berkala</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
