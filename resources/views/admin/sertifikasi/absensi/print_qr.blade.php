@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Cetak QR Absensi</h2>
                    <p class="text-muted mb-0">{{ $attendance->user->name ?? $attendance->user->username ?? '-' }}</p>
                </div>
                <button onclick="window.print()" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-printer me-1"></i> Cetak
                </button>
            </div>

            <div class="border p-4 rounded-4 text-center" style="background: #f8fafc;">
                <h5 class="fw-semibold mb-3">Kode QR Absensi</h5>
                <div class="mb-3">
                    @php
                        $qrData = 'Absensi_' . $attendance->user_id . '_' . ($attendance->jadwal->kode_jadwal ?? 'nojadwal') . '_' . ($attendance->user->username ?? $attendance->user->nik ?? 'peserta');
                    @endphp
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ rawurlencode($qrData) }}"
                         alt="QR Absensi"
                         class="img-fluid rounded-3"
                         style="width: 220px; height: 220px; object-fit: contain;">
                </div>
                <p class="mb-1"><span class="fw-semibold">Peserta:</span> {{ $attendance->user->name ?? $attendance->user->username }}</p>
                <p class="mb-1"><span class="fw-semibold">Jadwal:</span> {{ $attendance->jadwal->kode_jadwal ?? '-' }}</p>
                <p class="mb-0"><span class="fw-semibold">Skema:</span> {{ optional($attendance->jadwal->skema)->nama_skema ?? 'Belum terhubung' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
