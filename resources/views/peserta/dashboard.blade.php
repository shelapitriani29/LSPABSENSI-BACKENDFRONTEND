@extends('layouts.peserta')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="mt-2 mb-3">
        <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">DASHBOARD</h3>
        <div class="text-secondary small mb-2">LSP P1 – SMK NEGERI 1 GARUT</div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">
                <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}" class="text-decoration-none text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Banner Selamat Datang -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body p-4">
                <h4 class="fw-bold text-dark mb-1">Selamat datang, {{ $user->name ?? 'Peserta' }}!</h4>
                <p class="text-muted small mb-0">Berikut ringkasan informasi sertifikasi Anda.</p>
            </div>
        </div>

        <!-- Grid Informasi -->
        <div class="row g-4">
            <!-- Skema Sertifikasi -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 50px; height: 50px; background-color: #e6f0fa; flex-shrink: 0;">
                                <i class="bi bi-award fs-5"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Skema Sertifikasi</span>
                                <h5 class="fw-bold text-dark mb-1">{{ optional(optional($nextJadwal)->skema)->nama_skema ?? ($user->skema_kompetensi ?? 'Belum terdaftar') }}</h5>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill fw-semibold" style="font-size: 0.75rem;">Aktif</span>
                            </div>
                        </div>
                        <hr class="text-muted opacity-25">
                        <div class="text-muted small">
                            Kode Skema: {{ optional(optional($nextJadwal)->skema)->kode_skema ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Uji -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 50px; height: 50px; background-color: #e8f8f0; flex-shrink: 0;">
                                <i class="bi bi-calendar-check fs-5"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Jadwal Uji</span>
                                <h5 class="fw-bold text-dark mb-1">{{ optional($nextJadwal)->tanggal ? \Carbon\Carbon::parse($nextJadwal->tanggal)->translatedFormat('j F Y') : 'Belum ada jadwal' }}</h5>
                            </div>
                        </div>
                        <div class="text-secondary small d-flex flex-column gap-1">
                            <div><i class="bi bi-clock me-1 text-primary"></i> {{ optional($nextJadwal)->jam_mulai ? optional($nextJadwal)->jam_mulai . ' - ' . optional($nextJadwal)->jam_selesai . ' WIB' : '-' }}</div>
                            <div><i class="bi bi-geo-alt me-1 text-primary"></i> {{ optional($nextJadwal)->lokasi ?? 'Lokasi belum ditentukan' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Absensi -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center {{ $attendance ? 'text-success' : 'text-danger' }}" style="width: 50px; height: 50px; background-color: {{ $attendance ? '#e7f7ee' : '#fde8e8' }}; flex-shrink: 0;">
                                    <i class="bi bi-qr-code-scan fs-5"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Status Absensi</span>
                                    <h5 class="fw-bold {{ $attendance ? 'text-success' : 'text-danger' }} mb-0">{{ $attendance ? ($attendance->status ?? 'Hadir') : 'Belum Absen' }}</h5>
                                </div>
                            </div>
                            <p class="text-muted small mb-4">Scan QR Code saat ujian berlangsung untuk melakukan absensi.</p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm border-0 d-inline-flex align-items-center gap-2" onclick="openScanner()" style="background-color: #0d6efd; font-size: 0.9rem;" {{ $nextJadwal ? '' : 'disabled' }}>
                                <i class="bi bi-qr-code-scan"></i> Scan QR
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Penilaian -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 50px; height: 50px; background-color: #fef6e7; flex-shrink: 0;">
                                <i class="bi bi-file-earmark-text fs-5"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Hasil Penilaian</span>
                                <h5 class="fw-bold text-dark mb-0">{{ $penilaian ? ($penilaian->hasil ?? 'Selesai') : 'Belum Diumumkan' }}</h5>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            {{ $penilaian ? ('Asesor: ' . optional($penilaian->asesor)->name . ', Jadwal: ' . ($penilaian->jadwal?->tanggal ? \Carbon\Carbon::parse($penilaian->jadwal->tanggal)->translatedFormat('j F Y') : '-')) : 'Hasil penilaian akan diumumkan setelah proses uji selesai.' }}
        </div>
    </div>

</div>

<!-- Popup Modal Murni JavaScript & CSS untuk Scanner -->
<div id="qrModal" class="custom-modal">
    <div class="custom-modal-content rounded-4 shadow-lg p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fw-bold text-dark mb-0">Scan QR Code</h5>
            <button type="button" class="btn-close" onclick="closeScanner()"></button>
        </div>
        <p class="text-secondary small mb-3">Arahkan kamera ke QR Code yang diberikan oleh asesor.</p>
        
        <!-- Area Reader Kamera -->
        <div id="reader" class="rounded-3 overflow-hidden bg-dark w-100" style="min-height: 250px;"></div>

        <p id="scanResult" class="text-muted small mt-3 text-center mb-4">
            <i class="bi bi-lightbulb me-1"></i> Arahkan kamera ke QR Code
        </p>

        <div class="text-end">
            <button type="button" class="btn btn-outline-secondary btn-sm px-4 rounded-pill" onclick="closeScanner()">Tutup</button>
        </div>
    </div>
</div>

<!-- Styling Modal Murni -->
<style>
.custom-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.custom-modal-content {
    width: 100%;
    max-width: 420px;
}
#reader {
    width: 100%;
}
</style>

<!-- Footer -->
<div class="text-center text-muted small mt-5 pt-3 border-top pb-3">
    &copy; 2026 LSP P1 SMK NEGERI 1 GARUT. All rights reserved.
</div>

<!-- Library HTML5-QRCode & Skrip Kamera -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let scanner = null;

function openScanner() {
    // Tampilkan modal terlebih dahulu agar elemen #reader memiliki ukuran piksel
    document.getElementById('qrModal').style.display = 'flex';

    if (!scanner) {
        scanner = new Html5Qrcode("reader");
    }

    scanner.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: { width: 220, height: 220 }
        },
        function(decodedText) {
            document.getElementById('scanResult').innerHTML = '<span class="text-success fw-bold">QR berhasil dibaca!</span>';
            console.log("QR:", decodedText);

            scanner.stop().then(() => {
                document.getElementById('qrModal').style.display = 'none';
                alert("Absensi Berhasil! Data: " + decodedText);
            }).catch(err => {
                console.error("Gagal menghentikan scanner", err);
            });
        },
        function(errorMessage) {
            // Frame normal saat mencari QR
        }
    ).catch(err => {
        console.error("Gagal mengakses kamera:", err);
        alert("Gagal mengakses kamera. Pastikan izin kamera di browser sudah diaktifkan.");
        document.getElementById('qrModal').style.display = 'none';
    });
}

function closeScanner() {
    if (scanner) {
        scanner.stop().then(() => {
            document.getElementById('qrModal').style.display = 'none';
        }).catch(err => {
            document.getElementById('qrModal').style.display = 'none';
        });
    } else {
        document.getElementById('qrModal').style.display = 'none';
    }
}
</script>
@endsection