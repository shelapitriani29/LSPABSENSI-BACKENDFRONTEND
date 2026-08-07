<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $absensis;

    public function __construct($absensis)
    {
        $this->absensis = $absensis;
    }

    public function collection()
    {
        return $this->absensis;
    }

    public function headings(): array
    {
        return [
            'No',
            'Peserta',
            'NIK / Username',
            'Instansi',
            'No HP',
            'Jadwal',
            'Skema',
            'Check In',
            'Check Out',
            'Status',
        ];
    }

    public function map($absensi): array
    {
        return [
            $absensi->id,
            optional($absensi->user)->name ?? '-',
            optional($absensi->user)->username ?? optional($absensi->user)->nik ?? '-',
            optional($absensi->user)->instansi ?? 'SMK NEGERI 1 GARUT',
            optional($absensi->user)->no_hp ?? '-',
            optional($absensi->jadwal)->kode_jadwal ?? '-',
            optional($absensi->jadwal->skema)->nama_skema ?? '-',
            $absensi->check_in ? \Carbon\Carbon::parse($absensi->check_in)->format('H:i') : '-',
            $absensi->check_out ? \Carbon\Carbon::parse($absensi->check_out)->format('H:i') : '-',
            $absensi->status ?? '-',
        ];
    }
}
