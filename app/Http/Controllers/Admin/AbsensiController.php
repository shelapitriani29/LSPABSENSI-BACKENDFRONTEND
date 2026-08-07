<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateWithQueryString;
use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    use PaginateWithQueryString;
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jadwalId = $request->input('jadwal_id');
        $perPage = $request->input('per_page', 10);

        $jadwal = $jadwalId ? Jadwal::with('skema')->find($jadwalId) : null;

        $pesertas = User::where('role', 'peserta')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('instansi', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($jadwal, function ($query, $jadwal) {
                return $query->where('kelas', $jadwal->kelas);
            })
            ->with([
                'jadwal.skema',
                'jadwal.asesor',
                'absensis' => function ($query) use ($jadwalId) {
                    if ($jadwalId) {
                        $query->where('jadwal_id', $jadwalId);
                    }
                }
            ])
            ->orderBy('name')
            ->paginate($perPage);

        $pesertas = $this->paginateWithQueryString($pesertas, $request);

        $jadwals = Jadwal::orderBy('kode_jadwal')->get();
        $skemas = Skema::orderBy('nama_skema')->get();

        return view('admin.sertifikasi.absensi.index', compact('pesertas', 'jadwals', 'skemas', 'jadwal', 'jadwalId'));
    }

    public function export(Request $request)
    {
        $jadwalId = $request->input('jadwal_id');
        $format = $request->input('format', 'pdf');

        $query = Absensi::with(['user', 'jadwal.skema'])
            ->when($jadwalId, function ($query, $jadwalId) {
                return $query->where('jadwal_id', $jadwalId);
            })
            ->latest();

        $absensis = $query->get();

        $filename = 'rekap-absensi-' . now()->format('Ymd-His');

        if ($format === 'excel') {
            return Excel::download(new AbsensiExport($absensis), "{$filename}.xlsx");
        }

        $jadwal = $jadwalId ? Jadwal::with('skema')->find($jadwalId) : null;
        $pdf = app('dompdf.wrapper')->loadView('admin.sertifikasi.absensi.export_pdf', compact('absensis', 'jadwal'));

        return $pdf->download("{$filename}.pdf");
    }

    public function edit($id)
    {
        $attendance = Absensi::with(['user', 'jadwal.skema'])->findOrFail($id);
        $jadwals = Jadwal::orderBy('kode_jadwal')->get();

        return view('admin.sertifikasi.absensi.edit', compact('attendance', 'jadwals'));
    }

    public function printQr($id)
    {
        $attendance = Absensi::with(['user', 'jadwal.skema'])->findOrFail($id);
        return view('admin.sertifikasi.absensi.print_qr', compact('attendance'));
    }

    public function printQrUser($userId)
    {
        $user = User::with(['jadwal.skema', 'jadwal.asesor'])->where('role', 'peserta')->findOrFail($userId);
        $jadwal = $user->jadwal;

        abort_unless($jadwal, 404, 'Jadwal tidak ditemukan untuk peserta ini.');

        return view('admin.sertifikasi.absensi.print_qr_user', compact('user', 'jadwal'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Absensi::findOrFail($id);

        $request->validate([
            'status' => ['required', Rule::in(['Hadir', 'Tidak Hadir', 'Terlambat', 'Izin', 'Sakit', 'Belum Absen'])],
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'keterangan' => 'nullable|string',
        ]);

        $attendance->update($request->only(['status', 'check_in', 'check_out', 'keterangan']));

        return redirect()->route('admin.sertifikasi.absensi.index')->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $attendance = Absensi::findOrFail($id);
        $attendance->delete();

        return redirect()->route('admin.sertifikasi.absensi.index')->with('success', 'Data absensi berhasil dihapus!');
    }
}
