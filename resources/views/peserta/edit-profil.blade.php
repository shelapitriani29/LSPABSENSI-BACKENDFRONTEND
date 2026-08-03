@extends('layouts.peserta')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    <!-- Header Title & Subtitle -->
    <div class="mb-3">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -0.5px;">Edit Profil</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">Perbarui informasi data diri akun Anda.</small>
        
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('peserta.profil') }}" class="text-decoration-none text-secondary">Profil</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Edit Profil</li>
            </ol>
        </nav>
    </div>

    <!-- Main Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border p-4 bg-white shadow-sm mb-4" style="border-color: #cbd5e1 !important; border-radius: 8px;">
                <h2 class="fw-bold text-dark mb-1" style="font-size: 1.25rem;">Informasi Akun</h2>
                <p class="text-secondary small mb-4">Perbarui informasi akun Anda pada form di bawah ini.</p>

                <form action="{{ route('peserta.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control border-secondary-subtle @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? 'Jenisa Nurfadillah') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">NIS / No. Registrasi</label>
                        <input type="text" name="nis" class="form-control border-secondary-subtle" value="{{ old('nis', $user->nis ?? '1234567890') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Kelas / Kompetensi</label>
                        <input type="text" name="kelas" class="form-control border-secondary-subtle" value="{{ old('kelas', $user->kelas ?? 'XI PPL 1 / Junior Web Developer (JWD)') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Email</label>
                        <input type="email" name="email" class="form-control border-secondary-subtle @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? 'jenisa.peserta@lsp1.sch.id') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">Role</label>
                        <input type="text" class="form-control border-secondary-subtle bg-light text-muted" value="Peserta" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small">Tanggal Bergabung</label>
                        <input type="text" class="form-control border-secondary-subtle bg-light text-muted" value="10 Maret 2025" disabled>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('peserta.profil') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 6px; font-size: 0.9rem;">Batal</a>
                        <button type="submit" class="btn text-white px-4 py-2 fw-semibold shadow-sm d-flex align-items-center gap-1" style="background-color: #1b6ca8; border-radius: 6px; font-size: 0.9rem;">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection