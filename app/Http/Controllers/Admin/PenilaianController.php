<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateWithQueryString;
use App\Models\Jadwal;
use App\Models\Penilaian;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenilaianController extends Controller
{
    use PaginateWithQueryString;
    public function index(Request $request)
    {
        $search = $request->input('search');
        $skemaId = $request->input('skema_id');
        $jadwalId = $request->input('jadwal_id');
        $asesorId = $request->input('asesor_id');
        $hasil = $request->input('hasil');
        $perPage = $request->input('per_page', 10);

        $penilaians = Penilaian::with(['user', 'jadwal.skema', 'asesor'])
            ->when($skemaId, function ($query, $skemaId) {
                return $query->whereHas('jadwal', function ($q) use ($skemaId) {
                    $q->where('skema_id', $skemaId);
                });
            })
            ->when($jadwalId, function ($query, $jadwalId) {
                return $query->where('jadwal_id', $jadwalId);
            })
            ->when($asesorId, function ($query, $asesorId) {
                return $query->where('asesor_id', $asesorId);
            })
            ->when($hasil, function ($query, $hasil) {
                return $query->where('hasil', $hasil);
            })
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('asesor', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('jadwal', function ($q) use ($search) {
                    $q->where('kode_jadwal', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage);

        $penilaians = $this->paginateWithQueryString($penilaians, $request);

        $skemas = Skema::orderBy('nama_skema')->get();
        $jadwals = Jadwal::orderBy('kode_jadwal')->get();
        $asesors = User::where('role', 'asesor')->orderBy('name')->get();

        $totalPeserta = Penilaian::count();
        $kompetenCount = Penilaian::where('hasil', 'Kompeten')->count();
        $belumCount = Penilaian::where('hasil', 'Belum Kompeten')->count();

        return view('admin.sertifikasi.penilaian.index', compact(
            'penilaians',
            'skemas',
            'jadwals',
            'asesors',
            'totalPeserta',
            'kompetenCount',
            'belumCount'
        ));
    }

    public function show($id)
    {
        $penilaian = Penilaian::with(['user', 'jadwal.skema', 'asesor', 'jadwal'])->findOrFail($id);
        return view('admin.sertifikasi.penilaian.show', compact('penilaian'));
    }
}
