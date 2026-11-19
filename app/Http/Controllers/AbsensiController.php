<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\SesiAbsensi;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class AbsensiController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Akun ini belum terhubung dengan data guru.');
        }

        $sesi = SesiAbsensi::with('kelas')
            ->where('guru_id', $guru->id)
            ->whereDate('tanggal', today())
            ->latest()
            ->get();

        return view('absensi.index', compact('sesi'));
    }

    public function siswa(int $id)
    {
        $sesi = SesiAbsensi::with([
            'kelas',
            'guru',
            'mataPelajaran'
        ])->findOrFail($id);

        $absensi = Absensi::with('siswa')
            ->where('sesi_absensi_id', $sesi->id)
            ->orderBy('waktu_absen')
            ->get();

        return view('absensi.siswa', compact('sesi', 'absensi'));
    }

    public function simpan(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $sesi = SesiAbsensi::findOrFail($id);

        if ($sesi->status !== 'dibuka') {
            return back()->with('error', 'Sesi absensi sudah ditutup.');
        }

        DB::transaction(function () use ($request, $sesi) {
            foreach ($request->status as $siswaId => $status) {
                Absensi::updateOrCreate(
                    [
                        'sesi_absensi_id' => $sesi->id,
                        'siswa_id' => $siswaId,
                    ],
                    [
                        'waktu_absen' => now(),
                        'status' => $status,
                        'metode' => 'langsung',
                    ]
                );
            }
        });

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Absensi berhasil disimpan.');
    }

    public function edit(int $id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Akun ini bukan akun guru.');
        }

        $sesi = SesiAbsensi::where('guru_id', $guru->id)
            ->findOrFail($id);

        $kelas = Kelas::orderBy('nama_kelas')->get();
        $mataPelajaran = MataPelajaran::orderBy('nama')->get();

        return view('absensi.edit', compact(
            'sesi',
            'kelas',
            'mataPelajaran'
        ));
    }

    public function update(Request $request, int $id)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Akun ini bukan akun guru.');
        }

        $sesi = SesiAbsensi::where('guru_id', $guru->id)
            ->findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $sesi->update([
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Sesi absensi berhasil diperbarui.');
    }

    public function manual()
    {
        $mataPelajaran = MataPelajaran::orderBy('nama')->get();

        $gambarMapel = [
            'Matematika' => 'Mathematics School Supplies Folder.png',
            'Pend.Agama Islam dan Budi Pekerti' => 'Islamic Essentials Organizer Icon.png',
            'Prakarya Kerajinan' => 'Lavender Craft Organizer with Supplies.png',
            'Sosiologi (IPS)' => 'Sociology Study Folder Sticker.png',
            'Bahasa Indonesia' => 'Indonesian Language Learning Folder.png',
            'Fisika (IPA)' => 'Physics folder with science essentials.png',
            'Informatika' => '3D IT Tools Folder Icon.png',
            'Seni dan Budaya (Seni Rupa)' => 'Colorful Art and Culture Folder.png',
            'Pend. Pancasila' => 'Pancasila Heritage Folder Illustration.png',
            'Mulok' => 'Cultural Heritage Collage Folder.png',
            'PJOK' => 'Colorful PJOK Sports Folder Icon.png',
            'Kimia (IPA)' => 'Colorful 3D Chemistry Folder.png',
            'Prakarya Budi Daya' => 'Colorful Gardening Craft Supply Basket.png',
            'Prakarya Pengolahan' => 'Cooking Essentials Recipe Folder.png',
            'Bimbingan dan Konseling' => 'Sociology Study Folder Sticker.png',
            'Geografi' => 'Geography Explorer Folder Organizer.png',
            'Sejarah (IPS)' => 'History Organizer with Indonesian Heritage Elements.png',
            'Biologi (IPA)' => 'Vibrant Biology Lab Folder Cluster.png',
            'Ekonomi (IPS)' => 'Colorful Finance and Economy Box.png',
            'Ekonomi Mapel Pilihan' => 'Colorful Finance and Economy Box.png',
            'Matematika Tingkat Lanjut' => 'Mathematics School Supplies Folder.png',
            'Sosiologi Mapel Pilihan' => 'Sociology Study Folder Sticker.png',
            'Bahasa Indonesia Tingkat Lanjut' => 'Indonesian Language Learning Folder.png',
            'Kimia Mapel Pilihan' => 'Colorful 3D Chemistry Folder.png',
            'Biologi Mapel Pilihan' => 'Vibrant Biology Lab Folder Cluster.png',
            'Bahasa Inggris' => 'Indonesian Language Learning Folder.png',
        ];

        return view('absensi.manual', compact('mataPelajaran', 'gambarMapel'));
    }

    public function manualKelas($mapel)
    {
        $mataPelajaran = MataPelajaran::findOrFail($mapel);
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('absensi.manual-kelas', compact('mataPelajaran', 'kelas'));
    }

    public function manualSiswa($mapel, $kelas)
    {
        $mataPelajaran = MataPelajaran::findOrFail($mapel);
        $kelas = Kelas::with(['siswa' => function ($query) {
            $query->orderBy('nama');
        }])->findOrFail($kelas);

        return view('absensi.manual-siswa', compact('mataPelajaran', 'kelas'));
    }

    public function manualSimpan(Request $request)
    {
        $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'required|array',
            'status.*' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Akun ini belum terhubung dengan data guru.');
        }

        $siswaIds = Siswa::where('kelas_id', $request->kelas_id)
            ->pluck('id')
            ->toArray();

        $statusIds = array_map('intval', array_keys($request->status));

        if (array_diff($statusIds, $siswaIds)) {
            return back()->with('error', 'Terdapat siswa yang tidak sesuai dengan kelas.');
        }

        DB::transaction(function () use ($request, $guru) {

            $sesi = SesiAbsensi::create([
                'kelas_id' => $request->kelas_id,
                'guru_id' => $guru->id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'tanggal' => today(),
                'jam_mulai' => now()->format('H:i:s'),
                'jam_selesai' => now()->format('H:i:s'),
                'status' => 'ditutup',
                'kode_absensi' => null,
            ]);

            foreach ($request->status as $siswaId => $status) {
                Absensi::updateOrCreate(
                    [
                        'sesi_absensi_id' => $sesi->id,
                        'siswa_id' => $siswaId,
                    ],
                    [
                        'waktu_absen' => now(),
                        'status' => $status,
                        'metode' => 'manual_guru',
                    ]
                );
            }
        });

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Absensi manual berhasil disimpan.');
    }

    public function create()
    {
        $kelas = Kelas::all();
        $mataPelajaran = MataPelajaran::all();

        return view('absensi.create', compact('kelas', 'mataPelajaran'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $user = Auth::user();
        $guru = $user->guru;

        if (!$guru) {
            return back()->with(
                'error',
                'Akun ini belum terhubung dengan data guru.'
            );
        }

        do {
            $kodeAbsensi = strtoupper(Str::random(6));
        } while (
            SesiAbsensi::where('kode_absensi', $kodeAbsensi)->exists()
        );

        SesiAbsensi::create([
            'kelas_id' => $request->kelas_id,
            'guru_id' => $guru->id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'dibuka',
            'kode_absensi' => $kodeAbsensi,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Sesi absensi berhasil dibuat. Kode: ' . $kodeAbsensi);
    }

}