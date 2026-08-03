@extends('layouts.app')

@section('content')
<div class="container-fluid p-4" style="font-family: 'Poppins', sans-serif;">
    
    <!-- Top Breadcrumb -->
    <div class="mb-4">
        <small class="text-secondary d-block fw-medium mb-1" style="font-size: 0.85rem;">LSP P1 – SMK NEGERI 1 GARUT</small>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted">Sertifikasi</li>
                <li class="breadcrumb-item text-muted">Sertifikat</li>
                <li class="breadcrumb-item active fw-medium text-secondary" aria-current="page">Detail Sertifikat</li>
            </ol>
        </nav>
    </div>

    <!-- Main Card Container -->
    <div class="card border-0 shadow-sm bg-white p-4 p-md-4" style="border-radius: 16px;">
        
        <h4 class="fw-bold text-dark mb-4">Detail Sertifikat Peserta</h4>

        <div class="row g-4">
            
            <!-- Kolom Kiri: Preview Sertifikat Fisik -->
            <div class="col-lg-6 text-center">
                <div class="p-3 border border-secondary-subtle bg-light rounded-3 d-inline-block shadow-sm">
                    <!-- Simulasi Tampilan Gambar Sertifikat -->
                    <div class="bg-white p-4 border position-relative text-start" style="width: 100%; max-width: 450px; min-height: 320px; border-radius: 8px;">
                        <div class="text-center mb-3">
                            <span class="fw-bold text-dark" style="font-size: 0.9rem;">LSP P1</span>
                            <div class="text-muted" style="font-size: 0.75rem;">SMK NEGERI 1 GARUT</div>
                        </div>
                        <div class="text-center my-4">
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Diberikan Kepada:</small>
                            <h3 class="fw-bold text-primary mt-1" style="font-family: serif; font-size: 1.8rem;">Haura</h3>
                            <div class="badge bg-secondary text-light mt-1" style="font-size: 0.7rem;">Graphic Design</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-5 pt-3 border-top" style="font-size: 0.7rem;">
                            <div>
                                <span class="text-muted d-block">Tanggal Terbit:</span>
                                <span class="fw-bold">15 Juni 2026</span>
                            </div>
                            <div class="text-end">
                                <span class="text-muted d-block">Ketua LSP:</span>
                                <span class="fw-bold">SMKN 1 Garut</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-muted mt-2" style="font-size: 0.85rem;">
                    ID Sertifikat: <span class="fw-bold text-dark">2026-CERT-001</span>
                </div>
            </div>

            <!-- Kolom Kanan: Informasi Detail -->
            <div class="col-lg-6">
                
                <!-- Box Data Peserta -->
                <div class="card border border-secondary-subtle bg-light mb-3" style="border-radius: 10px;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold text-dark mb-2" style="font-size: 0.95rem;">Data Peserta</h6>
                        <table class="table table-sm table-borderless mb-0" style="font-size: 0.88rem;">
                            <tr>
                                <td class="text-secondary" style="width: 140px;">Nama Lengkap</td>
                                <td class="fw-bold text-dark">: Haura</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Skema</td>
                                <td class="fw-bold text-dark">: Graphic Design</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Sekolah/Instansi</td>
                                <td class="fw-bold text-dark">: SMK Negeri 1 Garut</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Email</td>
                                <td class="fw-bold text-dark">: haura@email.com</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Box Informasi Sertifikasi -->
                <div class="card border border-secondary-subtle bg-light mb-4" style="border-radius: 10px;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold text-dark mb-2" style="font-size: 0.95rem;">Informasi Sertifikasi</h6>
                        <table class="table table-sm table-borderless mb-0" style="font-size: 0.88rem;">
                            <tr>
                                <td class="text-secondary" style="width: 140px;">Nomor Sertifikat</td>
                                <td class="fw-bold text-dark">: LSP-001-2026</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Status Kelulusan</td>
                                <td class="fw-bold text-success">: Kompeten (Aktif)</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Tanggal Terbit</td>
                                <td class="fw-bold text-dark">: 15 Juni 2026</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Masa Berlaku</td>
                                <td class="fw-bold text-dark">: 15 Juni 2026 - 15 Juni 2029 (3 Tahun)</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Asesor Penguji</td>
                                <td class="fw-bold text-dark">: Tim Asesor LSP SMKN 1 Garut</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Tombol Aksi di Bawah Informasi -->
                <div class="d-flex flex-column gap-2">
                    <a href="#" class="btn text-white fw-bold py-2 d-flex justify-content-center align-items-center gap-2 shadow-sm" style="background-color: #174664; border-radius: 8px; font-size: 0.9rem;">
                        <i class="bi bi-file-earmark-pdf"></i> Unduh Sertifikat (PDF)
                    </a>
                    <a href="#" class="btn text-white fw-bold py-2 d-flex justify-content-center align-items-center gap-2 shadow-sm" style="background-color: #1b5278; border-radius: 8px; font-size: 0.9rem;">
                        <i class="bi bi-printer"></i> Cetak Sertifikat
                    </a>
                    <a href="{{ route('admin.sertifikasi.sertifikat.index') }}" class="btn btn-light border border-secondary-subtle fw-bold py-2 d-flex justify-content-center align-items-center gap-2" style="border-radius: 8px; font-size: 0.9rem;">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
</a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection