@extends('layouts.peserta')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    <!-- Header Title & Subtitle -->
    <div class="mb-3">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -0.5px;">Profil Saya</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">Informasi profil akun Anda.</small>
        
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Profil</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Success / Error Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Container -->
    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Profil -->
        <div class="col-lg-8">
            <div class="card border p-4 bg-white shadow-sm mb-4" style="border-color: #cbd5e1 !important; border-radius: 8px;">
                <h2 class="fw-bold text-dark mb-4" style="font-size: 1.25rem;">Informasi Profil</h2>

                <div class="row align-items-center mb-4">
                    <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                        @if(auth()->check() && auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil" class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                        @else
                            <div class="d-inline-block p-3 rounded-circle text-white shadow-sm" style="background-color: #1b6ca8; width: 90px; height: 90px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9 text-center text-md-start">
                        <button type="button" class="btn btn-outline-secondary btn-sm px-3 fw-medium mb-2" style="border-radius: 6px;" data-bs-toggle="modal" data-bs-target="#modalUbahFoto">
                            <i class="bi bi-camera me-1"></i> Ubah Foto
                        </button>
                        <p class="text-secondary small mb-0">Format yang diizinkan: JPG, JPEG, PNG. Ukuran maks. 2MB.</p>
                    </div>
                </div>

                <hr class="text-secondary opacity-25 mb-4">

                <div class="row g-3 mb-3">
                    <div class="col-sm-4 text-secondary fw-medium small">Nama Lengkap</div>
                    <div class="col-sm-8 text-dark fw-semibold">{{ $user->name ?? '-' }}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-4 text-secondary fw-medium small">NIS / No. Registrasi</div>
                    <div class="col-sm-8 text-dark fw-semibold">{{ $user->nis ?? $user->nik ?? $user->username ?? '-' }}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-4 text-secondary fw-medium small">Kelas / Kompetensi</div>
                    <div class="col-sm-8 text-dark fw-semibold">{{ $user->kelas ?? $user->skema_kompetensi ?? 'Belum ditentukan' }}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-4 text-secondary fw-medium small">Email</div>
                    <div class="col-sm-8 text-dark fw-semibold">{{ $user->email ?? '-' }}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-4 text-secondary fw-medium small">Role</div>
                    <div class="col-sm-8">
                        <span class="badge text-white px-3 py-1 fw-semibold" style="background-color: #1b6ca8; border-radius: 6px; font-size: 0.8rem;">{{ ucfirst($user->role ?? 'Peserta') }}</span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-sm-4 text-secondary fw-medium small">Bergabung Sejak</div>
                    <div class="col-sm-8 text-dark fw-semibold">{{ optional($user->created_at)->translatedFormat('j F Y') ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Aksi / Menu Cepat (Edit Profil & Ubah Password) -->
        <div class="col-lg-4">
            <!-- Card Edit Profil -->
            <div class="card border p-4 bg-white shadow-sm mb-4" style="border-color: #cbd5e1 !important; border-radius: 8px;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-2 rounded-2 text-white" style="background-color: #1b6ca8;">
                        <i class="bi bi-person-gear fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">Edit Profil</h5>
                        <small class="text-secondary" style="font-size: 0.8rem;">Perbarui informasi profil seperti nama, email, dan foto profil.</small>
                    </div>
                </div>
                <a href="{{ route('peserta.profil.edit') }}" class="btn text-white fw-medium w-100 py-2 shadow-sm text-decoration-none text-center" style="background-color: #1b6ca8; border-radius: 6px; font-size: 0.9rem;">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profil
                </a>
            </div>

            <!-- Card Ubah Password -->
            <div class="card border p-4 bg-white shadow-sm" style="border-color: #cbd5e1 !important; border-radius: 8px;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-2 rounded-2 text-white" style="background-color: #1b6ca8;">
                        <i class="bi bi-shield-lock fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">Ubah Password</h5>
                        <small class="text-secondary" style="font-size: 0.8rem;">Ganti password akun Anda secara berkala untuk keamanan.</small>
                    </div>
                </div>
                <a href="{{ route('peserta.profil.ubah-password') }}" class="btn btn-outline-secondary fw-medium w-100 py-2 shadow-sm text-decoration-none text-center" style="border-radius: 6px; font-size: 0.9rem;">
                    <i class="bi bi-key me-1"></i> Ubah Password
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL UBAH FOTO ================= -->
<div class="modal fade" id="modalUbahFoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-bottom px-4 py-3 bg-light" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title fw-bold text-dark">Ubah Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('peserta.profil.update-foto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3 text-center">
                        <label class="form-label fw-semibold small text-secondary">Pilih Foto Baru</label>
                        <input type="file" name="foto" class="form-control border-secondary-subtle" accept=".jpg, .jpeg, .png" required>
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Format: JPG, JPEG, PNG. Ukuran maks: 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 border-top bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white fw-semibold btn-sm px-4" style="background-color: #1b6ca8; border-radius: 6px;">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection