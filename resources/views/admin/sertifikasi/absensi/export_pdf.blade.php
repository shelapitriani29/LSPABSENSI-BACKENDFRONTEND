<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 0; padding: 24px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 6px 0 0; color: #4b5563; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { border: 1px solid #d1d5db; padding: 8px 10px; font-size: 11px; }
        th { background: #f3f4f6; text-align: left; }
        .text-center { text-align: center; }
        .small { font-size: 11px; color: #6b7280; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 12px; font-size: 10px; color: #fff; }
        .badge-success { background: #10b981; }
        .badge-danger { background: #ef4444; }
        .badge-secondary { background: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rekap Absensi Peserta</h1>
        <p>{{ $jadwal ? ($jadwal->kode_jadwal . ' - ' . optional($jadwal->skema)->nama_skema) : 'Semua Jadwal' }}</p>
        <p class="small">Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th>Peserta</th>
                <th>NIK / Username</th>
                <th>Instansi</th>
                <th>No HP</th>
                <th>Jadwal</th>
                <th>Skema</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensis as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ optional($item->user)->name ?? '-' }}</td>
                    <td>{{ optional($item->user)->username ?? optional($item->user)->nik ?? '-' }}</td>
                    <td>{{ optional($item->user)->instansi ?? 'SMK NEGERI 1 GARUT' }}</td>
                    <td>{{ optional($item->user)->no_hp ?? '-' }}</td>
                    <td>{{ optional($item->jadwal)->kode_jadwal ?? '-' }}</td>
                    <td>{{ optional($item->jadwal->skema)->nama_skema ?? '-' }}</td>
                    <td>{{ $item->check_in ? \Carbon\Carbon::parse($item->check_in)->format('H:i') : '-' }}</td>
                    <td>{{ $item->check_out ? \Carbon\Carbon::parse($item->check_out)->format('H:i') : '-' }}</td>
                    <td>
                        @php
                            $status = $item->status ?? '-';
                            $class = strtolower($status) === 'hadir' ? 'badge-success' : (strtolower($status) === 'tidak hadir' ? 'badge-danger' : 'badge-secondary');
                        @endphp
                        <span class="badge {{ $class }}">{{ $status }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
