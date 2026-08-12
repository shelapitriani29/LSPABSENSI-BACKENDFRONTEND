<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skema;
use App\Models\Sertifikat;
use App\Models\Penilaian;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeserta = User::where('role', 'peserta')->count();
        $totalAsesor  = User::where('role', 'asesor')->count();
        $totalSkema = Skema::count();
        $totalSertifikat = Sertifikat::whereNotNull('tanggal_terbit')->count();

        $totalPenilaian = Penilaian::count();
        $lulusCount = Penilaian::where('hasil', 'Kompeten')->count();
        $tidakLulusCount = Penilaian::where('hasil', 'Belum Kompeten')->count();

        $persentaseLulus = $totalPenilaian ? round($lulusCount / $totalPenilaian * 100) : 0;
        $persentaseTidakLulus = $totalPenilaian ? (100 - $persentaseLulus) : 0;

        $grafikSertifikasi = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'lulus' => array_fill(0, 12, 0),
            'tidak_lulus' => array_fill(0, 12, 0),
        ];

        $byMonth = Penilaian::selectRaw('MONTH(tanggal) as month, hasil, COUNT(*) as total')
            ->whereYear('tanggal', Carbon::now()->year)
            ->groupBy('month', 'hasil')
            ->get();

        foreach ($byMonth as $row) {
            $index = $row->month - 1;

            if ($index >= 0 && $index < count($grafikSertifikasi['labels'])) {
                if ($row->hasil === 'Kompeten') {
                    $grafikSertifikasi['lulus'][$index] = $row->total;
                } else {
                    $grafikSertifikasi['tidak_lulus'][$index] = $row->total;
                }
            }
        }

        return view('admin.dashboard', compact(
            'totalPeserta',
            'totalAsesor',
            'totalSkema',
            'totalSertifikat',
            'grafikSertifikasi',
            'lulusCount',
            'tidakLulusCount',
            'persentaseLulus',
            'persentaseTidakLulus'
        ));
    }
}
