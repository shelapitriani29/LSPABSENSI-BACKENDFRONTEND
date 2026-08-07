@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Style Data Peserta -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">Data Skema Sertifikasi</h3>
        <p class="text-secondary mb-1" style="font-size: 0.9rem;">LSP P1 – SMK NEGERI 1 GARUT</p>
        <div class="text-secondary" style="font-size: 0.85rem;">
            Dashboard / <span class="text-dark">Data Skema Sertifikasi</span>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel Style Data Peserta -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            
            <!-- Judul di Dalam Card & Tombol Tambah Skema Sejajar di Kanan -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark mb-0">Data Skema Sertifikasi</h4>
                <a href="{{ route('admin.skema.create') }}" class="btn btn-primary btn-sm d-flex align-items-center px-3" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Skema
                </a>
            </div>

            <!-- Bagian Atas Tabel: Show Entries di Kiri, Search di Kanan (Sejajar) -->
            <div class="row align-items-center mb-3 g-2">
                <!-- Dropdown Show Entries Dinamis -->
                <div class="col-12 col-md-6 d-flex align-items-center" style="font-size: 0.9rem;">
                    show 
                    <form action="{{ route('admin.skema.index') }}" method="GET" id="perPageForm" class="d-inline-block mx-2">
                        <!-- Pertahankan query search jika sedang ada pencarian -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        
                        <select name="per_page" class="form-select form-select-sm" style="width: 75px;" onchange="document.getElementById('perPageForm').submit();">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form> 
                    entries
                </div>

                <!-- Input Search di sebelah kanan -->
                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center">
                    <form action="{{ route('admin.skema.index') }}" method="GET" class="d-flex align-items-center gap-2">
                        <!-- Pertahankan limit per_page saat melakukan submit pencarian -->
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif

                        <label for="searchInput" class="small text-secondary mb-0">Search:</label>
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <input type="text" 
                                   name="search" 
                                   id="searchInput" 
                                   class="form-control form-control-sm" 
                                   placeholder="Cari nama, kode, status..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit" title="Cari">
                                <i class="bi bi-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.skema.index', request()->only('per_page')) }}" class="btn btn-outline-danger" title="Reset Pencarian">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel dengan Garis Pembatas (Bordered) -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-3">
                    <thead class="table-light text-uppercase text-dark" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <tr>
                            <th class="py-3 text-center" style="width: 5%;">No.</th>
                            <th class="py-3" style="width: 25%;">Nama Skema</th>
                            <th class="py-3" style="width: 15%;">Kode</th>
                            <th class="py-3" style="width: 15%;">Kelas</th>
                            <th class="py-3" style="width: 15%;">Peserta</th>
                            <th class="py-3 text-center" style="width: 10%;">Status</th>
                            <th class="py-3 text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
                        {{-- MENGGUNAKAN VARIABLE $skemas DARI CONTROLLER --}}
                        @forelse($skemas as $key => $skema)
                        <tr>
                            <td class="text-center fw-semibold text-secondary">{{ $skemas->firstItem() + $key }}.</td>
                            <td>
                                <span class="fw-bold text-dark d-block">{{ $skema->nama_skema }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $skema->kode_skema }}</span>
                            </td>
                            <td>
                                <span class="text-dark">{{ $skema->kelas ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $skema->pesertas_count }} Peserta</span>
                            </td>
                            <td class="text-center">
                                @if($skema->status == 'Aktif')
                                    <span class="badge rounded-pill bg-success px-3 py-1 text-white" style="font-size: 0.75rem;">Aktif</span>
                                @else
                                    <span class="badge rounded-pill bg-danger px-3 py-1 text-white" style="font-size: 0.75rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center position-relative">
                                <!-- Tombol Aksi Dropdown Kotak Biru dengan Garis Tiga -->
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-sm text-white shadow-sm px-2 py-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; border-radius: 6px;">
                                        <i class="bi bi-list fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-1" style="font-size: 0.85rem; z-index: 1050;">
                                        <li>
                                            <a class="dropdown-item py-2 text-dark" href="{{ route('admin.skema.edit', $skema->id) }}">
                                                <i class="bi bi-pencil-square text-warning me-2"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <form action="{{ route('admin.skema.destroy', $skema->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item py-2 text-danger border-0 bg-transparent w-100 text-start" onclick="return confirm('Yakin ingin menghapus data skema ini?')">
                                                    <i class="bi bi-trash me-2"></i> Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                @if(request('search'))
                                    Data skema dengan kata kunci "<strong>{{ request('search') }}</strong>" tidak ditemukan.
                                @else
                                    Belum ada data skema sertifikasi.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Tabel: Pagination Dinamis bawaan Laravel -->
            <div class="d-flex justify-content-center pt-2">
                {{ $skemas->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
@endsection