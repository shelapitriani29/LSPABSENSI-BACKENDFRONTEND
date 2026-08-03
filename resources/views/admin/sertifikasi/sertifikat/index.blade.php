@extends('layouts.app')

@section('content')
@php
    // Data Dummy Tampilan Frontend
    $sertifikats = collect([
        (object)[
            'id' => 1,
            'no_sertifikat' => 'LSP-001-2026',
            'peserta' => 'Haura',
            'skema' => 'Graphic Design',
            'tanggal_terbit' => '2026-06-15',
            'status' => 'Aktif'
        ],
        (object)[
            'id' => 2,
            'no_sertifikat' => 'LSP-002-2026',
            'peserta' => 'Jenisa',
            'skema' => 'Graphic Design',
            'tanggal_terbit' => '2026-06-15',
            'status' => 'Nonaktif'
        ],
        (object)[
            'id' => 3,
            'no_sertifikat' => 'LSP-003-2026',
            'peserta' => 'Shela',
            'skema' => 'Graphic Design',
            'tanggal_terbit' => '2026-06-20',
            'status' => 'Aktif'
        ],
        (object)[
            'id' => 4,
            'no_sertifikat' => 'LSP-004-2026',
            'peserta' => 'Aulia',
            'skema' => 'Graphic Design',
            'tanggal_terbit' => '2026-06-20',
            'status' => 'Aktif'
        ],
        (object)[
            'id' => 5,
            'no_sertifikat' => 'LSP-005-2026',
            'peserta' => 'Nafis',
            'skema' => 'Graphic Design',
            'tanggal_terbit' => '2026-06-25',
            'status' => 'Aktif'
        ],
        (object)[
            'id' => 6,
            'no_sertifikat' => 'LSP-006-2026',
            'peserta' => 'Sinta',
            'skema' => 'Graphic Design',
            'tanggal_terbit' => '2026-06-25',
            'status' => 'Nonaktif'
        ],
    ]);
@endphp

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
            
            <!-- Tombol Dropdown Export PDF -->
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

        <!-- Controls Row (Show Entries & Search) -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            
            <!-- Show Antrian Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <span class="text-dark fw-medium">show</span>
                <select class="form-select form-select-sm border-secondary-subtle shadow-none" style="width: 65px; border-radius: 6px; font-size: 0.88rem;">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="text-dark fw-medium">antrian</span>
            </div>

            <!-- Search Field -->
            <div class="d-flex align-items-center gap-2">
                <span class="text-dark fw-medium">Search:</span>
                <input type="text" class="form-control form-control-sm border-secondary-subtle shadow-none" style="width: 180px; border-radius: 6px;">
            </div>
        </div>

        <!-- Tabel Sertifikat -->
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
                    @forelse ($sertifikats as $item)
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}.</td>
                            <td>{{ $item->no_sertifikat }}</td>
                            <td class="fw-bold">{{ $item->peserta }}</td>
                            <td>{{ $item->skema }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                            <td>
                                @if(strtolower($item->status) === 'aktif')
                                    <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: #20c997; border-radius: 20px; font-size: 0.85rem;">Aktif</span>
                                @else
                                    <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: #ff4d4d; border-radius: 20px; font-size: 0.85rem;">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <!-- Dropdown Aksi -->
                                <div class="dropdown">
                                    <button class="btn btn-primary p-2 border-0 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #0d6efd; border-radius: 10px;">
                                        <i class="bi bi-list-task fs-6"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="border-radius: 12px; min-width: 185px;">
                                        
                                        <!-- Detail Sertifikat -->
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-dark rounded-2" href="{{ route('admin.sertifikasi.sertifikat.show', $item->id ?? 1) }}">
                                                <i class="bi bi-eye text-primary"></i> Detail Sertifikat
                                            </a>
                                        </li>

                                        <!-- Edit Data -->
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-dark rounded-2" href="{{ route('admin.sertifikasi.sertifikat.edit', $item->id ?? 1) }}">
                                                <i class="bi bi-pencil-square text-warning"></i> Edit Data
                                            </a>
                                        </li>

                                        <!-- Generate Sertifikat -->
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-dark rounded-2" href="{{ route('admin.sertifikasi.sertifikat.generate', $item->id ?? 1) }}">
                                                <i class="bi bi-file-earmark-pdf text-success"></i> Generate Sertifikat
                                            </a>
                                        </li>

                                        <!-- Hapus -->
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 fw-medium text-danger rounded-2 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="bi bi-trash"></i> Hapus Sertifikat
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Modal Edit Data -->
                                <div class="modal fade text-start" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="border-radius: 12px;">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold text-dark" id="editModalLabel{{ $item->id }}">Edit Data Sertifikat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                <form action="#" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <!-- Nomor Sertifikat -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium text-secondary" style="font-size: 0.88rem;">No Sertifikat</label>
                                                        <input type="text" name="no_sertifikat" class="form-control" value="{{ $item->no_sertifikat }}" required>
                                                    </div>

                                                    <!-- Nama Peserta -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium text-secondary" style="font-size: 0.88rem;">Nama Peserta</label>
                                                        <input type="text" name="peserta" class="form-control" value="{{ $item->peserta }}" required>
                                                    </div>

                                                    <!-- Skema -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium text-secondary" style="font-size: 0.88rem;">Skema Sertifikasi</label>
                                                        <input type="text" name="skema" class="form-control" value="{{ $item->skema }}" required>
                                                    </div>

                                                    <!-- Tanggal Terbit -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium text-secondary" style="font-size: 0.88rem;">Tanggal Terbit</label>
                                                        <input type="date" name="tanggal_terbit" class="form-control" value="{{ $item->tanggal_terbit }}" required>
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium text-secondary" style="font-size: 0.88rem;">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="Aktif" {{ strtolower($item->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="Nonaktif" {{ strtolower($item->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                        </select>
                                                    </div>

                                                    <!-- Tombol Aksi Modal -->
                                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                                        <button type="button" class="btn btn-light px-3 fw-medium" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                                                        <button type="submit" class="btn btn-warning text-white px-3 fw-medium" style="border-radius: 6px;">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus Dummy -->
                                <div class="modal fade text-start" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="border-radius: 12px;">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold text-dark">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                Apakah Anda yakin ingin menghapus sertifikat untuk <strong>{{ $item->peserta }}</strong>?
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light px-3 fw-medium" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                                                <button type="button" class="btn btn-danger px-3 fw-medium" data-bs-dismiss="modal" style="border-radius: 6px;">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-muted">Belum ada data sertifikat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination di Tengah (Center) -->
        <div class="d-flex justify-content-center align-items-center mt-4">
            <ul class="pagination pagination-sm mb-0 shadow-sm" style="border-radius: 6px; overflow: hidden;">
                <li class="page-item disabled">
                    <a class="page-link text-secondary" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link bg-primary border-primary text-white" href="#">1</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-secondary" href="#">Next</a>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection