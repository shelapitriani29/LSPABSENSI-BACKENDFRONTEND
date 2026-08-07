<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sistem</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 0; padding: 24px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 4px 0; color: #4b5563; font-size: 12px; }
        .summary { margin-top: 20px; margin-bottom: 16px; }
        .summary span { display: inline-block; margin-right: 16px; font-size: 12px; color: #374151; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #d1d5db; padding: 8px 10px; font-size: 10px; }
        th { background: #f3f4f6; text-align: left; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 999px; font-size: 9px; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-secondary { background: #e5e7eb; color: #374151; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Sistem</h1>
        <p>LSP P1 – SMK NEGERI 1 GARUT</p>
    </div>

    <div class="summary">
        <span><strong>Periode:</strong> {{ $titlePeriode }}</span>
        <span><strong>Skema:</strong> {{ $titleSkema }}</span>
        <span><strong>Hasil:</strong> {{ $titleHasil }}</span>
        <span><strong>Dicetak:</strong> {{ now()->translatedFormat('d F Y H:i') }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th>Peserta</th>
                <th>Skema Sertifikasi</th>
                <th>Jadwal Uji</th>
                <th>Asesor</th>
                <th>Kehadiran</th>
                <th>Hasil</th>
                <th>Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penilaians as $index => $item)
                @php
                    $attendance = $attendanceMap[$item->user_id . '_' . $item->jadwal_id] ?? null;
                    $hadir = optional($attendance)->status ?? 'Tidak Hadir';
                    $badgeClass = strtolower($hadir) === 'hadir' ? 'badge-success' : (strtolower($hadir) === 'tidak hadir' ? 'badge-danger' : 'badge-secondary');
                    $resultBadge = strtolower($item->hasil) === 'kompeten' ? 'badge-success' : 'badge-danger';
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ optional($item->user)->name ?? '-' }}</td>
                    <td>{{ optional($item->jadwal->skema)->nama_skema ?? '-' }}</td>
                    <td>{{ optional($item->jadwal)->tanggal ? 
                        \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d/m/Y') : '-' }}
                        <br><span>{{ optional($item->jadwal)->jam_mulai }} - {{ optional($item->jadwal)->jam_selesai }}</span>
                    </td>
                    <td>{{ optional($item->asesor)->name ?? '-' }}</td>
                    <td class="text-center"><span class="badge {{ $badgeClass }}">{{ $hadir }}</span></td>
                    <td class="text-center"><span class="badge {{ $resultBadge }}">{{ $item->hasil }}</span></td>
                    <td class="text-center">{{ optional($item->sertifikat)->no_sertifikat ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
