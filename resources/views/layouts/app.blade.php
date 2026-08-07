<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin - LSP SMKN 1 Garut' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f4f6f9; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            overflow-x: hidden;
            margin: 0;
        }
        .top-header-brand {
            background-color: #e9ecef;
            color: #212529;
            height: 48px;
            padding: 0 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1010;
        }
        .sidebar { 
            width: 280px; 
            height: calc(100vh - 48px); 
            background-color: #1b6ca8; 
            color: white; 
            position: fixed; 
            top: 48px; 
            left: 0; 
            z-index: 1000; 
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
            overflow-y: auto;
        }
        .sidebar .nav-link { 
            color: rgba(255,255,255,0.9); 
            padding: 9px 14px; 
            font-weight: 500; 
            border-radius: 6px; 
            margin: 3px 12px; 
            transition: all 0.2s ease-in-out;
            font-size: 0.9rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            background-color: #145380; 
            color: white; 
        }
        .submenu {
            list-style: none;
            padding-left: 0;
            margin: 2px 12px;
            background: rgba(0, 0, 0, 0.12);
            border-radius: 6px;
            overflow: hidden;
        }
        .submenu li a {
            color: rgba(255,255,255,0.85);
            padding: 7px 12px 7px 35px;
            display: block;
            text-decoration: none;
            font-size: 0.85rem;
            transition: background 0.2s;
        }
        .submenu li a:hover, .submenu li a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }
        .main-content { 
            margin-left: 280px; 
            margin-top: 48px;
            padding: 25px; 
            width: calc(100% - 280px);
        }
    </style>
</head>
<body>

    <!-- Header Atas -->
    <div class="top-header-brand">
        <div class="d-flex align-items-center">
            <span class="fw-bold text-dark me-2" style="font-size: 1rem;">LSP</span> 
            <span class="text-secondary fw-semibold" style="font-size: 0.8rem;">SMK NEGERI 1 GARUT</span>
        </div>
        <div>
            <i class="bi bi-window-sidebar text-dark" style="font-size: 1rem;"></i>
        </div>
    </div>

    <!-- Sidebar Admin -->
    <div class="sidebar d-flex flex-column pb-4 pt-3">
        
        <!-- User Profile Section -->
        <div class="px-3 py-2 mb-2 d-flex align-items-center">
            <div class="bg-white rounded-circle me-3 shadow-sm flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                <i class="bi bi-person-fill text-secondary fs-4"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0 text-white" style="font-size: 0.9rem;">Administrator</h6>
                <small class="text-white-50" style="font-size: 0.75rem;">admin@smkn1garut.sch.id</small>
            </div>
        </div>

        <!-- Main Menu Section -->
        <div class="small fw-bold text-white-50 px-3 mb-1 text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">MAIN MENU</div>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-speedometer2 me-2 fs-6"></i> Dashboard
                </a>
            </li>
        </ul>

        <!-- Pilihan Menu Section -->
        <div class="small fw-bold text-white-50 px-3 mb-1 text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">PILIHAN MENU</div>
        <ul class="nav flex-column mb-auto">
            
            <!-- Dropdown Referensi -->
            @php 
                $isReferensi = request()->routeIs('admin.user.*') || request()->routeIs('admin.peserta.*') || request()->routeIs('admin.asesor.*') || request()->routeIs('admin.skema.*'); 
            @endphp
            <li class="nav-item mb-1">
                <a class="nav-link d-flex justify-content-between align-items-center {{ $isReferensi ? 'active' : '' }}" data-bs-toggle="collapse" href="#menuReferensi" role="button" aria-expanded="{{ $isReferensi ? 'true' : 'false' }}">
                    <span><i class="bi bi-folder2-open me-2"></i>Referensi</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse {{ $isReferensi ? 'show' : '' }}" id="menuReferensi">
                    <ul class="submenu my-1">
                        <li><a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">Manajemen User</a></li>
                        <li><a href="{{ route('admin.peserta.index') }}" class="{{ request()->routeIs('admin.peserta.*') ? 'active' : '' }}">Data Peserta</a></li>
                        <li><a href="{{ route('admin.asesor.index') }}" class="{{ request()->routeIs('admin.asesor.*') ? 'active' : '' }}">Data Asesor</a></li>
                        <li><a href="{{ route('admin.skema.index') }}" class="{{ request()->routeIs('admin.skema.*') ? 'active' : '' }}">Data Skema Sertifikasi</a></li>
                    </ul>
                </div>
            </li>

            <!-- Dropdown Sertifikasi -->
            @php $isSertifikasi = request()->routeIs('admin.sertifikasi.*'); @endphp
            <li class="nav-item mb-1">
                <a class="nav-link d-flex justify-content-between align-items-center {{ $isSertifikasi ? 'active' : '' }}" data-bs-toggle="collapse" href="#menuSertifikasi" role="button" aria-expanded="{{ $isSertifikasi ? 'true' : 'false' }}">
                    <span><i class="bi bi-award me-2"></i>Sertifikasi</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse {{ $isSertifikasi ? 'show' : '' }}" id="menuSertifikasi">
                    <ul class="submenu my-1">
                        <li><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="{{ request()->routeIs('admin.sertifikasi.jadwal.*') ? 'active' : '' }}">Jadwal Uji</a></li>
                        <li><a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="{{ request()->routeIs('admin.sertifikasi.penilaian.*') ? 'active' : '' }}">Penilaian</a></li>
                        <li><a href="{{ route('admin.sertifikasi.absensi.index') }}" class="{{ request()->routeIs('admin.sertifikasi.absensi.*') ? 'active' : '' }}">Absensi Peserta</a></li>
                        <li><a href="{{ route('admin.sertifikasi.sertifikat.index') }}" class="{{ request()->routeIs('admin.sertifikasi.sertifikat.*') ? 'active' : '' }}">Sertifikat</a></li>
                    </ul>
                </div>
            </li>

            <!-- Menu Laporan Sistem -->
            @php $isLaporan = request()->routeIs('admin.laporan.*'); @endphp
            <li class="nav-item mb-1">
                <a class="nav-link d-flex justify-content-between align-items-center {{ $isLaporan ? 'active' : '' }}" data-bs-toggle="collapse" href="#menuLaporan" role="button" aria-expanded="{{ $isLaporan ? 'true' : 'false' }}">
                    <span><i class="bi bi-file-earmark-text me-2"></i>Laporan</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse {{ $isLaporan ? 'show' : '' }}" id="menuLaporan">
                    <ul class="submenu my-1">
                        <li><a href="{{ route('admin.laporan.sistem') }}" class="{{ request()->routeIs('admin.laporan.sistem') ? 'active' : '' }}">Laporan Sistem</a></li>
                    </ul>
                </div>
            </li>

            <!-- Menu Pengaturan -->
            <li class="nav-item mb-1">
                <a href="{{ route('admin.profil') }}" class="nav-link {{ request()->routeIs('admin.profil') ? 'active' : '' }} d-flex align-items-center">
                    <i class="bi bi-gear me-2 fs-6"></i> Pengaturan
                </a>
            </li>

        </ul>

        <!-- Logout Section -->
        <div class="px-3 mt-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn w-100 text-danger border-0 d-flex align-items-center fw-semibold text-start px-3 py-2" style="background-color: rgba(255,255,255,0.1); border-radius: 6px;">
                    <i class="bi bi-box-arrow-right me-2 fs-6 text-danger"></i> Logout
                </button>
            </form>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>