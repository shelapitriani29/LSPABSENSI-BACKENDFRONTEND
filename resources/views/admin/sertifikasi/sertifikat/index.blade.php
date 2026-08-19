@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Top Header & Breadcrumb -->
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-0 text-uppercase" style="font-size: 2.2rem; letter-spacing: 0.5px;">SERTIFIKAT</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Sertifikasi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Sertifikat</li>
            </ol>
        </nav>
    </div>

    <!-- Main Card Container -->
    <div class="card border border-secondary-subtle shadow-sm bg-white p-4" style="border-radius: 12px;">
        
        <!-- Judul Section & Tombol Export PDF Sejajar -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
            <h3 class="fw-bold text-dark mb-0 text-uppercase" style="font-size: 1.3rem; letter-spacing: 0.5px;">SERTIFIKAT</h3>
            
            <div class="dropdown">
                <button class="btn text-white fw-bold px-3 py-1.5 dropdown-toggle shadow-sm d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1b5278; border-radius: 8px; font-size: 0.88rem;">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </button>
                <ul class="dropdown-menu shadow border-0 py-2" style="border-radius: 10px; min-width: 170px;">
                    <li>
                        <a class="dropdown-item py-2 px-3 fw-medium d-flex align-items-center gap-2 text-dark" href="#" onclick="window.print()">
                            <i class="bi bi-printer text-primary"></i> Cetak / Unduh PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Filter & Search Row -->
        <form action="{{ route('admin.sertifikasi.sertifikat.index') }}" method="GET">
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-lg-2 col-6 d-flex align-items-center gap-2">
                    <span class="text-dark fw-medium">Show</span>
                    <select name="per_page" class="form-select form-select-sm border-secondary-subtle shadow-none" style="border-radius: 6px; font-size: 0.88rem;">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
                <div class="col-lg-3 col-6 d-flex align-items-center gap-2">
                    <span class="text-dark fw-medium">Status</span>
                    <select name="status" class="form-select form-select-sm border-secondary-subtle shadow-none" style="border-radius: 6px; font-size: 0.88rem;">
                        <option value="">Semua</option>
                        <option value="Aktif" {{ request('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ request('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="col-lg-3 col-6 d-flex align-items-center gap-2">
                    <span class="text-dark fw-medium">Skema</span>
                    <select name="skema_id" class="form-select form-select-sm border-secondary-subtle shadow-none" style="border-radius: 6px; font-size: 0.88rem;">
                        <option value="">Semua Skema</option>
                        @foreach($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ request('skema_id') == $skema->id ? 'selected' : '' }}>{{ $skema->nama_skema }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2 justify-content-lg-end">
                        <div class="d-flex align-items-center gap-2 grow min-w-0">
                            <span class="text-dark fw-medium">Search:</span>
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm border-secondary-subtle shadow-none grow min-w-0" style="border-radius: 6px;" placeholder="Cari peserta / no sertifikat">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Tabel Sertifikat (gabungkan kandidat dan sertifikat ada) -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center mb-0" style="border-color: #dee2e6;">
                <thead class="table-light">
                    <tr class="fw-bold text-uppercase" style="font-size: 0.88rem; color: #333;">
                        <th style="width: 55px; padding: 12px;">NO.</th>
                        <th style="padding: 12px;">NO SERTIFIKAT</th>
                        <th style="padding: 12px;">PESERTA</th>
                        <th style="padding: 12px;">SKEMA</th>
                        <th style="padding: 12px;">TANGGAL TERBIT</th>
                        <th style="padding: 12px;">STATUS</th>
                        <th style="width: 90px; padding: 12px;">AKSI</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.92rem;" class="fw-medium text-dark">
                    @php $idx = 1; @endphp

                    @if(!empty($candidates) && $candidates->count())
                        @foreach($candidates as $cand)
                            <tr>
                                <td class="fw-bold">{{ $idx }}.</td>
                                <td>-</td>
                                <td class="text-start ps-3">{{ optional($cand->user)->name ?? '-' }}</td>
                                <td>{{ optional($cand->jadwal->skema)->nama_skema ?? '-' }}</td>
                                <td>-</td>
                                <td>
                                    <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: #20c997; border-radius: 20px; font-size: 0.85rem;">Kompeten</span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.sertifikasi.sertifikat.generate.from_penilaian', $cand->id) }}" method="POST" onsubmit="return confirm('Buat sertifikat untuk peserta ini?');">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Generate Sertifikat</button>
                                    </form>
                                </td>
                            </tr>
                            @php $idx++; @endphp
                        @endforeach
                    @endif

                    @forelse ($sertifikats as $item)
                        <tr>
                            <td class="fw-bold">{{ $idx }}.</td>
                            <td>{{ $item->no_sertifikat }}</td>
                            <td class="text-start ps-3">{{ optional($item->user)->name ?? $item->peserta ?? '-' }}</td>
                            <td>{{ optional($item->skema)->nama_skema ?? $item->skema ?? '-' }}</td>
                            <td>{{ $item->tanggal_terbit ? \Carbon\Carbon::parse($item->tanggal_terbit)->translatedFormat('d F Y') : '-' }}</td>
                            <td>
                                @php
                                    $penilaianHasil = optional($item->penilaian)->hasil;
                                    if (strtolower($penilaianHasil ?? '') === 'kompeten') {
                                        $badgeText = 'Kompeten';
                                        $badgeColor = '#20c997';
                                    } else {
                                        $badgeText = $item->status ?? 'Tidak Diketahui';
                                        $badgeColor = strtolower($item->status ?? '') === 'aktif' ? '#20c997' : '#ff4d4d';
                                    }
                                @endphp
                                <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: {{ $badgeColor }}; border-radius: 20px; font-size: 0.85rem;">
                                    {{ $badgeText }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary p-2 border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #0d6efd; border-radius: 10px;">
                                        <i class="bi bi-list-task fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="border-radius: 12px; min-width: 185px;">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-dark rounded-2" href="{{ route('admin.sertifikasi.sertifikat.show', $item->id) }}">
                                                <i class="bi bi-eye text-primary"></i> Detail Sertifikat
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-dark rounded-2" href="{{ route('admin.sertifikasi.sertifikat.edit', $item->id) }}">
                                                <i class="bi bi-pencil-square text-warning"></i> Edit Data
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-dark rounded-2" href="{{ route('admin.sertifikasi.sertifikat.generate', $item->id) }}">
                                                <i class="bi bi-file-earmark-pdf text-success"></i> Generate Sertifikat
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-danger rounded-2 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="bi bi-trash"></i> Hapus Sertifikat
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="modal fade text-start" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="border-radius: 12px;">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold text-dark">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.sertifikasi.sertifikat.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body py-3">
                                                    Apakah Anda yakin ingin menghapus sertifikat untuk <strong>{{ optional($item->user)->name ?? $item->peserta ?? 'peserta ini' }}</strong>?
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light px-3 fw-medium" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                                                    <button type="submit" class="btn btn-danger px-3 fw-medium" style="border-radius: 6px;">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php $idx++; @endphp
                    @empty
                        @if($idx === 1)
                            <tr>
                                <td colspan="7" class="py-4 text-muted">Belum ada data sertifikat atau kandidat.</td>
                            </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end align-items-center mt-3">
            {{ $sertifikats->links() }}
        </div>
    </div>
</div>
@endsection