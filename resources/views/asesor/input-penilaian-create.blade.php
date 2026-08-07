@extends('layouts.asesor')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: 0.5px;">Tambah Penilaian Peserta</h4>
        <small class="text-muted d-block mb-2">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="{{ route('asesor.dashboard') }}" class="text-dark text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asesor.input-penilaian.index') }}" class="text-dark text-decoration-none">Input Penilaian</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Tambah Penilaian</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-4">
            <form action="{{ route('asesor.input-penilaian.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="card border rounded-3 h-100 bg-light bg-opacity-25">
                            <div class="card-header bg-white fw-bold border-bottom py-3">
                                <i class="bi bi-person-badge me-2" style="color: #1E6388;"></i> Data Peserta
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Nama Lengkap</label>
                                    <span class="fw-bold text-dark fs-6">{{ $user->name }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Username / NIK</label>
                                    <span class="fw-semibold text-dark">{{ $user->username ?? $user->nik ?? '-' }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Instansi</label>
                                    <span class="fw-semibold text-dark">{{ $user->instansi ?? '-' }}</span>
                                </div>
                                <div class="mb-0">
                                    <label class="text-muted small d-block">Kelas</label>
                                    <span class="fw-semibold text-dark">{{ $user->kelas ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card border rounded-3 h-100 bg-light bg-opacity-25">
                            <div class="card-header bg-white fw-bold border-bottom py-3">
                                <i class="bi bi-journal-check me-2" style="color: #1E6388;"></i> Detail Penilaian
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted">Jadwal</label>
                                        <select name="jadwal_id" class="form-select @error('jadwal_id') is-invalid @enderror">
                                            <option value="">Pilih Jadwal</option>
                                            @foreach($jadwals as $jadwal)
                                                <option value="{{ $jadwal->id }}" {{ old('jadwal_id', $selectedJadwalId ?? '') == $jadwal->id ? 'selected' : '' }}>
                                                    {{ $jadwal->kode_jadwal }} - {{ $jadwal->skema->nama_skema ?? '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jadwal_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted">Tanggal</label>
                                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" class="form-control @error('tanggal') is-invalid @enderror">
                                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted">Hasil</label>
                                        <select name="hasil" class="form-select @error('hasil') is-invalid @enderror">
                                            <option value="">Pilih hasil</option>
                                            <option value="Kompeten" {{ old('hasil') == 'Kompeten' ? 'selected' : '' }}>Kompeten</option>
                                            <option value="Belum Kompeten" {{ old('hasil') == 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                                        </select>
                                        @error('hasil')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted">Catatan</label>
                                        <input type="text" name="catatan" value="{{ old('catatan') }}" class="form-control @error('catatan') is-invalid @enderror" placeholder="Contoh: Peserta menunjukkan kemampuan baik.">
                                        @error('catatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold text-muted">Keterangan Tambahan</label>
                                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Opsional: catatan lanjutan untuk asesmen...">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('asesor.input-penilaian.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Penilaian</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection