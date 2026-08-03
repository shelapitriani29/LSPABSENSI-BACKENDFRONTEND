@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.3rem;">Manajemen User</h3>
            <p class="text-secondary small mb-1">LSP P1 – SMK NEGERI 1 GARUT</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-secondary">Referensi</li>
                    <li class="breadcrumb-item text-secondary">Manajemen User</li>
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.user.index') }}" class="btn text-white fw-semibold px-3 shadow-sm" style="background-color: #1b6ca8; border-color: #1b6ca8;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <form action="#" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="role" class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Pilih Role</label>
                    <select class="form-select" id="roleSelect" name="role" required>
                        <option value="peserta" selected>Peserta</option>
                        <option value="asesor">Asesor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="Jenisa" placeholder="Masukkan nama..." required>
                    </div>
                    <div class="col-md-6 mb-3" id="field-identifier">
                        <label class="form-label fw-semibold text-dark" id="label-identifier" style="font-size: 0.9rem;">NISN</label>
                        <input type="text" class="form-control" name="identifier" id="input-identifier" value="2310012345" placeholder="Masukkan NISN...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3" id="extra-nohp">
                        <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">No HP</label>
                        <input type="text" class="form-control" name="no_hp" value="081234567890" placeholder="Masukkan No HP...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Password <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah)</small></label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password baru...">
                    </div>
                </div>

                <div id="extra-peserta">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Kelas</label>
                            <select class="form-select" name="kelas">
                                <option value="">Pilih Kelas</option>
                                <option value="10">Kelas X</option>
                                <option value="11" selected>Kelas XI</option>
                                <option value="12">Kelas XII</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" value="Rekayasa Perangkat Lunak" placeholder="Masukkan Nama Jurusan...">
                        </div>
                    </div>
                </div>

                <div class="mb-3 d-none" id="extra-asesor">
                    <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Bidang Kompetensi</label>
                    <input type="text" class="form-control" name="bidang_kompetensi" placeholder="Masukkan bidang kompetensi...">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark" style="font-size: 0.9rem;">Status</label>
                    <select class="form-select" name="status">
                        <option value="aktif" selected>Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm" style="background-color: #28a745; border-color: #28a745;">Simpan Perubahan</button>
                    <a href="{{ route('admin.user.index') }}" class="btn text-white px-4 fw-semibold shadow-sm" style="background-color: #dc3545; border-color: #dc3545;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript untuk Mengubah Form Secara Dinamis Berdasarkan Role -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('roleSelect');
        const labelIdentifier = document.getElementById('label-identifier');
        const inputIdentifier = document.getElementById('input-identifier');
        
        const extraPeserta = document.getElementById('extra-peserta');
        const extraAsesor = document.getElementById('extra-asesor');
        const extraNohp = document.getElementById('extra-nohp');

        function updateFormFields() {
            const selectedRole = roleSelect.value;

            if (selectedRole === 'peserta') {
                labelIdentifier.textContent = 'NISN';
                inputIdentifier.placeholder = 'Masukkan NISN...';
                extraPeserta.classList.remove('d-none');
                extraAsesor.classList.add('d-none');
                extraNohp.classList.remove('d-none');
            } else if (selectedRole === 'asesor') {
                labelIdentifier.textContent = 'NIP';
                inputIdentifier.placeholder = 'Masukkan NIP...';
                extraPeserta.classList.add('d-none');
                extraAsesor.classList.remove('d-none');
                extraNohp.classList.remove('d-none');
            } else if (selectedRole === 'admin') {
                labelIdentifier.textContent = 'Username';
                inputIdentifier.placeholder = 'Masukkan Username...';
                extraPeserta.classList.add('d-none');
                extraAsesor.classList.add('d-none');
                extraNohp.classList.add('d-none');
            }
        }

        roleSelect.addEventListener('change', updateFormFields);
        updateFormFields();
    });
</script>
@endsection