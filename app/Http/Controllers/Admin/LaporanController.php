<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateWithQueryString;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Penilaian;
use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    use PaginateWithQueryString;
    private function getPeriodeLabel(string $periode): string
    {
        $parts = explode('-', $periode);
        if (count($parts) !== 2) {
            return $periode;
        }

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return ($months[$parts[1]] ?? $parts[1]) . ' ' . $parts[0];
    }

    public function index(Request $request)
    {
        $periode = $request->input('periode');
        $skemaId = $request->input('skema_id');
        $hasil = $request->input('hasil');
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Penilaian::with(['user', 'jadwal.skema', 'asesor', 'sertifikat'])
            ->when($periode, function ($query, $periode) {
                return $query->whereHas('jadwal', function ($query) use ($periode) {
                    $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$periode]);
                });
            })
            ->when($skemaId, function ($query, $skemaId) {
                return $query->whereHas('jadwal', function ($query) use ($skemaId) {
                    $query->where('skema_id', $skemaId);
                });
            })
            ->when($hasil, function ($query, $hasil) {
                return $query->where('hasil', $hasil);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('jadwal', function ($query) use ($search) {
                        $query->where('kode_jadwal', 'like', "%{$search}%");
                    })
                    ->orWhereHas('jadwal.skema', function ($query) use ($search) {
                        $query->where('nama_skema', 'like', "%{$search}%");
                    })
                    ->orWhereHas('asesor', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->latest('tanggal');

        $penilaians = $query->paginate($perPage);
        $penilaians = $this->paginateWithQueryString($penilaians, $request);

        $periodeOptions = Jadwal::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as periode")
            ->groupBy('periode')
            ->orderBy('periode', 'desc')
            ->pluck('periode')
            ->mapWithKeys(function ($periode) {
                return [$periode => $this->getPeriodeLabel($periode)];
            });

        $skemas = Skema::orderBy('nama_skema')->get();

        $attendanceMap = Absensi::whereIn('user_id', $penilaians->pluck('user_id')->unique())
            ->whereIn('jadwal_id', $penilaians->pluck('jadwal_id')->unique())
            ->get()
            ->keyBy(function ($item) {
                return $item->user_id . '_' . $item->jadwal_id;
            });

        return view('admin.laporan.sistem', compact(
            'penilaians',
            'periodeOptions',
            'skemas',
            'attendanceMap',
            'periode',
            'skemaId',
            'hasil',
            'search',
            'perPage'
        ));
    }

    public function export(Request $request)
    {
        $periode = $request->input('periode');
        $skemaId = $request->input('skema_id');
        $hasil = $request->input('hasil');
        $search = $request->input('search');

        $query = Penilaian::with(['user', 'jadwal.skema', 'asesor', 'sertifikat'])
            ->when($periode, function ($query, $periode) {
                return $query->whereHas('jadwal', function ($query) use ($periode) {
                    $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$periode]);
                });
            })
            ->when($skemaId, function ($query, $skemaId) {
                return $query->whereHas('jadwal', function ($query) use ($skemaId) {
                    $query->where('skema_id', $skemaId);
                });
            })
            ->when($hasil, function ($query, $hasil) {
                return $query->where('hasil', $hasil);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('jadwal', function ($query) use ($search) {
                        $query->where('kode_jadwal', 'like', "%{$search}%");
                    })
                    ->orWhereHas('jadwal.skema', function ($query) use ($search) {
                        $query->where('nama_skema', 'like', "%{$search}%");
                    })
                    ->orWhereHas('asesor', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->latest('tanggal');

        $penilaians = $query->get();

        $attendanceMap = Absensi::whereIn('user_id', $penilaians->pluck('user_id')->unique())
            ->whereIn('jadwal_id', $penilaians->pluck('jadwal_id')->unique())
            ->get()
            ->keyBy(function ($item) {
                return $item->user_id . '_' . $item->jadwal_id;
            });

        $titlePeriode = $periode ? $this->getPeriodeLabel($periode) : 'Semua Periode';
        $titleSkema = 'Semua Skema';
        if ($skemaId) {
            $skema = Skema::find($skemaId);
            $titleSkema = $skema ? $skema->nama_skema : 'Semua Skema';
        }
        $titleHasil = $hasil ?: 'Semua';

        $pdf = app('dompdf.wrapper')->loadView('admin.laporan.export_pdf', compact(
            'penilaians',
            'attendanceMap',
            'titlePeriode',
            'titleSkema',
            'titleHasil'
        ));

        return $pdf->download('laporan-sistem-' . now()->format('YmdHis') . '.pdf');
    }
}
