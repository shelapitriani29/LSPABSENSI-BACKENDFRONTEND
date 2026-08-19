<div class="sidebar d-flex flex-column pb-4 pt-3 text-white" style="background-color: #1E6388; min-height: 100vh; width: 290px; flex-shrink: 0;">
    
    <!-- HEADER LOGO (Memanjang ke Samping / Horizontal sesuai UI/UX) -->
    <div class="sidebar-header-brand mb-3 px-3 py-3" style="background-color: #e9ecef; color: #212529; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #dee2e6;">
        <div class="text-truncate" style="font-size: 0.9rem; white-space: nowrap;">
            <span class="fs-5 fw-bold text-dark">LSP</span> 
            <span class="text-secondary fw-semibold" style="font-size: 0.85rem;">SMK NEGERI 1 GARUT</span>
        </div>
        <i class="bi bi-window-sidebar text-dark fs-5 shrink-0 ms-2"></i>
    </div>

    <!-- Profile User (Sesuai UI/UX Figma) -->
    <div class="d-flex align-items-center gap-3 my-3 px-3">
        <div class="bg-light rounded-circle shrink-0 shadow-sm d-flex align-items-center justify-content-center text-secondary" style="width: 50px; height: 50px;">
            <i class="bi bi-person-fill fs-4"></i>
        </div>
        <div class="text-start overflow-hidden">
            <h6 class="fw-bold mb-0 text-white text-uppercase text-truncate" style="font-size: 0.95rem; letter-spacing: 0.5px;">ADMINISTRATOR</h6>
            <small class="text-white-50 text-truncate d-block" style="font-size: 0.8rem;">admin@smkn1garut.sch.id</small>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="mb-3 px-2">
        <small class="text-uppercase text-white-50 fw-bold px-2" style="font-size: 0.75rem; letter-spacing: 1px;">Main Menu</small>
        <ul class="nav nav-pills flex-column mt-2">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white d-flex align-items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #145380;' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
        </ul>
    </div>

    <!-- Pilihan Menu -->
    <div class="px-2 mb-auto">
        <small class="text-uppercase text-white-50 fw-bold px-2" style="font-size: 0.75rem; letter-spacing: 1px;">Pilihan Menu</small>
        <ul class="nav nav-pills flex-column mt-2">
            
            <!-- Referensi Dropdown -->
            @php $isReferensi = request()->routeIs('admin.user.*') || request()->routeIs('admin.peserta.*') || request()->routeIs('admin.asesor.*') || request()->routeIs('admin.skema.*'); @endphp
            <li class="nav-item">
                <a class="nav-link text-white-50 d-flex justify-content-between align-items-center {{ $isReferensi ? 'active text-white' : '' }}" data-bs-toggle="collapse" href="#menuReferensi" role="button" aria-expanded="{{ $isReferensi ? 'true' : 'false' }}" style="{{ $isReferensi ? 'background-color: #145380;' : '' }}">
                    <span><i class="bi bi-folder me-2"></i> Referensi</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ms-2 {{ $isReferensi ? 'show' : '' }}" id="menuReferensi">
                    <ul class="nav flex-column mt-1 bg-black bg-opacity-10 rounded-2 p-1">
                        <li><a href="{{ route('admin.user.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.user.*') ? 'text-white fw-semibold' : '' }}">Manajemen User</a></li>
                        <li><a href="{{ route('admin.peserta.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.peserta.*') ? 'text-white fw-semibold' : '' }}">Data Peserta</a></li>
                        <li><a href="{{ route('admin.asesor.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.asesor.*') ? 'text-white fw-semibold' : '' }}">Data Asesor</a></li>
                        <li><a href="{{ route('admin.skema.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.skema.*') ? 'text-white fw-semibold' : '' }}">Data Skema Sertifikasi</a></li>
                    </ul>
                </div>
            </li>

            <!-- Sertifikasi Dropdown -->
            @php $isSertifikasi = request()->routeIs('admin.sertifikasi.*'); @endphp
            <li class="nav-item mt-1">
                <a class="nav-link text-white-50 d-flex justify-content-between align-items-center {{ $isSertifikasi ? 'active text-white' : '' }}" data-bs-toggle="collapse" href="#menuSertifikasi" role="button" aria-expanded="{{ $isSertifikasi ? 'true' : 'false' }}" style="{{ $isSertifikasi ? 'background-color: #145380;' : '' }}">
                    <span><i class="bi bi-award me-2"></i> Sertifikasi</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ms-2 {{ $isSertifikasi ? 'show' : '' }}" id="menuSertifikasi">
                    <ul class="nav flex-column mt-1 bg-black bg-opacity-10 rounded-2 p-1">
                        <li><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.sertifikasi.jadwal.*') ? 'text-white fw-semibold' : '' }}">Jadwal Uji</a></li>
                        <li><a href="{{ route('admin.sertifikasi.penilaian.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.sertifikasi.penilaian.*') ? 'text-white fw-semibold' : '' }}">Penilaian</a></li>
                        <li><a href="{{ route('admin.sertifikasi.absensi.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.sertifikasi.absensi.*') ? 'text-white fw-semibold' : '' }}">Absensi Peserta</a></li>
                        <li><a href="{{ route('admin.sertifikasi.sertifikat.index') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.sertifikasi.sertifikat.*') ? 'text-white fw-semibold' : '' }}">Sertifikat</a></li>
                    </ul>
                </div>
            </li>

            <!-- Laporan Sistem -->
            @php $isLaporan = request()->routeIs('admin.laporan.*'); @endphp
            <li class="nav-item mt-1">
                <a class="nav-link text-white-50 d-flex justify-content-between align-items-center {{ $isLaporan ? 'active text-white' : '' }}" data-bs-toggle="collapse" href="#menuLaporan" role="button" aria-expanded="{{ $isLaporan ? 'true' : 'false' }}" style="{{ $isLaporan ? 'background-color: #145380;' : '' }}">
                    <span><i class="bi bi-file-earmark-text me-2"></i> Laporan</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ms-2 {{ $isLaporan ? 'show' : '' }}" id="menuLaporan">
                    <ul class="nav flex-column mt-1 bg-black bg-opacity-10 rounded-2 p-1">
                        <li><a href="{{ route('admin.laporan.sistem') }}" class="nav-link text-white-50 py-1 px-3 {{ request()->routeIs('admin.laporan.sistem') ? 'text-white fw-semibold' : '' }}">Laporan Sistem</a></li>
                    </ul>
                </div>
            </li>

            <!-- Pengaturan -->
            @php $isPengaturan = request()->routeIs('admin.pengaturan.*'); @endphp
            <li class="nav-item mt-1">
                <a href="{{ route('admin.pengaturan.index') }}" class="nav-link text-white-50 d-flex align-items-center {{ $isPengaturan ? 'active text-white' : '' }}" style="{{ $isPengaturan ? 'background-color: #145380;' : '' }}">
                    <i class="bi bi-gear me-2"></i> Pengaturan
                </a>
            </li>
        </ul>
    </div>

    <!-- Logout Button -->
    <div class="px-3 mt-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn w-100 text-danger border-0 d-flex align-items-center fw-semibold text-start px-3 py-2" style="background-color: rgba(255,255,255,0.1); border-radius: 6px;">
                <i class="bi bi-box-arrow-right me-2 fs-6 text-danger"></i> Logout
            </button>
        </form>
    </div>
</div>