@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Ubah Password</h2>
        <p class="text-muted mb-1">Pastikan password Anda kuat dan tidak mudah ditebak.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.profil') }}">Profil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-1">Ubah Password</h5>
                <p class="text-muted small">Pastikan password Anda kuat dan tidak mudah ditebak.</p>
                <hr class="text-muted opacity-25">

                <form action="{{ route('admin.profil.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold text-muted">Password Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Masukkan password saat ini" required>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-semibold text-muted">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru" required>
                    </div>

                    <div class="mb-4">
                        <label for="new_password_confirmation" class="form-label fw-semibold text-muted">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi password baru" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.profil') }}" class="btn btn-outline-secondary px-4 fw-semibold">Batal</a>
                        <button type="submit" class="btn text-white px-4 fw-semibold" style="background-color: #1b6ca8;" onmouseover="this.style.backgroundColor='#145380'" onmouseout="this.style.backgroundColor='#1b6ca8'">
                            <i class="bi bi-key me-1"></i> Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Keamanan Samping -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="text-primary fs-4 me-2">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Tips Keamanan</h6>
                </div>
                <ul class="text-muted small ps-3 mb-0 lh-lg">
                    <li>Gunakan minimal 6 karakter.</li>
                    <li>Kombinasikan huruf besar, kecil, angka, dan simbol.</li>
                    <li>Jangan gunakan informasi pribadi.</li>
                    <li>Ganti password secara berkala.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
