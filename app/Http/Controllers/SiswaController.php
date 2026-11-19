<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('kelas')
            ->orderBy('nama', 'asc')
            ->paginate(15);

        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();

        return view('siswa.index', compact('siswa', 'kelas'));
    }

    public function updateKelas(Request $request, int $id)
    {
        abort_unless(Auth::user()->role === 'admin', 403);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Kelas siswa berhasil diperbarui.');
    }
}