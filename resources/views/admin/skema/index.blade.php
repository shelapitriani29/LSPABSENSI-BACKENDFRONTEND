@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Style Data Peserta -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">Data Skema Sertifikasi</h3>
        <p class="text-secondary mb-1" style="font-size: 0.9rem;">LSP P1 – SMK NEGERI 1 GARUT</p>
        <div class="text-secondary" style="font-size: 0.85rem;">
            Dashboard / Referensi / <span class="text-dark">Data Skema Sertifikasi</span>
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
                <div class="col-12 col-md-6 d-flex align-items-center" style="font-size: 0.9rem;">
                    show 
                    <select class="form-select form-select-sm mx-2" style="width: 70px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select> 
                    entries
                </div>
                <!-- Input Search di sebelah kanan sejajar dengan show entries -->
                <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center gap-2">
                    <label for="searchInput" class="small text-secondary mb-0">Search:</label>
                    <input type="text" id="searchInput" class="form-control form-control-sm" style="max-width: 200px;" placeholder="">
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
                        @php
                            $dummySkemas = [
                                (object)[
                                    'id' => 1, 
                                    'nama' => 'Junior Web Developer', 
                                    'kode' => 'JWD', 
                                    'kelas' => 'XI RPL 1', 
                                    'peserta' => '36 Peserta', 
                                    'status' => 'Aktif'
                                ],
                                (object)[
                                    'id' => 2, 
                                    'nama' => 'Junior Programmer', 
                                    'kode' => 'JP', 
                                    'kelas' => 'XI RPL 2', 
                                    'peserta' => '34 Peserta', 
                                    'status' => 'Aktif'
                                ],
                                (object)[
                                    'id' => 3, 
                                    'nama' => 'UI/UX Designer', 
                                    'kode' => 'UXD', 
                                    'kelas' => 'XI RPL 3', 
                                    'peserta' => '32 Peserta', 
                                    'status' => 'Nonaktif'
                                ],
                            ];
                        @endphp

                        @foreach($dummySkemas as $key => $skema)
                        <tr>
                            <td class="text-center fw-semibold text-secondary">{{ $key + 1 }}.</td>
                            <td>
                                <span class="fw-bold text-dark d-block">{{ $skema->nama }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $skema->kode }}</span>
                            </td>
                            <td>
                                <span class="text-dark">{{ $skema->kelas }}</span>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $skema->peserta }}</span>
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer Tabel: Pagination di Tengah -->
            <div class="d-flex justify-content-center pt-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link" style="background-color: #1b6ca8; border-color: #1b6ca8;">1</span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection