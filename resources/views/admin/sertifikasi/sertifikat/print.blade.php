<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Sertifikat - LSP P1 SMK Negeri 1 Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        body {
            background-color: #525252;
            font-family: 'Times New Roman', Times, serif;
            color: #333;
            -webkit-print-color-adjust: exact;
        }
        .certificate-container {
            width: 297mm;
            height: 210mm;
            margin: 20mm auto;
            background: #fff;
            padding: 20mm;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            border: 15px solid #1a365d;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .certificate-inner {
            border: 3px double #d4af37;
            padding: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }
        .header-title h3 {
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #1a365d;
            letter-spacing: 2px;
        }
        .header-title h5 {
            font-family: Arial, sans-serif;
            color: #555;
            letter-spacing: 1px;
        }
        .recipient-name {
            font-family: 'Brush Script MT', cursive, Georgia, serif;
            font-size: 3.5rem;
            color: #1a365d;
            border-bottom: 2px solid #d4af37;
            display: inline-block;
            padding: 0 40px;
            margin: 10px 0;
        }
        .no-print {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                background: none;
            }
            .certificate-container {
                margin: 0;
                box-shadow: none;
                border: 10px solid #1a365d;
                width: 100vw;
                height: 100vh;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol Aksi (Tidak ikut tercetak) -->
    <div class="no-print d-flex gap-2">
        <button onclick="window.print()" class="btn btn-primary shadow fw-bold px-4">
            <i class="bi bi-printer"></i> Cetak / Simpan PDF
        </button>
        <a href="{{ route('admin.sertifikasi.sertifikat.show', $id ?? 1) }}" class="btn btn-light shadow fw-bold border">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Lembar Dokumen Sertifikat -->
    <div class="certificate-container">
        <div class="certificate-inner">
            
            <!-- Header Lembaga -->
            <div class="header-title">
                <h3>LEMBAGA SERTIFIKASI PROFESI PI</h3>
                <h5>SMK NEGERI 1 GARUT</h5>
                <p class="text-muted small mb-0">Nomor Sertifikat: LSP-001-2026</p>
            </div>

            <!-- Bagian Isi / Penerima -->
            <div class="body-content my-3">
                <p class="text-uppercase fw-bold text-secondary mb-1" style="font-family: Arial, sans-serif; letter-spacing: 3px;">Sertifikat Ini Diberikan Kepada:</p>
                <div class="recipient-name">Haura</div>
                <p class="mt-3 fs-5">Telah dinyatakan <strong>KOMPETEN</strong> dalam Skema Sertifikasi:</p>
                <h4 class="fw-bold text-dark text-uppercase" style="font-family: Arial, sans-serif; color: #1a365d !important;">Graphic Design</h4>
            </div>

            <!-- Footer Tanda Tangan -->
            <div class="row align-items-center mt-4" style="font-family: Arial, sans-serif;">
                <div class="col-4 text-center">
                    <p class="small text-muted mb-1">Masa Berlaku:</p>
                    <p class="fw-bold mb-0">15 Juni 2026 – 15 Juni 2029</p>
                </div>
                <div class="col-4 text-center">
                    <div class="p-2 border border-dark rounded d-inline-block bg-light">
                        <small class="fw-bold text-success"><i class="bi bi-shield-check"></i> TERVERIFIKASI LSP</small>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <p class="mb-1">Garut, 15 Juni 2026</p>
                    <p class="small text-muted mb-5">Ketua LSP SMK Negeri 1 Garut</p>
                    <p class="fw-bold text-decoration-underline mb-0">Tim Asesor LSP</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>