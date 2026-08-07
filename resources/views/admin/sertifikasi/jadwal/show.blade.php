@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page dengan Tombol Kembali di Kanan -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Detail Jadwal Uji</h3>
            <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Sertifikasi</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Detail Jadwal Uji</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="btn text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1" style="background-color: #337ab7;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Informasi Detail Jadwal -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4">Detail Jadwal Uji</h5>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted small">Kode Jadwal</div>
                <div class="col-sm-9 fw-semibold text-dark">: {{ $jadwal->kode_jadwal }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted small">Status</div>
                <div class="col-sm-9">: <span class="badge {{ $jadwal->status == 'Akan Mendatang' ? 'bg-warning text-dark' : ($jadwal->status == 'Mulai' ? 'bg-success' : 'bg-secondary') }} text-white px-3 py-1 rounded-pill">{{ $jadwal->status }}</span></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted small">Skema Sertifikasi</div>
                <div class="col-sm-9 fw-semibold text-dark">: {{ $jadwal->skema->nama_skema ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted small">Kelas & Peserta</div>
                <div class="col-sm-9">: {{ $jadwal->kelas }} ({{ $pesertas->count() }} Peserta)</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted small">Asesor Penguji</div>
                <div class="col-sm-9">: {{ $jadwal->asesor->name ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted small">Tanggal & Waktu</div>
                <div class="col-sm-9">: {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('j F Y') }} ({{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} WIB)</div>
            </div>
            <div class="row mb-0">
                <div class="col-sm-3 text-muted small">Lokasi</div>
                <div class="col-sm-9">: {{ $jadwal->lokasi }}</div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Peserta -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4">Daftar Peserta Uji</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th scope="col" class="py-3 px-3" style="width: 8%;">No.</th>
                            <th scope="col" class="py-3">Nama Peserta</th>
                            <th scope="col" class="py-3" style="width: 25%;">NISN</th>
                            <th scope="col" class="py-3 text-center" style="width: 20%;">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($pesertas as $index => $peserta)
                        <tr>
                            <td class="px-3">{{ $index + 1 }}.</td>
                            <td class="fw-bold text-dark">{{ $peserta->name }}</td>
                            <td>{{ $peserta->nisn ?? '-' }}</td>
                            <td class="text-center"><span class="badge bg-light text-secondary border px-2 py-1">-</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada peserta untuk kelas ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection