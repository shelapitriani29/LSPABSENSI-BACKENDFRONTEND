<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateWithQueryString;
use App\Models\Jadwal;
use App\Models\Penilaian;
use App\Models\Sertifikat;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SertifikatController extends Controller
{
    use PaginateWithQueryString;

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $skemaId = $request->input('skema_id');
        $perPage = $request->input('per_page', 10);

        // Jika tabel belum dibuat (mis. sebelum migrate), jangan trigger query yang menyebabkan exception
        if (!Schema::hasTable('sertifikats')) {
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $empty = collect();
            $sertifikats = new LengthAwarePaginator($empty->forPage($currentPage, $perPage), $empty->count(), $perPage, $currentPage, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        } else {
            $sertifikats = Sertifikat::with(['user', 'skema', 'jadwal', 'penilaian'])
                ->when($search, function ($query, $search) {
                    return $query->where('no_sertifikat', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('skema', function ($q) use ($search) {
                            $q->where('nama_skema', 'like', "%{$search}%");
                        });
                })
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->when($skemaId, function ($query, $skemaId) {
                    return $query->where('skema_id', $skemaId);
                })
                ->latest()
                ->paginate($perPage);

            $sertifikats = $this->paginateWithQueryString($sertifikats, $request);
        }

        $skemas = Skema::orderBy('nama_skema')->get();

        // Kandidat: penilaian dengan hasil 'Kompeten' yang belum punya sertifikat
        if (Schema::hasTable('sertifikats')) {
            $candidates = Penilaian::with(['user', 'jadwal.skema'])
                ->where('hasil', 'Kompeten')
                ->whereDoesntHave('sertifikat')
                ->get();
        } else {
            $candidates = collect();
        }

        return view('admin.sertifikasi.sertifikat.index', compact('sertifikats', 'skemas', 'candidates'));
    }

    public function show($id)
    {
        if (!Schema::hasTable('sertifikats')) {
            return redirect()->route('admin.sertifikasi.sertifikat.index')->with('error', 'Tabel sertifikats belum dibuat. Jalankan php artisan migrate.');
        }
        $sertifikat = Sertifikat::with(['user', 'skema', 'jadwal.asesor', 'penilaian'])->findOrFail($id);

        return view('admin.sertifikasi.sertifikat.show', compact('sertifikat'));
    }

    public function edit($id)
    {
        if (!Schema::hasTable('sertifikats')) {
            return redirect()->route('admin.sertifikasi.sertifikat.index')->with('error', 'Tabel sertifikats belum dibuat. Jalankan php artisan migrate.');
        }
        $sertifikat = Sertifikat::with(['user', 'skema', 'jadwal'])->findOrFail($id);
        $skemas = Skema::orderBy('nama_skema')->get();
        $jadwals = Jadwal::orderBy('kode_jadwal')->get();
        $users = User::where('role', 'peserta')->orderBy('name')->get();

        return view('admin.sertifikasi.sertifikat.edit', compact('sertifikat', 'skemas', 'jadwals', 'users'));
    }

    public function update(Request $request, $id)
    {
        if (!Schema::hasTable('sertifikats')) {
            return redirect()->route('admin.sertifikasi.sertifikat.index')->with('error', 'Tabel sertifikats belum dibuat. Jalankan php artisan migrate.');
        }
        $sertifikat = Sertifikat::findOrFail($id);

        $request->validate([
            'no_sertifikat' => ['required', 'string', Rule::unique('sertifikats', 'no_sertifikat')->ignore($sertifikat->id)],
            'user_id' => 'required|exists:users,id',
            'skema_id' => 'nullable|exists:skemas,id',
            'jadwal_id' => 'nullable|exists:jadwals,id',
            'tanggal_terbit' => 'nullable|date',
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ]);

        $sertifikat->update($request->only(['no_sertifikat', 'user_id', 'skema_id', 'jadwal_id', 'tanggal_terbit', 'status']));

        return redirect()->route('admin.sertifikasi.sertifikat.index')->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function generate($id)
    {
        if (!Schema::hasTable('sertifikats')) {
            return redirect()->route('admin.sertifikasi.sertifikat.index')->with('error', 'Tabel sertifikats belum dibuat. Jalankan php artisan migrate.');
        }
        $sertifikat = Sertifikat::with(['user', 'skema', 'jadwal'])->findOrFail($id);

        return view('admin.sertifikasi.sertifikat.print', compact('sertifikat'));
    }

    public function generateFromPenilaian(Request $request, $penilaianId)
    {
        if (!Schema::hasTable('sertifikats')) {
            return redirect()->back()->with('error', 'Tabel sertifikats belum dibuat. Jalankan php artisan migrate.');
        }
        $penilaian = Penilaian::with('jadwal')->findOrFail($penilaianId);

        if ($penilaian->hasil !== 'Kompeten') {
            return redirect()->back()->with('error', 'Penilaian tidak berstatus Kompeten.');
        }

        if ($penilaian->sertifikat) {
            return redirect()->back()->with('error', 'Sertifikat sudah ada untuk penilaian ini.');
        }

        $no = 'SRT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));

        $sertifikat = Sertifikat::create([
            'user_id' => $penilaian->user_id,
            'penilaian_id' => $penilaian->id,
            'skema_id' => optional($penilaian->jadwal)->skema_id ?? null,
            'jadwal_id' => $penilaian->jadwal_id,
            'no_sertifikat' => $no,
            'tanggal_terbit' => now()->toDateString(),
            'status' => 'Aktif',
        ]);

        return redirect()->route('admin.sertifikasi.sertifikat.index')->with('success', 'Sertifikat berhasil dibuat dari penilaian.');
    }

    public function destroy($id)
    {
        if (!Schema::hasTable('sertifikats')) {
            return redirect()->route('admin.sertifikasi.sertifikat.index')->with('error', 'Tabel sertifikats belum dibuat. Jalankan php artisan migrate.');
        }
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('admin.sertifikasi.sertifikat.index')->with('success', 'Sertifikat berhasil dihapus!');
    }
}
