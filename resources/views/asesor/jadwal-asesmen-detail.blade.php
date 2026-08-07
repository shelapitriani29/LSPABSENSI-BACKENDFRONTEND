@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Utama (Judul, Sub-judul, Tombol Kembali di Kanan, dan Breadcrumb) -->
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Detail Jadwal Asesmen</h4>
            <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.jadwal-asesmen') }}" class="text-dark text-decoration-none">Sertifikasi</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.jadwal-asesmen') }}" class="text-dark text-decoration-none">Jadwal Asesmen</a></li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Detail Jadwal Asesmen</li>
                </ol>
            </nav>
        </div>

        <!-- Tombol Kembali di Sebelah Kanan -->
        <div>
            <a href="{{ route('asesor.jadwal-asesmen') }}" class="btn btn-primary btn-sm px-3 shadow-sm" style="background-color: #2b70c9; border-color: #2b70c9;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Informasi Detail Jadwal -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">SKEMA</p>
                            <h5 class="fw-bold text-dark">{{ optional($jadwal->skema)->nama_skema ?? '-' }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">KELAS</p>
                            <h5 class="fw-bold text-dark">{{ $jadwal->kelas ?? '-' }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">ASESOR</p>
                            <p class="text-dark mb-0 fw-semibold">{{ optional($jadwal->asesor)->name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">STATUS JADWAL</p>
                            <p class="mb-0"><span class="badge {{ $jadwal->status == 'Mulai' ? 'bg-success' : ($jadwal->status == 'Akan Mendatang' ? 'bg-warning text-dark' : 'bg-secondary text-white') }}">{{ $jadwal->status ?? 'Tidak diketahui' }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">TANGGAL</p>
                            <p class="text-dark mb-0">{{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">JAM</p>
                            <p class="text-dark mb-0">{{ $jadwal->jam_mulai ?? '-' }} - {{ $jadwal->jam_selesai ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">LOKASI</p>
                            <p class="text-dark mb-0">{{ $jadwal->lokasi ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small fw-semibold">JUMLAH PESERTA</p>
                            <p class="text-dark mb-0 fw-semibold">{{ $pesertaCount }} Orang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Progress Asesmen -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Progress Asesmen</h5>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Verifikasi Kehadiran</span>
                            <span class="fw-bold text-success">✅ {{ $hadirCount }} / {{ $pesertaCount }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pesertaCount ? round($hadirCount / $pesertaCount * 100) : 0 }}%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Input Penilaian</span>
                            <span class="fw-bold text-warning">🟡 {{ $penilaianCount }} / {{ $pesertaCount }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pesertaCount ? round($penilaianCount / $pesertaCount * 100) : 0 }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi Utama -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark mb-3">Aksi Asesor</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('asesor.daftar-peserta') }}" class="btn btn-outline-dark">
                    <i class="bi bi-file-earmark-text me-1"></i> Daftar Peserta
                </a>

                @php
                    $canInputPenilaian = $hadirCount > 0;
                @endphp
                <a href="{{ $canInputPenilaian ? route('asesor.input-penilaian.index', ['jadwal_id' => $jadwal->id]) : 'javascript:void(0)' }}"
                   class="btn {{ $canInputPenilaian ? 'btn-primary' : 'btn-secondary disabled' }}"
                   style="{{ $canInputPenilaian ? 'background-color: #2b70c9; border-color: #2b70c9;' : '' }}"
                   role="button"
                   aria-disabled="{{ $canInputPenilaian ? 'false' : 'true' }}">
                    <i class="bi bi-pencil-square me-1"></i> Input Penilaian
                </a>
                @unless($canInputPenilaian)
                    <div class="text-muted small mt-2">
                        Input Penilaian akan aktif setelah setidaknya satu peserta hadir menggunakan QR Code.
                    </div>
                @endunless
            </div>
        </div>
    </div>
</div>
@endsection