@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Top Header & Breadcrumb -->
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">Data Peserta</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}" class="text-decoration-none text-muted">Data Peserta</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Edit Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Error Validasi -->
    @if ($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm mb-4">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi kesalahan input:</div>
            <ul class="mb-0 ps-3 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.peserta.update', $peserta->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-4">
            
            <!-- Kolom Kiri: Identitas Pengguna & Data Detail Keasesoran -->
            <div class="col-lg-8 d-flex flex-column gap-4">
                
                <!-- 1. IDENTITAS PENGGUNA -->
                <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2" style="font-size: 1rem; color: #1e293b !important;">
                        <i class="bi bi-person-fill text-primary"></i> 1. IDENTITAS PENGGUNA
                    </h5>
                    <hr class="text-muted opacity-25 mt-0 mb-4">

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold text-secondary small">Nama Lengkap & Gelar *</label>
                        <input type="text" name="name" id="name" class="form-control bg-light py-2 px-3" value="{{ old('name', $peserta->name) }}" placeholder="Contoh: Budi Santoso, M.Kom." style="border-radius: 8px;" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nip" class="form-label fw-bold text-secondary small">NIP / NIPTK / NISN</label>
                            <input type="text" name="nip" id="nip" class="form-control bg-light py-2 px-3" value="{{ old('nip', $peserta->nip ?? '') }}" placeholder="Masukkan nomor induk..." style="border-radius: 8px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label fw-bold text-secondary small">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control bg-light py-2 px-3" value="{{ old('nik', $peserta->nik ?? '') }}" placeholder="Masukkan 16 digit NIK..." style="border-radius: 8px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tempat_lahir" class="form-label fw-bold text-secondary small">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control bg-light py-2 px-3" value="{{ old('tempat_lahir', $peserta->tempat_lahir ?? '') }}" placeholder="Kota Kelahiran" style="border-radius: 8px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label fw-bold text-secondary small">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control bg-light py-2 px-3" value="{{ old('tanggal_lahir', $peserta->tanggal_lahir ?? '') }}" style="border-radius: 8px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label fw-bold text-secondary small">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select bg-light py-2 px-3" style="border-radius: 8px;">
                                @php
                                    $selectedGenderRaw = old('jenis_kelamin', $peserta->jenis_kelamin ?? '');
                                    $selectedGender = in_array(strtolower($selectedGenderRaw), ['l', 'laki-laki', 'laki laki'], true) ? 'L'
                                        : (in_array(strtolower($selectedGenderRaw), ['p', 'perempuan'], true) ? 'P' : '');
                                @endphp
                                <option value="" disabled {{ $selectedGender === '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                <option value="L" {{ $selectedGender === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $selectedGender === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label fw-bold text-secondary small">No. HP / WhatsApp</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control bg-light py-2 px-3" value="{{ old('no_hp', $peserta->no_hp ?? '') }}" placeholder="08xxxxxxxxxx" style="border-radius: 8px;">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label for="alamat" class="form-label fw-bold text-secondary small">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control bg-light py-2 px-3" placeholder="Alamat domisili pengguna..." style="border-radius: 8px;">{{ old('alamat', $peserta->alamat ?? '') }}</textarea>
                    </div>
                </div>

                <!-- 3. DATA DETAIL & KEASESORAN -->
                <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2" style="font-size: 1rem; color: #1e293b !important;">
                        <i class="bi bi-shield-check text-primary"></i> 3. DATA DETAIL & KEASESORAN
                    </h5>
                    <hr class="text-muted opacity-25 mt-0 mb-4">

                    <div class="row mb-0">
                        <div class="col-md-6 mb-3">
                            <label for="kelas" class="form-label fw-bold text-secondary small">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select bg-light py-2 px-3" style="border-radius: 8px;">
                                @php $selectedKelas = old('kelas', $peserta->kelas ?? ''); @endphp
                                <option value="" disabled {{ empty($selectedKelas) ? 'selected' : '' }}>Pilih Kelas</option>
                                @forelse($kelases as $kelas)
                                    <option value="{{ $kelas }}" {{ $selectedKelas == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                                @empty
                                    <option value="" disabled>Tidak ada kelas tersedia</option>
                                @endforelse
                                @if($selectedKelas && !$kelases->contains($selectedKelas))
                                    <option value="{{ $selectedKelas }}" selected>{{ $selectedKelas }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jurusan" class="form-label fw-bold text-secondary small">Jurusan</label>
                            <input type="text" name="jurusan" id="jurusan" class="form-control bg-light py-2 px-3" value="{{ old('jurusan', $peserta->jurusan ?? '') }}" placeholder="Masukkan Nama Jurusan..." style="border-radius: 8px;">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Akun Sistem & Tombol Simpan/Batal -->
            <div class="col-lg-4 d-flex flex-column gap-4">
                
                <!-- 2. AKUN SISTEM -->
                <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2" style="font-size: 1rem; color: #1e293b !important;">
                        <i class="bi bi-lock-fill text-primary"></i> 2. AKUN SISTEM
                    </h5>
                    <hr class="text-muted opacity-25 mt-0 mb-4">

                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold text-secondary small">Username / ID Login *</label>
                        <input type="text" name="username" id="username" class="form-control bg-light py-2 px-3" value="{{ old('username', $peserta->username ?? $peserta->nik) }}" placeholder="admin@lsp.com" style="border-radius: 8px;" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold text-secondary small">Email *</label>
                        <input type="email" name="email" id="email" class="form-control bg-light py-2 px-3" value="{{ old('email', $peserta->email) }}" placeholder="email@sekolah.sch.id" style="border-radius: 8px;" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold text-secondary small">Password Baru (Opsional)</label>
                        <input type="password" name="password" id="password" class="form-control bg-light py-2 px-3" placeholder="********" style="border-radius: 8px;">
                        <small class="text-muted" style="font-size: 0.75rem;">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold text-secondary small">Status Akun Sistem *</label>
                        <select name="status" id="status" class="form-select bg-light py-2 px-3" style="border-radius: 8px;">
                            <option value="Aktif" {{ (old('status', $peserta->status) == 'Aktif' || strtolower(old('status', $peserta->status)) == 'aktif') ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ (old('status', $peserta->status) == 'Nonaktif' || strtolower(old('status', $peserta->status)) == 'nonaktif' || strtolower(old('status', $peserta->status)) == 'tidak aktif') ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn text-white fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #0d6efd; border-radius: 8px; border: none;">
                            <i class="bi bi-box-arrow-down"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="{{ route('admin.peserta.index') }}" class="btn btn-light fw-bold py-2 border shadow-sm text-secondary text-center" style="border-radius: 8px;">
                            Batal
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>
@endsection