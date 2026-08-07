@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Detail Riwayat Penilaian</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.riwayat-penilaian') }}" class="text-dark text-decoration-none">Riwayat Penilaian</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Detail Riwayat Penilaian</li>
            </ol>
        </nav>
    </div>

    <div class="card border shadow-sm rounded-3 overflow-hidden mb-4 bg-white">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-info-circle me-1 text-primary"></i> Informasi Penilaian</h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Informasi Peserta</h5>
                    <table class="table table-borderless table-sm mb-4">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 140px;">Nama Peserta</td>
                            <td>: {{ $penilaian->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Username</td>
                            <td>: {{ $penilaian->user->username ?? $penilaian->user->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Skema</td>
                            <td>: {{ $penilaian->jadwal->skema->nama_skema ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Jadwal</td>
                            <td>: {{ $penilaian->jadwal->kode_jadwal ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Tanggal</td>
                            <td>: {{ $penilaian->tanggal ? \Carbon\Carbon::parse($penilaian->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                        </tr>
                    </table>

                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Informasi Asesor</h5>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 140px;">Nama Asesor</td>
                            <td>: {{ $penilaian->asesor->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Email</td>
                            <td>: {{ $penilaian->asesor->email ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Ringkasan Hasil</h5>
                    <table class="table table-borderless table-sm mb-4">
                        <tr>
                            <td class="text-muted fw-semibold" style="width: 170px;">Hasil</td>
                            <td>: <span class="fw-bold">{{ $penilaian->hasil ?? 'Belum Dinilai' }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Catatan</td>
                            <td>: {{ $penilaian->catatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-semibold">Tanggal Input</td>
                            <td>: {{ $penilaian->created_at ? \Carbon\Carbon::parse($penilaian->created_at)->translatedFormat('d F Y, H.i') : '-' }}</td>
                        </tr>
                    </table>

                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Status Asesmen</h5>
                    <div class="mb-3">
                        <span class="badge {{ $penilaian->hasil === 'Kompeten' ? 'bg-success' : ($penilaian->hasil === 'Belum Kompeten' ? 'bg-danger' : 'bg-secondary') }} fs-6 px-3 py-2">
                            {{ $penilaian->hasil ? $penilaian->hasil : 'Belum Dinilai' }}
                        </span>
                    </div>
                    <div class="text-muted small">
                        <i class="bi bi-clock me-1"></i> Dibuat pada: <strong>{{ $penilaian->created_at ? \Carbon\Carbon::parse($penilaian->created_at)->translatedFormat('d F Y H.i') : '-' }}</strong>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <h5 class="fw-bold text-dark mb-2">Catatan Tambahan</h5>
                <div class="p-3 bg-light rounded-3 text-secondary" style="font-size: 0.95rem; line-height: 1.6;">
                    {{ $penilaian->keterangan ?? 'Tidak ada catatan tambahan.' }}
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-4">
        <a href="{{ route('asesor.riwayat-penilaian') }}" class="btn text-white px-4 py-2 shadow-sm" style="background-color: #1e3a5f;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection