<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AsesorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\SkemaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Penilaian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// ==========================================
// GUEST ROUTES (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    // Menampilkan Form Login
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [AuthController::class, 'showLoginForm']);

    // Memproses Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:10,1');
});

// Logout (Hanya bisa diakses jika sudah login)
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Shortcut /dashboard (Redirect dinamis sesuai role user yang login)
Route::get('/dashboard', function () {
    $user = Auth::user();
    $normalizedRole = User::normalizeRole($user->role);

    if ($normalizedRole === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($normalizedRole === 'asesor') {
        return redirect()->route('asesor.dashboard');
    } elseif ($normalizedRole === 'peserta') {
        return redirect()->route('peserta.dashboard');
    }

    return redirect('/');
})->middleware('auth');


// ==========================================
// ADMIN ROUTES
// ==========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // ------------------------------------------
        // REFERENSI
        // ------------------------------------------
        Route::resource('user', UserController::class);
        Route::put('user/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggle-status');

        Route::resource('peserta', PesertaController::class);
        Route::resource('asesor', AsesorController::class)->except(['create', 'store']);
        Route::resource('skema', SkemaController::class);

        // ------------------------------------------
        // FITUR SERTIFIKASI ADMIN
        // ------------------------------------------
        Route::prefix('sertifikasi')->name('sertifikasi.')->group(function () {

            // Jadwal Uji Kompetensi
            Route::prefix('jadwal')->name('jadwal.')->group(function () {
                Route::get('/', [JadwalController::class, 'index'])->name('index');
                Route::get('/create', [JadwalController::class, 'create'])->name('create');
                Route::post('/', [JadwalController::class, 'store'])->name('store');
                Route::get('/{id}', [JadwalController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [JadwalController::class, 'edit'])->name('edit');
                Route::put('/{id}', [JadwalController::class, 'update'])->name('update');
                Route::delete('/{id}', [JadwalController::class, 'destroy'])->name('destroy');
            });

            // Penilaian (Hasil Asesmen)
            Route::prefix('penilaian')->name('penilaian.')->group(function () {
                Route::get('/', [PenilaianController::class, 'index'])->name('index');
                Route::get('/{id}', [PenilaianController::class, 'show'])->name('show');
            });

            // Absensi
            Route::prefix('absensi')->name('absensi.')->group(function () {
                Route::get('/', [AbsensiController::class, 'index'])->name('index');
                Route::post('/export', [AbsensiController::class, 'export'])->name('export');
                Route::get('/{id}/print-qr', [AbsensiController::class, 'printQr'])->name('print-qr');
                Route::get('/user/{userId}/print-qr', [AbsensiController::class, 'printQrUser'])->name('print-qr-user');
                Route::get('/{id}/edit', [AbsensiController::class, 'edit'])->name('edit');
                Route::put('/{id}', [AbsensiController::class, 'update'])->name('update');
                Route::delete('/{id}', [AbsensiController::class, 'destroy'])->name('destroy');
            });

            // Sertifikat
            Route::prefix('sertifikat')->name('sertifikat.')->group(function () {
                Route::get('/', [SertifikatController::class, 'index'])->name('index');
                Route::get('/generate/{id}', [SertifikatController::class, 'generate'])->name('generate');
                Route::post('/generate-from-penilaian/{id}', [SertifikatController::class, 'generateFromPenilaian'])->name('generate.from_penilaian');
                Route::get('/{id}/edit', [SertifikatController::class, 'edit'])->name('edit');
                Route::put('/{id}', [SertifikatController::class, 'update'])->name('update');
                Route::delete('/{id}', [SertifikatController::class, 'destroy'])->name('destroy');
                Route::get('/{id}', [SertifikatController::class, 'show'])->name('show');
            });

            // Pengaturan Sistem
            Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
                Route::get('/', function () { return view('admin.pengaturan.index'); })->name('index');
            });
        });

        // Laporan Sistem
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/sistem', [LaporanController::class, 'index'])->name('sistem');
            Route::get('/sistem/export', [LaporanController::class, 'export'])->name('sistem.export');
        });

        // Profil Admin
        Route::get('/profil', function () {
            $user = Auth::user();
            return view('admin.profil.index', compact('user'));
        })->name('profil');

        Route::get('/profil/edit', function () {
            $user = Auth::user();
            return view('admin.profil.edit', compact('user'));
        })->name('profil.edit');

        Route::put('/profil/update', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            ]);

            $user->update($request->only(['name', 'email']));

            return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
        })->name('profil.update');

        Route::get('/profil/ubah-password', function () {
            return view('admin.profil.ubah-password');
        })->name('profil.ubah-password');

        Route::put('/profil/update-password', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'current_password' => ['required', 'string', 'min:6'],
                'new_password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }

            $user->update(['password' => Hash::make($request->new_password)]);

            return redirect()->route('admin.profil')->with('success', 'Password berhasil diperbarui!');
        })->name('profil.update-password');
});


// ==========================================
// ASESOR ROUTES
// ==========================================
Route::middleware(['auth', 'role:asesor'])
    ->prefix('asesor')
    ->name('asesor.')
    ->group(function () {
        Route::get('/dashboard', function () {
            $today = now()->toDateString();

            $totalPeserta = User::where('role', 'peserta')->count();
            $jadwalHariIniCount = Jadwal::whereDate('tanggal', $today)->count();
            $absensiHadir = Absensi::where('status', 'Hadir')->count();
            $absensiBelum = Absensi::where('status', 'Belum Absen')->count();
            $penilaianDone = Penilaian::count();
            $penilaianPending = max(0, $totalPeserta - $penilaianDone);

            return view('asesor.dashboard', compact(
                'totalPeserta',
                'jadwalHariIniCount',
                'absensiHadir',
                'absensiBelum',
                'penilaianDone',
                'penilaianPending'
            ));
        })->name('dashboard');

        Route::get('/jadwal-asesmen', function (Request $request) {
            $search = $request->input('search');
            $status = $request->input('status');
            $perPage = $request->input('per_page', 10);

            $jadwals = Jadwal::with(['skema', 'asesor'])
                ->withCount(['pesertas'])
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
                ->paginate($perPage)
                ->appends($request->query());

            return view('asesor.jadwal-asesmen', compact('jadwals'));
        })->name('jadwal-asesmen');

        Route::get('/jadwal-asesmen/{id}', function ($id) {
            $jadwal = Jadwal::with(['skema', 'asesor'])->findOrFail($id);
            $pesertaCount = User::where('role', 'peserta')->where('kelas', $jadwal->kelas)->count();
            $hadirCount = Absensi::where('jadwal_id', $jadwal->id)->where('status', 'Hadir')->count();
            $penilaianCount = Penilaian::where('jadwal_id', $jadwal->id)->count();
            $belumPenilaianCount = max(0, $pesertaCount - $penilaianCount);

            return view('asesor.jadwal-asesmen-detail', compact('jadwal', 'pesertaCount', 'hadirCount', 'penilaianCount', 'belumPenilaianCount'));
        })->name('jadwal-asesmen.detail');

        Route::get('/daftar-peserta', function (Request $request) {
            $asesorId = Auth::id();
            $kelasList = Jadwal::where('asesor_id', $asesorId)->pluck('kelas')->filter()->unique();

            $query = User::where('role', 'peserta')
                ->when($kelasList->isNotEmpty(), fn($query) => $query->whereIn('kelas', $kelasList));

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
            $pesertas = $query->latest()->paginate($perPage)->appends($request->query());

            return view('asesor.daftar-peserta', compact('pesertas'));
        })->name('daftar-peserta');

        Route::get('/daftar-peserta/{id}/detail', function ($id) {
            $peserta = User::with('absensis')->where('role', 'peserta')->findOrFail($id);
            $lastAbsensi = $peserta->absensis->last();
            $penilaian = Penilaian::where('user_id', $peserta->id)->latest()->first();

            return view('asesor.daftar-peserta-detail', compact('peserta', 'lastAbsensi', 'penilaian'));
        })->name('daftar-peserta.detail');

        Route::prefix('input-penilaian')->name('input-penilaian.')->group(function () {
            Route::get('/', function (Request $request) {
                $search = $request->input('search');
                $jadwalId = $request->input('jadwal_id');
                $perPage = $request->input('per_page', 10);

                $asesorId = Auth::id();
                $jadwals = Jadwal::where('asesor_id', $asesorId)->with('skema')->orderBy('kode_jadwal')->get();
                $jadwal = $jadwalId ? $jadwals->firstWhere('id', $jadwalId) : null;
                $kelasList = $jadwals->pluck('kelas')->filter()->unique();

                $pesertas = User::where('role', 'peserta')
                    ->when($kelasList->isNotEmpty(), fn($query) => $query->whereIn('kelas', $kelasList))
                    ->when($jadwal, fn($query) => $query->where('kelas', $jadwal->kelas))
                    ->when($search, function ($query, $search) {
                        return $query->where(function ($sub) use ($search) {
                            $sub->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('nik', 'like', "%{$search}%")
                                ->orWhere('instansi', 'like', "%{$search}%")
                                ->orWhere('kelas', 'like', "%{$search}%");
                        });
                    })
                    ->with([
                        'penilaians' => function ($query) use ($jadwalId) {
                            if ($jadwalId) {
                                $query->where('jadwal_id', $jadwalId);
                            }
                        },
                        'absensis' => function ($query) use ($jadwalId) {
                            if ($jadwalId) {
                                $query->where('jadwal_id', $jadwalId);
                            }
                        },
                    ])
                    ->orderBy('name')
                    ->paginate($perPage)
                    ->appends($request->query());

                return view('asesor.input-penilaian-index', compact('pesertas', 'jadwals', 'jadwal', 'jadwalId'));
            })->name('index');

            Route::get('/{id}/create', function ($id) {
                $user = User::where('role', 'peserta')->findOrFail($id);
                $jadwals = Jadwal::with('skema')
                    ->when($user->kelas, fn($query) => $query->where('kelas', $user->kelas))
                    ->orderBy('kode_jadwal')
                    ->get();

                $selectedJadwalId = request('jadwal_id') ?: ($jadwals->count() === 1 ? $jadwals->first()->id : null);

                return view('asesor.input-penilaian-create', compact('user', 'jadwals', 'selectedJadwalId'));
            })->name('create');

            Route::post('/store', function (Request $request) {
                $request->validate([
                    'user_id' => ['required', 'exists:users,id'],
                    'jadwal_id' => ['required', 'exists:jadwals,id'],
                    'hasil' => ['required', 'in:Kompeten,Belum Kompeten'],
                    'catatan' => ['nullable', 'string'],
                    'tanggal' => ['nullable', 'date'],
                    'keterangan' => ['nullable', 'string'],
                ]);

                $data = $request->only(['user_id', 'jadwal_id', 'hasil', 'catatan', 'tanggal', 'keterangan']);
                $data['asesor_id'] = Auth::id();

                Penilaian::create($data);

                return redirect()->route('asesor.input-penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
            })->name('store');

            Route::get('/{id}/detail', function ($id) {
                $penilaian = Penilaian::with(['user', 'jadwal.skema', 'asesor'])->findOrFail($id);
                return view('asesor.input-penilaian-detail', compact('penilaian'));
            })->name('detail');
        });

        Route::get('/riwayat-penilaian', function (Request $request) {
            $search = $request->input('search');
            $perPage = $request->input('per_page', 10);

            $query = Penilaian::with(['user', 'jadwal.skema', 'asesor'])
                ->when($search, function ($query, $search) {
                    return $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                    })->orWhereHas('jadwal', function ($q) use ($search) {
                        $q->where('kode_jadwal', 'like', "%{$search}%");
                    });
                });

            $total = $query->count();
            $kompetenCount = (clone $query)->where('hasil', 'Kompeten')->count();
            $belumCount = (clone $query)->where('hasil', 'Belum Kompeten')->count();

            $penilaians = $query->latest()->paginate($perPage)->appends($request->query());

            return view('asesor.riwayat-penilaian', compact('penilaians', 'total', 'kompetenCount', 'belumCount'));
        })->name('riwayat-penilaian');

        Route::get('/riwayat-penilaian/{id}/detail', function ($id) {
            $penilaian = Penilaian::with(['user', 'jadwal.skema', 'asesor'])->findOrFail($id);
            return view('asesor.riwayat-penilaian-detail', compact('penilaian'));
        })->name('riwayat-penilaian.detail');

        // Profil & Pengaturan Asesor
        Route::get('/profil', function () {
            $user = Auth::user();
            return view('asesor.profil', compact('user'));
        })->name('profil');

        Route::get('/profil/edit', function () {
            $user = Auth::user();
            return view('asesor.edit-profil', compact('user'));
        })->name('profil.edit');

        Route::put('/profil/update', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
                'no_hp' => ['nullable', 'string', 'max:20'],
                'instansi' => ['nullable', 'string', 'max:255'],
                'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ]);

            $data = $request->only(['name', 'email', 'username', 'no_hp', 'instansi']);

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('profiles', 'public');
                $data['foto'] = $path;
            }

            $user->update($data);

            return redirect()->route('asesor.profil')->with('success', 'Profil berhasil diperbarui!');
        })->name('profil.update');

        Route::post('/profil/update-foto', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'foto' => ['required', 'image', 'max:2048'],
            ]);

            $path = $request->file('foto')->store('profiles', 'public');
            $user->update(['foto' => $path]);

            return redirect()->route('asesor.profil')->with('success', 'Foto profil berhasil diperbarui!');
        })->name('profil.update-foto');

        Route::get('/profil/ubah-password', function () {
            return view('asesor.ubah-password');
        })->name('profil.ubah-password');

        Route::put('/profil/update-password', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'current_password' => ['required', 'string', 'min:6'],
                'new_password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }

            $user->update(['password' => Hash::make($request->new_password)]);

            return redirect()->route('asesor.profil')->with('success', 'Password berhasil diperbarui!');
        })->name('profil.update-password');
});


// ==========================================
// PESERTA ROUTES
// ==========================================
Route::middleware(['auth', 'role:peserta'])
    ->prefix('peserta')
    ->name('peserta.')
    ->group(function () {

        // Dashboard & Profil
        Route::get('/dashboard', function () {
            $user = Auth::user();
            $nextJadwal = Jadwal::with(['skema', 'asesor'])
                ->where('kelas', $user->kelas)
                ->whereDate('tanggal', '>=', now()->toDateString())
                ->orderBy('tanggal')
                ->first();

            $attendance = null;
            if ($nextJadwal) {
                $attendance = Absensi::where('user_id', $user->id)
                    ->where('jadwal_id', $nextJadwal->id)
                    ->first();
            }

            $penilaian = Penilaian::with(['jadwal.skema', 'asesor'])
                ->where('user_id', $user->id)
                ->latest('tanggal')
                ->first();

            return view('peserta.dashboard', compact('user', 'nextJadwal', 'attendance', 'penilaian'));
        })->name('dashboard');

        Route::get('/profil', function () {
            $user = Auth::user();
            return view('peserta.profil', compact('user'));
        })->name('profil');

        // Route Edit Profil
        Route::get('/profil/edit', function () {
            $user = Auth::user();
            return view('peserta.edit-profil', compact('user'));
        })->name('profil.edit');

        Route::put('/profil/update', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'nis' => ['nullable', 'string', 'max:100'],
                'kelas' => ['nullable', 'string', 'max:100'],
                'no_hp' => ['nullable', 'string', 'max:20'],
                'instansi' => ['nullable', 'string', 'max:255'],
            ]);

            $user->update($request->only(['name', 'email', 'nis', 'kelas', 'no_hp', 'instansi']));

            return redirect()->route('peserta.profil')->with('success', 'Profil berhasil diperbarui!');
        })->name('profil.update');

        Route::post('/profil/update-foto', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'foto' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ]);

            $path = $request->file('foto')->store('profiles', 'public');
            $user->update(['foto' => $path]);

            return redirect()->route('peserta.profil')->with('success', 'Foto profil berhasil diperbarui!');
        })->name('profil.update-foto');

        // Route Ubah Password
        Route::get('/profil/ubah-password', function () {
            return view('peserta.ubah-password');
        })->name('profil.ubah-password');

        Route::put('/profil/update-password', function (Request $request) {
            /** @var User $user */
            $user = Auth::user();

            $request->validate([
                'current_password' => ['required', 'string', 'min:6'],
                'new_password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }

            $user->update(['password' => Hash::make($request->new_password)]);

            return redirect()->route('peserta.profil')->with('success', 'Password berhasil diperbarui!');
        })->name('profil.update-password');

        // Pendaftaran Sertifikasi
        Route::get('/sertifikasi/create', function () { return view('peserta.sertifikasi.create'); })->name('sertifikasi.create');
        Route::post('/sertifikasi', function () { return redirect()->route('peserta.dashboard')->with('success', 'Pendaftaran sertifikasi berhasil dikirim!'); })->name('sertifikasi.store');

        // Jadwal Uji
        Route::get('/jadwal', function () {
            $user = Auth::user();
            $jadwals = Jadwal::with(['skema', 'asesor'])
                ->where('kelas', $user->kelas)
                ->orderBy('tanggal')
                ->get();

            return view('peserta.jadwal.index', compact('user', 'jadwals'));
        })->name('jadwal.index');

        // Absensi QR Code
        Route::get('/absensi', function () {
            $user = Auth::user();
            $nextJadwal = Jadwal::with(['skema', 'asesor'])
                ->where('kelas', $user->kelas)
                ->whereDate('tanggal', '>=', now()->toDateString())
                ->orderBy('tanggal')
                ->first();

            $attendance = null;
            if ($nextJadwal) {
                $attendance = Absensi::where('user_id', $user->id)
                    ->where('jadwal_id', $nextJadwal->id)
                    ->first();
            }

            return view('peserta.absensi.absensi', compact('user', 'nextJadwal', 'attendance'));
        })->name('absensi');

        Route::post('/absensi/scan', function (Request $request) {
            $request->validate([
                'qr_data' => ['required', 'string'],
            ]);

            $user = Auth::user();
            $qrData = trim($request->input('qr_data'));

            if (!str_starts_with($qrData, 'Absensi_')) {
                return redirect()->route('peserta.absensi')->with('error', 'QR Code tidak valid.');
            }

            $parts = explode('_', $qrData, 4);
            if (count($parts) < 4) {
                return redirect()->route('peserta.absensi')->with('error', 'QR Code tidak valid.');
            }

            [$prefix, $qrUserId, $kodeJadwal, $qrUsername] = $parts;

            if (!ctype_digit($qrUserId) || (int) $qrUserId !== $user->id) {
                return redirect()->route('peserta.absensi')->with('error', 'QR Code ini tidak untuk akun Anda.');
            }

            $jadwal = Jadwal::where('kode_jadwal', $kodeJadwal)->first();
            if (! $jadwal) {
                return redirect()->route('peserta.absensi')->with('error', 'Jadwal tidak ditemukan untuk QR ini.');
            }

            if ($jadwal->kelas !== $user->kelas) {
                return redirect()->route('peserta.absensi')->with('error', 'QR Code ini bukan untuk kelas Anda.');
            }

            $attendance = Absensi::where('user_id', $user->id)
                ->where('jadwal_id', $jadwal->id)
                ->first();

            if (! $attendance) {
                $attendance = Absensi::create([
                    'user_id' => $user->id,
                    'jadwal_id' => $jadwal->id,
                    'status' => 'Hadir',
                    'check_in' => now()->format('H:i'),
                    'keterangan' => null,
                ]);

                return redirect()->route('peserta.absensi')->with('success', 'Check-in berhasil direkam!');
            }

            if ($attendance && ! $attendance->check_out) {
                $attendance->check_out = now()->format('H:i');
                $attendance->status = 'Selesai';
                $attendance->save();

                return redirect()->route('peserta.absensi')->with('success', 'Check-out berhasil. Ujian selesai.');
            }

            return redirect()->route('peserta.absensi')->with('error', 'Anda telah selesai mengikuti ujian; scan tidak diperbolehkan.');
        })->name('absensi.scan');

        // Hasil Penilaian
        Route::get('/hasil-penilaian', function () {
            $user = Auth::user();
            $penilaian = Penilaian::with(['jadwal.skema', 'asesor'])
                ->where('user_id', $user->id)
                ->latest('tanggal')
                ->first();

            return view('peserta.penilaian.index', compact('user', 'penilaian'));
        })->name('penilaian.index');
});
