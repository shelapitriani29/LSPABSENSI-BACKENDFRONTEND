@extends('layouts.app')

@section('content')
<style>
    /* Mencegah dropdown terpotong/tersembunyi di dalam table-responsive */
    .table-responsive {
        overflow: visible !important;
    }
</style>

<div class="container-fluid px-4">
    <!-- Header Halaman -->
    <div class="mt-4 mb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="h3 fw-bold text-dark mb-0">Data Peserta</h1>
            <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-muted">Referensi</li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Data Peserta</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm my-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Utama -->
    <div class="card border-0 shadow-sm mt-3 mb-4">
        <div class="card-body">
            
            <!-- Judul Tabel di Dalam Card -->
            <h4 class="fw-bold text-dark mb-3">Data Peserta</h4>

            <!-- Baris Kontrol: Form Search & Per Page -->
            <form action="{{ route('admin.peserta.index') }}" method="GET" class="mb-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    
                    <!-- Per Page Dropdown -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted small">Show</span>
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span class="text-muted small">entries</span>
                    </div>

                    <!-- Search Input & Button -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-dark small">Search:</span>
                        <div class="input-group input-group-sm" style="width: 260px;">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama/NIK..." value="{{ request('search') }}">
                            
                            <!-- Tombol Cari -->
                            <button class="btn btn-primary" type="submit" style="background-color: #2b6cb0; border-color: #2b6cb0;">
                                <i class="bi bi-search"></i>
                            </button>

                            <!-- Tombol Reset Search -->
                            @if(request('search'))
                                <a href="{{ route('admin.peserta.index', ['per_page' => request('per_page')]) }}" class="btn btn-outline-secondary" title="Reset Search">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </form>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" width="100%" cellspacing="0">
                    <thead class="table-light text-dark fw-bold">
                        <tr>
                            <th width="5%" class="text-center py-3">NO.</th>
                            <th class="py-3">NIK / Username</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Instansi</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">No. HP</th>
                            <th width="12%" class="text-center py-3">Status</th>
                            <th width="10%" class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas as $key => $peserta)
                            <tr>
                                <td class="text-center fw-semibold">
                                    {{ method_exists($pesertas, 'firstItem') ? $pesertas->firstItem() + $key : $key + 1 }}.
                                </td>
                                <td>{{ $peserta->username ?? $peserta->nik ?? '-' }}</td>
                                <td class="fw-medium text-dark">{{ $peserta->name ?? $peserta->nama ?? '-' }}</td>
                                <td>{{ $peserta->instansi ?? 'SMK NEGERI 1 GARUT' }}</td>
                                <td>{{ $peserta->kelas ?? '-' }}</td>
                                <td>{{ $peserta->no_hp ?? '-' }}</td>
                                <td class="text-center">
                                    @php
                                        $status = strtolower($peserta->status ?? 'aktif');
                                    @endphp
                                    @if($status == 'aktif')
                                        <span class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #20c997;">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill text-white px-3 py-2 fw-semibold" style="background-color: #ff4d4d;">Nonaktif</span>
                                    @endif
                                </td>
                                
                                <!-- Kolom Dropdown Aksi -->
                                <td class="text-center position-relative">
                                    <div class="dropdown">
                                        <button class="btn text-white btn-sm rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" 
                                                type="button" 
                                                id="dropdownMenuButton{{ $peserta->id }}"
                                                data-bs-toggle="dropdown" 
                                                aria-expanded="false" 
                                                style="background-color: #2b6cb0; width: 38px; height: 34px;">
                                            <i class="bi bi-list fs-5"></i>
                                        </button>
                                        
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" 
                                            aria-labelledby="dropdownMenuButton{{ $peserta->id }}"
                                            style="min-width: 160px; z-index: 1050;">
                                            <li>
                                                <a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.show', $peserta->id) }}">
                                                    <i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta
                                                </a>
                                            </li> 
                                            <li>
                                                <a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('admin.peserta.edit', $peserta->id) }}">
                                                    <i class="bi bi-pencil-square text-warning" style="width: 16px;"></i> Edit Data
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider my-1"></li>
                                            <li>
                                                <form action="{{ route('admin.peserta.destroy', $peserta->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peserta {{ $peserta->name ?? $peserta->nama }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item py-2 small d-flex align-items-center gap-2 text-danger fw-medium border-0 bg-transparent w-100 text-start">
                                                        <i class="bi bi-trash" style="width: 16px;"></i> Hapus Peserta
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Data peserta belum tersedia atau tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Dinamis -->
            <div class="d-flex justify-content-center align-items-center mt-4 pt-2">
                @if(method_exists($pesertas, 'links'))
                    {{ $pesertas->appends(request()->query())->links() }}
                @endif
            </div>

        </div>
    </div>
</div>
@endsection