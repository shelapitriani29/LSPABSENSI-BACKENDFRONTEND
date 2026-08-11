@extends('layouts.peserta')

@section('content')

<div class="container-fluid px-4">

    <!-- =========================
         PAGE HEADER
    ========================== -->
    <div class="mt-2 mb-3">

        <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">
            Absensi
        </h3>

        <div class="text-secondary small mb-2">
            LSP P1 – SMK NEGERI 1 GARUT
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent p-0 small">

                <li class="breadcrumb-item">
                    <a href="{{ route('peserta.dashboard') }}"
                       class="text-decoration-none text-secondary">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active text-dark fw-semibold"
                    aria-current="page">
                    Absensi
                </li>

            </ol>
        </nav>

    </div>


    <!-- =========================
         INFORMASI ABSENSI
    ========================== -->
    <div class="alert border-0 bg-primary bg-opacity-10 text-primary
                d-flex align-items-center mb-4 rounded-3
                py-3 px-3 shadow-sm"
         role="alert"
         style="font-size: 0.9rem;">

        <i class="bi bi-info-circle-fill fs-5 me-2"></i>

        <div>
            Lakukan absensi saat Anda hadir di lokasi uji
            menggunakan QR Code yang disediakan oleh panitia.
        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if(!$attendance)
        <div class="alert alert-warning border-0 rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Akses kamera dan pindai QR Code asesor untuk merekam kehadiran Anda.
        </div>
    @else
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            Absensi Anda sudah terkonfirmasi sebagai <strong>{{ $attendance->status ?? 'Hadir' }}</strong>.
            @if(optional($attendance)->check_in)
                Check-in pada {{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i') }}.
            @endif
        </div>
    @endif


    <!-- =========================
         CARD DETAIL ABSENSI
    ========================== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body p-4">

            <!-- Header Card -->
            <div class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-start
                        align-items-md-center
                        pb-4 mb-4 border-bottom gap-3">

                <div class="d-flex align-items-center gap-3">

                    <div class="rounded-circle
                                d-flex align-items-center
                                justify-content-center
                                text-primary"
                         style="
                            width: 55px;
                            height: 55px;
                            background-color: #e6f0fa;
                            flex-shrink: 0;
                         ">

                        <i class="bi bi-calendar-check fs-4"></i>

                    </div>

                    <div>

                        <span class="text-muted small d-block mb-1">
                            Skema Sertifikasi Anda
                        </span>

                        <h4 class="fw-bold text-dark mb-0">
                            {{ optional(optional($nextJadwal)->skema)->nama_skema ?? ($user->skema_kompetensi ?? 'Belum terdaftar') }}
                        </h4>

                    </div>

                </div>


                <!-- Status -->
                <div>
                    @php
                        $statusText = $attendance ? ($attendance->status ?? 'Hadir') : 'Belum Absen';
                        $badgeClass = $attendance ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger';
                        $dotClass = $attendance ? 'bg-success' : 'bg-danger';
                    @endphp
                    <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill d-flex align-items-center gap-1 fw-semibold" style="font-size: 0.85rem;">
                        <span class="badge {{ $dotClass }} rounded-circle p-1" style="width: 6px; height: 6px;"></span>
                        {{ $statusText }}
                    </span>
                </div>

            </div>


            @if($nextJadwal)
                <div class="row g-3" style="font-size: 0.95rem;">

                    <!-- Tanggal -->
                    <div class="col-12">
                        <div class="row py-2">
                            <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-calendar-event text-primary fs-5"></i>
                                Tanggal Uji
                            </div>
                            <div class="col-md-9 fw-semibold text-dark d-flex align-items-center">
                                : {{ $nextJadwal->tanggal ? \Carbon\Carbon::parse($nextJadwal->tanggal)->translatedFormat('j F Y') : '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- Waktu -->
                    <div class="col-12">
                        <div class="row py-2">
                            <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-clock text-primary fs-5"></i>
                                Waktu
                            </div>
                            <div class="col-md-9 fw-semibold text-dark d-flex align-items-center">
                                : {{ $nextJadwal->jam_mulai }} – {{ $nextJadwal->jam_selesai }} WIB
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="col-12">
                        <div class="row py-2">
                            <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt text-primary fs-5"></i>
                                Lokasi
                            </div>
                            <div class="col-md-9 fw-semibold text-dark">
                                <div>: {{ $nextJadwal->lokasi ?? 'Belum ditentukan' }}</div>
                                <div class="text-muted fw-normal ms-3">SMK NEGERI 1 GARUT</div>
                            </div>
                        </div>
                    </div>

                    <!-- Asesor -->
                    <div class="col-12">
                        <div class="row py-2">
                            <div class="col-md-3 text-muted d-flex align-items-center gap-2">
                                <i class="bi bi-person text-primary fs-5"></i>
                                Asesor
                            </div>
                            <div class="col-md-9 fw-semibold text-dark d-flex align-items-center">
                                : {{ optional($nextJadwal->asesor)->name ?? 'Belum ditentukan' }}
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="text-center py-4">
                    <p class="mb-0 text-muted">Belum ada jadwal uji terdaftar untuk kelas Anda.</p>
                </div>
            @endif

        </div>

    </div>


    <!-- =========================
         CARD SCAN QR
    ========================== -->
    @if(! $attendance)
        <div class="card border-0 shadow-sm rounded-4 mb-4
                    text-center py-5 px-3">

            <div class="card-body">

                <!-- Icon -->
                <div class="rounded-circle mx-auto
                            d-flex align-items-center
                            justify-content-center
                            text-primary mb-3"
                     style="
                        width: 70px;
                        height: 70px;
                        background-color: #e6f0fa;
                     ">

                    <i class="bi bi-qr-code-scan fs-2"></i>

                </div>


                <h5 class="fw-bold text-dark mb-1">
                    Anda belum melakukan absensi
                </h5>


                <p class="text-muted small mb-4">
                    Klik tombol di bawah untuk membuka kamera
                    dan memindai QR Code.
                </p>


                <!-- =========================
                     BUTTON SCAN
                ========================== -->
                <button type="button"
                        id="btnScanQR"
                        class="btn btn-primary px-4 py-2
                               rounded-pill fw-semibold
                               shadow-sm border-0
                               d-inline-flex align-items-center gap-2"
                        onclick="openScanner()"
                        style="
                            background-color: #0d6efd;
                            font-size: 0.95rem;
                        "
                        {{ $nextJadwal ? '' : 'disabled' }}>

                    <i class="bi bi-qr-code-scan"></i>

                    {{ $nextJadwal ? 'Scan QR Code' : 'Jadwal belum tersedia' }}

                </button>

            </div>

        </div>
    @elseif($attendance && ! $attendance->check_out)
        <div class="card border-0 shadow-sm rounded-4 mb-4
                    text-center py-5 px-3">

            <div class="card-body">

                <div class="rounded-circle mx-auto
                            d-flex align-items-center
                            justify-content-center
                            text-primary mb-3"
                     style="
                        width: 70px;
                        height: 70px;
                        background-color: #e6f0fa;
                     ">

                    <i class="bi bi-qr-code-scan fs-2"></i>

                </div>

                <h5 class="fw-bold text-dark mb-1">
                    Anda sudah melakukan check-in
                </h5>

                <p class="text-muted small mb-2">
                    Check-in pada {{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i') }}.
                </p>

                <p class="text-muted small mb-4">
                    Jika Anda selesai ujian, silakan scan kembali untuk Check Out.
                </p>

                <button type="button"
                        id="btnScanQR"
                        class="btn btn-primary px-4 py-2
                               rounded-pill fw-semibold
                               shadow-sm border-0
                               d-inline-flex align-items-center gap-2"
                        onclick="openScanner()"
                        style="
                            background-color: #0d6efd;
                            font-size: 0.95rem;
                        "
                        {{ $nextJadwal ? '' : 'disabled' }}>

                    <i class="bi bi-qr-code-scan"></i>

                    Scan Check Out

                </button>

            </div>

        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 mb-4
                    text-center py-5 px-3">

            <div class="card-body">

                <div class="rounded-circle mx-auto
                            d-flex align-items-center
                            justify-content-center
                            text-primary mb-3"
                     style="
                        width: 70px;
                        height: 70px;
                        background-color: #e6f0fa;
                     ">

                    <i class="bi bi-flag-fill fs-2"></i>

                </div>

                <h5 class="fw-bold text-dark mb-1">
                    Ujian telah selesai
                </h5>

                <p class="text-muted small mb-2">
                    Terima kasih telah mengikuti sertifikasi.
                </p>

                <p class="text-muted small mb-0">
                    Check-in: {{ optional($attendance)->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '-' }} — Check-out: {{ optional($attendance)->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '-' }}
                </p>

            </div>

        </div>
    @endif

</div>



<!-- ==================================================
     POPUP / MODAL QR SCANNER
================================================== -->

<div id="qrModal" class="custom-modal">

    <div class="custom-modal-content
                rounded-4 shadow-lg p-4 bg-white">


        <!-- Header Modal -->
        <div class="d-flex justify-content-between
                    align-items-center mb-2">

            <h5 class="fw-bold text-dark mb-0">
                Scan QR Code
            </h5>


            <button type="button"
                    class="btn-close"
                    onclick="closeScanner()">
            </button>

        </div>


        <!-- Instruction -->
        <p class="text-secondary small mb-3">

            Arahkan kamera ke QR Code
            yang diberikan oleh asesor.

        </p>


        <!-- =========================
             CAMERA READER
        ========================== -->
        <div id="reader"
             class="rounded-3 overflow-hidden
                    bg-dark w-100"
             style="min-height: 250px;">

        </div>


        <!-- =========================
             SCAN STATUS
        ========================== -->
        <p id="scanResult"
           class="text-muted small mt-3
                  text-center mb-4">

            <i class="bi bi-lightbulb me-1"></i>

            Arahkan kamera ke QR Code

        </p>


        <!-- Button Tutup -->
        <div class="text-end">

            <button type="button"
                    class="btn btn-outline-secondary
                           btn-sm px-4 rounded-pill"
                    onclick="closeScanner()">

                Tutup

            </button>

        </div>

    </div>

</div>



<!-- ==================================================
     CSS
================================================== -->

<style>

/* =========================
   MODAL
========================= */

.custom-modal {

    display: none;

    position: fixed;

    inset: 0;

    background: rgba(0, 0, 0, 0.6);

    justify-content: center;

    align-items: center;

    z-index: 9999;

    padding: 20px;

}


/* =========================
   MODAL CONTENT
========================= */

.custom-modal-content {

    width: 100%;

    max-width: 420px;

}


/* =========================
   CAMERA
========================= */

#reader {

    width: 100%;

}


/* Kamera hasil library */

#reader video {

    width: 100% !important;

    border-radius: 12px;

}


/* =========================
   SCAN AREA
========================= */

#reader__scan_region {

    border-radius: 12px;

    overflow: hidden;

}


/* =========================
   BUTTON
========================= */

#btnScanQR {

    transition: 0.2s ease;

}

#btnScanQR:hover {

    transform: translateY(-1px);

}


/* =========================
   MOBILE
========================= */

@media (max-width: 576px) {

    .custom-modal {

        padding: 10px;

    }

    .custom-modal-content {

        max-width: 100%;

    }

}

</style>



<!-- ==================================================
     FOOTER
================================================== -->

<div class="text-center text-muted small
            mt-5 pt-3 border-top">

    &copy; 2026 LSP P1 SMK NEGERI 1 GARUT.
    All rights reserved.

</div>



<!-- ==================================================
     HTML5 QR CODE LIBRARY
================================================== -->

<script src="https://unpkg.com/html5-qrcode"></script>



<!-- ==================================================
     JAVASCRIPT QR SCANNER
================================================== -->

<script>

    /*
    |--------------------------------------------------------------------------
    | VARIABLE
    |--------------------------------------------------------------------------
    */

    let scanner = null;

    let isScanning = false;

    let qrAlreadyScanned = false;



    /*
    |--------------------------------------------------------------------------
    | OPEN SCANNER
    |--------------------------------------------------------------------------
    */

    function openScanner() {

        const modal =
            document.getElementById('qrModal');

        const result =
            document.getElementById('scanResult');


        /*
        | Tampilkan popup
        */

        modal.style.display = 'flex';


        /*
        | Reset status
        */

        qrAlreadyScanned = false;


        result.innerHTML = `
            <i class="bi bi-lightbulb me-1"></i>
            Arahkan kamera ke QR Code
        `;


        /*
        | Buat scanner jika belum ada
        */

        if (!scanner) {

            scanner =
                new Html5Qrcode("reader");

        }


        /*
        | Cegah scanner berjalan dua kali
        */

        if (isScanning) {

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | START CAMERA
        |--------------------------------------------------------------------------
        */

        const scanOptions = {
            fps: 10,
            qrbox: {
                width: 220,
                height: 220
            }
        };

        const startCamera = (constraints) => {
            return scanner.start(
                constraints,
                scanOptions,

                /*
                |--------------------------------------------------------------------------
                | QR BERHASIL DIBACA
                |--------------------------------------------------------------------------
                */

                function(decodedText) {


                /*
                | Cegah QR terbaca berkali-kali
                */

                if (qrAlreadyScanned) {

                    return;

                }


                qrAlreadyScanned = true;


                /*
                | Tampilkan status
                */

                result.innerHTML = `

                    <span class="text-success fw-bold">

                        <i class="bi bi-check-circle-fill me-1"></i>

                        QR Code berhasil dibaca!

                    </span>

                `;


                /*
                | Simpan hasil QR
                */

                console.log(
                    "QR Code:",
                    decodedText
                );


                /*
                | Stop kamera
                */

                scanner.stop()

                    .then(() => {


                        isScanning = false;


                        /*
                        | Tutup popup
                        */

                        document
                            .getElementById('qrModal')
                            .style.display = 'none';


                        /*
                        |--------------------------------------------------------------------------
                        | HASIL QR
                        |--------------------------------------------------------------------------
                        |
                        | Untuk sekarang hanya ditampilkan.
                        |
                        | Nanti bagian ini bisa diganti
                        | dengan fetch() ke Laravel.
                        |
                        */

                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('peserta.absensi.scan') }}';
                        form.style.display = 'none';

                        const token = document.createElement('input');
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        form.appendChild(token);

                        const qrInput = document.createElement('input');
                        qrInput.name = 'qr_data';
                        qrInput.value = decodedText;
                        form.appendChild(qrInput);

                        document.body.appendChild(form);
                        form.submit();


                    })

                    .catch(error => {

                        console.error(
                            "Gagal menghentikan kamera:",
                            error
                        );

                    });

            },


            /*
            |--------------------------------------------------------------------------
            | QR BELUM TERBACA
            |--------------------------------------------------------------------------
            */

                function(errorMessage) {

                    /*
                    | Tidak perlu melakukan apa-apa.
                    |
                    | Function ini terus dipanggil
                    | selama kamera mencari QR.
                    */

                }

            );
        };

        startCamera({ facingMode: "environment" })
            .then(() => {
                isScanning = true;
                console.log("Kamera berhasil dimulai.");
            })
            .catch(error => {
                console.warn("Kamera environment ditolak, mencoba kamera depan.", error);

                startCamera({ facingMode: "user" })
                    .then(() => {
                        isScanning = true;
                        console.log("Kamera fallback berhasil dimulai.");
                    })
                    .catch(fallbackError => {
                        console.error("Gagal mengakses kamera:", fallbackError);

                        isScanning = false;

                        result.innerHTML = `

                            <span class="text-danger fw-semibold">

                                <i class="bi bi-camera-video-off me-1"></i>

                                Kamera tidak dapat digunakan.

                            </span>

                        `;

                        alert(
                            "Gagal mengakses kamera.\n\n" +
                            "Pastikan izin kamera di browser " +
                            "sudah diberikan."
                        );

                        modal.style.display = 'none';
                    });
            });

    }



    /*
    |--------------------------------------------------------------------------
    | CLOSE SCANNER
    |--------------------------------------------------------------------------
    */

    function closeScanner() {

        const modal =
            document.getElementById('qrModal');


        /*
        | Kalau scanner sedang aktif
        */

        if (scanner && isScanning) {


            scanner.stop()

                .then(() => {

                    isScanning = false;

                    modal.style.display = 'none';

                    console.log(
                        "Kamera dihentikan."
                    );

                })

                .catch(error => {

                    console.error(
                        "Gagal menghentikan kamera:",
                        error
                    );

                    isScanning = false;

                    modal.style.display = 'none';

                });


        } else {


            /*
            | Kalau scanner tidak aktif
            */

            modal.style.display = 'none';

        }

    }

</script>

@endsection
