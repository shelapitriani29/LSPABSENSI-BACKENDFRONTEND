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
    <div class="mb-4">
        <a href="{{ route('admin.skema.index') }}" class="text-decoration-none small mb-2 d-inline-block fw-semibold text-dark">
            <i class="bi bi-arrow-left"></i> Kembali ke Data Skema
        </a>
        <h4 class="fw-bold mb-1 text-dark">Edit Skema Sertifikasi</h4>
        <p class="text-secondary small mb-0">Perbarui informasi skema sertifikasi dan penetapan pesertanya</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.skema.update', $skema->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Informasi Skema -->
                <h6 class="fw-bold mb-3 text-uppercase fs-7" style="color: #1b6ca8;">Informasi Skema</h6>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Nama Skema *</label>
                    <input type="text" name="nama_skema" class="form-control" value="{{ old('nama_skema', $skema->nama_skema) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-dark">Kode Skema *</label>
                        <input type="text" name="kode_skema" class="form-control" value="{{ old('kode_skema', $skema->kode_skema) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-dark">Status</label>
                        <select name="status" class="form-select">
                            <option value="Aktif" {{ old('status', $skema->status) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status', $skema->status) === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-dark">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $skema->deskripsi) }}</textarea>
                </div>

                <hr class="my-4 text-muted">

                <!-- Kelas yang Mengikuti Skema -->
                <h6 class="fw-bold mb-3 text-uppercase fs-7" style="color: #1b6ca8;">Kelas & Peserta yang Mengikuti Skema</h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark">Pilih Kelas *</label>
                    <!-- Perbaikan: Tambahkan name="kelas" dan buat looping dinamis -->
                    <select name="kelas" class="form-select">
                        <option value="" disabled {{ empty($skema->kelas) ? 'selected' : '' }}>-- Pilih Kelas --</option>
                        
                        @forelse($kelases as $kelas)
                            <option value="{{ $kelas }}" {{ old('kelas', $skema->kelas) == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @empty
                            <option value="" disabled>Belum ada data kelas dari Manajemen User</option>
                        @endforelse
                    </select>
                </div>

                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-dark fw-semibold">
                            Peserta dari kelas ini: <span id="countPeserta" class="fw-bold text-primary">{{ $pesertas->where('kelas', $skema->kelas)->count() }} orang</span>
                        </small>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            <label class="form-check-label small fw-semibold text-dark" for="selectAll">Pilih Semua Peserta</label>
                        </div>
                    </div>
                    
                    <div class="row g-2 ps-2 pt-2 border-top" id="pesertaContainer" style="max-height: 200px; overflow-y: auto;">
                        <div class="col-12 text-center text-muted py-3 small" id="noDataMessage">
                            Silakan pilih kelas terlebih dahulu untuk melihat daftar peserta.
                        </div>

                        @forelse($pesertas as $peserta)
                            <div class="col-md-6 peserta-item" data-kelas="{{ $peserta->kelas }}" style="display: none;">
                                <div class="form-check">
                                    <input class="form-check-input peserta-checkbox" type="checkbox" id="peserta_{{ $peserta->id }}" name="peserta[]" value="{{ $peserta->id }}"
                                        {{ (is_array(old('peserta')) && in_array($peserta->id, old('peserta'))) || ($skema->kelas && $skema->kelas === $peserta->kelas) ? 'checked' : '' }}>
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
                    <a href="{{ route('admin.skema.index') }}" class="btn btn-light px-4 border fw-semibold text-secondary">Batal</a>
                    <button type="submit" class="btn px-4 text-white fw-semibold shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKelas = document.querySelector('select[name="kelas"]');
        const selectAllCheckbox = document.getElementById('selectAll');
        const pesertaItems = document.querySelectorAll('.peserta-item');
        const countPeserta = document.getElementById('countPeserta');
        const noDataMessage = document.getElementById('noDataMessage');

        function filterPeserta() {
            const selectedKelas = selectKelas ? selectKelas.value : null;
            let visibleCount = 0;

            pesertaItems.forEach(item => {
                const itemKelas = item.getAttribute('data-kelas');
                const checkbox = item.querySelector('.peserta-checkbox');

                if (selectedKelas && itemKelas === selectedKelas) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                    if (checkbox) checkbox.checked = false;
                }
            });

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

            if (countPeserta) countPeserta.textContent = `${visibleCount} orang`;

            updateSelectAllState();
        }

        function updateSelectAllState() {
            const visibleCheckboxes = document.querySelectorAll('.peserta-item[style*="display: block"] .peserta-checkbox');
            const visibleChecked = document.querySelectorAll('.peserta-item[style*="display: block"] .peserta-checkbox:checked');

            if (selectAllCheckbox) {
                selectAllCheckbox.checked = (visibleCheckboxes.length > 0 && visibleCheckboxes.length === visibleChecked.length);
            }
        }

        if (selectKelas) {
            selectKelas.addEventListener('change', filterPeserta);
            // Jalankan filter awal berdasarkan nilai tersimpan
            if (selectKelas.value) filterPeserta();
        }

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

        pesertaItems.forEach(item => {
            const checkbox = item.querySelector('.peserta-checkbox');
            if (checkbox) {
                checkbox.addEventListener('change', updateSelectAllState);
            }
        });
    });
</script>
@endpush