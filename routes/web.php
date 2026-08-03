<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ==========================================
// AUTHENTICATION ROUTES
// ==========================================
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('admin.dashboard');
})->name('login.post');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});


// ==========================================
// ADMIN ROUTES
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Manajemen User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', function () { return view('admin.referensi.user.index'); })->name('index');
        Route::get('/create', function () { return view('admin.referensi.user.create'); })->name('create');
        Route::post('/', function () { return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!'); })->name('store');
        Route::get('/{id}', function ($id) { return view('admin.referensi.user.show', compact('id')); })->name('show');
        Route::get('/{id}/edit', function ($id) { return view('admin.referensi.user.edit', compact('id')); })->name('edit');
        Route::get('/{id}/toggle-status', function ($id) { return redirect()->route('admin.user.index')->with('success', 'Status user berhasil diubah!'); })->name('toggle-status');
        Route::delete('/{id}', function ($id) { return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!'); })->name('destroy');
    });

    // CRUD Data Peserta
    Route::prefix('peserta')->name('peserta.')->group(function () {
        Route::get('/', function () { return view('admin.peserta.index'); })->name('index');
        Route::get('/create', function () { return view('admin.peserta.create'); })->name('create');
        Route::get('/edit', function () { return view('admin.peserta.edit'); })->name('edit');
        Route::get('/{id}', function () { return view('admin.peserta.show'); })->name('show');
    });

    // CRUD Data Asesor
    Route::prefix('asesor')->name('asesor.')->group(function () {
        Route::get('/', function () { return view('admin.asesor.index'); })->name('index');
        Route::get('/create', function () { return view('admin.asesor.create'); })->name('create');
        Route::post('/', function () { return redirect()->route('admin.asesor.index')->with('success', 'Data asesor berhasil ditambahkan!'); })->name('store');
        Route::get('/{id}', function ($id) { return view('admin.asesor.show', compact('id')); })->name('show');
        Route::get('/{id}/edit', function ($id) { return view('admin.asesor.edit', compact('id')); })->name('edit');
        Route::put('/{id}', function ($id) { return redirect()->route('admin.asesor.index')->with('success', 'Data asesor berhasil diperbarui!'); })->name('update');
        Route::delete('/{id}', function ($id) { return redirect()->route('admin.asesor.index')->with('success', 'Data asesor berhasil dihapus!'); })->name('destroy');
    });

    // CRUD Data Skema Sertifikasi
    Route::prefix('skema')->name('skema.')->group(function () {
        Route::get('/', function () { return view('admin.skema.index'); })->name('index');
        Route::get('/create', function () { return view('admin.skema.create'); })->name('create');
        Route::post('/', function () { return redirect()->route('admin.skema.index')->with('success', 'Skema sertifikasi berhasil ditambahkan!'); })->name('store');
        Route::get('/{id}', function ($id) { return view('admin.skema.show', compact('id')); })->name('show');
        Route::get('/{id}/edit', function ($id) { return view('admin.skema.edit', compact('id')); })->name('edit');
        Route::put('/{id}', function ($id) { return redirect()->route('admin.skema.index')->with('success', 'Skema sertifikasi berhasil diperbarui!'); })->name('update');
        Route::delete('/{id}', function ($id) { return redirect()->route('admin.skema.index')->with('success', 'Skema sertifikasi berhasil dihapus!'); })->name('destroy');
    });

    // Fitur Sertifikasi Admin
    Route::prefix('sertifikasi')->name('sertifikasi.')->group(function () {
        
        // Jadwal Uji Kompetensi
        Route::prefix('jadwal')->name('jadwal.')->group(function () {
            Route::get('/', function () { return view('admin.sertifikasi.jadwal.index'); })->name('index');
            Route::get('/create', function () { return view('admin.sertifikasi.jadwal.create'); })->name('create');
            Route::post('/', function () { return redirect()->route('admin.sertifikasi.jadwal.index')->with('success', 'Jadwal uji berhasil ditambahkan!'); })->name('store');
            Route::get('/{id}', function ($id) { return view('admin.sertifikasi.jadwal.show', compact('id')); })->name('show');
            Route::get('/{id}/edit', function ($id) { return view('admin.sertifikasi.jadwal.edit', compact('id')); })->name('edit');
            Route::put('/{id}', function ($id) { return redirect()->route('admin.sertifikasi.jadwal.index')->with('success', 'Jadwal uji berhasil diperbarui!'); })->name('update');
            Route::delete('/{id}', function ($id) { return redirect()->route('admin.sertifikasi.jadwal.index')->with('success', 'Jadwal uji berhasil dihapus!'); })->name('destroy');
        });

        // Penilaian (Hasil Asesmen)
        Route::prefix('penilaian')->name('penilaian.')->group(function () {
            Route::get('/', function () { return view('admin.sertifikasi.penilaian.index'); })->name('index');
            Route::get('/{id}', function ($id) { return view('admin.sertifikasi.penilaian.show', compact('id')); })->name('show');
        });

        // Absensi
        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('/', function () { return view('admin.sertifikasi.absensi.index'); })->name('index');
            Route::get('/edit', function () { return view('admin.sertifikasi.absensi.edit'); })->name('edit');
        });

        // Sertifikat
        Route::prefix('sertifikat')->name('sertifikat.')->group(function () {
            Route::get('/', function () { return view('admin.sertifikasi.sertifikat.index'); })->name('index');
            Route::get('/generate/{id}', function ($id) { return view('admin.sertifikasi.sertifikat.print', compact('id')); })->name('generate');
            Route::get('/edit/{id?}', function () { return view('admin.sertifikasi.sertifikat.edit'); })->name('edit');
            Route::get('/{id}', function ($id) { return view('admin.sertifikasi.sertifikat.show'); })->name('show');
        });
    });

    // Laporan Sistem
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/sistem', function () { return view('admin.laporan.sistem'); })->name('sistem');
    });

    // Pengaturan Sistem
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/', function () { return view('admin.pengaturan.index'); })->name('index');
    });

    // Profil Admin (Diperbarui dengan Dummy Data untuk Frontend)
    Route::get('/profil', function () { 
        $user = (object) [
            'name' => 'Administrator',
            'email' => 'admin@smkn1garut.sch.id',
            'created_at' => now()
        ];
        return view('admin.profil.index', compact('user')); 
    })->name('profil');

    Route::get('/profil/edit', function () { 
        $user = (object) [
            'name' => 'Administrator',
            'email' => 'admin@smkn1garut.sch.id'
        ];
        return view('admin.profil.edit', compact('user')); 
    })->name('profil.edit');

    Route::put('/profil/update', function () { 
        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!'); 
    })->name('profil.update');

    // Tambahan Route Ubah Password Admin
    Route::get('/profil/ubah-password', function () { 
        return view('admin.profil.ubah-password'); 
    })->name('profil.ubah-password');

    Route::put('/profil/update-password', function () { 
        return redirect()->route('admin.profil')->with('success', 'Password berhasil diperbarui!'); 
    })->name('profil.update-password');
});


// ==========================================
// ASESOR ROUTES
// ==========================================
Route::prefix('asesor')->name('asesor.')->group(function () {
    Route::get('/dashboard', function () { return view('asesor.dashboard'); })->name('dashboard');
    
    Route::get('/jadwal-asesmen', function () { return view('asesor.jadwal-asesmen'); })->name('jadwal-asesmen');
    Route::get('/jadwal-asesmen/{id}', function ($id) { return view('asesor.jadwal-asesmen-detail', compact('id')); })->name('jadwal-asesmen.detail');

    Route::get('/daftar-peserta', function () { return view('asesor.daftar-peserta'); })->name('daftar-peserta');
    Route::get('/daftar-peserta/{id}/detail', function ($id) { return view('asesor.daftar-peserta-detail', compact('id')); })->name('daftar-peserta.detail');

    Route::get('/verifikasi-kehadiran', function () { return view('asesor.verifikasi-kehadiran'); })->name('verifikasi-kehadiran');

    Route::prefix('input-penilaian')->name('input-penilaian.')->group(function () {
        Route::get('/', function () { return view('asesor.input-penilaian-index'); })->name('index');
        Route::get('/{id}/create', function ($id) { return view('asesor.input-penilaian-create', compact('id')); })->name('create');
        Route::get('/{id}/detail', function ($id) { return view('asesor.input-penilaian-detail', compact('id')); })->name('detail');
    }); 

    Route::get('/riwayat-penilaian', function () { return view('asesor.riwayat-penilaian'); })->name('riwayat-penilaian');
    Route::get('/riwayat-penilaian/{id}/detail', function ($id) { return view('asesor.riwayat-penilaian-detail', compact('id')); })->name('riwayat-penilaian.detail');

    // Profil & Pengaturan Asesor
    Route::get('/profil', function () { return view('asesor.profil'); })->name('profil');
    Route::get('/profil/edit', function () { return view('asesor.edit-profil'); })->name('profil.edit');
    Route::put('/profil/update', function () { 
        return redirect()->route('asesor.profil')->with('success', 'Profil berhasil diperbarui!'); 
    })->name('profil.update');
    Route::post('/profil/update-foto', function () { 
        return redirect()->route('asesor.profil')->with('success', 'Foto profil berhasil diperbarui!'); 
    })->name('profil.update-foto');
    Route::get('/profil/ubah-password', function () { 
        return view('asesor.ubah-password'); 
    })->name('profil.ubah-password');
    Route::put('/profil/update-password', function () { 
        return redirect()->route('asesor.profil')->with('success', 'Password berhasil diperbarui!'); 
    })->name('profil.update-password');
});


// ==========================================
// PESERTA ROUTES
// ==========================================
Route::prefix('peserta')->name('peserta.')->group(function () {
    
    // Dashboard & Profil
    Route::get('/dashboard', function () { return view('peserta.dashboard'); })->name('dashboard');
    Route::get('/profil', function () { return view('peserta.profil'); })->name('profil');
    
    // Route Edit Profil
    Route::get('/profil/edit', function () { return view('peserta.edit-profil'); })->name('profil.edit');
    Route::put('/profil/update', function () { 
        return redirect()->route('peserta.profil')->with('success', 'Profil berhasil diperbarui!'); 
    })->name('profil.update');

    Route::post('/profil/update-foto', function () { 
        return redirect()->route('peserta.profil')->with('success', 'Foto profil berhasil diperbarui!'); 
    })->name('profil.update-foto');

    // Route Ubah Password
    Route::get('/profil/ubah-password', function () { 
        return view('peserta.ubah-password'); 
    })->name('profil.ubah-password');

    Route::put('/profil/update-password', function () { 
        return redirect()->route('peserta.profil')->with('success', 'Password berhasil diperbarui!'); 
    })->name('profil.update-password');

    // Pendaftaran Sertifikasi
    Route::get('/sertifikasi/create', function () { return view('peserta.sertifikasi.create'); })->name('sertifikasi.create');
    Route::post('/sertifikasi', function () { return redirect()->route('peserta.dashboard')->with('success', 'Pendaftaran sertifikasi berhasil dikirim!'); })->name('sertifikasi.store');

    // Jadwal Uji
    Route::get('/jadwal', function () { return view('peserta.jadwal.index'); })->name('jadwal.index');

    // Absensi QR Code
    Route::get('/absensi', function () { return view('peserta.absensi.absensi'); })->name('absensi');
    Route::post('/absensi/scan', function () { return redirect()->route('peserta.absensi')->with('success', 'Absensi berhasil direkam!'); })->name('absensi.scan');

    // Hasil Penilaian
    Route::get('/hasil-penilaian', function () { return view('peserta.penilaian.index'); })->name('penilaian.index');

});