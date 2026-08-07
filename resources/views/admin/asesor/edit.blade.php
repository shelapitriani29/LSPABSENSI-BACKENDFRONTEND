@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page -->
    <div class="mb-3">
        <h3 class="fw-bold mb-1" style="color: #212529;">Data Asesor</h3>
        <p class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-decoration-none text-muted">Referensi</span></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.asesor.index') }}" class="text-decoration-none text-muted">Data Asesor</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Edit Asesor</li>
            </ol>
        </nav>
    </div>

    <!-- Judul Edit Data Asesor -->
    <div class="mb-3">
        <h4 class="fw-bold text-dark">Edit Data Asesor</h4>
    </div>

    <form action="{{ route('admin.asesor.update', $asesor->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Kolom Kiri: Identitas & Keasesoran -->
            <div class="col-lg-8">
                
                <!-- Card Identitas -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-person-lines-fill me-2"></i>1. Identitas Asesor</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $asesor->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">NIP / NIPTK</label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $asesor->nip ?? '') }}">
                                @error('nip')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">NIK</label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $asesor->nik ?? '') }}">
                                @error('nik')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $asesor->tempat_lahir ?? '') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $asesor->tanggal_lahir ?? '') }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="L" {{ old('jenis_kelamin', $asesor->jenis_kelamin ?? 'L') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $asesor->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $asesor->no_hp ?? '') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $asesor->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card Keasesoran -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-patch-check-fill me-2"></i>3. Data Keasesoran</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor Registrasi / Sertifikat Asesor (MET)</label>
                            <input type="text" name="no_met" class="form-control @error('no_met') is-invalid @enderror" value="{{ old('no_met', $asesor->no_met ?? $asesor->no_sertifikat ?? '') }}">
                            @error('no_met')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Skema Kompetensi Dropdown -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Skema Kompetensi</label>
                            @php
                                $skemaSelected = old('skema_kompetensi', $asesor->skema_kompetensi ?? '');
                            @endphp
                            <select name="skema_kompetensi" class="form-select @error('skema_kompetensi') is-invalid @enderror">
                                <option value="" disabled {{ empty($skemaSelected) ? 'selected' : '' }}>Pilih Skema Kompetensi</option>
                                @foreach($skemas as $skema)
                                    <option value="{{ $skema->nama_skema }}" {{ $skemaSelected == $skema->nama_skema ? 'selected' : '' }}>
                                        {{ $skema->nama_skema }}
                                    </option>
                                @endforeach
                            </select>
                            @error('skema_kompetensi')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Status Asesor</label>
                            @php
                                $statusSelected = strtolower(old('status', $asesor->status ?? 'aktif'));
                            @endphp
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="aktif" {{ $statusSelected == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $statusSelected == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Akun Sistem -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-shield-lock-fill me-2"></i>2. Akun Sistem</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Username / ID Login <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $asesor->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $asesor->email) }}">
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Baru <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak diubah">
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn text-white py-2 shadow-sm fw-semibold" style="background-color: #1e293b; border-color: #1e293b;">
                                <i class="bi bi-arrow-repeat me-1"></i> Perbarui Data Asesor
                            </button>
                            <a href="{{ route('admin.asesor.index') }}" class="btn btn-light py-2 border">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection