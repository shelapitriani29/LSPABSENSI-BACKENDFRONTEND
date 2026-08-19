<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KategoriSoal;
use App\Models\PilihanJawaban;
use App\Models\Skema;
use App\Models\Soal;
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

    /**
     * Menangani halaman khusus untuk pengelolaan soal berdasarkan jadwal uji.
     */
    public function kelolaSoal($id)
    {
        $jadwal = Jadwal::with(['skema', 'asesor'])->findOrFail($id);
        $kategoris = $jadwal->kategoris()->withCount('soals')->get();
        $pesertas = User::where('role', 'peserta')
            ->where('kelas', $jadwal->kelas)
            ->orderBy('name')
            ->get();

        if (view()->exists('admin.sertifikasi.jadwal.kelola-soal')) {
            return view('admin.sertifikasi.jadwal.kelola-soal', compact('jadwal', 'kategoris', 'pesertas'));
        }

        return view('admin.sertifikasi.jadwal.show', compact('jadwal', 'pesertas'));
    }

    /**
     * Menyimpan pengaturan ujian tambahan pada jadwal tertentu.
     */
    public function updatePengaturan(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'passing_grade' => 'nullable|integer|min:0|max:100',
            'durasi_ujian' => 'nullable|integer|min:1',
            'durasi' => 'nullable|integer|min:1',
        ]);

        $durasi = $request->input('durasi_ujian', $request->input('durasi', $jadwal->durasi_ujian ?? 120));
        $passingGrade = $request->input('passing_grade', $jadwal->passing_grade ?? 75);

        $jadwal->update([
            'passing_grade' => (int) $passingGrade,
            'durasi_ujian' => (int) $durasi,
        ]);

        return redirect()->back()->with('success', 'Pengaturan ujian berhasil diperbarui!');
    }

    /**
     * Menyimpan kategori soal baru untuk jadwal tertentu.
     */
    public function storeKategori(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jadwal->kategoris()->create($request->only(['nama_kategori', 'deskripsi']));

        return redirect()->route('admin.sertifikasi.jadwal.soal', $jadwal->id)->with('success', 'Kategori soal berhasil ditambahkan!');
    }

    public function kategoriIndex($id)
    {
        $jadwal = Jadwal::with(['skema', 'kategoris.soals'])->findOrFail($id);
        $kategoris = $jadwal->kategoris()->withCount('soals')->get();

        return view('admin.sertifikasi.jadwal.kelola-soal', compact('jadwal', 'kategoris'));
    }

    public function showKategoriSoal($id, $kategoriId)
    {
        $jadwal = Jadwal::with(['skema', 'asesor'])->findOrFail($id);
        $kategori = $jadwal->kategoris()->with('soals')->findOrFail($kategoriId);
        $soals = $kategori->soals()->with('pilihanJawaban')->get();

        return view('admin.sertifikasi.jadwal.detail-soal', compact('jadwal', 'kategori', 'soals'));
    }

    public function createKategoriSoal($id)
    {
        $jadwal = Jadwal::with('skema')->findOrFail($id);

        return view('admin.sertifikasi.jadwal.create-kategori', compact('jadwal'));
    }

    public function createSoal($id, $kategoriId)
    {
        $jadwal = Jadwal::with('skema')->findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);

        return view('admin.sertifikasi.jadwal.tambah-soal', compact('jadwal', 'kategori'));
    }

    public function editSoal($id, $kategoriId, $soalId)
    {
        $jadwal = Jadwal::with('skema')->findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);
        $soal = $kategori->soals()->with('pilihanJawaban')->findOrFail($soalId);

        return view('admin.sertifikasi.jadwal.edit-soal', compact('jadwal', 'kategori', 'soal'));
    }

    public function editKategori($id, $kategoriId)
    {
        $jadwal = Jadwal::with('skema')->findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);

        return view('admin.sertifikasi.jadwal.create-kategori', compact('jadwal', 'kategori'));
    }

    public function updateKategori(Request $request, $id, $kategoriId)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->only(['nama_kategori', 'deskripsi']));

        return redirect()->route('admin.sertifikasi.jadwal.soal', $jadwal->id)->with('success', 'Kategori soal berhasil diperbarui!');
    }

    public function destroyKategori($id, $kategoriId)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);

        if ($kategori->soals()->exists()) {
            return redirect()->route('admin.sertifikasi.jadwal.soal', $jadwal->id)->with('error', 'Kategori tidak dapat dihapus karena masih memiliki soal.');
        }

        $kategori->delete();

        return redirect()->route('admin.sertifikasi.jadwal.soal', $jadwal->id)->with('success', 'Kategori soal berhasil dihapus!');
    }

    public function storeSoal(Request $request, $id, $kategoriId)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);

        $validationRules = [
            'pertanyaan' => 'required|string',
            'tipe_soal' => 'required|in:Pilihan Ganda,Essay,Isian Singkat',
            'tingkat_kesulitan' => 'required|string',
            'poin' => 'required|integer|min:1',
            'jawaban_benar' => 'nullable|string|max:1',
        ];

        // Add validation for pilihan jawaban when tipe_soal is Pilihan Ganda
        if ($request->input('tipe_soal') === 'Pilihan Ganda') {
            $validationRules['pilihan_a'] = 'required|string';
            $validationRules['pilihan_b'] = 'required|string';
            $validationRules['pilihan_c'] = 'required|string';
            $validationRules['pilihan_d'] = 'required|string';
        }

        $request->validate($validationRules, [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'tipe_soal.required' => 'Tipe soal wajib dipilih.',
            'tipe_soal.in' => 'Tipe soal tidak valid.',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib dipilih.',
            'poin.required' => 'Poin wajib diisi.',
            'poin.integer' => 'Poin harus berupa angka.',
            'poin.min' => 'Poin minimal 1.',
            'jawaban_benar.required_if' => 'Jawaban benar wajib dipilih untuk soal pilihan ganda.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
        ]);

        $soal = $kategori->soals()->create([
            'pertanyaan' => $request->pertanyaan,
            'tipe_soal' => $request->tipe_soal,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'poin' => $request->poin,
            'jawaban_benar' => $request->tipe_soal === 'Pilihan Ganda' ? $request->jawaban_benar : null,
        ]);

        if ($request->tipe_soal === 'Pilihan Ganda') {
            foreach (['A', 'B', 'C', 'D'] as $pilihan) {
                $field = 'pilihan_' . strtolower($pilihan);
                if ($request->filled($field)) {
                    PilihanJawaban::create([
                        'soal_id' => $soal->id,
                        'pilihan' => $pilihan,
                        'teks_jawaban' => $request->$field,
                    ]);
                }
            }
        }

        return redirect()->route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, $kategori->id])->with('success', 'Soal berhasil ditambahkan!');
    }

    public function updateSoal(Request $request, $id, $kategoriId, $soalId)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);
        $soal = $kategori->soals()->findOrFail($soalId);

        $validationRules = [
            'pertanyaan' => 'required|string',
            'tipe_soal' => 'required|in:Pilihan Ganda,Essay,Isian Singkat',
            'tingkat_kesulitan' => 'required|string',
            'poin' => 'required|integer|min:1',
            'jawaban_benar' => 'nullable|string|max:1',
        ];

        // Add validation for pilihan jawaban when tipe_soal is Pilihan Ganda
        if ($request->input('tipe_soal') === 'Pilihan Ganda') {
            $validationRules['pilihan_a'] = 'required|string';
            $validationRules['pilihan_b'] = 'required|string';
            $validationRules['pilihan_c'] = 'required|string';
            $validationRules['pilihan_d'] = 'required|string';
        }

        $request->validate($validationRules, [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'tipe_soal.required' => 'Tipe soal wajib dipilih.',
            'tipe_soal.in' => 'Tipe soal tidak valid.',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib dipilih.',
            'poin.required' => 'Poin wajib diisi.',
            'poin.integer' => 'Poin harus berupa angka.',
            'poin.min' => 'Poin minimal 1.',
            'jawaban_benar.required_if' => 'Jawaban benar wajib dipilih untuk soal pilihan ganda.',
            'pilihan_a.required' => 'Pilihan A wajib diisi.',
            'pilihan_b.required' => 'Pilihan B wajib diisi.',
            'pilihan_c.required' => 'Pilihan C wajib diisi.',
            'pilihan_d.required' => 'Pilihan D wajib diisi.',
        ]);

        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'tipe_soal' => $request->tipe_soal,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'poin' => $request->poin,
            'jawaban_benar' => $request->tipe_soal === 'Pilihan Ganda' ? $request->jawaban_benar : null,
        ]);

        if ($request->tipe_soal === 'Pilihan Ganda') {
            $soal->pilihanJawaban()->delete();
            foreach (['A', 'B', 'C', 'D'] as $pilihan) {
                $field = 'pilihan_' . strtolower($pilihan);
                if ($request->filled($field)) {
                    PilihanJawaban::create([
                        'soal_id' => $soal->id,
                        'pilihan' => $pilihan,
                        'teks_jawaban' => $request->$field,
                    ]);
                }
            }
        }

        return redirect()->route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, $kategori->id])->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroySoal($id, $kategoriId, $soalId)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kategori = $jadwal->kategoris()->findOrFail($kategoriId);
        $soal = $kategori->soals()->findOrFail($soalId);

        $soal->delete();

        return redirect()->route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, $kategori->id])->with('success', 'Soal berhasil dihapus!');
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