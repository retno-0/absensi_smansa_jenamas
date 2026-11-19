@extends('layouts.app')

@section('title', 'Absensi Manual Siswa')
@section('page-heading', 'Absensi Manual')
@section('page-description', 'Isi kehadiran siswa berdasarkan kelas.')

@section('content')
<div class="dash-content">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="dash-welcome">
        <div>
            <h2>{{ $mataPelajaran->nama }} - {{ $kelas->nama_kelas }}</h2>
            <p>Atur status kehadiran setiap siswa.</p>
        </div>

        <a href="{{ route('absensi.manual.kelas', $mataPelajaran->id) }}"
           class="btn btn-primary"
           style="text-decoration:none;">
            Kembali
        </a>
    </div>

    <div class="dash-card" style="margin-top:25px; padding:20px;">

        <form action="{{ route('absensi.manual.simpan') }}" method="POST">
            @csrf

            <input type="hidden" name="mata_pelajaran_id" value="{{ $mataPelajaran->id }}">
            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kelas->siswa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nama }}</td>

                                <td>
                                    <select name="status[{{ $item->id }}]"
                                            class="status-absensi"
                                            required>
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpa">Alpa</option>
                                    </select>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; padding:25px;">
                                    Belum ada siswa di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($kelas->siswa->count() > 0)
                <div style="margin-top:20px; display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary">
                        Simpan Absensi
                    </button>
                </div>
            @endif

        </form>
    </div>
</div>
@endsection