<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Asesor - LSP SMK Negeri 1 Garut</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        /* Styling Sidebar dengan Tinggi Pas & Flexbox */
        .sidebar {
            width: 260px;
            height: calc(100vh - 46px); /* Mengikuti sisa layar di bawah header */
            background-color: #1E6388;
            color: #fff;
            position: fixed;
            top: 46px; /* Mulai pas di bawah header */
            left: 0;
            z-index: 100;
            overflow-y: auto; /* Bisa di-scroll jika menu berlebih */
        }
        /* Header Atas Ramping */
        .top-header {
            height: 46px;
            background-color: #e9ecef;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 99;
            border-bottom: 1px solid #dee2e6;
        }
        /* Konten Utama */
        .main-content {
            margin-left: 260px;
            margin-top: 46px;
            padding: 25px;
        }
        /* Styling Nav Link Sidebar */
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: #154c6a;
        }
        .sidebar .sub-menu .nav-link {
            padding-left: 28px;
            font-size: 0.85rem;
        }
        @media (max-width: 992px) {
            .sidebar { width: 0; overflow: hidden; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- 1. TOP HEADER -->
    <div class="top-header d-flex align-items-center justify-content-between px-3">
        <div class="d-flex align-items-center">
            <span class="d-flex align-items-baseline">
                <span class="fw-bold text-dark me-2" style="font-size: 1rem; letter-spacing: 0.5px;">LSP</span> 
                <span class="text-secondary" style="font-size: 0.8rem; font-weight: 500; letter-spacing: 0.2px;">SMK NEGERI 1 GARUT</span>
            </span>
        </div>
        <div>
            <button class="btn btn-light btn-sm border shadow-sm py-0 px-2" style="font-size: 0.8rem;">
                <i class="bi bi-layout-sidebar"></i>
            </button>
        </div>
    </div>

    <!-- 2. SIDEBAR ASESOR -->
    <div class="sidebar d-flex flex-column justify-content-between p-3">
        
        <!-- Bagian Atas (Profil & Menu) -->
        <div>
            <!-- Profil User -->
            @php
                $sidebarUser = auth()->user();
                $sidebarInitials = $sidebarUser ? collect(explode(' ', trim($sidebarUser->name)))->map(fn($part) => strtoupper(substr($part, 0, 1)))->join('') : 'U';
                $sidebarPhotoUrl = $sidebarUser && $sidebarUser->foto ? asset('storage/' . $sidebarUser->foto) : null;
            @endphp
            <div class="user-profile text-center mb-3 pb-3 border-bottom border-light border-opacity-25">
                <div class="rounded-circle bg-white text-dark fw-bold d-inline-flex align-items-center justify-content-center mb-1 shadow-sm overflow-hidden" style="width: 40px; height: 40px; font-size: 1rem;">
                    @if($sidebarPhotoUrl)
                        <img src="{{ $sidebarPhotoUrl }}" alt="Foto Profil" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
                    @else
                        {{ $sidebarInitials ?: 'U' }}
                    @endif
                </div>
                <h6 class="fw-bold mb-0 text-white" style="font-size: 0.9rem;">{{ $sidebarUser->name ?? 'User' }}</h6>
                <small class="text-white-50" style="font-size: 0.7rem;">{{ $sidebarUser ? ($sidebarUser->role === 'asesor' ? 'Asesor Kompetensi' : ucfirst($sidebarUser->role)) : 'Asesor Kompetensi' }}</small>
            </div>

            <!-- List Menu -->
            <span class="text-uppercase text-white-50 fw-bold mb-1 px-2 d-block" style="font-size: 0.6rem; letter-spacing: 0.5px;">MAIN MENU</span>
            <ul class="nav flex-column gap-1 mb-2">
                <li class="nav-item">
                    <a href="{{ route('asesor.dashboard') }}" class="nav-link {{ Request::routeIs('asesor.dashboard') ? 'active' : '' }} d-flex align-items-center">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
            </ul>

            <span class="text-uppercase text-white-50 fw-bold mb-1 px-2 d-block" style="font-size: 0.6rem; letter-spacing: 0.5px;">PILIHAN MENU</span>
            <ul class="nav flex-column gap-1">
                <!-- Dropdown Sertifikasi -->
                <li class="nav-item">
                    <a href="#sertifikasiSubmenu" data-bs-toggle="collapse" class="nav-link d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-file-earmark-text me-2"></i> Sertifikasi</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse sub-menu mt-1" id="sertifikasiSubmenu">
                        <ul class="nav flex-column gap-1">
                            <li class="nav-item">
                                <a href="{{ route('asesor.jadwal-asesmen') }}" class="nav-link d-flex align-items-center">
                                    <i class="bi bi-calendar-check me-2"></i> Jadwal Asesmen
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('asesor.daftar-peserta') }}" class="nav-link">Daftar Peserta</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Menu Input Penilaian -->
                <li class="nav-item">
                    <a href="{{ route('asesor.input-penilaian.index') }}" class="nav-link {{ Request::routeIs('asesor.input-penilaian*') ? 'active' : '' }} d-flex align-items-center">
                        <i class="bi bi-pencil-square me-2"></i> Input Penilaian
                    </a>
                </li>

                <!-- Menu Riwayat Penilaian -->
                <li class="nav-item">
                    <a href="{{ url('/asesor/riwayat-penilaian') }}" class="nav-link d-flex align-items-center">
                        <i class="bi bi-clock-history me-2"></i> Riwayat Penilaian
                    </a>
                </li>

                <!-- Menu Pengaturan (Langsung Mengarah ke Halaman Profil Tanpa Dropdown) -->
                <li class="nav-item">
                    <a href="{{ route('asesor.profil') }}" class="nav-link {{ Request::routeIs('asesor.profil*') ? 'active' : '' }} d-flex align-items-center">
                        <i class="bi bi-gear me-2"></i> Pengaturan
                    </a>
                </li>
            </ul>
        </div>

        <!-- Bagian Bawah (Tombol Logout Menempel di Bawah) -->
        <div class="pt-2 border-top border-light border-opacity-25 mt-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link text-danger w-100 text-start d-flex align-items-center bg-transparent border-0" style="font-weight: 500;">
                    <i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout
                </button>
            </form>
        </div>

    </div>

    <!-- 3. KONTEN UTAMA HALAMAN -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>