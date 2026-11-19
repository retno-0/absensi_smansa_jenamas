<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\SesiAbsensi;
use Carbon\Carbon;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        $siswa = Siswa::where('user_id', $user->id)
            ->firstOrFail();

        $riwayatKelas = $siswa->riwayatKelas()
            ->with('kelas')
            ->whereNull('tanggal_selesai')
            ->first();

        $kelasAktif = $riwayatKelas?->kelas;

        $daftarKelas = Kelas::orderBy('nama_kelas')->get();

        $jumlahHadir = Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'hadir')
            ->count();

        $jumlahIzin = Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'izin')
            ->count();

        $jumlahSakit = Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'sakit')
            ->count();

        $jumlahAlpa = Absensi::where('siswa_id', $siswa->id)
            ->where('status', 'alpa')
            ->count();

        $sesiHariIni = collect();

        if ($kelasAktif) {
            $sesiHariIni = SesiAbsensi::with([
                'kelas',
                'guru',
                'mataPelajaran'
            ])
                ->where('kelas_id', $kelasAktif->id)
                ->whereDate('tanggal', today())
                ->get();

            $sekarang = Carbon::now();

            foreach ($sesiHariIni as $sesi) {

                $absensi = Absensi::where('sesi_absensi_id', $sesi->id)
                    ->where('siswa_id', $siswa->id)
                    ->first();

                if ($absensi) {
                    $statusSiswa = ucfirst($absensi->status);

                } else {
                    $mulai = Carbon::parse(
                        $sesi->tanggal . ' ' . $sesi->jam_mulai
                    );

                    $selesai = Carbon::parse(
                        $sesi->tanggal . ' ' . $sesi->jam_selesai
                    );

                    if (
                        $sesi->status === 'ditutup' ||
                        $sekarang->gt($selesai)
                    ) {
                        $statusSiswa = 'Terlewat';

                    } elseif ($sekarang->lt($mulai)) {
                        $statusSiswa = 'Belum Dibuka';

                    } else {
                        $statusSiswa = 'Belum Absen';
                    }
                }

                $sesi->status_siswa = $statusSiswa;
            }
        }

        $jumlahBelumAbsen = $sesiHariIni
            ->where('status_siswa', 'Belum Absen')
            ->count();

        $jumlahTerlewat = $sesiHariIni
            ->where('status_siswa', 'Terlewat')
            ->count();

        return view('siswa.dashboard', compact(
            'siswa',
            'kelasAktif',
            'daftarKelas',
            'jumlahHadir',
            'jumlahIzin',
            'jumlahSakit',
            'jumlahAlpa',
            'jumlahBelumAbsen',
            'jumlahTerlewat',
            'sesiHariIni'
        ));
    }
}
