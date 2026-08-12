<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $perPage = $request->input('per_page', 10);

        $jadwals = Jadwal::with(['skema', 'asesor'])
            ->when($status, function ($query, $status) {
                return $query->whereComputedStatus($status);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->whereHas('skema', function ($q2) use ($search) {
                        $q2->where('nama_skema', 'like', "%{$search}%");
                    })
                    ->orWhereHas('asesor', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('kode_jadwal', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage);

        if (method_exists($jadwals, 'withQueryString')) {
            $jadwals = $jadwals->withQueryString();
        } else {
            $jadwals->appends($request->query());
        }

        return view('admin.sertifikasi.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        $asesors = User::where('role', 'asesor')->orderBy('name')->get();
        $kelasOptions = User::where('role', 'peserta')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->orderBy('kelas')
            ->pluck('kelas')
            ->unique();

        $kelasCounts = User::where('role', 'peserta')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->selectRaw('kelas, count(*) as count')
            ->groupBy('kelas')
            ->pluck('count', 'kelas');

        return view('admin.sertifikasi.jadwal.create', compact('skemas', 'asesors', 'kelasOptions', 'kelasCounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jadwal' => 'required|string|unique:jadwals,kode_jadwal',
            'skema_id' => 'required|exists:skemas,id',
            'kelas' => 'required|string|max:100',
            'asesor_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'kode_jadwal.required' => 'Kode jadwal wajib diisi.',
            'skema_id.required' => 'Skema sertifikasi wajib dipilih.',
            'skema_id.exists' => 'Skema yang dipilih tidak valid.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'asesor_id.required' => 'Asesor wajib dipilih.',
            'asesor_id.exists' => 'Asesor yang dipilih tidak valid.',
            'tanggal.required' => 'Tanggal uji wajib diisi.',
            'tanggal.date' => 'Tanggal uji harus berupa tanggal yang valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Jam mulai harus menggunakan format HH:MM.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Jam selesai harus menggunakan format HH:MM.',
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi terlalu panjang.',
        ]);

        Jadwal::create($request->only([
            'kode_jadwal',
            'skema_id',
            'kelas',
            'asesor_id',
            'tanggal',
            'jam_mulai',
            'jam_selesai',
            'lokasi',
            'keterangan',
        ]));

        return redirect()->route('admin.sertifikasi.jadwal.index')->with('success', 'Jadwal uji berhasil ditambahkan!');
    }

    public function show($id)
    {
        $jadwal = Jadwal::with(['skema', 'asesor'])->findOrFail($id);
        $pesertas = User::where('role', 'peserta')
            ->where('kelas', $jadwal->kelas)
            ->orderBy('name')
            ->get();

        return view('admin.sertifikasi.jadwal.show', compact('jadwal', 'pesertas'));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $skemas = Skema::orderBy('nama_skema')->get();
        $asesors = User::where('role', 'asesor')->orderBy('name')->get();
        $kelasOptions = User::where('role', 'peserta')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->orderBy('kelas')
            ->pluck('kelas')
            ->unique();

        $kelasCounts = User::where('role', 'peserta')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->selectRaw('kelas, count(*) as count')
            ->groupBy('kelas')
            ->pluck('count', 'kelas');

        return view('admin.sertifikasi.jadwal.edit', compact('jadwal', 'skemas', 'asesors', 'kelasOptions', 'kelasCounts'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->merge([
            'jam_mulai' => $request->filled('jam_mulai') ? substr($request->jam_mulai, 0, 5) : null,
            'jam_selesai' => $request->filled('jam_selesai') ? substr($request->jam_selesai, 0, 5) : null,
        ]);

        $request->validate([
            'kode_jadwal' => ['required', 'string', Rule::unique('jadwals', 'kode_jadwal')->ignore($jadwal->id)],
            'skema_id' => 'required|exists:skemas,id',
            'kelas' => 'required|string|max:100',
            'asesor_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'kode_jadwal.required' => 'Kode jadwal wajib diisi.',
            'kode_jadwal.unique' => 'Kode jadwal sudah digunakan.',
            'skema_id.required' => 'Skema sertifikasi wajib dipilih.',
            'skema_id.exists' => 'Skema yang dipilih tidak valid.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'asesor_id.required' => 'Asesor wajib dipilih.',
            'asesor_id.exists' => 'Asesor yang dipilih tidak valid.',
            'tanggal.required' => 'Tanggal uji wajib diisi.',
            'tanggal.date' => 'Tanggal uji harus berupa tanggal yang valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Jam mulai harus menggunakan format HH:MM.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Jam selesai harus menggunakan format HH:MM.',
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi terlalu panjang.',
        ]);

        $jadwal->update($request->only([
            'kode_jadwal',
            'skema_id',
            'kelas',
            'asesor_id',
            'tanggal',
            'jam_mulai',
            'jam_selesai',
            'lokasi',
            'keterangan',
        ]));

        return redirect()->route('admin.sertifikasi.jadwal.index')->with('success', 'Jadwal uji berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.sertifikasi.jadwal.index')->with('success', 'Jadwal uji berhasil dihapus!');
    }
}
