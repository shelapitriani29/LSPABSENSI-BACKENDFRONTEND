@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    
    <!-- Header & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Manajemen User</h3>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT &bull; <span class="text-secondary">Dashboard / Referensi / Manajemen User / Edit User</span></p>
        </div>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-sm px-3 py-2 fw-semibold shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri (Identitas & Detail) -->
            <div class="col-lg-8">
                
                <!-- Section 1: Identitas Pengguna -->
                <div class="card border-0 shadow-sm mb-4 rounded-3">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                            <i class="bi bi-person-fill me-2 fs-5"></i> 1. IDENTITAS PENGGUNA
                        </h6>
                        <hr class="text-muted opacity-25 mb-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap & Gelar *</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">NIP / NIPTK / NISN</label>
                                <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $user->nisn ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">NIK</label>
                                <input type="text" name="nik" class="form-control" value="{{ old('nik', $user->nik ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $user->tempat_lahir ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $user->tanggal_lahir ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ (old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ (old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp ?? '') }}">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold small">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $user->alamat ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Data Detail & Keasesoran -->
                <div class="card border-0 shadow-sm mb-4 rounded-3">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                            <i class="bi bi-shield-check me-2 fs-5"></i> 3. DATA DETAIL & KEASESORAN
                        </h6>
                        <hr class="text-muted opacity-25 mb-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Kelas</label>
                                <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $user->kelas ?? '') }}" placeholder="Contoh: XI AKL 2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $user->jurusan ?? '') }}" placeholder="Masukkan Nama Jurusan">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan (Akun Sistem & Tombol Aksi) -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 70px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                            <i class="bi bi-lock-fill me-2 fs-5"></i> 2. AKUN SISTEM
                        </h6>
                        <hr class="text-muted opacity-25 mb-4">

                        <!-- Field Pilih Role sudah dihilangkan dari sini -->

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Username / ID Login *</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username ?? $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Password Baru <span class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah)</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru...">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small">Status Akun Sistem</label>
                            <select name="status" class="form-select">
                                <option value="Aktif" {{ (old('status', $user->status ?? 'Aktif') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                                <option value="Non-Aktif" {{ (old('status', $user->status ?? '') == 'Non-Aktif') ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success fw-semibold py-2">
                                <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-light border fw-semibold py-2 text-secondary">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection