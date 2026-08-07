@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Profil Saya</h2>
        <p class="text-secondary mb-2" style="font-size: 0.9rem;">Informasi profil akun Anda.</p>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-decoration-none" style="color: #1E6388;">Dashboard</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Profil</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Success jika ada session success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 0.9rem;">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Profil -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h5 class="fw-bold text-dark mb-4" style="font-size: 1.1rem;">Informasi Profil</h5>
                
                <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                    @php
                        $initials = collect(explode(' ', trim($user->name)))->map(fn($part) => strtoupper(substr($part, 0, 1)))->join('');
                        $profilePhotoUrl = $user->foto ? asset('storage/' . $user->foto) : null;
                    @endphp
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm overflow-hidden" style="width: 80px; height: 80px; font-size: 1.8rem; background-color: #1E6388;">
                        @if($profilePhotoUrl)
                            <img src="{{ $profilePhotoUrl }}" alt="Foto Profil" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
                        @else
                            {{ $initials ?: 'U' }}
                        @endif
                    </div>
                    <div>
                        <button type="button" onclick="event.preventDefault(); document.getElementById('profile-photo-input').click();" class="btn btn-outline-secondary btn-sm mb-1 px-3 py-1" style="font-size: 0.8rem;">
                            <i class="bi bi-camera me-1"></i> Ubah Foto
                        </button>
                        <p class="text-muted mb-0" style="font-size: 0.75rem;">Format yang diizinkan: JPG, JPEG, PNG. Ukuran maks. 2MB.</p>
                    </div>
                </div>
                <form id="profile-photo-form" action="{{ route('asesor.profil.update-foto') }}" method="POST" enctype="multipart/form-data" class="d-none">
                    @csrf
                    <input id="profile-photo-input" type="file" name="foto" accept="image/*" onchange="this.form.submit()">
                </form>

                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0" style="font-size: 0.9rem;">
                        <tbody>
                            <tr>
                                <td class="text-secondary py-2" style="width: 35%;">Nama Lengkap</td>
                                <td class="fw-bold text-dark py-2">: {{ $user->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary py-2">Username</td>
                                <td class="fw-bold text-dark py-2">: {{ $user->username ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary py-2">Email</td>
                                <td class="fw-bold text-dark py-2">: {{ $user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary py-2">No. HP</td>
                                <td class="fw-bold text-dark py-2">: {{ $user->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary py-2">Instansi</td>
                                <td class="fw-bold text-dark py-2">: {{ $user->instansi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary py-2">Role</td>
                                <td class="py-2">
                                    <span class="badge px-2 py-1 text-white" style="font-size: 0.75rem; font-weight: 500; background-color: #1E6388;">{{ ucfirst($user->role ?? 'asesor') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-secondary py-2">Bergabung Sejak</td>
                                <td class="fw-bold text-dark py-2">: {{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Aksi Edit & Password -->
        <div class="col-lg-4">
            <!-- Box Edit Profil -->
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-3 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: rgba(30, 99, 136, 0.1); color: #1E6388;">
                        <i class="bi bi-person-gear fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Edit Profil</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Perbarui informasi profil akun Anda.</small>
                    </div>
                </div>
                <a href="{{ route('asesor.profil.edit') }}" class="btn text-white w-100 py-2 d-flex align-items-center justify-content-center shadow-sm" style="font-size: 0.85rem; font-weight: 500; background-color: #1E6388;">
                    <i class="bi bi-pencil-square me-2"></i> Edit Profil
                </a>
            </div>

            <!-- Box Ubah Password -->
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-shield-lock fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">Ubah Password</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Ganti password akun Anda secara berkala.</small>
                    </div>
                </div>
                <a href="{{ route('asesor.profil.ubah-password') }}" class="btn btn-outline-secondary w-100 py-2 d-flex align-items-center justify-content-center" style="font-size: 0.85rem; font-weight: 500;">
                    <i class="bi bi-key me-2"></i> Ubah Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection