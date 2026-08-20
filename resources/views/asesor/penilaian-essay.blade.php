@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Title & Breadcrumb -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.75rem;">Input Nilai Essay</h3>
            <small class="text-muted d-block mb-3" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-muted text-decoration-none">Input Penilaian</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.jadwal-asesmen.lihat-peserta', $penilaian->jadwal_id) }}" class="text-muted text-decoration-none">Pilih Peserta</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asesor.penilaian-peserta-demo', ['peserta_id' => $penilaian->user_id, 'jadwal_id' => $penilaian->jadwal_id]) }}" class="text-muted text-decoration-none">Penilaian Peserta</a></li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Penilaian Essay</li>
                </ol>
            </nav>
        </div>
        <div>
            <!-- Tombol Kembali dengan latar belakang warna #1b6ca8 -->
            <a href="{{ route('asesor.penilaian-peserta-demo', ['peserta_id' => $penilaian->user_id, 'jadwal_id' => $penilaian->jadwal_id]) }}" class="btn text-white px-3 fw-semibold shadow-sm rounded-2" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Pesan Error/Success -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <strong>Validasi Gagal!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Box Utama ala Figma -->
    <div class="card border-0 shadow-sm rounded-3 bg-white mb-5">
        <form action="{{ route('asesor.penilaian-essay.store') }}" method="POST" id="formNilaiEssay">
            @csrf
            <input type="hidden" name="penilaian_id" value="{{ $penilaian->id }}">

            <div class="card-body p-4 p-md-5">

                <!-- Header di dalam Card (Judul & Tombol Close) -->
                <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                    <h5 class="fw-bold text-dark mb-0">Nilai Essay</h5>
                    <a href="{{ route('asesor.penilaian-peserta-demo', ['peserta_id' => $penilaian->user_id, 'jadwal_id' => $penilaian->jadwal_id]) }}" class="text-muted text-decoration-none fs-5 fw-bold px-2">
                        &times;
                    </a>
                </div>

                <!-- Pertanyaan Soal Essay -->
                <div class="mb-4">
                    <span class="fw-bold text-dark small d-block mb-2" style="letter-spacing: 0.5px;">Soal Essay</span>
                    <p class="text-dark mb-0" style="font-size: 0.95rem;">
                        Masukkan penilaian essay untuk {{ $penilaian->user->name }}.
                    </p>
                </div>

                <!-- Jawaban Peserta -->
                <div class="mb-4">
                    <span class="fw-bold text-dark small d-block mb-2" style="letter-spacing: 0.5px;">Jawaban Peserta</span>
                    @forelse($jawabanEssay as $index => $jawaban)
                        <div class="p-3 rounded-3 bg-light border mb-3 text-dark" style="font-size: 0.9rem; line-height: 1.6;">
                            <div class="fw-semibold mb-2">Soal {{ $index + 1 }}</div>
                            <div class="text-muted mb-2">{{ $jawaban->soal->pertanyaan ?? '-' }}</div>
                            <div class="border-top pt-2" style="white-space: pre-wrap;">{{ $jawaban->jawaban ?: 'Peserta tidak mengisi jawaban.' }}</div>
                            @php $maksimalNilai = (float) ($jawaban->soal->poin ?? 100); @endphp
                            <div class="d-flex align-items-center gap-2 mt-3" style="max-width: 280px;">
                                <label class="fw-bold text-dark mb-0">Nilai:</label>
                                <input type="number" step="0.01" name="nilai_essay[{{ $jawaban->id }}]" class="form-control form-control-sm text-center fw-bold text-dark shadow-sm py-2 @error('nilai_essay.' . $jawaban->id) is-invalid @enderror" value="{{ old('nilai_essay.' . $jawaban->id, $jawaban->nilai) }}" min="0" max="{{ $maksimalNilai }}" required>
                                <span class="text-muted small text-nowrap">/ {{ $maksimalNilai }}</span>
                            </div>
                            @error('nilai_essay.' . $jawaban->id)<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    @empty
                        <div class="p-3 rounded-3 bg-light border-0 text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                            Jawaban essay peserta belum tersedia.
                        </div>
                    @endforelse
                </div>

                <!-- Form Catatan (Opsional) -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Catatan (Opsional)</label>
                        <textarea name="catatan_essay" class="form-control text-dark shadow-sm @error('catatan_essay') is-invalid @enderror" rows="3" placeholder="Isi Catatan (Opsional)" style="font-size: 0.9rem;">{{ old('catatan_essay', $penilaian->catatan_essay) }}</textarea>
                    @error('catatan_essay')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Tombol Aksi Bawah (Batal & Simpan) -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('asesor.penilaian-peserta-demo', ['peserta_id' => $penilaian->user_id, 'jadwal_id' => $penilaian->jadwal_id]) }}" class="btn btn-outline-secondary px-4 fw-semibold shadow-sm rounded-2 bg-white text-secondary py-2" style="font-size: 0.9rem;">
                        Batal
                    </a>
                    <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm rounded-2 py-2" style="background-color: #1b6ca8; border-color: #1b6ca8; font-size: 0.9rem;">
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
