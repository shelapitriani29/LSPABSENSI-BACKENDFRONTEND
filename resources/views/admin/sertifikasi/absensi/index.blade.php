@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    <!-- Header Title & Subtitle -->
    <div class="mb-3">
        <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -0.5px;">Absensi Peserta</h1>
        <small class="text-secondary d-block fw-medium mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Dashboard</a></li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Sertifikasi</li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Absensi Peserta</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Success / Error Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Outer Card Container -->
    <div class="card border p-4 bg-white shadow-sm" style="border-color: #cbd5e1 !important; border-radius: 8px;">
        
        <!-- Inside Card Header Title -->
        <h2 class="fw-bold text-dark mb-4" style="font-size: 1.5rem;">Absensi Peserta</h2>

        <!-- Title Header & Search/Filter Form -->
        <form method="GET" action="{{ route('admin.sertifikasi.absensi.index') }}" id="filterForm">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                
                <!-- Show Entries Dropdown (Kiri) -->
                <div class="d-inline-flex align-items-center gap-2">
                    <span class="text-dark fw-medium" style="font-size: 0.95rem;">show</span>
                    <select name="per_page" class="form-select form-select-sm border-secondary text-center fw-semibold" 
                            style="width: 65px; height: 32px; border-radius: 4px; font-size: 0.85rem;" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-dark fw-medium" style="font-size: 0.95rem;">antrian</span>
                </div>

                <!-- Right Side: Buttons & Search Input (Kanan) -->
                <div class="d-flex flex-wrap align-items-center gap-3 ms-auto">
                    <!-- Button Rekap Absensi -->
                    <button type="button" class="btn text-white fw-medium px-3 py-1-5 d-inline-flex align-items-center gap-2 shadow-sm" 
                            data-bs-toggle="modal" data-bs-target="#modalRekapAbsensi"
                            style="background-color: #20c997; border-radius: 50px; font-size: 0.88rem; border: none;">
                        <span>Rekap Absensi</span>
                        <i class="bi bi-plus-lg fs-6"></i>
                    </button>

                    <!-- Search Input Box -->
                    <div class="d-inline-flex align-items-center gap-2">
                        <span class="text-dark fw-medium" style="font-size: 0.95rem;">Search:</span>
                        <input type="search" name="search" class="form-control form-control-sm border-secondary" 
                               value="{{ request('search') }}" 
                               style="width: 150px; height: 32px; border-radius: 4px;">
                    </div>
                </div>

            </div>
        </form>

        <!-- Table Data Absensi -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center mb-0" style="border-color: #a0aec0;">
                <thead style="background-color: #e2e8f0;">
                    <tr class="fw-bold text-dark" style="font-size: 0.95rem; height: 45px;">
                        <th style="width: 65px;">NO.</th>
                        <th>Peserta</th>
                        <th>NIK / Username</th>
                        <th>Instansi</th>
                        <th>Jadwal</th>
                        <th>Check in</th>
                        <th>Check Out</th>
                        <th style="width: 100px;">QR</th>
                        <th style="width: 130px;">Status</th>
                        <th style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark fw-medium" style="font-size: 0.95rem;">
                    @forelse($pesertas as $index => $item)
                        @php
                            $attendance = $item->absensis->first();
                            $attendanceJadwal = optional($attendance)->jadwal;
                            $participantJadwal = $attendanceJadwal ?: $item->jadwal;
                            $status = $attendance->status ?? 'Belum Absen';
                            $statusBg = match($status) {
                                'Hadir' => '#20C997',
                                'Tidak Hadir' => '#FF4D4D',
                                'Terlambat' => '#FFC107',
                                'Izin' => '#3182CE',
                                'Sakit' => '#805AD5',
                                default => '#2D3748',
                            };
                            $qrData = 'Absensi_' . $item->id . '_' . ($participantJadwal->kode_jadwal ?? ($jadwal ? $jadwal->kode_jadwal : 'nojadwal')) . '_' . ($item->username ?? $item->nik ?? 'peserta');
                        @endphp
                        <tr style="height: 52px;">
                            <td class="fw-bold">
                                {{ $pesertas->firstItem() ? $pesertas->firstItem() + $index : $index + 1 }}.
                            </td>
                            <td class="text-start ps-3" style="min-width: 180px; max-width: 220px;">
                                <div class="fw-semibold text-truncate" style="max-width: 220px;">{{ $item->name ?? '-' }}</div>
                                <div class="text-muted small text-truncate" style="max-width: 220px;">{{ $item->email ?? $item->no_hp ?? '-' }}</div>
                            </td>
                            <td class="text-start" style="min-width: 120px;">
                                {{ $item->username ?? $item->nik ?? '-' }}
                            </td>
                            <td class="text-start" style="min-width: 140px;">
                                {{ $item->instansi ?? 'SMK NEGERI 1 GARUT' }}
                            </td>
                            <td class="text-start" style="min-width: 130px;">
                                <div class="fw-semibold">{{ optional($participantJadwal)->kode_jadwal ?? ($jadwal ? $jadwal->kode_jadwal : '-') }}</div>
                                <div class="text-muted small">{{ optional(optional($participantJadwal)->skema)->nama_skema ?? 'Skema belum terpilih' }}</div>
                            </td>
                            <td>{{ optional($attendance)->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H.i') : '-' }}</td>
                            <td>{{ optional($attendance)->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H.i') : '-' }}</td>
                            <td class="text-center">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ rawurlencode($qrData) }}" 
                                     alt="QR Absensi" 
                                     style="width: 64px; height: 64px; object-fit: cover; border-radius: 12px; border: 1px solid #dee2e6;">
                            </td>
                            <td>
                                <span class="badge text-white px-2 py-2 fw-semibold w-100" 
                                    style="background-color: {{ $statusBg }}; border-radius: 12px; font-size: 0.8rem; letter-spacing: 0.2px;">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>
                                @if($participantJadwal)
                                    @if($attendance)
                                        <a href="{{ route('admin.sertifikasi.absensi.print-qr', ['id' => $attendance->id]) }}" target="_blank" class="btn btn-sm btn-secondary px-3 py-2" style="border-radius: 8px; font-size: 0.88rem;">
                                            <i class="bi bi-printer me-1"></i> Cetak
                                        </a>
                                    @else
                                        <a href="{{ route('admin.sertifikasi.absensi.print-qr-user', ['userId' => $item->id]) }}" target="_blank" class="btn btn-sm btn-secondary px-3 py-2" style="border-radius: 8px; font-size: 0.88rem;">
                                            <i class="bi bi-printer me-1"></i> Cetak
                                        </a>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-sm btn-outline-secondary px-3 py-2" disabled style="border-radius: 8px; font-size: 0.88rem;">
                                        Belum Tersedia
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">Tidak ada peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end align-items-center mt-3">
            {{ $pesertas->links() }}
        </div>

    </div>
</div>

<!-- ================= MODAL POPUP ================= -->

<!-- 1. Modal Rekap Absensi -->
<div class="modal fade" id="modalRekapAbsensi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-bottom px-4 py-3">
                <h5 class="modal-title fw-bold">Rekap Data Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.sertifikasi.absensi.export') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Skema / Jadwal</label>
                        <select name="jadwal_id" class="form-select">
                            <option value="">Semua Jadwal</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}" {{ request('jadwal_id') == $jadwal->id ? 'selected' : '' }}>
                                    {{ $jadwal->kode_jadwal }} - {{ optional($jadwal->skema)->nama_skema ?? 'Skema tidak tersedia' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Format Export</label>
                        <select name="format" class="form-select">
                            <option value="pdf">PDF Document (.pdf)</option>
                            <option value="excel">Excel Spreadsheet (.xlsx)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer px-4 py-3 border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white fw-semibold" style="background-color: #20C997;">
                        <i class="bi bi-download me-1"></i> Download Rekap
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 2. Modal Generate QR Code Absensi -->
<div class="modal fade" id="modalGenerateQR" tabindex="-1" aria-labelledby="modalGenerateQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-bottom px-4 py-3">
                <h5 class="modal-title fw-bold text-dark" id="modalGenerateQRLabel" style="font-size: 1.25rem;">
                    Generate QR Code Absensi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form dibungkus melingkupi modal-body agar tombol generate ada di dalam submit form / bagian bawah -->
            <form id="qrForm" action="#" method="POST">
                @csrf
                <div class="modal-body p-4 bg-white">
                    <div class="row g-4">
                        <!-- Kiri: Form Konfigurasi QR Code -->
                        <div class="col-md-6 border-end pe-md-4">
                            <h6 class="fw-bold text-dark mb-3">Konfigurasi QR Code</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary small mb-1">Skema</label>
                                <select name="skema_id" id="qrSertifikasi" class="form-select border-secondary-subtle py-2" style="border-radius: 8px;">
                                    <option value="">Pilih Skema</option>
                                    @foreach($skemas as $skema)
                                        <option value="{{ $skema->id }}">{{ $skema->nama_skema }} ({{ $skema->kode_skema }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary small mb-1">Jadwal Uji</label>
                                <input type="date" name="tanggal_uji" id="qrTanggal" class="form-control border-secondary-subtle py-2" value="{{ date('Y-m-d') }}" style="border-radius: 8px;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary small mb-1">Sesi</label>
                                <select name="sesi" id="qrSesi" class="form-select border-secondary-subtle py-2" style="border-radius: 8px;">
                                    <option value="pagi">Pagi (08.00 - 11.00)</option>
                                    <option value="siang">Siang (13.00 - 16.00)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary small mb-1">Lokasi</label>
                                <input type="text" name="lokasi" id="qrLokasi" class="form-control border-secondary-subtle py-2" value="Lab Komputer 1" style="border-radius: 8px;">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium text-secondary small mb-1 d-block">Masa Berlaku QR</label>
                                <div class="form-check form-check-inline me-3">
                                    <input class="form-check-input" type="radio" name="masaBerlaku" id="hanyaHariIni" value="today" checked>
                                    <label class="form-check-label small text-dark" for="hanyaHariIni">Hanya Hari Ini</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="masaBerlaku" id="sampaiSelesai" value="until_finished">
                                    <label class="form-check-label small text-dark" for="sampaiSelesai">Sampai Selesai Ujian</label>
                                </div>
                            </div>
                        </div>

                        <!-- Kanan: Preview QR Code -->
                        <div class="col-md-6 ps-md-4 d-flex flex-column justify-content-between">
                            <div class="p-4 bg-light rounded-3 border d-flex flex-column align-items-center justify-content-center flex-grow-1">
                                <div class="bg-white p-2 border rounded-3 shadow-sm mb-3">
                                    <img id="qrImagePreview" 
                                         src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=Absensi_JWD_{{ date('Ymd') }}" 
                                         alt="QR Code Absensi" 
                                         class="img-fluid" style="width: 170px; height: 170px;">
                                </div>

                                <div class="text-center small">
                                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                        <span class="text-secondary fw-medium">QR Status</span>
                                        <span class="badge rounded-pill bg-success fw-semibold px-2 py-1">Aktif</span>
                                    </div>
                                    <div class="text-secondary mb-1">
                                        Dibuat : <span id="qrCreatedTime" class="text-dark font-monospace fw-semibold">{{ date('d F Y H.i') }}</span>
                                    </div>
                                    <div class="text-secondary">
                                        Berlaku sampai : <span id="qrExpiredTime" class="text-dark font-monospace fw-semibold">{{ date('d F Y') }} 17.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-2 mt-3">
                                <a id="btnDownloadQR" href="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=Absensi_JWD_{{ date('Ymd') }}" download="QR_Absensi.png" class="btn btn-outline-secondary btn-sm flex-fill fw-medium py-1-5" style="border-radius: 6px;">
                                    Download QR
                                </a>
                                <button type="button" class="btn btn-outline-secondary btn-sm flex-fill fw-medium py-1-5" style="border-radius: 6px;" onclick="window.print()">
                                    Cetak QR
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm flex-fill fw-medium py-1-5" style="border-radius: 6px;">
                                    Nonaktifkan QR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Modal (Tombol Generate QR dipindahkan ke bagian bawah kanan footer modal) -->
                <div class="modal-footer px-4 py-3 border-top bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" id="btnUpdateQRPreview" class="btn text-white fw-semibold px-4 shadow-sm" style="background-color: #1e3a5f; border-radius: 8px; font-size: 0.95rem;">
                        Generate QR Code
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Dynamic QR Code Preview Update
        const btnGenerateQR = document.getElementById('btnUpdateQRPreview');
        if (btnGenerateQR) {
            btnGenerateQR.addEventListener('click', function () {
                const sertifikasi = document.getElementById('qrSertifikasi').value;
                const tanggal = document.getElementById('qrTanggal').value;
                const sesi = document.getElementById('qrSesi').value;

                const payload = `Absensi_${sertifikasi}_${tanggal}_${sesi}`;
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${encodeURIComponent(payload)}`;

                document.getElementById('qrImagePreview').src = qrUrl;
                document.getElementById('btnDownloadQR').href = qrUrl;
            });
        }
    });
</script>
@endpush