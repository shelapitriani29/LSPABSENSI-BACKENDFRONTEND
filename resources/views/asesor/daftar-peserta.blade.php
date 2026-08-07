@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Judul Halaman, Sub-judul, dan Breadcrumb Sesuai Contoh Data Asesor -->
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3 mb-2">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white shadow-sm" style="width: 44px; height: 44px;">
                <i class="bi bi-people-fill fs-5"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Daftar Peserta</h4>
                <small class="text-muted">LSP P1 – SMK NEGERI 1 GARUT</small>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-dark text-decoration-none">Sertifikasi</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Daftar Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Tabel Daftar Peserta -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
        <!-- Card Header Diubah Menjadi Putih -->
        <div class="card-header bg-white py-3 border-bottom">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-people-fill me-1 text-primary"></i> Daftar Peserta Asesmen</h6>
        </div>
        <div class="card-body p-4">
            
            <!-- Filter & Search Bar -->
            <form action="{{ route('asesor.daftar-peserta') }}" method="GET" class="row row-cols-lg-auto g-3 align-items-center mb-3">
                <div class="col-auto d-flex align-items-center gap-2">
                    <span class="text-muted small">Show</span>
                    <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-muted small">entries</span>
                </div>
                <div class="col-auto d-flex align-items-center gap-2">
                    <span class="text-muted small">Search:</span>
                    <div class="input-group input-group-sm" style="width: 220px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama/username/kelas..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit" style="background-color: #2b70c9; border-color: #2b70c9;"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" width="100%" cellspacing="0">
                    <thead class="table-light text-dark fw-bold small">
                        <tr>
                            <th class="py-3 text-center" style="width: 5%;">No.</th>
                            <th class="py-3">NIK / Username</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Instansi</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">No. HP</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas as $key => $peserta)
                            <tr>
                                <td class="text-center fw-semibold">{{ $pesertas->firstItem() + $key }}.</td>
                                <td>{{ $peserta->username ?? $peserta->nik ?? '-' }}</td>
                                <td class="fw-medium text-dark">{{ $peserta->name ?? '-' }}</td>
                                <td>{{ $peserta->instansi ?? 'SMK NEGERI 1 GARUT' }}</td>
                                <td>{{ $peserta->kelas ?? '-' }}</td>
                                <td>{{ $peserta->no_hp ?? '-' }}</td>
                                <td class="text-center">
                                    @php $status = strtolower($peserta->status ?? 'aktif'); @endphp
                                    @if($status === 'aktif')
                                        <span class="badge rounded-pill text-white px-3 py-2" style="background-color: #20c997;">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill text-white px-3 py-2" style="background-color: #ff4d4d;">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm text-white rounded-2 shadow-sm border-0 d-inline-flex align-items-center justify-content-center" 
                                                type="button" 
                                                id="dropdownMenuButton{{ $peserta->id }}"
                                                data-bs-toggle="dropdown" 
                                                aria-expanded="false" 
                                                style="background-color: #2b70c9; width: 38px; height: 34px;">
                                            <i class="bi bi-list"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2" aria-labelledby="dropdownMenuButton{{ $peserta->id }}" style="min-width: 160px; z-index: 1050;">
                                            <li><a class="dropdown-item py-2 small d-flex align-items-center gap-2 text-dark fw-medium" href="{{ route('asesor.daftar-peserta.detail', $peserta->id) }}"><i class="bi bi-eye text-info" style="width: 16px;"></i> Detail Peserta</a></li>
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
            <div class="d-flex justify-content-center mt-4">
                {{ $pesertas->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

            <!-- Paginasi di Tengah -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link text-white" href="#" style="background-color: #2b70c9; border-color: #2b70c9;">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" style="color: #2b70c9;">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection