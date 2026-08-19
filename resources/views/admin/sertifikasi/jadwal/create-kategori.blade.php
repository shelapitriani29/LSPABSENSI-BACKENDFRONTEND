@extends('layouts.app')

@section('content')
<div class="container-fluid px-2" style="max-width: 800px;">
    <!-- Header Page & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #212529;">Tambah Kategori Soal</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Sertifikasi</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.index') }}" class="text-secondary text-decoration-none">Jadwal Uji</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, 1]) ?? '#' }}" class="text-secondary text-decoration-none">Kelola Soal</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Tambah Kategori</li>
                </ol>
            </nav>
        </div>
        <a href="javascript:history.back()" class="btn rounded-3 px-3 py-2 small shadow-sm d-flex align-items-center gap-1 text-white border-0 text-decoration-none" style="background-color: #1b6ca8;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Tambah Kategori -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ isset($kategori) ? route('admin.sertifikasi.jadwal.kategori.update', [$jadwal->id, $kategori->id]) : route('admin.sertifikasi.jadwal.kategori.store', $jadwal->id) }}" method="POST">
                @csrf
                @if(isset($kategori))
                    @method('PUT')
                @endif
                
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label small fw-bold text-dark">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-3 py-2" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" placeholder="Contoh: Prinsip Animasi" required>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label small fw-bold text-dark">Deskripsi / Materi</label>
                    <textarea class="form-control rounded-3" id="deskripsi" name="deskripsi" rows="4" placeholder="Contoh: Konsep dasar animasi seperti squash & stretch, anticipation, staging, dll.">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
                </div>

                <div class="alert alert-light border small text-secondary rounded-3 p-3 mb-4">
                    <span class="fw-bold d-block text-dark mb-1">Informasi:</span>
                    Pastikan nama kategori yang dimasukkan sudah sesuai dengan skema sertifikasi pada jadwal uji ini.
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-3 px-3">Batal</a>
                    <button type="submit" class="btn btn-sm text-white rounded-3 px-4 shadow-sm py-2" style="background-color: #1b6ca8;">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection