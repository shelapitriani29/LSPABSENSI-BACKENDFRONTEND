<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AsesorController extends Controller
{
    /**
     * Tampilkan daftar data asesor
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');

        $query = User::where('role', 'asesor');

        if ($search) {
            // Menggunakan orWhere agar pencarian fleksibel
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $asesors = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('admin.asesor.index', compact('asesors'));
    }

    /**
     * Detail asesor
     */
    public function show($id)
    {
        $asesor = User::where('role', 'asesor')->findOrFail($id);
        return view('admin.asesor.show', compact('asesor'));
    }

    /**
     * Form edit asesor
     */
    public function edit($id)
    {
        $asesor = User::where('role', 'asesor')->findOrFail($id);
        $skemas = Skema::orderBy('nama_skema')->get();
        return view('admin.asesor.edit', compact('asesor', 'skemas'));
    }

    /**
     * Update data asesor
     */
    public function update(Request $request, $id)
    {
        $asesor = User::where('role', 'asesor')->findOrFail($id);

        $request->validate([
            'name'             => 'required|string|max:255',
            'username'         => ['required', 'string', Rule::unique('users', 'username')->ignore($asesor->id)],
            'email'            => ['nullable', 'email', Rule::unique('users', 'email')->ignore($asesor->id)],
            'password'         => ['nullable','string','min:6','max:255'],
            'nip'              => 'nullable|string|max:50',
            'nik'              => 'nullable|string|max:20',
            'tempat_lahir'     => 'nullable|string|max:100',
            'tanggal_lahir'    => 'nullable|date',
            'jenis_kelamin'    => 'nullable|in:L,P',
            'no_hp'            => 'nullable|string|max:20',
            'alamat'           => 'nullable|string',
            'no_met'           => 'nullable|string|max:100',
            'skema_kompetensi' => 'nullable|string|max:255',
            'status'           => 'nullable|string|in:aktif,nonaktif',
        ]);

        // Normalisasi status agar match dengan enum values di database
        $status = $request->status ?? $asesor->status;
        if ($status) {
            $lowerStatus = strtolower($status);
            if (in_array($lowerStatus, ['a', 'aktif'], true)) {
                $status = 'Aktif';
            } elseif (in_array($lowerStatus, ['n', 'nonaktif', 'non-aktif', 'tidak aktif'], true)) {
                $status = 'Nonaktif';
            }
        }

        $data = [
            'name'             => $request->name,
            'username'         => $request->username,
            'email'            => $request->email,
            'nip'              => $request->nip,
            'nik'              => $request->nik,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'no_hp'            => $request->no_hp,
            'alamat'           => $request->alamat,
            'no_met'           => $request->no_met,
            'skema_kompetensi' => $request->skema_kompetensi,
            'status'           => $status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $asesor->update($data);

        return redirect()->route('admin.asesor.index')->with('success', 'Data Asesor berhasil diperbarui!');
    }

    /**
     * Hapus data asesor
     */
    public function destroy($id)
    {
        $asesor = User::where('role', 'asesor')->findOrFail($id);
        $asesor->delete();

        return redirect()->route('admin.asesor.index')->with('success', 'Data Asesor berhasil dihapus!');
    }
}
