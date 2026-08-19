@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    <!-- Header Page -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #212529;">Jadwal Uji</h3>
        <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-secondary">Sertifikasi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Jadwal Uji</li>
            </ol>
        </nav>
    </div>
        
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel Jadwal Uji -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <!-- Judul Tabel & Tombol Tambah -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold text-dark mb-1">Jadwal Uji</h5>
                    <p class="text-secondary small mb-0">Daftar jadwal pelaksanaan uji kompetensi.</p>
                </div>
                <a href="{{ route('admin.sertifikasi.jadwal.create') }}" class="btn text-white rounded-3 px-3 py-2 border-0 shadow-sm d-flex align-items-center gap-1" style="background-color: #1b6ca8;">
                    <i class="bi bi-plus-lg"></i> Tambah Jadwal
                </a>
            </div>

            <!-- Filter Status & Search Bar -->
            <form action="{{ route('admin.sertifikasi.jadwal.index') }}" method="GET" class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2 small text-secondary">
                    <span>Filter Status:</span>
                    <select name="status" class="form-select form-select-sm" style="width: 140px;" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="siap" {{ request('status') == 'siap' ? 'selected' : '' }}>Siap</option>
                        <option value="belum_lengkap" {{ request('status') == 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                        <option value="belum_dibuat" {{ request('status') == 'belum_dibuat' ? 'selected' : '' }}>Belum Dibuat</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm" style="width: 280px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari kode, skema, asesor, kelas..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>

            <!-- Tabel Jadwal Uji Sesuai Figma (Menggunakan overflow-visible agar dropdown tidak terpotong) -->
            <div class="table-responsive overflow-visible">
                <table class="table table-hover table-bordered align-middle mb-0" style="table-layout: fixed;">
                    <thead class="table-light text-secondary small" style="font-weight: 600;">
                        <tr>
                            <th scope="col" class="py-3 px-2 text-center" style="width: 5%;">NO.</th>
                            <th scope="col" class="py-3" style="width: 10%;">Kode Jadwal</th>
                            <th scope="col" class="py-3" style="width: 16%;">Skema</th>
                            <th scope="col" class="py-3" style="width: 9%;">Kelas</th>
                            <th scope="col" class="py-3" style="width: 13%;">Asesor</th>
                            <th scope="col" class="py-3 text-center" style="width: 9%;">Durasi</th>
                            <th scope="col" class="py-3 text-center" style="width: 13%;">Status Soal</th>
                            <th scope="col" class="py-3 text-center" style="width: 8%;">Jumlah Soal</th>
                            <th scope="col" class="py-3 text-center" style="width: 10%;">Status</th>
                            <th scope="col" class="py-3 text-center" style="width: 7%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($jadwals ?? [] as $key => $jadwal)
                        <tr>
                            <td class="text-center">{{ isset($jadwals) && method_exists($jadwals, 'firstItem') ? $jadwals->firstItem() + $key : $key + 1 }}.</td>
                            <td class="fw-medium text-dark text-truncate" title="{{ $jadwal->kode_jadwal ?? '-' }}">{{ $jadwal->kode_jadwal ?? '-' }}</td>
                            <td class="text-truncate" title="{{ $jadwal->skema->nama_skema ?? '-' }}">{{ $jadwal->skema->nama_skema ?? '-' }}</td>
                            <td class="fw-semibold text-truncate">{{ $jadwal->kelas ?? '-' }}</td>
                            <td class="text-truncate" title="{{ $jadwal->asesor->name ?? '-' }}">{{ $jadwal->asesor->name ?? '-' }}</td>
                            
                            <!-- Durasi Ujian -->
                            <td class="text-center text-nowrap">
                                {{ $jadwal->durasi ?? '60' }} Menit
                            </td>
                            
                            <!-- Status Soal -->
                            @php
                                $jumlahSoal = $jadwal->soals_count ?? (isset($jadwal->soals) ? $jadwal->soals->count() : 0);
                                $targetSoal = 20; 
                            @endphp
                            <td class="text-center">
                                @if($jumlahSoal >= $targetSoal)
                                    <span class="badge text-white px-2 py-1 rounded-pill fw-normal shadow-sm d-inline-block" style="background-color: #28a745; font-size: 0.75rem; white-space: nowrap;">Soal Siap</span>
                                @elseif($jumlahSoal > 0)
                                    <span class="badge text-white px-2 py-1 rounded-pill fw-normal shadow-sm d-inline-block" style="background-color: #ffc107; color: #000 !important; font-size: 0.75rem; white-space: nowrap;">Belum Lengkap</span>
                                @else
                                    <span class="badge text-white px-2 py-1 rounded-pill fw-normal shadow-sm d-inline-block" style="background-color: #f39c12; font-size: 0.75rem; white-space: nowrap;">Soal Belum Dibuat</span>
                                @endif
                            </td>

                            <!-- Jumlah Soal -->
                            <td class="text-center fw-bold">{{ $jumlahSoal }}</td>
                            
                            <!-- Status Waktu/Ujian -->
                            @php
                                $now = \Carbon\Carbon::now();
                                $tanggalUji = !empty($jadwal->tanggal) ? \Carbon\Carbon::parse($jadwal->tanggal) : null;
                                
                                if ($tanggalUji && $tanggalUji->isFuture()) {
                                    $statusUjian = 'Akan Datang';
                                    $bgStatus = '#f39c12';
                                } elseif ($tanggalUji && $tanggalUji->isPast()) {
                                    $statusUjian = 'Selesai';
                                    $bgStatus = '#6c757d';
                                } else {
                                    $statusUjian = 'Aktif';
                                    $bgStatus = '#28a745';
                                }
                            @endphp
                            <td class="text-center">
                                <span class="badge text-white px-2 py-1 rounded-pill fw-normal shadow-sm text-truncate d-inline-block" style="background-color: {{ $bgStatus }}; font-size: 0.70rem; max-width: 100%;">
                                    {{ $statusUjian }}
                                </span>
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="text-center" style="overflow: visible;">
                                <div class="dropdown">
                                    <button class="btn text-white rounded-3 p-0 border-0 shadow-sm d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 small py-2" style="z-index: 1050; position: absolute;">
                                        <li><a class="dropdown-item py-2 px-3" href="{{ route('admin.sertifikasi.jadwal.soal', $jadwal->id) }}"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Kelola Soal</a></li>
                                        <li><a class="dropdown-item py-2 px-3" href="{{ route('admin.sertifikasi.jadwal.show', $jadwal->id) }}"><i class="bi bi-eye me-2 text-info"></i> Detail</a></li>
                                        <li><a class="dropdown-item py-2 px-3" href="{{ route('admin.sertifikasi.jadwal.edit', $jadwal->id) }}"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <form action="{{ route('admin.sertifikasi.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item py-2 px-3 text-danger"><i class="bi bi-trash me-2"></i> Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">Belum ada jadwal uji.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(isset($jadwals) && method_exists($jadwals, 'links'))
            <div class="d-flex justify-content-end align-items-center pt-3">
                <div>
                    {{ $jadwals->appends(request()->input())->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection