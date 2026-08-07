@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Halaman & Tombol Kembali Disejajarkan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Detail Asesor</h3>
            <p class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small" style="background: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-secondary">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-secondary">Referensi</span></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.asesor.index') }}" class="text-decoration-none text-secondary">Data Asesor</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Detail Asesor</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.asesor.edit', $asesor->id) }}" class="btn btn-warning text-dark fw-semibold px-3 shadow-sm">
                <i class="bi bi-pencil-square me-1"></i> Edit Data
            </a>
            <a href="{{ route('admin.asesor.index') }}" class="btn text-white fw-semibold px-3 shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Identitas -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4 rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-person-fill me-2" style="color: #1b6ca8;"></i>1. Identitas Asesor</h5>
                    <table class="table table-borderless align-middle small mb-0">
                        <tr>
                            <td width="30%" class="text-muted">Nama Lengkap</td>
                            <td width="2%">:</td>
                            <td class="fw-bold text-dark fs-6">{{ $asesor->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIP / NIPTK</td>
                            <td>:</td>
                            <td class="text-dark">{{ $asesor->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIK</td>
                            <td>:</td>
                            <td class="text-dark">{{ $asesor->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td class="text-dark">
                                @if(!empty($asesor->tempat_lahir) || !empty($asesor->tanggal_lahir))
                                    {{ $asesor->tempat_lahir ?? '-' }}, {{ $asesor->tanggal_lahir ? \Carbon\Carbon::parse($asesor->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jenis Kelamin</td>
                            <td>:</td>
                            <td class="text-dark">
                                @if(strtoupper($asesor->jenis_kelamin ?? '') == 'L')
                                    Laki-laki
                                @elseif(strtoupper($asesor->jenis_kelamin ?? '') == 'P')
                                    Perempuan
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Alamat Lengkap</td>
                            <td>:</td>
                            <td class="text-dark">{{ $asesor->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. HP / WhatsApp</td>
                            <td>:</td>
                            <td class="text-dark">{{ $asesor->no_hp ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Data Akun Sistem -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4 rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-shield-lock-fill me-2" style="color: #1b6ca8;"></i>2. Data Akun Sistem</h5>
                    <table class="table table-borderless align-middle small mb-3">
                        <tr>
                            <td width="40%" class="text-muted">Username</td>
                            <td width="5%">:</td>
                            <td class="fw-bold text-dark">{{ $asesor->username ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>:</td>
                            <td class="text-dark text-break">{{ $asesor->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Role</td>
                            <td>:</td>
                            <td><span class="badge bg-secondary">Asesor</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status Akun</td>
                            <td>:</td>
                            <td>
                                @if(strtolower($asesor->status ?? 'aktif') == 'aktif')
                                    <span class="badge bg-success px-3 py-1">Aktif</span>
                                @else
                                    <span class="badge bg-danger px-3 py-1">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Bawah: Data Keasesoran -->
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-patch-check-fill me-2" style="color: #1b6ca8;"></i>3. Data Keasesoran</h5>
            <table class="table table-borderless align-middle small mb-0">
                <tr>
                    <td width="20%" class="text-muted">No. Registrasi / Sertifikat</td>
                    <td width="2%">:</td>
                    <td>
                        <span class="badge bg-dark text-white px-2 py-1">
                            {{ $asesor->no_met ?? '-' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Skema Kompetensi</td>
                    <td>:</td>
                    <td>
                        <span class="fw-medium text-dark">{{ $asesor->skema_kompetensi ?? '-' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Status Asesor</td>
                    <td>:</td>
                    <td>
                        @if(strtolower($asesor->status ?? 'aktif') == 'aktif')
                            <span class="badge bg-success px-3 py-1">Aktif</span>
                        @else
                            <span class="badge bg-danger px-3 py-1">Nonaktif</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection