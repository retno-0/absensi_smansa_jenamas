<?php

namespace App\Http\Controllers;

use App\Models\AbsensiGuru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = $user?->guru;

        if (!$guru) {
            abort(403, 'Akun ini tidak terhubung dengan data guru.');
        }

        $hariIni = now()->toDateString();

        $absensiHariIni = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $hariIni)
            ->first();

        $riwayat = AbsensiGuru::where('guru_id', $guru->id)
            ->orderByDesc('tanggal')
            ->take(10)
            ->get();

        return view('guru.absensi', compact(
            'guru',
            'absensiHariIni',
            'riwayat'
        ));
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $user = Auth::user();
        $guru = $user?->guru;

        if (!$guru) {
            abort(403, 'Akun ini tidak terhubung dengan data guru.');
        }

        $absensi = AbsensiGuru::firstOrCreate(
            [
                'guru_id' => $guru->id,
                'tanggal' => now()->toDateString(),
            ]
        );

        if ($absensi->jam_masuk) {
            return back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
        }

        $absensi->update([
            'jam_masuk' => now(),
            'latitude_masuk' => $request->latitude,
            'longitude_masuk' => $request->longitude,
        ]);

        return back()->with('success', 'Absen masuk berhasil.');
    }

    public function pulang(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $user = Auth::user();
        $guru = $user?->guru;

        if (!$guru) {
            abort(403, 'Akun ini tidak terhubung dengan data guru.');
        }

        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', now()->toDateString())
            ->first();

        if (!$absensi || !$absensi->jam_masuk) {
            return back()->with('error', 'Anda belum melakukan absen masuk.');
        }

        if ($absensi->jam_pulang) {
            return back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
        }

        $absensi->update([
            'jam_pulang' => now(),
            'latitude_pulang' => $request->latitude,
            'longitude_pulang' => $request->longitude,
        ]);

        return back()->with('success', 'Absen pulang berhasil.');
    }
    
    public function rekap(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
        ]);

        $query = AbsensiGuru::with('guru');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        $rekap = $query->orderByDesc('tanggal')
            ->orderBy('guru_id')
            ->paginate(15)
            ->withQueryString();

        return view('laporan.absensi-guru', compact('rekap'));
    }
}
