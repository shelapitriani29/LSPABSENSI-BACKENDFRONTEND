<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    /**
     * Path direktori view khusus peserta
     */
    private $viewPath = 'admin.peserta';

    /**
     * Menampilkan daftar peserta
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'peserta');

        // Fitur Search Multi-Kolom
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 10);
        $pesertas = $query->latest()->paginate($perPage);

        return view($this->viewPath . '.index', compact('pesertas'));
    }

    /**
     * Menampilkan detail data peserta
     */
    public function show($id)
    {
        $peserta = User::with(['absensis.jadwal.skema'])
            ->where('role', 'peserta')
            ->findOrFail($id);

        return view($this->viewPath . '.show', compact('peserta'));
    }

    /**
     * Menampilkan form edit peserta
     */
    public function create()
    {
        return view($this->viewPath . '.create');
    }

    public function edit($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);

        $kelases = User::where('role', 'peserta')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->pluck('kelas')
            ->unique();

        if ($kelases->isEmpty()) {
            $kelases = collect(['XII RPL 1', 'XII RPL 2']);
        }

        return view($this->viewPath . '.edit', compact('peserta', 'kelases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6',
            'nik'           => 'nullable|string|max:50',
            'instansi'      => 'nullable|string|max:255',
            'no_hp'         => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'kelas'         => 'nullable|string|max:100',
            'jurusan'       => 'nullable|string|max:100',
            'status'        => 'nullable|string|in:aktif,nonaktif,Aktif,Nonaktif',
        ]);

        $status = $request->status ? strtolower($request->status) : 'aktif';

        User::create([
            'name'        => $request->name,
            'username'    => $request->username,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'peserta',
            'status'      => $status,
            'nik'         => $request->nik,
            'instansi'    => $request->instansi,
            'no_hp'       => $request->no_hp,
            'alamat'      => $request->alamat,
            'kelas'       => $request->kelas,
            'jurusan'     => $request->jurusan,
        ]);

        return redirect()->route('admin.peserta.index')->with('success', 'Peserta berhasil ditambahkan dan dapat login.');
    }

    /**
     * Memperbarui data peserta
     */
    public function update(Request $request, $id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);

        // Validasi input mencakup seluruh kolom peserta
        $request->validate([
            'name'             => 'required|string|max:255',
            'username'         => ['required', 'string', Rule::unique('users', 'username')->ignore($peserta->id)],
            'email'            => ['nullable', 'email', Rule::unique('users', 'email')->ignore($peserta->id)],
            'password'         => 'nullable|string|min:6',
            'nik'              => 'nullable|string|max:50',
            'tempat_lahir'     => 'nullable|string|max:100',
            'tanggal_lahir'    => 'nullable|date',
            'jenis_kelamin'    => ['nullable', 'string', Rule::in(['L', 'P', 'Laki-laki', 'Perempuan'])],
            'no_hp'            => 'nullable|string|max:20',
            'alamat'           => 'nullable|string',
            'kelas'            => 'nullable|string|max:100',
            'jurusan'          => 'nullable|string|max:100',
            'skema_kompetensi' => 'nullable|string|max:255',
            'status'           => 'nullable|string|in:aktif,nonaktif',
            'instansi'         => 'nullable|string|max:255',
        ]);

        // Normalisasi jenis kelamin agar tersimpan sebagai L atau P
        $jenisKelamin = $request->jenis_kelamin;
        if ($jenisKelamin) {
            $lowerGender = strtolower($jenisKelamin);
            if (in_array($lowerGender, ['l', 'laki-laki', 'laki laki'], true)) {
                $jenisKelamin = 'L';
            } elseif (in_array($lowerGender, ['p', 'perempuan'], true)) {
                $jenisKelamin = 'P';
            }
        }

        // Masukkan atribut ke dalam array update
        $data = [
            'name'             => $request->name,
            'username'         => $request->username,
            'email'            => $request->email,
            'nik'              => $request->nik,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'jenis_kelamin'    => $jenisKelamin,
            'no_hp'            => $request->no_hp,
            'alamat'           => $request->alamat,
            'kelas'            => $request->kelas,
            'jurusan'          => $request->jurusan,
            'skema_kompetensi' => $request->skema_kompetensi,
            'instansi'         => $request->instansi,
            'status'           => $request->status,
        ];

        // Hanya hash password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $peserta->update($data);

        return redirect()->route('admin.peserta.index')->with('success', 'Data Peserta berhasil diperbarui!');
    }

    /**
     * Menghapus data peserta
     */
    public function destroy($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);
        $peserta->delete();

        return redirect()->route('admin.peserta.index')->with('success', 'Data Peserta berhasil dihapus!');
    }
}