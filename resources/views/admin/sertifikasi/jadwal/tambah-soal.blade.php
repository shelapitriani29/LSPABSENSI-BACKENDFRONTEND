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
                    <div class="fw-bold text-dark">Junior Animator <span class="text-muted fw-normal mx-1">&bull;</span> <span class="text-secondary fw-semibold">Kode Skema: JA001</span></div>
                </div>
            </div>

            <!-- Form Inputs -->
            <form>
                
                <!-- 1. Pertanyaan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-question-circle text-primary" style="color: #1b6ca8 !important;"></i> Pertanyaan
                    </label>
                    <textarea class="form-control rounded-3" id="inputPertanyaan" rows="4" placeholder="Tulis pertanyaan di sini..."></textarea>
                    <div class="d-flex justify-content-end mt-1">
                        <span class="text-muted" id="charCount" style="font-size: 11px;">0 / 500</span>
                    </div>
                </div>

                <!-- 2. Tipe Soal -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-ui-checks text-primary" style="color: #1b6ca8 !important;"></i> Tipe Soal
                    </label>
                    <select class="form-select rounded-3" id="tipeSoalSelect">
                        <option value="pilihan-ganda" selected>Pilihan Ganda</option>
                        <option value="essay">Essay</option>
                    </select>
                </div>

                <!-- 3. Tingkat Kesulitan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-speedometer2 text-primary" style="color: #1b6ca8 !important;"></i> Tingkat Kesulitan
                    </label>
                    <select class="form-select rounded-3" name="tingkat_kesulitan">
                        <option value="" disabled selected>Pilih tingkat kesulitan soal</option>
                        <option value="mudah">Mudah</option>
                        <option value="sedang">Sedang</option>
                        <option value="sulit">Sulit</option>
                    </select>
                </div>

                <!-- ================= BAGIAN KHUSUS PILIHAN GANDA ================= -->
                <div id="wrapperPilihanGanda">
                    <!-- Pilihan Jawaban -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-list-ul text-primary" style="color: #1b6ca8 !important;"></i> Pilihan Jawaban
                        </label>
                        
                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">{{ $opt }}</span>
                            <input type="text" class="form-control" placeholder="Masukkan pilihan jawaban {{ $opt }}">
                            <span class="input-group-text bg-white">
                                <input class="form-check-input mt-0" type="radio" name="correct_answer_radio" aria-label="Radio for {{ $opt }}">
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Jawaban Benar Pilihan Ganda -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shield-check text-primary" style="color: #1b6ca8 !important;"></i> Jawaban Benar
                        </label>
                        <select class="form-select rounded-3">
                            <option value="" disabled selected>Pilih salah satu jawaban yang benar.</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>

                <!-- ================= BAGIAN KHUSUS ESSAY ================= -->
                <div id="wrapperEssay" class="d-none">
                    <!-- Kunci jawaban essay telah dihapus sesuai permintaan -->
                </div>

                <!-- 5. Point (Berlaku untuk semua jenis soal) -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-star text-primary" style="color: #1b6ca8 !important;"></i> Point
                    </label>
                    <input type="number" class="form-control rounded-3" value="5" placeholder="Masukkan point untuk soal ini.">
                </div>

                <hr class="my-4 text-muted opacity-25">

                <!-- Tombol Aksi Batal & Simpan Soal -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-3 px-4 py-2 small fw-semibold text-decoration-none">
                        Batal
                    </a>
                    <button type="button" class="btn text-white rounded-3 px-4 py-2 small fw-semibold border-0 shadow-sm" style="background-color: #1b6ca8;" onclick="alert('Simpan soal diklik (Frontend Mode)')">
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

        tipeSoalSelect.addEventListener('change', function() {
            const val = this.value;
            
            // Sembunyikan semua terlebih dahulu
            wrapperPG.classList.add('d-none');
            wrapperEssay.classList.add('d-none');

            // Tampilkan sesuai pilihan
            if (val === 'pilihan-ganda') {
                wrapperPG.classList.remove('d-none');
            } else if (val === 'essay') {
                wrapperEssay.classList.remove('d-none');
            }
        });
    });
</script>
@endsection