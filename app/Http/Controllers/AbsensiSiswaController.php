<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\SesiAbsensi;

class AbsensiSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())
            ->firstOrFail();

        return view('siswa.absensi', compact('siswa'));
    }

    public function cekKode(Request $request)
    {
        $request->validate([
            'kode_absensi' => 'required|string|max:10',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())
            ->firstOrFail();

        $kode = strtoupper(trim($request->kode_absensi));

        $sesi = SesiAbsensi::with([
            'kelas',
            'guru',
            'mataPelajaran'
        ])
            ->where('kode_absensi', $kode)
            ->first();

        if (!$sesi) {
            return back()->with('error', 'Kode absensi tidak ditemukan.');
        }

        if ($sesi->status !== 'dibuka') {
            return back()->with('error', 'Sesi absensi sudah ditutup.');
        }

        if ($sesi->tanggal->format('Y-m-d') !== today()->format('Y-m-d')) {
            return back()->with('error', 'Kode absensi bukan untuk hari ini.');
        }

        $mulai = now()->parse(
            $sesi->tanggal->format('Y-m-d') . ' ' . $sesi->jam_mulai
        );

        $selesai = now()->parse(
            $sesi->tanggal->format('Y-m-d') . ' ' . $sesi->jam_selesai
        );

        if (now()->lt($mulai) || now()->gt($selesai)) {
            return back()->with(
                'error',
                'Waktu absensi belum dimulai atau sudah berakhir.'
            );
        }

        $sudahAbsen = Absensi::where('sesi_absensi_id', $sesi->id)
            ->where('siswa_id', $siswa->id)
            ->exists();

        if ($sudahAbsen) {
            return back()->with(
                'error',
                'Kamu sudah mengisi absensi pada sesi ini.'
            );
        }

        session([
            'kode_absensi' => $kode
        ]);

        return redirect()->route('siswa.absensi.form');
    }

    public function form()
    {
        $siswa = Siswa::where('user_id', Auth::id())
            ->firstOrFail();

        $kode = session('kode_absensi');

        if (!$kode) {
            return redirect()
                ->route('siswa.absensi')
                ->with('error', 'Silakan masukkan kode absensi terlebih dahulu.');
        }

        $sesi = SesiAbsensi::with([
            'kelas',
            'guru',
            'mataPelajaran'
        ])
            ->where('kode_absensi', $kode)
            ->first();

        if (!$sesi || $sesi->status !== 'dibuka') {
            session()->forget('kode_absensi');

            return redirect()
                ->route('siswa.absensi')
                ->with('error', 'Sesi absensi tidak ditemukan atau sudah ditutup.');
        }

        if ($sesi->tanggal->format('Y-m-d') !== today()->format('Y-m-d')) {
            session()->forget('kode_absensi');

            return redirect()
                ->route('siswa.absensi')
                ->with('error', 'Sesi absensi bukan untuk hari ini.');
        }

        $mulai = now()->parse(
            $sesi->tanggal->format('Y-m-d') . ' ' . $sesi->jam_mulai
        );

        $selesai = now()->parse(
            $sesi->tanggal->format('Y-m-d') . ' ' . $sesi->jam_selesai
        );

        if (now()->lt($mulai) || now()->gt($selesai)) {
            session()->forget('kode_absensi');

            return redirect()
                ->route('siswa.absensi')
                ->with('error', 'Waktu absensi sudah berakhir atau belum dimulai.');
        }

        $sudahAbsen = Absensi::where('sesi_absensi_id', $sesi->id)
            ->where('siswa_id', $siswa->id)
            ->exists();

        if ($sudahAbsen) {
            session()->forget('kode_absensi');

            return redirect()
                ->route('siswa.absensi')
                ->with('error', 'Kamu sudah mengisi absensi pada sesi ini.');
        }

        return view('siswa.form-absensi', compact('siswa', 'sesi'));
    }

    public function simpan(Request $request, int $id)
    {
        $siswa = Siswa::where('user_id', Auth::id())
            ->firstOrFail();

        $sesi = SesiAbsensi::findOrFail($id);

        $request->validate([
            'kode_absensi' => 'required|string',
        ]);

        if (
            strtoupper(trim($request->kode_absensi)) !==
            strtoupper($sesi->kode_absensi ?? '')
        ) {
            abort(403, 'Kode absensi tidak sesuai.');
        }

        if (
            strtoupper(trim($request->kode_absensi)) !==
            strtoupper(session('kode_absensi', ''))
        ) {
            abort(403, 'Kode absensi tidak sesuai dengan sesi yang diperiksa.');
        }

        if ($sesi->status !== 'dibuka') {
            return back()->with('error', 'Sesi absensi sudah ditutup.');
        }

        if ($sesi->tanggal->format('Y-m-d') !== today()->format('Y-m-d')) {
            return back()->with('error', 'Sesi absensi bukan untuk hari ini.');
        }

        $mulai = now()->parse(
            $sesi->tanggal->format('Y-m-d') . ' ' . $sesi->jam_mulai
        );

        $selesai = now()->parse(
            $sesi->tanggal->format('Y-m-d') . ' ' . $sesi->jam_selesai
        );

        if (now()->lt($mulai) || now()->gt($selesai)) {
            return back()->with(
                'error',
                'Waktu absensi sudah berakhir atau belum dimulai.'
            );
        }

        if (
            Absensi::where('sesi_absensi_id', $sesi->id)
                ->where('siswa_id', $siswa->id)
                ->exists()
        ) {
            session()->forget('kode_absensi');

            return redirect()
                ->route('siswa.absensi')
                ->with('error', 'Kamu sudah mengisi absensi.');
        }

        $request->validate([
            'status' => 'required|in:hadir,izin,sakit',
            'bukti_sakit' => [
                'required_if:status,sakit',
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ], [
            'status.required' => 'Silakan pilih status kehadiran.',
            'bukti_sakit.required_if' => 'Foto surat sakit wajib dilampirkan.',
            'bukti_sakit.image' => 'Lampiran harus berupa gambar.',
            'bukti_sakit.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'bukti_sakit.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $path = null;

        if ($request->hasFile('bukti_sakit')) {
            $path = $request->file('bukti_sakit')
                ->store('surat-sakit', 'public');
        }

        try {
            DB::transaction(function () use (
                $sesi,
                $siswa,
                $request,
                $path
            ) {
                Absensi::create([
                    'sesi_absensi_id' => $sesi->id,
                    'siswa_id' => $siswa->id,
                    'waktu_absen' => now(),
                    'status' => $request->status,
                    'metode' => 'langsung',
                    'bukti_sakit' => $path,
                    'latitude' => null,
                    'longitude' => null,
                ]);
            });
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            throw $e;
        }

        session()->forget('kode_absensi');

        return redirect()
            ->route('siswa.absensi')
            ->with('success', 'Absensi berhasil dikirim.');
    }

    public function riwayat()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Data siswa belum terhubung dengan akun ini.'
                );
        }

        $riwayat = Absensi::with([
            'sesiAbsensi.mataPelajaran',
            'sesiAbsensi.guru'
        ])
            ->where('siswa_id', $siswa->id)
            ->orderByDesc('waktu_absen')
            ->paginate(15);

        return view('siswa.riwayat-absensi', compact(
            'siswa',
            'riwayat'
        ));
    }
}