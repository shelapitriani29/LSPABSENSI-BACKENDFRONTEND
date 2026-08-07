@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 900px;">
    <!-- Header Page dengan Breadcrumb hitam & Subtitle LSP -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Detail Hasil Asesmen</h4>
            <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-decoration-none text-muted">Sertifikasi</span></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="text-decoration-none text-muted">Penilaian</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Detail Hasil Asesmen</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="btn btn-primary px-3 shadow-sm" style="background-color: #2b70c9; border-color: #2b70c9;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Informasi Peserta Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark text-uppercase small mb-3">Informasi Peserta</h6>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Nama Peserta</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->user->name ?? '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Email</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->user->email ?? '-' }}</div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 text-muted small">Asesor</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->asesor->name ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Informasi Asesmen Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark text-uppercase small mb-3">Informasi Asesmen</h6>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Skema</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->jadwal->skema->nama_skema ?? '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Kode Jadwal</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->jadwal->kode_jadwal ?? '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Tanggal</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->tanggal ? \Carbon\Carbon::parse($penilaian->tanggal)->translatedFormat('d F Y') : ($penilaian->jadwal->tanggal ? \Carbon\Carbon::parse($penilaian->jadwal->tanggal)->translatedFormat('d F Y') : '-') }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Waktu</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->jadwal->jam_mulai ? \Carbon\Carbon::parse($penilaian->jadwal->jam_mulai)->format('H.i') : '-' }} - {{ $penilaian->jadwal->jam_selesai ? \Carbon\Carbon::parse($penilaian->jadwal->jam_selesai)->format('H.i') : '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Lokasi</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->jadwal->lokasi ?? '-' }}</div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 text-muted small">Asesor</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->asesor->name ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Hasil Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark text-uppercase small mb-3">Hasil</h6>
            <div class="row mb-3">
                <div class="col-md-4 text-muted small">Status</div>
                <div class="col-md-8">
                    <span class="badge px-3 py-2 text-white fw-semibold" style="background-color: {{ $penilaian->hasil === 'Kompeten' ? '#198754' : '#dc3545' }};">{{ $penilaian->hasil ?? '-' }}</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted small">Catatan Asesor</div>
                <div class="col-md-8">
                    <div class="p-3 bg-light rounded-3 text-secondary small border">
                        {{ $penilaian->catatan ?? 'Tidak ada catatan.' }}
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 text-muted small">Tanggal Penilaian</div>
                <div class="col-md-8 fw-semibold text-dark">: {{ $penilaian->tanggal ? \Carbon\Carbon::parse($penilaian->tanggal)->translatedFormat('d F Y') : '-' }}</div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 text-muted small">Status Sertifikat</div>
                <div class="col-md-8 fw-semibold text-muted">: {{ $penilaian->sertifikat ? 'Sudah Diterbitkan' : 'Belum Diterbitkan' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection