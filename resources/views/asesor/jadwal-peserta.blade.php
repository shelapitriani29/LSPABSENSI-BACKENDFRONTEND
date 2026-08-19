@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title & Breadcrumb -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.75rem;">Pilih Peserta</h3>
            <small class="text-muted d-block mb-2" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-muted text-decoration-none">Input Penilaian</a></li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Pilih Peserta</li>
                </ol>
            </nav>
        </div>
        <div>
            <!-- Tombol Kembali ke Pilih Jadwal dengan latar #1b6ca8 -->
            <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-sm px-3 fw-semibold shadow-sm rounded-2 text-white" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Jadwal
            </a>
        </div>
    </div>

    <!-- Informasi Detail Jadwal (Box Atas ala Figma) -->
    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-3 col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Skema Sertifikasi</span>
                    <span class="fw-bold text-dark d-block mt-1">{{ $jadwal->skema->nama_skema ?? '-' }}</span>
                    @if(isset($jadwal->skema->kode_skema))
                        <span class="badge bg-light text-primary border mt-1 px-2 py-1" style="font-size: 0.75rem;">{{ $jadwal->skema->kode_skema }}</span>
                    @endif
                </div>
                <div class="col-md-2 col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal Uji</span>
                    <span class="fw-semibold text-dark d-block mt-1">{{ $jadwal->tanggal ?? '-' }}</span>
                </div>
                <div class="col-md-2 col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Waktu</span>
                    <span class="fw-semibold text-dark d-block mt-1">{{ $jadwal->waktu ?? '08.00-12.00' }}</span>
                </div>
                <div class="col-md-2 col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Kelas</span>
                    <span class="fw-semibold text-dark d-block mt-1">{{ $jadwal->kelas }}</span>
                </div>
                <div class="col-md-2 col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Lokasi</span>
                    <span class="fw-semibold text-dark d-block mt-1">{{ $jadwal->lokasi ?? 'Lab Komputer' }}</span>
                </div>
                <div class="col-md-1 col-sm-6">
                    <span class="text-muted d-block" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Peserta</span>
                    <span class="fw-semibold text-dark d-block mt-1">{{ count($pesertas) }} Orang</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Container Daftar Peserta -->
    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-4">
            
            <!-- Header Tabel & Search Bar -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <h5 class="fw-bold text-dark mb-0">Daftar Peserta</h5>
                <div class="w-auto" style="min-width: 280px;">
                    <div class="input-group input-group-sm">
                        <input type="search" id="searchPeserta" class="form-control" placeholder="Cari nama peserta....">
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Peserta -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0" id="tabelPeserta">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Nama Peserta</th>
                            <th>NISN / Username</th>
                            <th class="text-center">Status Ujikom</th>
                            <th class="text-center">Nilai Ujikom (Sistem)</th>
                            <th class="text-center">Status Penilaian</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas ?? [] as $index => $peserta)
                            @php
                                $absen = $peserta->absensis->first();
                                $penilaian = $peserta->penilaians->first();
                                
                                $isSelesai = $absen && in_array($absen->status, ['Hadir', 'Selesai']);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-semibold text-dark">{{ $peserta->name }}</td>
                                <td>{{ $peserta->username ?? $peserta->nisn ?? '-' }}</td>
                                <td class="text-center">
                                    @if($isSelesai)
                                        <span class="badge fw-semibold px-3 py-1 rounded-2 border border-success" style="background-color: #d1e7dd !important; color: #0f5132;">Selesai</span>
                                    @else
                                        <span class="badge fw-semibold px-3 py-1 rounded-2 border border-danger" style="background-color: #f8d7da !important; color: #842029;">Belum Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center fw-semibold text-dark">
                                    {{ $peserta->nilai_sistem ?? '-' }}
                                </td>
                                <td class="text-center">
                                    @if($penilaian)
                                        <span class="badge fw-semibold px-3 py-1 rounded-2 border border-success" style="background-color: #d1e7dd !important; color: #0f5132;">Sudah Dinilai</span>
                                    @else
                                        <span class="badge fw-semibold px-3 py-1 rounded-2 border border-warning" style="background-color: #fff3cd !important; color: #664d03;">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($penilaian)
                                        <a href="{{ route('asesor.input-penilaian.detail', $penilaian->id) }}" class="btn btn-sm btn-outline-primary px-3 fw-semibold shadow-sm rounded-2">
                                            Lihat Detail
                                        </a>
                                    @else
                                        <a href="{{ route('asesor.penilaian-peserta-demo', ['peserta_id' => $peserta->id, 'jadwal_id' => $jadwal->id]) }}" class="btn btn-sm text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                                            Input Nilai
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Tidak ada peserta ditemukan untuk jadwal ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchPeserta').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tabelPeserta tbody tr');
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection