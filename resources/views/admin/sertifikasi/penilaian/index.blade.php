@extends('layouts.app')

@section('content')
<div class="container-fluid px-2">
    <!-- Header Page dengan Breadcrumb hitam & Subtitle LSP -->
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">Hasil Asesmen</h4>
        <p class="text-muted small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-dark">Sertifikasi</span></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Statistik Cards dengan Background Keren -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase">Total Penilaian</span>
                        <h2 class="fw-bold mt-1 mb-0">{{ $totalPeserta }}</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase">Kompeten</span>
                        <h2 class="fw-bold mt-1 mb-0">{{ $kompetenCount }}</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-patch-check"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small fw-semibold text-white-50 text-uppercase">Belum Kompeten</span>
                        <h2 class="fw-bold mt-1 mb-0">{{ $belumCount }}</h2>
                    </div>
                    <div class="fs-1 text-white-50"><i class="bi bi-exclamation-triangle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Filter & Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-3">Filter Hasil</h5>
            
            <!-- Filter Bar -->
            <form method="GET" action="{{ route('admin.sertifikasi.penilaian.index') }}">
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Skema</label>
                        <select name="skema_id" class="form-select form-select-sm">
                            <option value="">Semua Skema</option>
                            @foreach($skemas as $skema)
                                <option value="{{ $skema->id }}" {{ request('skema_id') == $skema->id ? 'selected' : '' }}>{{ $skema->nama_skema }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Jadwal</label>
                        <select name="jadwal_id" class="form-select form-select-sm">
                            <option value="">Semua Jadwal</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}" {{ request('jadwal_id') == $jadwal->id ? 'selected' : '' }}>{{ $jadwal->kode_jadwal }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Asesor</label>
                        <select name="asesor_id" class="form-select form-select-sm">
                            <option value="">Semua Asesor</option>
                            @foreach($asesors as $asesor)
                                <option value="{{ $asesor->id }}" {{ request('asesor_id') == $asesor->id ? 'selected' : '' }}>{{ $asesor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Hasil</label>
                        <select name="hasil" class="form-select form-select-sm">
                            <option value="">Semua Hasil</option>
                            <option value="Kompeten" {{ request('hasil') == 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                            <option value="Belum Kompeten" {{ request('hasil') == 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-md-5">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama peserta..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="btn btn-outline-secondary btn-sm">Reset Filter</a>
                    </div>
                </div>
            </form>



            <!-- Entries Option -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="small text-muted">Show</span>
                    <form method="GET" action="{{ route('admin.sertifikasi.penilaian.index') }}" class="d-inline-flex align-items-center">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="skema_id" value="{{ request('skema_id') }}">
                        <input type="hidden" name="jadwal_id" value="{{ request('jadwal_id') }}">
                        <input type="hidden" name="asesor_id" value="{{ request('asesor_id') }}">
                        <input type="hidden" name="hasil" value="{{ request('hasil') }}">
                        <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        </select>
                    </form>
                    <span class="small text-muted">Entries</span>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive shadow-sm rounded-4 border border-light">
                <table class="table table-hover table-bordered align-middle mb-0" style="table-layout: auto;">
                    <thead class="table-light text-uppercase fs-7 text-secondary fw-semibold">
                        <tr>
                            <th class="py-3 text-center" style="width: 5%;">No</th>
                            <th class="py-3" style="width: 18%;">Peserta</th>
                            <th class="py-3" style="width: 18%;">Skema</th>
                            <th class="py-3" style="width: 14%;">Jadwal</th>
                            <th class="py-3" style="width: 14%;">Asesor</th>
                            <th class="py-3 text-center" style="width: 12%;">Tanggal</th>
                            <th class="py-3 text-center" style="width: 12%;">Hasil</th>
                            <th class="py-3 text-center" style="width: 7%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($penilaians as $penilaian)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->iteration + ($penilaians->firstItem() ? $penilaians->firstItem() - 1 : 0) }}</td>
                                <td class="fw-semibold text-dark text-truncate" title="{{ $penilaian->user->name ?? '-' }}">
                                    {{ $penilaian->user->name ?? '-' }}
                                </td>
                                <td class="text-truncate" title="{{ $penilaian->jadwal->skema->nama_skema ?? '-' }}">
                                    {{ $penilaian->jadwal->skema->nama_skema ?? '-' }}
                                </td>
                                <td class="text-truncate" title="{{ $penilaian->jadwal->kode_jadwal ?? '-' }}">
                                    {{ $penilaian->jadwal->kode_jadwal ?? '-' }}
                                </td>
                                <td class="text-truncate" title="{{ $penilaian->asesor->name ?? '-' }}">
                                    {{ $penilaian->asesor->name ?? '-' }}
                                </td>
                                <td class="text-center text-nowrap">
                                    @if($penilaian->jadwal->tanggal)
                                        <span class="badge bg-light text-dark fw-normal">{{ \Carbon\Carbon::parse($penilaian->jadwal->tanggal)->format('d M Y') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($penilaian->hasil === 'Kompeten')
                                        <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-2 py-1 rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i>{{ $penilaian->hasil }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger fw-semibold px-2 py-1 rounded-pill">
                                            <i class="bi bi-x-circle-fill me-1"></i>{{ $penilaian->hasil }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm text-white rounded-pill shadow-sm border-0 d-inline-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b6ca8; width: 36px; height: 36px;">
                                            <i class="bi bi-list fs-6"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                                            <li><a class="dropdown-item py-2 px-3 small" href="{{ route('admin.sertifikasi.penilaian.show', $penilaian->id) }}"><i class="bi bi-eye text-info me-2"></i> Detail</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    <span>Tidak ada data penilaian.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center align-items-center mt-4 pt-3 border-top">
                {{ $penilaians->links() }}
            </div>
        </div>
    </div>
</div>
@endsection