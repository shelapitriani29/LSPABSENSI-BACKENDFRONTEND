@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Kelola Soal</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Sertifikasi</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Kelola Soal</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="btn rounded-3 px-3 py-2 small shadow-sm d-flex align-items-center gap-1 text-white border-0" style="background-color: #1b6ca8;">
            <i class="bi bi-arrow-left"></i> Kembali ke Jadwal Uji
        </a>
    </div>

    <!-- Informasi Ringkasan Jadwal & Skema -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center g-3">
                <!-- 1. Skema Sertifikasi -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-shield-check fs-5"></i>
                        </div>
                        <div class="grow overflow-hidden">
                            <div class="text-secondary" style="font-size: 11px;">Skema Sertifikasi</div>
                            <div class="fw-bold text-dark lh-sm" style="font-size: 13px; word-break: break-word;">{{ $jadwal->skema->nama_skema ?? '-' }}</div>
                            <div class="badge bg-primary bg-opacity-10 text-primary px-1.5 py-0 mt-1" style="font-size: 9px;">{{ $jadwal->skema->kode_skema ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- 2. Kode Skema -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-journal-code fs-5"></i>
                        </div>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Kode Skema</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">{{ $jadwal->skema->kode_skema ?? ($jadwal->kode_jadwal ?? '-') }}</div>
                        </div>
                    </div>
                </div>

                <!-- 3. Lokasi -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-geo-alt fs-5"></i>
                        </div>
                        <div class="grow overflow-hidden">
                            <div class="text-secondary" style="font-size: 11px;">Lokasi</div>
                            <div class="fw-bold text-dark text-truncate" style="font-size: 13px;">{{ $jadwal->lokasi ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- 4. Status Soal -->
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center text-success shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-patch-check fs-5"></i>
                        </div>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Status Soal</div>
                            <div class="mt-1">
                                @php
                                    $totalSoal = isset($jadwal->soals) ? $jadwal->soals->count() : 0;
                                @endphp
                                @if($totalSoal > 0)
                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1" style="font-size: 11px;">Soal Siap</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1" style="font-size: 11px;">Belum Lengkap</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-3 text-muted opacity-25">

            <div class="row align-items-center g-3">
                <!-- 5. Tanggal Uji -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-calendar3 fs-5"></i>
                        </div>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Tanggal Uji</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">{{ !empty($jadwal->tanggal) ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') : '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- 6. Jam Uji / Waktu -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-clock fs-5"></i>
                        </div>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Jam Uji</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">
                                {{ isset($jadwal->jam_mulai) ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '-' }} - 
                                {{ isset($jadwal->jam_selesai) ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 7. Jumlah Peserta -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-people fs-5"></i>
                        </div>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Jumlah Peserta</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">{{ isset($pesertas) ? $pesertas->count() : 0 }} Orang</div>
                        </div>
                    </div>
                </div>

                <!-- 8. Jumlah Soal & Progress Bar -->
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary shrink-0" style="width: 42px; height: 42px;">
                            <i class="bi bi-journal-text fs-5"></i>
                        </div>
                        <div class="grow">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary" style="font-size: 11px;">Jumlah Soal</span>
                                @php
                                    $targetSoal = 20; 
                                    $percent = min(100, ($totalSoal / $targetSoal) * 100);
                                @endphp
                                <strong class="text-dark" style="font-size: 11px;">{{ $totalSoal }} / {{ $targetSoal }} Soal ({{ round($percent) }}%)</strong>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $totalSoal }}" aria-valuemin="0" aria-valuemax="{{ $targetSoal }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaturan Ujian -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.sertifikasi.jadwal.update-pengaturan', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Pengaturan Ujian</h5>
                        <p class="text-secondary small mb-0">Atur parameter ujian untuk jadwal ini.</p>
                    </div>
                    <button type="submit" class="btn btn-sm text-white px-3 rounded-3 shadow-sm" style="background-color: #1b6ca8;">Simpan Pengaturan</button>
                </div>
                
                <div class="row align-items-center g-3">
                    <div class="col-md-4">
                        <label class="form-label text-secondary small mb-1">Passing Grade (Minimum Lulus)</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light"><i class="bi bi-trophy text-primary"></i></span>
                            <input type="number" name="passing_grade" class="form-control" value="{{ old('passing_grade', $jadwal->passing_grade ?? 75) }}" min="0" max="100">
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small mb-1">Durasi Ujian</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light"><i class="bi bi-clock text-primary"></i></span>
                            <input type="number" name="durasi" class="form-control" value="{{ old('durasi', $jadwal->durasi ?? 120) }}" min="1">
                            <span class="input-group-text bg-light">menit</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-primary bg-primary bg-opacity-10 border-0 small p-2 mb-0 rounded-3 d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle text-primary fs-5 shrink-0"></i>
                            <span style="font-size: 11px;">Durasi akan digunakan sebagai batas waktu ujian untuk peserta.</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Kategori Soal -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold text-dark mb-1">Kategori Soal</h5>
                    <p class="text-secondary small mb-0">Kelola kategori untuk mengelompokkan soal berdasarkan materi/kompetensi.</p>
                </div>
                <a href="{{ route('admin.sertifikasi.jadwal.kategori.create', $jadwal->id) }}" class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1 text-decoration-none" style="background-color: #1b6ca8;">
                    <i class="bi bi-plus-lg"></i> Tambah Kategori
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small">
                        <tr>
                            <th scope="col" class="text-center" style="width: 5%;">No.</th>
                            <th scope="col" style="width: 25%;">Nama Kategori</th>
                            <th scope="col" style="width: 45%;">Deskripsi (Materi)</th>
                            <th scope="col" class="text-center" style="width: 10%;">Jumlah Soal</th>
                            <th scope="col" class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @if(isset($kategoris) && $kategoris->count() > 0)
                            @foreach($kategoris as $key => $kategori)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td class="fw-bold text-dark">{{ $kategori->nama_kategori ?? '-' }}</td>
                                <td class="text-secondary">{{ $kategori->deskripsi ?? '-' }}</td>
                                <td class="text-center fw-semibold">{{ $kategori->soals_count ?? 0 }} Soal</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <a href="{{ route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, $kategori->id]) }}" class="btn btn-sm px-3 rounded-pill py-1 fw-medium text-white" style="font-size: 12px; background-color: #1b6ca8;">
                                            Kelola Soal
                                        </a>
                                        <form action="{{ route('admin.sertifikasi.jadwal.kategori.destroy', [$jadwal->id, $kategori->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori soal ini? Kategori yang masih memiliki soal tidak dapat dihapus.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill py-1 px-2" title="Hapus kategori" aria-label="Hapus kategori {{ $kategori->nama_kategori }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-4 text-secondary">
                                    <div class="mb-3">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                    </div>
                                    <p class="mb-0">Belum ada kategori soal. Silakan tambah kategori terlebih dahulu untuk memulai mengelola soal.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection