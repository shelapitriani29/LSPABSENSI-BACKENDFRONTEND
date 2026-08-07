<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('username', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('kelas', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('admin.referensi.user.index', compact('users'));
    }

    public function create()
    {
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('admin.referensi.user.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name'                 => 'required|string|max:255',
            'username'             => 'required|string|max:255|unique:users,username',
            'email'                => 'required|email|unique:users,email',
            'password'             => 'required|string|min:6',
            'role'                 => 'required|string',
            'status'               => 'nullable|string',
            'nomor_induk'          => 'nullable|string',
            'nik'                  => 'nullable|string',
            'tempat_lahir'         => 'nullable|string',
            'tanggal_lahir'        => 'nullable|date',
            'jenis_kelamin'        => 'nullable|string',
            'no_hp'                => 'nullable|string',
            'alamat'               => 'nullable|string',
            'kelas'                => 'nullable|string',
            'jurusan'              => 'nullable|string',
            'no_sertifikat_asesor' => 'nullable|string',
            'skema_kompetensi'     => 'nullable|string',
            'status_asesor'        => 'nullable|string',
        ]);

        // 2. Normalisasi Nilai Jenis Kelamin (Mencegah Error Data Truncated)
        $jenisKelamin = $request->jenis_kelamin;
        if (in_array(strtolower($jenisKelamin), ['laki-laki', 'laki laki', 'l'])) {
            $jenisKelamin = 'L';
        } elseif (in_array(strtolower($jenisKelamin), ['perempuan', 'p'])) {
            $jenisKelamin = 'P';
        }

        // 3. Simpan Data Ke Database
        User::create([
            'name'                 => $request->name,
            'username'             => $request->username,
            'email'                => $request->email,
            'password'             => Hash::make($request->password),
            'role'                 => $request->role,
            'status'               => $request->status ?? 'Aktif',
            'nomor_induk'          => $request->nomor_induk,
            'nik'                  => $request->nik,
            'tempat_lahir'         => $request->tempat_lahir,
            'tanggal_lahir'        => $request->tanggal_lahir,
            'jenis_kelamin'        => $jenisKelamin,
            'no_hp'                => $request->no_hp,
            'alamat'               => $request->alamat,
            'kelas'                => $request->kelas,
            'jurusan'              => $request->jurusan,
            'no_sertifikat_asesor' => $request->no_sertifikat_asesor,
            'skema_kompetensi'     => $request->skema_kompetensi,
            'status_asesor'        => $request->status_asesor,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.referensi.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validasi khusus form edit
        $request->validate([
            'name'        => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username,' . $id,
            'email'       => 'required|email|unique:users,email,' . $id,
            'nomor_induk' => 'nullable|string',
            'nik'         => 'nullable|string',
            'tempat_lahir'=> 'nullable|string',
            'tanggal_lahir'=> 'nullable|date',
            'no_hp'       => 'nullable|string',
            'alamat'      => 'nullable|string',
            'kelas'       => 'nullable|string',
            'jurusan'     => 'nullable|string',
            'status'      => 'nullable|string',
            'password'    => 'nullable|string|min:6',
        ]);

        // 2. Ambil data input
        $data = $request->only([
            'name',
            'username',
            'email',
            'nomor_induk',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'no_hp',
            'alamat',
            'kelas',
            'jurusan',
            'status',
            'bidang_kompetensi'
        ]);

        // 3. Normalisasi Jenis Kelamin jika dikirim saat edit
        if ($request->filled('jenis_kelamin')) {
            $jk = $request->jenis_kelamin;
            $data['jenis_kelamin'] = in_array(strtolower($jk), ['laki-laki', 'l']) ? 'L' : 'P';
        }

        // 4. Jika password diisi, enkripsi dan perbarui
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }
}