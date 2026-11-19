<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\AbsensiSiswaController;

use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'jumlahSiswa' => DB::table('siswa')->count(),
        'jumlahGuru' => DB::table('guru')->count(),
        'jumlahKelas' => DB::table('kelas')->count(),
    ]);
})->middleware('auth')->name('dashboard');


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/siswa/dashboard', [DashboardSiswaController::class, 'index'])
        ->name('siswa.dashboard');

    Route::get('/siswa', [SiswaController::class, 'index'])
        ->name('siswa.index');

    Route::post('/siswa/{id}/kelas', [SiswaController::class, 'updateKelas'])
        ->name('siswa.updateKelas');

    Route::put('/siswa/{id}/kelas', function (Request $request, $id) {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = \App\Models\Siswa::findOrFail($id);

        $siswa->update([
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Kelas siswa berhasil diperbarui.');
    })->name('siswa.update-kelas');

    Route::get('/guru', [GuruController::class, 'index'])
    ->name('guru.index');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');

    Route::get('/absensi', [AbsensiController::class, 'index'])
        ->name('absensi.index');

    Route::get('/absensi/manual', [AbsensiController::class, 'manual'])
        ->name('absensi.manual');

    Route::get('/absensi/manual/{mapel}/kelas', [AbsensiController::class, 'manualKelas'])
        ->name('absensi.manual.kelas');

    Route::get('/absensi/manual/{mapel}/kelas/{kelas}', [AbsensiController::class, 'manualSiswa'])
        ->name('absensi.manual.siswa');

    Route::post('/absensi/manual/simpan', [AbsensiController::class, 'manualSimpan'])
        ->name('absensi.manual.simpan');

    Route::get('/absensi/{id}/siswa', [AbsensiController::class, 'siswa'])
        ->name('absensi.siswa');

    Route::post('/absensi/{id}/simpan', [AbsensiController::class, 'simpan'])
        ->name('absensi.simpan');

    Route::get('/absensi/create', [AbsensiController::class, 'create'])
        ->name('absensi.create');

    Route::post('/absensi/store', [AbsensiController::class, 'store'])
        ->name('absensi.store');

    Route::get('/absensi/{id}/edit', [AbsensiController::class, 'edit'])
        ->name('absensi.edit');

    Route::put('/absensi/{id}/update', [AbsensiController::class, 'update'])
        ->name('absensi.update');

    Route::get('/guru/absensi', [AbsensiGuruController::class, 'index'])
        ->name('guru.absensi');

    Route::post('/guru/absensi/masuk', [AbsensiGuruController::class, 'masuk'])
        ->name('guru.absensi.masuk');

    Route::post('/guru/absensi/pulang', [AbsensiGuruController::class, 'pulang'])
        ->name('guru.absensi.pulang');

    Route::get('/siswa/absensi', [AbsensiSiswaController::class, 'index'])
        ->name('siswa.absensi');

    Route::post('/siswa/absensi/cek-kode', [AbsensiSiswaController::class, 'cekKode'])
        ->name('siswa.absensi.cek-kode');

    Route::get('/siswa/absensi/form', [AbsensiSiswaController::class, 'form'])
        ->name('siswa.absensi.form');

    Route::post('/siswa/absensi/{id}/simpan', [AbsensiSiswaController::class, 'simpan'])
        ->name('siswa.absensi.simpan');

    Route::get('/siswa/riwayat-absensi',
    [AbsensiSiswaController::class, 'riwayat']
        )->name('siswa.riwayat');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/export', [LaporanController::class, 'export'])
        ->name('laporan.export');

    Route::get('/laporan/absensi-guru/export',
    [LaporanController::class, 'exportAbsensiGuru']
        )->name('laporan.absensi-guru.export');
    
    Route::get('/admin/rekap-absensi-guru',
    [AbsensiGuruController::class, 'rekap']
        )->name('admin.rekap-absensi-guru');

    Route::get('/laporan/absensi-guru',
    [AbsensiGuruController::class, 'rekap']
        )->name('laporan.absensi-guru');

    Route::get('/laporan/absensi-guru/export',
    [LaporanController::class, 'exportAbsensiGuru']
        )->name('laporan.absensi-guru.export');
});
