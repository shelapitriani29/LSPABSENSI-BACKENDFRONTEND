@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <!-- Header Title & Breadcrumb -->
    <div class="mb-4">
        <h2 class="fw-bold mb-0">Dashboard</h2>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- 1. Row Stat Cards (Dengan Visual Accent & Pattern) -->
<div class="row g-3 mb-4">
    <!-- Card Peserta -->
    <div class="col-md-3">
        <div class="card border-0 text-white overflow-hidden position-relative h-100 shadow" 
             style="background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%); border-radius: 16px;">
            <!-- Decorative SVG Pattern Background -->
            <svg class="position-absolute end-0 bottom-0 text-white" style="opacity: 0.15; transform: translate(10%, 20%);" width="160" height="160" fill="currentColor" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.002.001zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4 0 0 1 0 1 1 1 1h6.502a5.1 5.1 0 0 1-.566-1H1.088c.023-.208.196-.91.737-1.54C2.396 10.82 3.483 10 5 10c.813 0 1.545.234 2.146.619a6 6 0 0 1-.21-.339m-1.272-3.923a2 2 0 1 0 .002-3.998 2 2 0 0 0-.002 3.998m0 1a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
            </svg>
            <div class="card-body p-4 position-relative" style="z-index: 2;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase fw-semibold tracking-wider text-white-50" style="font-size: 0.8rem; letter-spacing: 1px;">Peserta</span>
                    <div class="px-2 py-1 rounded-3" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px);">
                        <small class="fw-bold">LSP P1</small>
                    </div>
                </div>
                <h1 class="display-4 fw-bold mb-1">125</h1>
                <p class="mb-0 text-white-50" style="font-size: 0.85rem;">
                    <span class="badge bg-white text-primary fw-bold me-1">+12%</span> dibanding bulan lalu
                </p>
            </div>
        </div>
    </div>

    <!-- Card Asesor -->
    <div class="col-md-3">
        <div class="card border-0 text-white overflow-hidden position-relative h-100 shadow" 
             style="background: linear-gradient(135deg, #b91c1c 0%, #ef4444 100%); border-radius: 16px;">
            <!-- Decorative SVG Pattern Background -->
            <svg class="position-absolute end-0 bottom-0 text-white" style="opacity: 0.15; transform: translate(10%, 20%);" width="160" height="160" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.904a6 6 0 0 0 5.159-2.884c.038-.078.016-.17-.052-.224-.627-.502-1.353-.872-2.148-1.089a5.5 5.5 0 0 0-5.918 0c-.795.217-1.521.587-2.148 1.089-.068.054-.09.146-.052.224A6 6 0 0 0 8 12.904m0 1a7 7 0 0 1-6-3.238c-.377-.552-.081-1.303.548-1.536A8.5 8.5 0 0 1 8 8.5c1.928 0 3.738.608 5.21 1.63.63.233.926.984.549 1.536A7 7 0 0 1 8 13.904"/>
            </svg>
            <div class="card-body p-4 position-relative" style="z-index: 2;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase fw-semibold tracking-wider text-white-50" style="font-size: 0.8rem; letter-spacing: 1px;">Asesor</span>
                    <div class="px-2 py-1 rounded-3" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px);">
                        <small class="fw-bold">Aktif</small>
                    </div>
                </div>
                <h1 class="display-4 fw-bold mb-1">15</h1>
                <p class="mb-0 text-white-50" style="font-size: 0.85rem;">
                    <span class="badge bg-white text-danger fw-bold me-1">100%</span> Asesor Terkompetensi
                </p>
            </div>
        </div>
    </div>

    <!-- Card Skema -->
    <div class="col-md-3">
        <div class="card border-0 text-white overflow-hidden position-relative h-100 shadow" 
             style="background: linear-gradient(135deg, #047857 0%, #10b981 100%); border-radius: 16px;">
            <!-- Decorative SVG Pattern Background -->
            <svg class="position-absolute end-0 bottom-0 text-white" style="opacity: 0.15; transform: translate(10%, 20%);" width="160" height="160" fill="currentColor" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
            </svg>
            <div class="card-body p-4 position-relative" style="z-index: 2;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase fw-semibold tracking-wider text-white-50" style="font-size: 0.8rem; letter-spacing: 1px;">Skema</span>
                    <div class="px-2 py-1 rounded-3" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px);">
                        <small class="fw-bold">BNSP</small>
                    </div>
                </div>
                <h1 class="display-4 fw-bold mb-1">8</h1>
                <p class="mb-0 text-white-50" style="font-size: 0.85rem;">
                    <span class="badge bg-white text-success fw-bold me-1">Tersedia</span> Skema Keahlian
                </p>
            </div>
        </div>
    </div>

    <!-- Card Sertifikat -->
    <div class="col-md-3">
        <div class="card border-0 text-white overflow-hidden position-relative h-100 shadow" 
             style="background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%); border-radius: 16px;">
            <!-- Decorative SVG Pattern Background -->
            <svg class="position-absolute end-0 bottom-0 text-white" style="opacity: 0.15; transform: translate(10%, 20%);" width="160" height="160" fill="currentColor" viewBox="0 0 16 16">
                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.545 6.425a.75.75 0 0 1 .046 1.058l-3.25 3.5a.75.75 0 0 1-1.077.02l-1.75-1.75a.75.75 0 0 1 1.06-1.06l1.205 1.206 2.713-2.918a.75.75 0 0 1 1.053-.056"/>
            </svg>
            <div class="card-body p-4 position-relative" style="z-index: 2;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase fw-semibold tracking-wider text-white-50" style="font-size: 0.8rem; letter-spacing: 1px;">Sertifikat</span>
                    <div class="px-2 py-1 rounded-3" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px);">
                        <small class="fw-bold">Terbit</small>
                    </div>
                </div>
                <h1 class="display-4 fw-bold mb-1">98</h1>
                <p class="mb-0 text-white-50" style="font-size: 0.85rem;">
                    <span class="badge bg-white text-warning fw-bold me-1">78%</span> Tingkat Kelulusan
                </p>
            </div>
        </div>
    </div>
</div>

    <!-- 2. Row Grafik Statistik Sertifikasi -->
    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 12px;">
        <h5 class="fw-bold mb-4">Grafik Statistik Sertifikasi</h5>
        <div class="row align-items-center">
            <!-- Bar Chart (Tahun) -->
            <div class="col-lg-8 border-end pe-lg-4 mb-4 mb-lg-0">
                <div style="height: 250px;">
                    <canvas id="barChartSertifikasi"></canvas>
                </div>
            </div>
            <!-- Donut Chart & Persentase (Kelulusan) -->
            <div class="col-lg-4 ps-lg-4">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div style="height: 110px; position: relative;">
                            <canvas id="doughnutLulus"></canvas>
                        </div>
                        <h6 class="fw-bold mt-2 mb-0">Lulus</h6>
                    </div>
                    <div class="col-6 mb-3">
                        <div style="height: 110px; position: relative;">
                            <canvas id="doughnutTidakLulus"></canvas>
                        </div>
                        <h6 class="fw-bold mt-2 mb-0">Tidak Lulus</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Row Jadwal Hari Ini & Aktivitas Terbaru -->
    <div class="row g-4">
        <!-- Jadwal Hari Ini -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px;">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center text-muted">
                            <th style="width: 25%;">Jam</th>
                            <th>Jadwal Hari Ini</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="text-center fw-bold py-3 bg-light">08.00</td>
                            <td class="ps-3 bg-light">Skema Web Developer</td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-center fw-bold py-3 bg-light">10.00</td>
                            <td class="ps-3 bg-light">Skema Network Engineer</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold py-3 bg-light">13.00</td>
                            <td class="ps-3 bg-light">Skema UI/UX Designer</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px;">
                <table class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center text-muted">
                            <th>Aktivitas Terbaru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="py-3 bg-light ps-3">Budi melakukan absensi</td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="py-3 bg-light ps-3">Admin menambahkan jadwal</td>
                        </tr>
                        <tr>
                            <td class="py-3 bg-light ps-3">Asesor menginput penilaian</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Bar Chart Sertifikasi
        const ctxBar = document.getElementById('barChartSertifikasi').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['2023', '2024', '2025', '2026'],
                datasets: [
                    {
                        label: 'Lulus',
                        data: [100, 90, 100, 85],
                        backgroundColor: '#20C997',
                        borderRadius: 4
                    },
                    {
                        label: 'Tidak Lulus',
                        data: [25, 40, 10, 15],
                        backgroundColor: '#FF4D4D',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: { callback: value => value + '%' }
                    }
                }
            }
        });

        // 2. Doughnut Chart Lulus (80%)
        const ctxLulus = document.getElementById('doughnutLulus').getContext('2d');
        new Chart(ctxLulus, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [80, 20],
                    backgroundColor: ['#20C997', '#E9ECEF'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { tooltip: { enabled: false } }
            },
            plugins: [{
                id: 'textCenter',
                beforeDraw: function(chart) {
                    var width = chart.width, height = chart.height, ctx = chart.ctx;
                    ctx.restore();
                    ctx.font = "bold 16px sans-serif";
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#20C997";
                    var text = "80%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;
                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }]
        });

        // 3. Doughnut Chart Tidak Lulus (20%)
        const ctxTidakLulus = document.getElementById('doughnutTidakLulus').getContext('2d');
        new Chart(ctxTidakLulus, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [20, 80],
                    backgroundColor: ['#FF4D4D', '#E9ECEF'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { tooltip: { enabled: false } }
            },
            plugins: [{
                id: 'textCenter',
                beforeDraw: function(chart) {
                    var width = chart.width, height = chart.height, ctx = chart.ctx;
                    ctx.restore();
                    ctx.font = "bold 16px sans-serif";
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#333";
                    var text = "20%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;
                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }]
        });
    });
</script>
@endsection