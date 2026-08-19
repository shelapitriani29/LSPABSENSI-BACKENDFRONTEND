@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 1200px;">
    
    <!-- Header Title & Tombol Kembali ke Daftar Soal -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h2 class="fw-bold mb-1" style="color: #212529;">Edit Soal</h2>
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
            <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Prinsip Animasi</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Edit Soal</li>
        </ol>
    </nav>

    <!-- FORM UTAMA EDIT SOAL -->
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
            <form action="{{ url('admin/sertifikasi/jadwal/' . $jadwal->id . '/kategori/' . $kategori->id . '/soal/' . $soal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- 1. Pertanyaan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-question-circle text-primary" style="color: #1b6ca8 !important;"></i> Pertanyaan
                    </label>
                    <textarea class="form-control rounded-3" id="inputPertanyaan" name="pertanyaan" rows="4" placeholder="Tulis pertanyaan di sini...">{{ $soal->pertanyaan }}</textarea>
                    <div class="d-flex justify-content-end mt-1">
                        <span class="text-muted" id="charCount" style="font-size: 11px;">{{ strlen($soal->pertanyaan) }} / 500</span>
                    </div>
                </div>

                <!-- 2. Tipe Soal -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-ui-checks text-primary" style="color: #1b6ca8 !important;"></i> Tipe Soal
                    </label>
                    <select class="form-select rounded-3" id="tipeSoalSelect" name="tipe_soal">
                        <option value="Pilihan Ganda" {{ $soal->tipe_soal === 'Pilihan Ganda' ? 'selected' : '' }}>Pilihan Ganda</option>
                        <option value="Essay" {{ $soal->tipe_soal === 'Essay' ? 'selected' : '' }}>Essay</option>
                        <option value="Isian Singkat" {{ $soal->tipe_soal === 'Isian Singkat' ? 'selected' : '' }}>Isian Singkat</option>
                    </select>
                </div>

                <!-- 3. Tingkat Kesulitan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-speedometer2 text-primary" style="color: #1b6ca8 !important;"></i> Tingkat Kesulitan
                    </label>
                    <select class="form-select rounded-3" name="tingkat_kesulitan" required>
                        <option value="" disabled>Pilih tingkat kesulitan soal</option>
                        <option value="Mudah" {{ $soal->tingkat_kesulitan === 'Mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="Sedang" {{ $soal->tingkat_kesulitan === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Sulit" {{ $soal->tingkat_kesulitan === 'Sulit' ? 'selected' : '' }}>Sulit</option>
                    </select>
                </div>

                <!-- ================= BAGIAN KHUSUS PILIHAN GANDA ================= -->
                <div id="wrapperPilihanGanda">
                    <!-- Pilihan Jawaban -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-list-ul text-primary" style="color: #1b6ca8 !important;"></i> Pilihan Jawaban
                        </label>
                        
                        @php
                            $pilihanMap = $soal->pilihanJawaban->keyBy('pilihan');
                        @endphp
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">A</span>
                            <input type="text" name="pilihan_a" class="form-control" value="{{ $pilihanMap['A']->teks_jawaban ?? '' }}" placeholder="Masukkan pilihan jawaban A">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">B</span>
                            <input type="text" name="pilihan_b" class="form-control" value="{{ $pilihanMap['B']->teks_jawaban ?? '' }}" placeholder="Masukkan pilihan jawaban B">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">C</span>
                            <input type="text" name="pilihan_c" class="form-control" value="{{ $pilihanMap['C']->teks_jawaban ?? '' }}" placeholder="Masukkan pilihan jawaban C">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">D</span>
                            <input type="text" name="pilihan_d" class="form-control" value="{{ $pilihanMap['D']->teks_jawaban ?? '' }}" placeholder="Masukkan pilihan jawaban D">
                        </div>
                    </div>

                    <!-- Jawaban Benar Pilihan Ganda -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shield-check text-primary" style="color: #1b6ca8 !important;"></i> Jawaban Benar
                        </label>
                        <select class="form-select rounded-3" id="jawabanBenarSelect" name="jawaban_benar">
                            <option value="" disabled>Pilih salah satu jawaban yang benar.</option>
                            <option value="A" {{ $soal->jawaban_benar === 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $soal->jawaban_benar === 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $soal->jawaban_benar === 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ $soal->jawaban_benar === 'D' ? 'selected' : '' }}>D</option>
                        </select>
                    </div>
                </div>

                <!-- ================= BAGIAN KHUSUS ESSAY ================= -->
                <div id="wrapperEssay" class="d-none">
                    <!-- Kunci jawaban essay ditiadakan sesuai ketentuan -->
                </div>

                <!-- 5. Point (Berlaku untuk semua jenis soal) -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-star text-primary" style="color: #1b6ca8 !important;"></i> Point
                    </label>
                    <input type="number" name="poin" class="form-control rounded-3" value="{{ $soal->poin }}" placeholder="Masukkan point untuk soal ini." min="1" required>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <!-- Tombol Aksi Batal & Simpan Perubahan -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-3 px-4 py-2 small fw-semibold text-decoration-none">
                        Batal
                    </a>
                    <button type="submit" class="btn text-white rounded-3 px-4 py-2 small fw-semibold border-0 shadow-sm" style="background-color: #1b6ca8;">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
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
        
        function updateCharCount() {
            let length = textarea.value.length;
            if(length > 500) {
                textarea.value = textarea.value.substring(0, 500);
                length = 500;
            }
            charCount.textContent = length + ' / 500';
        }

        textarea.addEventListener('input', updateCharCount);
        updateCharCount();

        // Logika Tukar Tampilan Berdasarkan Tipe Soal
        const tipeSoalSelect = document.getElementById('tipeSoalSelect');
        const wrapperPG = document.getElementById('wrapperPilihanGanda');
        const wrapperEssay = document.getElementById('wrapperEssay');
        const jawabanBenarSelect = document.getElementById('jawabanBenarSelect');

        function toggleTipeSoal() {
            const val = tipeSoalSelect.value;
            
            wrapperPG.classList.add('d-none');
            wrapperEssay.classList.add('d-none');

            if (val === 'Pilihan Ganda') {
                wrapperPG.classList.remove('d-none');
                jawabanBenarSelect.setAttribute('required', 'required');
            } else if (val === 'Essay') {
                wrapperEssay.classList.remove('d-none');
                jawabanBenarSelect.removeAttribute('required');
            } else if (val === 'Isian Singkat') {
                wrapperEssay.classList.remove('d-none');
                jawabanBenarSelect.removeAttribute('required');
            }
        }

        tipeSoalSelect.addEventListener('change', toggleTipeSoal);
        toggleTipeSoal();  // Trigger on page load to show/hide sections based on current value
    });
</script>
@endsection