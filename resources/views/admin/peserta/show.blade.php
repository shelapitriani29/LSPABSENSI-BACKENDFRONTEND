@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">

    <!-- Top Header & Breadcrumb -->
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">Detail Peserta</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Referensi</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}" class="text-decoration-none text-muted">Data Peserta</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Detail Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
        <div class="row g-4">

            <!-- Kolom Kiri: Profil, Jadwal, Hasil Penilaian -->
            <div class="col-lg-6 d-flex flex-column gap-4">

                <!-- Profil Peserta -->
                <div>
                    <h5 class="fw-bold text-dark mb-3" style="letter-spacing: 0.5px;">PROFIL PESERTA</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Nama Lengkap</th>
                                    <td>{{ $peserta->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">NISN</th>
                                    <td>{{ $peserta->nip ?? $peserta->nis ?? $peserta->nik ?? $peserta->username ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">NIK</th>
                                    <td>{{ $peserta->nik ?? $peserta->username ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Jenis Kelamin</th>
                                    <td>{{ $peserta->jenis_kelamin ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Tanggal Lahir</th>
                                    <td>{{ $peserta->tanggal_lahir ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">No Ponsel</th>
                                    <td>{{ $peserta->no_hp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Email</th>
                                    <td>{{ $peserta->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Alamat</th>
                                    <td>{{ $peserta->alamat ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Data Kompetensi Peserta -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Data Kompetensi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Kelas</th>
                                    <td>{{ $peserta->kelas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Jurusan</th>
                                    <td>{{ $peserta->jurusan ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Data Instansi, Data Sertifikasi, Riwayat Absensi -->
            <div class="col-lg-6 d-flex flex-column gap-4">

                <!-- Data Instansi -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Data Instansi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Instansi</th>
                                    <td>{{ $peserta->instansi ?? 'SMK Negeri 1 Garut' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Jurusan/Kelas</th>
                                    <td>{{ $peserta->jurusan ?? 'Rekayasa Perangkat Lunak' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Data Sertifikasi -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Data Sertifikasi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light fw-bold text-dark" style="width: 35%;">Skema Sertifikasi</th>
                                    <td class="fw-bold">{{ $selectedSkema?->nama_skema ?? $selectedSkema ?? $peserta->skema_kompetensi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Kode Skema</th>
                                    <td>{{ $selectedSkema?->kode_skema ?? $peserta->kode_skema ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Tanggal Pendaftaran</th>
                                    <td>{{ $peserta->created_at ? $peserta->created_at->format('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light fw-bold text-dark">Status Peserta</th>
                                    <td>
                                        <span class="badge px-3 py-1 text-white fw-medium" style="background-color: #20c997; border-radius: 20px;">
                                            {{ ucfirst($peserta->status ?? 'Aktif') }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Riwayat Absensi -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Riwayat Absensi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center mb-0">
                            <thead class="bg-light text-dark fw-bold">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peserta->absensis as $absensi)
                                    <tr>
                                        <td>{{ optional($absensi->created_at)->format('d-m-Y') ?? '-' }}</td>
                                        <td>{{ $absensi->check_in ? \Carbon\Carbon::parse($absensi->check_in)->format('H.i') : '-' }}</td>
                                        <td>{{ $absensi->check_out ? \Carbon\Carbon::parse($absensi->check_out)->format('H.i') : '-' }}</td>
                                        <td>
                                            <span class="badge px-3 py-1 text-white fw-medium" style="background-color: {{ $absensi->status === 'Hadir' ? '#20c997' : ($absensi->status === 'Terlambat' ? '#ffb703' : '#6c757d') }}; border-radius: 20px;">
                                                {{ $absensi->status ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada riwayat absensi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons (Kembali & Download Sertifikat) -->
        <div class="d-flex justify-content-end align-items-center gap-3 mt-4 pt-3 border-top">
            <a href="{{ route('admin.peserta.index') }}" class="btn text-white fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="background-color: #ffb703; border-radius: 8px; border: none; min-width: 140px;">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <a href="#" class="btn btn-primary fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="background-color: #3b82f6; border-radius: 8px; border: none;">
                <i class="bi bi-download"></i>
                <span>Download Sertifikat</span>
            </a>
        </div>

    </div>
</div>
@endsection
