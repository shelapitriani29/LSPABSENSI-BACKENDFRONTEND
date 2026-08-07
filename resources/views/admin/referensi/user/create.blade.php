@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1100px;">
    <!-- Header Page -->
    <div class="mb-3">
        <h3 class="fw-bold mb-1" style="color: #212529;">Tambah User</h3>
        <p class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><span class="text-secondary">Dashboard</span></li>
                <li class="breadcrumb-item"><span class="text-secondary">Referensi</span></li>
                <li class="breadcrumb-item"><span class="text-secondary">Manajemen User</span></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Tambah User</li>
            </ol>
        </nav>
    </div>

    <!-- Judul -->
    <div class="mb-3">
        <h4 class="fw-bold text-dark mb-0">Tambah User Baru</h4>
    </div>

    {{-- Alert Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal menyimpan data!</strong>
            <ul class="mb-0 mt-2 ps-3 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Kolom Kiri: Identitas & Detail Keasesoran/Peserta -->
            <div class="col-lg-8">
                
                <!-- Bagian 1: Identitas Pengguna -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase fs-7 text-dark">
                            <i class="bi bi-person-fill me-1 text-primary"></i> 1. Identitas Pengguna
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark">Nama Lengkap & Gelar *</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Santoso, M.Kom." value="{{ old('name') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">NIP / NIPTK / NISN</label>
                                <input type="text" class="form-control" name="nomor_induk" placeholder="Masukkan nomor induk..." value="{{ old('nomor_induk') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">NIK</label>
                                <input type="text" class="form-control" name="nik" placeholder="Masukkan 16 digit NIK..." value="{{ old('nik') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Kota Kelahiran" value="{{ old('tempat_lahir') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin">
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small text-dark">No. HP / WhatsApp</label>
                                <input type="text" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold small text-dark">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat domisili pengguna...">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Bagian 3: Detail Tambahan Berdasarkan Role -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase fs-7 text-dark">
                            <i class="bi bi-shield-check me-1 text-primary"></i> 3. Data Detail & Keasesoran
                        </h6>

                        <!-- Field khusus Peserta -->
                        <div id="formPeserta" class="role-specific-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Kelas</label>
                                    <input type="text" 
                                            name="kelas" 
                                            class="form-control" 
                                            placeholder="Masukkan Kelas..."  
                                            value="{{ old('kelas') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-dark">Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan" placeholder="Masukkan Nama Jurusan..." value="{{ old('jurusan') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Field khusus Asesor -->
                        <div id="formAsesor" class="role-specific-form d-none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-dark">Nomor Registrasi / Sertifikat Asesor</label>
                                <input type="text" class="form-control" name="no_sertifikat_asesor" placeholder="Contoh: ASR-001/LSP-SMKN1GRT/2023" value="{{ old('no_sertifikat_asesor') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-dark">Skema Kompetensi</label>
                                <select class="form-select" name="skema_kompetensi">
                                    <option value="" selected disabled>Pilih Skema Kompetensi</option>
                                    @foreach($skemas as $skema)
                                        <option value="{{ $skema->nama_skema }}" {{ old('skema_kompetensi') == $skema->nama_skema ? 'selected' : '' }}>
                                            {{ $skema->nama_skema }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-semibold small text-dark">Status Asesor</label>
                                <select class="form-select" name="status_asesor">
                                    <option value="Aktif" {{ old('status_asesor') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status_asesor') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Akun Sistem & Aksi -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase fs-7 text-dark">
                            <i class="bi bi-lock-fill me-1 text-primary"></i> 2. Akun Sistem
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark">Pilih Role *</label>
                            <select class="form-select" id="roleSelect" name="role" required>
                                <option value="peserta" {{ old('role', 'peserta') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                                <option value="asesor" {{ old('role') == 'asesor' ? 'selected' : '' }}>Asesor</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark">Username / ID Login *</label>
                            <input type="text" class="form-control" name="username" placeholder="Username unik..." value="{{ old('username') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark">Email *</label>
                            <input type="email" class="form-control" name="email" placeholder="email@sekolah.sch.id" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark">Password Awal *</label>
                            <input type="password" class="form-control" name="password" placeholder="Min. 6 karakter" required>
                        </div>

                        {{-- NAMA FIELD DIUBAH DARI status_akun MENJADI status AGAR SESUAI DENGAN CONTROLLER --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-dark">Status Akun Sistem</label>
                            <select class="form-select" name="status">
                                <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn text-white fw-semibold shadow-sm py-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                <i class="bi bi-save me-1"></i> Simpan User Baru
                            </button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-light border fw-semibold text-secondary py-2">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Script Toggle Dynamic Role Form -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let roleSelect = document.getElementById('roleSelect');
        let formPeserta = document.getElementById('formPeserta');
        let formAsesor = document.getElementById('formAsesor');

        function toggleRoleForms() {
            let role = roleSelect.value;
            formPeserta.classList.add('d-none');
            formAsesor.classList.add('d-none');

            if (role === 'peserta') {
                formPeserta.classList.remove('d-none');
            } else if (role === 'asesor') {
                formAsesor.classList.remove('d-none');
            }
        }

        roleSelect.addEventListener('change', toggleRoleForms);
        
        // Jalankan saat pertama kali halaman di-load (menyesuaikan jika ada error redirect/old value)
        toggleRoleForms();
    });
</script>
@endsection