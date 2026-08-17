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
                    <div class="fw-bold text-dark">Junior Animator <span class="text-muted fw-normal mx-1">&bull;</span> <span class="text-secondary fw-semibold">Kode Skema: JA001</span></div>
                </div>
            </div>

            <!-- Form Inputs -->
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                
                <!-- 1. Pertanyaan -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-question-circle text-primary" style="color: #1b6ca8 !important;"></i> Pertanyaan
                    </label>
                    <textarea class="form-control rounded-3" id="inputPertanyaan" rows="4" placeholder="Tulis pertanyaan di sini...">Apa yang dimaksud dengan squash and stretch dalam animasi?</textarea>
                    <div class="d-flex justify-content-end mt-1">
                        <span class="text-muted" id="charCount" style="font-size: 11px;">54 / 500</span>
                    </div>
                </div>

                <!-- 2. Tipe Soal -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-ui-checks text-primary" style="color: #1b6ca8 !important;"></i> Tipe Soal
                    </label>
                    <select class="form-select rounded-3" id="tipeSoalSelect" name="tipe_soal">
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
                        <option value="" disabled>Pilih tingkat kesulitan soal</option>
                        <option value="mudah" selected>Mudah</option>
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
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">A</span>
                            <input type="text" class="form-control" value="Penambahan efek suara pada objek bergerak" placeholder="Masukkan pilihan jawaban A">
                            <span class="input-group-text bg-white">
                                <input class="form-check-input mt-0" type="radio" name="jawaban_benar_radio" aria-label="Radio for A">
                            </span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">B</span>
                            <input type="text" class="form-control" value="Upaya membuat ilusi kelenturan dan berat pada objek" placeholder="Masukkan pilihan jawaban B">
                            <span class="input-group-text bg-white">
                                <input class="form-check-input mt-0" type="radio" name="jawaban_benar_radio" checked aria-label="Radio for B">
                            </span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">C</span>
                            <input type="text" class="form-control" value="Teknik mempercepat frame rate video" placeholder="Masukkan pilihan jawaban C">
                            <span class="input-group-text bg-white">
                                <input class="form-check-input mt-0" type="radio" name="jawaban_benar_radio" aria-label="Radio for C">
                            </span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light text-primary" style="color: #1b6ca8 !important; width: 45px; justify-content: center;">D</span>
                            <input type="text" class="form-control" value="Proses pewarnaan karakter 2D" placeholder="Masukkan pilihan jawaban D">
                            <span class="input-group-text bg-white">
                                <input class="form-check-input mt-0" type="radio" name="jawaban_benar_radio" aria-label="Radio for D">
                            </span>
                        </div>
                    </div>

                    <!-- Jawaban Benar Pilihan Ganda -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shield-check text-primary" style="color: #1b6ca8 !important;"></i> Jawaban Benar
                        </label>
                        <select class="form-select rounded-3" name="jawaban_benar">
                            <option value="" disabled>Pilih salah satu jawaban yang benar.</option>
                            <option value="A">A</option>
                            <option value="B" selected>B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
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
                    <input type="number" class="form-control rounded-3" name="poin" value="5" placeholder="Masukkan point untuk soal ini.">
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

        function toggleTipeSoal() {
            const val = tipeSoalSelect.value;
            
            wrapperPG.classList.add('d-none');
            wrapperEssay.classList.add('d-none');

            if (val === 'pilihan-ganda') {
                wrapperPG.classList.remove('d-none');
            } else if (val === 'essay') {
                wrapperEssay.classList.remove('d-none');
            }
        }

        tipeSoalSelect.addEventListener('change', toggleTipeSoal);
        toggleTipeSoal();
    });
</script>
@endsection