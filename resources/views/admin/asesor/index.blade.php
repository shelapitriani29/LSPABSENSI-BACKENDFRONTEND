@extends('layouts.app')

@section('content')
<style>
    /* Mencegah menu dropdown terpotong oleh overflow table-responsive */
    .table-responsive {
        overflow: visible !important;
    }
</style>

<div class="container-fluid px-4">
    <!-- Header Page -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #212529;">Data Asesor</h3>
        <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item text-secondary">Referensi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Data Asesor</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Success Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel Data Asesor -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            
            <!-- Header Card (Tombol Tambah Asesor Dihapus) -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0">Daftar Asesor</h5>
            </div>

            <!-- Form Kontrol: Show Entries & Search Filter -->
            <form action="{{ route('admin.asesor.index') }}" method="GET" class="mb-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    
                    <!-- Show Entries -->
                    <div class="d-flex align-items-center gap-2 small text-secondary">
                        <span>show</span>
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="per_page" class="form-select form-select-sm" style="width: 75px;" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span>entries</span>
                    </div>
                    
                    <!-- Search Field -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-secondary">Search:</span>
                        <div class="input-group input-group-sm style-search" style="width: 220px;">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama/No. MET..." value="{{ request('search') }}">
                            <button class="btn text-white" type="submit" style="background-color: #337ab7;">
                                <i class="bi bi-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.asesor.index', ['per_page' => request('per_page')]) }}" class="btn btn-outline-secondary" title="Reset Search">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </form>

            <!-- Table Responsive -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th scope="col" class="py-3 px-3 text-center" style="width: 5%;">No.</th>
                            <th scope="col" class="py-3">Nama Asesor</th>
                            <th scope="col" class="py-3">No. MET / Email</th>
                            <th scope="col" class="py-3">Bidang Keahlian / Skema</th>
                            <th scope="col" class="py-3 text-center" style="width: 10%;">Status</th>
                            <th scope="col" class="py-3 text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($asesors as $key => $asesor)
                            <tr>
                                <td class="px-3 text-center fw-semibold">
                                    {{ method_exists($asesors, 'firstItem') ? $asesors->firstItem() + $key : $key + 1 }}.
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $asesor->name }}</span>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">{{ $asesor->no_met ?? $asesor->username ?? '-' }}</div>
                                    <div class="text-secondary small">{{ $asesor->email ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-normal">
                                        {{ $asesor->skema_kompetensi ?? $asesor->instansi ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $status = strtolower($asesor->status ?? 'aktif');
                                    @endphp
                                    @if($status == 'aktif')
                                        <span class="badge bg-success px-3 py-1 rounded-pill">Aktif</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-1 rounded-pill">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center position-relative">
                                    <div class="dropdown">
                                        <button class="btn btn-sm text-white rounded-3 px-3 py-2 border-0 shadow-sm" 
                                                type="button" 
                                                id="dropdownAsesor{{ $asesor->id }}"
                                                data-bs-toggle="dropdown" 
                                                aria-expanded="false" 
                                                style="background-color: #337ab7;">
                                            <i class="bi bi-list fs-6"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small py-2" aria-labelledby="dropdownAsesor{{ $asesor->id }}" style="z-index: 1050; min-width: 150px;">
                                            <li>
                                                <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.asesor.show', $asesor->id) }}">
                                                    <i class="bi bi-eye text-info"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.asesor.edit', $asesor->id) }}">
                                                    <i class="bi bi-pencil-square text-warning"></i> Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider my-1"></li>
                                            <li>
                                                <form action="{{ route('admin.asesor.destroy', $asesor->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data asesor {{ $asesor->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item py-2 text-danger d-flex align-items-center gap-2 w-100 bg-transparent border-0">
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
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Data asesor belum tersedia atau tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Dynamic Pagination Posisi Tengah -->
            <div class="d-flex justify-content-center align-items-center mt-4">
                @if(method_exists($asesors, 'links'))
                    {{ $asesors->appends(request()->query())->links() }}
                @endif
            </div>

        </div>
    </div>
</div>
@endsection