@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Edit Profil</h2>
        <p class="text-muted mb-1">Perbarui informasi data diri akun Anda.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.profil') }}">Profil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Informasi Akun</h5>
                <p class="text-muted small">Perbarui informasi akun Anda pada form di bawah ini.</p>
                <hr class="text-muted opacity-25">

                <form action="{{ route('admin.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-muted">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? 'Administrator') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold text-muted">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? 'admin@smkn1garut.sch.id') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Role</label>
                        <input type="text" class="form-control bg-light" value="Administrator" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted">Tanggal Bergabung</label>
                        <input type="text" class="form-control bg-light" value="{{ isset($user->created_at) ? $user->created_at->format('d F Y') : '03 August 2026' }}" disabled>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.profil') }}" class="btn btn-outline-secondary px-4 fw-semibold">Batal</a>
                        <button type="submit" class="btn text-white px-4 fw-semibold" style="background-color: #1b6ca8;" onmouseover="this.style.backgroundColor='#145380'" onmouseout="this.style.backgroundColor='#1b6ca8'">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection