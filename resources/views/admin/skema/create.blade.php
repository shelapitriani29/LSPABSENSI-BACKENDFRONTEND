@extends('layouts.app')

@push('styles')
<style>
    .form-check-input[type="checkbox"] {
        border: 1px solid #adb5bd !important;
        background-color: #ffffff !important;
        background-image: none !important;
        border-radius: 4px !important;
        width: 1.1em !important;
        height: 1.1em !important;
        cursor: pointer;
    }

    .form-check-input[type="checkbox"]:checked {
        background-color: #1b6ca8 !important;
        border-color: #1b6ca8 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-2" style="max-width: 900px;">
    <!-- Header Page -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.3rem;">Data Skema Sertifikasi</h3>
            <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Referensi</li>
                    <li class="breadcrumb-item text-secondary">Data Skema Sertifikasi</li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Tambah Skema</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.skema.index') }}" class="btn text-white fw-semibold px-3 shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h4 class="fw-bold text-dark mb-4">Tambah Skema Sertifikasi</h4>
            <form action="{{ route('admin.skema.store') }}" method="POST">
                @csrf
                <!-- Informasi Skema -->
                <h6 class="fw-bold text-dark mb-3 text-uppercase fs-7">Informasi Skema</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Skema *</label>
                    <input type="text" name="nama_skema" class="form-control" placeholder="Contoh: Junior Web Developer" value="{{ old('nama_skema') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Kode Skema *</label>
                        <input type="text" name="kode_skema" class="form-control" placeholder="Contoh: JWD" value="{{ old('kode_skema') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small">Status</label>
                        <select name="status" class="form-select">
                            <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi singkat mengenai skema...">{{ old('deskripsi') }}</textarea>
                </div>

                <hr class="my-4 text-muted">

                <!-- Kelas & Peserta yang Mengikuti Skema -->
                <h6 class="fw-bold text-dark mb-3 text-uppercase fs-7">Kelas & Peserta yang Mengikuti Skema</h6>

                <!-- Dropdown Pilih Kelas Dinamis -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Pilih Kelas *</label>
                    <select name="kelas" id="selectKelas" class="form-select" required>
                        <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                        
                        {{-- Looping Kelas Dinamis dari Controller --}}
                        @forelse($kelases as $kelas)
                            <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @empty
                            <option value="" disabled>Belum ada data kelas di Manajemen User</option>
                        @endforelse
                    </select>
                </div>

                <!-- Box Daftar Peserta Dinamis -->
                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-dark fw-semibold">
                            Peserta dari kelas ini: <span id="countPeserta" class="fw-bold text-primary">0 orang</span>
                        </small>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            <label class="form-check-label small fw-semibold text-dark" for="selectAll">Pilih Semua Peserta</label>
                        </div>
                    </div>
                    
                    <div class="row g-2 ps-2 pt-2 border-top" id="pesertaContainer" style="max-height: 200px; overflow-y: auto;">
                        {{-- Pesan saat belum memilih kelas / kelas tidak punya data --}}
                        <div class="col-12 text-center text-muted py-3 small" id="noDataMessage">
                            Silakan pilih kelas terlebih dahulu untuk melihat daftar peserta.
                        </div>

                        {{-- Looping Peserta Dinamis Berdasarkan Controller --}}
                        @forelse($pesertas as $peserta)
                            <div class="col-md-6 peserta-item" data-kelas="{{ $peserta->kelas }}" style="display: none;">
                                <div class="form-check">
                                    <input class="form-check-input peserta-checkbox" type="checkbox" id="peserta_{{ $peserta->id }}" name="peserta[]" value="{{ $peserta->id }}" {{ is_array(old('peserta')) && in_array($peserta->id, old('peserta')) ? 'checked' : '' }}>
                                    <label class="form-check-label small text-dark" for="peserta_{{ $peserta->id }}">
                                        {{ $peserta->name ?? $peserta->nama }}
                                    </label>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.skema.index') }}" class="btn text-white px-4 fw-semibold shadow-sm" style="background-color: #dc3545; border-color: #dc3545;">Batal</a>
                    <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm" style="background-color: #28a745; border-color: #28a745;">Simpan Skema</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKelas = document.getElementById('selectKelas');
        const selectAllCheckbox = document.getElementById('selectAll');
        const pesertaItems = document.querySelectorAll('.peserta-item');
        const countPeserta = document.getElementById('countPeserta');
        const noDataMessage = document.getElementById('noDataMessage');

        // Fungsi filter peserta & hitung jumlah berdasarkan kelas yang dipilih
        function filterPeserta() {
            const selectedKelas = selectKelas.value;
            let visibleCount = 0;

            pesertaItems.forEach(item => {
                const itemKelas = item.getAttribute('data-kelas');
                const checkbox = item.querySelector('.peserta-checkbox');

                if (selectedKelas && itemKelas === selectedKelas) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                    if (checkbox) checkbox.checked = false; // Uncheck jika disembunyikan
                }
            });

            // Tampilkan atau sembunyikan pesan bantuan jika peserta kosong
            if (visibleCount > 0) {
                if (noDataMessage) noDataMessage.style.display = 'none';
            } else {
                if (noDataMessage) {
                    noDataMessage.style.display = 'block';
                    noDataMessage.textContent = selectedKelas 
                        ? 'Tidak ada peserta terdaftar di kelas ini.' 
                        : 'Silakan pilih kelas terlebih dahulu untuk melihat daftar peserta.';
                }
            }

            // Update teks hitungan peserta
            countPeserta.textContent = `${visibleCount} orang`;

            // Reset status Select All
            updateSelectAllState();
        }

        // Helper untuk perbarui status centang "Pilih Semua"
        function updateSelectAllState() {
            const visibleCheckboxes = document.querySelectorAll('.peserta-item[style*="display: block"] .peserta-checkbox');
            const visibleChecked = document.querySelectorAll('.peserta-item[style*="display: block"] .peserta-checkbox:checked');

            if (selectAllCheckbox) {
                selectAllCheckbox.checked = (visibleCheckboxes.length > 0 && visibleCheckboxes.length === visibleChecked.length);
            }
        }

        // 1. Panggil filter saat kelas diubah
        if (selectKelas) {
            selectKelas.addEventListener('change', filterPeserta);
            if (selectKelas.value) filterPeserta();
        }

        // 2. Fitur "Pilih Semua Peserta"
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                pesertaItems.forEach(item => {
                    if (item.style.display !== 'none') {
                        const checkbox = item.querySelector('.peserta-checkbox');
                        if (checkbox) checkbox.checked = selectAllCheckbox.checked;
                    }
                });
            });
        }

        // 3. Update centang "Pilih Semua" jika peserta dicentang manual
        pesertaItems.forEach(item => {
            const checkbox = item.querySelector('.peserta-checkbox');
            if (checkbox) {
                checkbox.addEventListener('change', updateSelectAllState);
            }
        });
    });
</script>
@endpush