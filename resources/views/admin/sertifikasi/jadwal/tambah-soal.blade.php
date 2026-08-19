@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    
    <!-- Header Title & Tombol Kembali ke Daftar Soal -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h2 class="fw-bold mb-1" style="color: #212529;">Tambah Soal</h2>
        </div>
        <a href="javascript:history.back()" class="btn rounded-3 px-3 py-2 small shadow-sm d-flex align-items-center gap-1 text-white border-0 text-decoration-none" style="background-color: #1b6ca8;">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Soal
        </a>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0 small text-muted">
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Kelola Soal</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Tambah Soal</li>
        </ol>
    </nav>

    <!-- FORM UTAMA TAMBAH SOAL -->
    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-4">
            
            <!-- Banner Informasi Skema Aktif -->
            <div class="p-3 mb-4 rounded-3 border bg-light d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; color: #1b6ca8 !important;">
                    <i class="bi bi-patch-check-fill fs-5"></i>
                </div>
                <div>
                    <div class="text-secondary" style="font-size: 12px;">Skema Aktif</div>
                    <div class="fw-bold text-dark">
                        {{ optional($jadwal->skema)->nama_skema ?? 'Skema belum ditentukan' }}
                        <span class="text-muted fw-normal mx-1">&bull;</span>
                        <span class="text-secondary fw-semibold">Kode Skema: {{ optional($jadwal->skema)->kode_skema ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Form Inputs -->
            <form action="{{ route('admin.sertifikasi.jadwal.kategori.soal.store', [$jadwal->id, $kategori->id]) }}" method="POST">
                @csrf
                
                <!-- 1. Pertanyaan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-question-circle text-primary" style="color: #1b6ca8 !important;"></i> Pertanyaan
                    </label>
                    <textarea class="form-control rounded-3" id="inputPertanyaan" name="pertanyaan" rows="4" placeholder="Tulis pertanyaan di sini..." required>{{ old('pertanyaan') }}</textarea>
                    <div class="d-flex justify-content-end mt-1">
                        <span class="text-muted" id="charCount" style="font-size: 11px;">0 / 500</span>
                    </div>
                </div>

                <!-- 2. Tipe Soal -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-ui-checks text-primary" style="color: #1b6ca8 !important;"></i> Tipe Soal
                    </label>
                    <select class="form-select rounded-3" id="tipeSoalSelect" name="tipe_soal">
                        <option value="Pilihan Ganda" selected>Pilihan Ganda</option>
                        <option value="Essay">Essay</option>
                    </select>
                </div>

                <!-- 3. Tingkat Kesulitan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-speedometer2 text-primary" style="color: #1b6ca8 !important;"></i> Tingkat Kesulitan
                    </label>
                    <select class="form-select rounded-3" name="tingkat_kesulitan" required>
                        <option value="" disabled selected>Pilih tingkat kesulitan soal</option>
                        <option value="Mudah">Mudah</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Sulit">Sulit</option>
                    </select>
                </div>

                <!-- ================= BAGIAN KHUSUS PILIHAN GANDA ================= -->
                <div id="wrapperPilihanGanda">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-list-ul text-primary" style="color: #1b6ca8 !important;"></i> Pilihan Jawaban
                        </label>
                        
                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">{{ $opt }}</span>
                            <input type="text" name="pilihan_{{ strtolower($opt) }}" class="form-control" placeholder="Masukkan pilihan jawaban {{ $opt }}">
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shield-check text-primary" style="color: #1b6ca8 !important;"></i> Jawaban Benar
                        </label>
                        <select class="form-select rounded-3" id="jawabanBenarSelect" name="jawaban_benar">
                            <option value="" disabled selected>Pilih salah satu jawaban yang benar.</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>

                <div id="wrapperEssay" class="d-none">
                    <div class="alert alert-light border small text-secondary rounded-3 p-3 mb-0">
                        Soal essay tidak memerlukan jawaban benar karena akan dinilai manual oleh asesor.
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-star text-primary" style="color: #1b6ca8 !important;"></i> Poin
                    </label>
                    <input type="number" name="poin" class="form-control rounded-3" value="5" placeholder="Masukkan point untuk soal ini." min="1" required>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <div class="d-flex justify-content-end gap-2">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-3 px-4 py-2 small fw-semibold text-decoration-none">
                        Batal
                    </a>
                    <button type="submit" class="btn text-white rounded-3 px-4 py-2 small fw-semibold border-0 shadow-sm" style="background-color: #1b6ca8;">
                        <i class="bi bi-save me-1"></i> Simpan Soal
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- Script Interaktif Tipe Soal & Hitung Karakter -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hitung karakter textarea pertanyaan
        const textarea = document.getElementById('inputPertanyaan');
        const charCount = document.getElementById('charCount');
        
        textarea.addEventListener('input', function() {
            let length = this.value.length;
            if(length > 500) {
                this.value = this.value.substring(0, 500);
                length = 500;
            }
            charCount.textContent = length + ' / 500';
        });

        // Logika Tukar Tampilan Berdasarkan Tipe Soal
        const tipeSoalSelect = document.getElementById('tipeSoalSelect');
        const wrapperPG = document.getElementById('wrapperPilihanGanda');
        const wrapperEssay = document.getElementById('wrapperEssay');
        const jawabanBenarSelect = document.getElementById('jawabanBenarSelect');

        tipeSoalSelect.addEventListener('change', function() {
            const val = this.value;
            
            // Sembunyikan semua terlebih dahulu
            wrapperPG.classList.add('d-none');
            wrapperEssay.classList.add('d-none');

            // Tampilkan sesuai pilihan dan set required attribute
            if (val === 'Pilihan Ganda') {
                wrapperPG.classList.remove('d-none');
                jawabanBenarSelect.setAttribute('required', 'required');
            } else if (val === 'Essay') {
                wrapperEssay.classList.remove('d-none');
                jawabanBenarSelect.removeAttribute('required');
            }
        });

        // Trigger on page load to show the correct section
        tipeSoalSelect.dispatchEvent(new Event('change'));
    });
</script>
@endsection