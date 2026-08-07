<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateWithQueryString;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    use PaginateWithQueryString;
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $skemas = Skema::withCount('pesertas')
            ->when($search, function ($query, $search) {
                return $query->where('nama_skema', 'like', "%{$search}%")
                            ->orWhere('kode_skema', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%")
                            ->orWhere('kelas', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage);

        $skemas = $this->paginateWithQueryString($skemas, $request);

        return view('admin.skema.index', compact('skemas'));
    }

    public function create()
    {
        // 1. Ambil daftar kelas unik dari database
        $kelases = User::whereNotNull('kelas')
                       ->where('kelas', '!=', '')
                       ->pluck('kelas')
                       ->unique();

        // Backup jika di database kolom 'kelas' masih kosong/null
        if ($kelases->isEmpty()) {
            $kelases = collect(['XI TKJ 1', 'XI RPL 2', 'XI MPL 3', 'XI AKL 2']);
        }

        // 2. Ambil semua peserta peserta saja
        $pesertas = User::where('role', 'peserta')->get();

        return view('admin.skema.create', compact('kelases', 'pesertas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_skema' => 'required|string|unique:skemas,kode_skema',
            'nama_skema' => 'required|string|max:255',
            'status'     => 'nullable|string|max:50',
            'deskripsi'  => 'nullable|string',
            'kelas'      => 'nullable|string|max:100',
        ]);

        Skema::create($request->only(['kode_skema', 'nama_skema', 'status', 'deskripsi', 'kelas']));

        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $skema = Skema::findOrFail($id);

        $kelases = User::whereNotNull('kelas')
                       ->where('kelas', '!=', '')
                       ->pluck('kelas')
                       ->unique();

        if ($kelases->isEmpty()) {
            $kelases = collect(['XI TKJ 1', 'XI RPL 2', 'XI MPL 3', 'XI AKL 2']);
        }

        // Ambil juga daftar peserta agar view edit dapat menampilkan peserta dinamis
        $pesertas = User::where('role', 'peserta')->get();

        return view('admin.skema.edit', compact('skema', 'kelases', 'pesertas'));
    }

    public function update(Request $request, $id)
    {
        $skema = Skema::findOrFail($id);

        $request->validate([
            'kode_skema' => 'required|string|unique:skemas,kode_skema,' . $id,
            'nama_skema' => 'required|string|max:255',
            'status'     => 'nullable|string|max:50',
            'deskripsi'  => 'nullable|string',
            'kelas'      => 'nullable|string|max:100',
        ]);

        $skema->update($request->only(['kode_skema', 'nama_skema', 'status', 'deskripsi', 'kelas']));

        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $skema = Skema::findOrFail($id);
        $skema->delete();

        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil dihapus!');
    }
}