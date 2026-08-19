@extends('layouts.peserta')

@section('content')
<div style="width: 100%; padding: 24px 16px; display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div style="width: 100%; max-width: 900px; background: #ffffff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; padding: 40px 32px; text-align: center;">
        
        <!-- Icon Centang Sukses -->
        <div style="display: flex; justify-content: center; margin-bottom: 16px;">
            <div style="width: 64px; height: 64px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 36px; height: 36px; color: #16a34a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <!-- Judul & Keterangan -->
        <h2 style="font-size: 22px; font-weight: 700; color: #111827; margin: 0 0 8px 0; letter-spacing: -0.025em;">Ujikom Selesai!</h2>
        <p style="font-size: 14px; color: #6b7280; margin: 0 0 32px 0;">Jawaban Anda telah berhasil disubmit.</p>

        <!-- Box Detail Ringkasan Ujian -->
        <div style="max-width: 600px; margin: 0 auto 32px auto; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 20px; padding: 24px; text-align: left;">
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="padding: 8px 0; font-size: 14px; color: #6b7280; width: 42%;">Skema Sertifikasi</td>
                        <td style="padding: 8px 0; font-size: 14px; color: #111827; font-weight: 600;">: {{ $jadwal->skema->nama_skema ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-size: 14px; color: #6b7280;">Jumlah Soal</td>
                        <td style="padding: 8px 0; font-size: 14px; color: #111827; font-weight: 600;">: {{ $jumlahSoal }} Soal</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-size: 14px; color: #6b7280;">Durasi</td>
                        <td style="padding: 8px 0; font-size: 14px; color: #111827; font-weight: 600;">: {{ $jadwal->durasi_ujian ?? 120 }} Menit</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-size: 14px; color: #6b7280;">Waktu Selesai</td>
                        <td style="padding: 8px 0; font-size: 14px; color: #111827; font-weight: 600;">: {{ $ujian?->waktu_selesai?->format('H:i') ?? '-' }} WIB</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-size: 14px; color: #6b7280;">Status</td>
                        <td style="padding: 8px 0; font-size: 14px; color: #111827; font-weight: 600;">
                            : <span style="display: inline-block; background: #dcfce7; color: #16a34a; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 9999px;">Selesai</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <div>
            <a href="{{ route('peserta.dashboard') }}" style="display: inline-block; padding: 12px 32px; background: #2563eb; color: #ffffff; font-weight: 600; border-radius: 12px; font-size: 14px; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(37,99,235,0.2); transition: background 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
@endsection