@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    
    <!-- Header Title & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="fw-bold mb-0" style="color: #212529;">{{ $kategori->nama_kategori }}</h2>
        <a href="{{ route('admin.sertifikasi.jadwal.soal', $jadwal->id) }}" class="btn rounded-3 px-3 py-2 small shadow-sm d-flex align-items-center gap-1 text-white border-0 text-decoration-none" style="background-color: #1b6ca8;">
            <i class="bi bi-arrow-left"></i> Kembali ke Kategori
        </a>
    </div>

    <!-- Breadcrumb Sesuai Permintaan -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0 small text-muted">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.soal', $jadwal->id) }}" class="text-secondary text-decoration-none">Kelola Soal</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">{{ $kategori->nama_kategori }}</li>
        </ol>
    </nav>

    <!-- CARD 1: Informasi Ringkasan Jadwal & Progress Soal -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center g-3">
                
                <!-- Skema & Tanggal Uji -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-calendar text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Skema</div>
                            <div class="fw-bold text-dark fs-6">{{ $jadwal->skema->nama_skema }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-calendar-check text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Tanggal Uji</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Kode Skema & Jam Uji -->
                <div class="col-md-2 border-end">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-scissors text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Kode Jadwal</div>
                            <div class="fw-bold text-dark fs-6">{{ $jadwal->kode_jadwal }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-stopwatch text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Jam Uji</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</div>
                        </div>
                    </div>
                </div>

                <!-- Lokasi & Jumlah Peserta -->
                <div class="col-md-3 border-end">
                    <div class="d-flex align-items-start gap-2 mb-3">
                        <i class="bi bi-geo-alt text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Lokasi</div>
                            <div class="fw-bold text-dark fs-6">{{ $jadwal->lokasi }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-people text-primary fs-5" style="color: #1b6ca8 !important;"></i>
                        <div>
                            <div class="text-secondary" style="font-size: 11px;">Jumlah Peserta</div>
                            <div class="fw-bold text-dark" style="font-size: 13px;">{{ count($jadwal->ujians ?? []) }} Orang</div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Soal di Kategori Ini & Progress Bar -->
                <div class="col-md-4">
                    <div class="text-secondary" style="font-size: 11px;">Jumlah Soal di Kategori Ini</div>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="fw-bold text-dark fs-5">{{ count($soals) }} / {{ count($soals) }} soal</span>
                        <span class="fw-bold text-success" style="font-size: 13px;">{{ count($soals) > 0 ? '100%' : '0%' }}</span>
                    </div>
                    <div class="progress mt-2" style="height: 8px;">
                        <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: {{ count($soals) > 0 ? '100' : '0' }}%;" aria-valuenow="{{ count($soals) }}" aria-valuemin="0" aria-valuemax="{{ count($soals) }}"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- CARD 2: Passing Grade & Durasi Ujian -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            
            <form method="POST" action="{{ route('admin.sertifikasi.jadwal.update-pengaturan', $jadwal->id) }}" id="formPengaturan">
                @csrf
                @method('PUT')

                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Pengaturan Ujian</h5>
                        <p class="text-secondary small mb-0">Atur parameter ujian untuk kategori ini.</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 small d-inline-flex align-items-center gap-2 rounded-pill" style="white-space: nowrap;">
                        <i class="bi bi-check-circle-fill"></i> Tersimpan
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold small mb-2">Passing Grade <span class="text-muted fw-normal">(Minimum Lulus)</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 px-3" style="font-size: 1.25rem;"><i class="bi bi-trophy text-primary"></i></span>
                            <input type="number" id="passingGrade" name="passing_grade" class="form-control border-0 bg-light fw-bold fs-6 shadow-none" value="{{ $jadwal->passing_grade ?? 75 }}" min="0" max="100" required>
                            <span class="input-group-text bg-light border-0 fw-semibold">%</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold small mb-2">Durasi Ujian</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0 px-3" style="font-size: 1.25rem;"><i class="bi bi-clock text-primary"></i></span>
                            <input type="number" id="durasiUjian" name="durasi_ujian" class="form-control border-0 bg-light fw-bold fs-6 shadow-none" value="{{ $jadwal->durasi_ujian ?? 120 }}" min="1" required>
                            <span class="input-group-text bg-light border-0 fw-semibold">menit</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-sm text-white rounded-3 px-4 py-2 border-0 shadow-sm d-flex align-items-center gap-2" style="background-color: #1b6ca8;">
                        <i class="bi bi-check2-square"></i> Simpan Pengaturan
                    </button>
                    <button type="reset" class="btn btn-sm btn-outline-secondary rounded-3 px-4 py-2 d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                </div>

                <div class="alert alert-primary bg-primary bg-opacity-10 border-0 text-primary small p-3 mb-0 mt-3 d-flex align-items-center gap-2 rounded-3">
                    <i class="bi bi-info-circle-fill fs-6 shrink-0"></i>
                    <span style="font-size: 12px;">Peserta dinyatakan kompeten jika nilai akhir ≥ passing grade.</span>
                </div>
            </form>

        </div>
    </div>

    <!-- NOTIFIKASI DI BAWAH CARD KEDUA -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show bg-success bg-opacity-10 border border-success border-opacity-25 text-success small p-3 mb-4 d-flex align-items-center justify-content-between rounded-4 shadow-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5 shrink-0"></i>
            <span class="fw-medium">{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="font-size: 11px;"></button>
    </div>
    @endif

    <!-- Tabel Daftar Soal -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            
            <!-- Baris Filter Show Entries & Tombol Tambah Soal -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2 small text-secondary">
                    Show
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    entries
                </div>
                <a href="{{ route('admin.sertifikasi.jadwal.kategori.soal.tambah', [$jadwal->id, $kategori->id]) }}" class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1 text-decoration-none" style="background-color: #1b6ca8;">
                    <i class="bi bi-plus-lg"></i> Tambah Soal
                </a>
            </div>

            <!-- Tabel Data Soal -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small">
                        <tr>
                            <th scope="col" class="text-center" style="width: 5%;">No</th>
                            <th scope="col" style="width: 45%;">Pertanyaan</th>
                            <th scope="col" class="text-center" style="width: 15%;">Tipe Soal</th>
                            <th scope="col" class="text-center" style="width: 15%;">Tingkat Kesulitan</th>
                            <th scope="col" class="text-center" style="width: 10%;">Poin</th>
                            <th scope="col" class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($soals as $index => $soal)
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}.</td>
                            <td>{{ $soal->pertanyaan }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">
                                    {{ $soal->tipe_soal }}
                                </span>
                            </td>
                            <td class="text-center">
                                @php
                                    $bgClass = match($soal->tingkat_kesulitan) {
                                        'Mudah' => 'bg-success text-success',
                                        'Sedang' => 'bg-warning text-warning',
                                        'Sulit' => 'bg-danger text-danger',
                                        default => 'bg-secondary text-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $bgClass }} bg-opacity-10 px-3 py-1 fw-semibold">
                                    {{ $soal->tingkat_kesulitan }}
                                </span>
                            </td>
                            <td class="text-center fw-bold">{{ $soal->poin }}</td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2">
                                        <li><a class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2" href="{{ route('admin.sertifikasi.jadwal.kategori.soal.edit', [$jadwal->id, $kategori->id, $soal->id]) }}"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.sertifikasi.jadwal.kategori.soal.destroy', [$jadwal->id, $kategori->id, $soal->id]) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item py-2 px-3 small d-flex align-items-center gap-2 text-danger border-0 bg-transparent" onclick="return confirm('Yakin ingin menghapus soal ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada soal di kategori ini. <a href="{{ route('admin.sertifikasi.jadwal.kategori.soal.tambah', [$jadwal->id, $kategori->id]) }}" class="text-primary">Tambah soal sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection