<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanExport;
use App\Exports\AbsensiGuruExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('absensi')
            ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->join('sesi_absensi', 'absensi.sesi_absensi_id', '=', 'sesi_absensi.id')
            ->join('kelas', 'sesi_absensi.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.nisn',
                'siswa.nama',
                'kelas.nama_kelas',
                'sesi_absensi.tanggal',
                'absensi.status'
            );

        if ($request->filled('tanggal')) {
            $query->whereDate('sesi_absensi.tanggal', $request->tanggal);
        }

        if ($request->filled('kelas_id')) {
            $query->where('kelas.id', $request->kelas_id);
        }

        $laporan = $query
            ->orderBy('sesi_absensi.tanggal', 'desc')
            ->orderBy('kelas.nama_kelas')
            ->orderBy('siswa.nama')
            ->get();

        $kelas = DB::table('kelas')->orderBy('nama_kelas')->get();

        return view('laporan.index', compact('laporan', 'kelas'));
    }

    public function export(Request $request)
{
    $request->validate([
        'tanggal' => 'nullable|date',
        'kelas_id' => 'nullable|integer|exists:kelas,id',
    ]);

    $tanggal = $request->filled('tanggal')
        ? $request->tanggal
        : null;

    $kelasId = $request->filled('kelas_id')
        ? (int) $request->kelas_id
        : null;

    return Excel::download(
        new LaporanExport($tanggal, $kelasId),
        'Laporan_Absensi_' . date('Y-m-d') . '.xlsx'
    );
    }

    public function exportAbsensiGuru(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
        ]);

        return Excel::download(
            new AbsensiGuruExport(
                $request->tanggal_awal,
                $request->tanggal_akhir
            ),
            'Rekap_Absensi_Guru_' . date('Y-m-d') . '.xlsx'
        );
    }
}