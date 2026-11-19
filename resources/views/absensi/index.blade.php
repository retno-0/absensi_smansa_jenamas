@extends('layouts.app')

@section('title', 'Data Absensi')
@section('page-heading', 'Data Absensi')
@section('page-description', 'Kelola dan pantau sesi absensi siswa.')

@section('content')
<div class="dash-content">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="dash-welcome">
        <div>
            <h2>Daftar Sesi Absensi</h2>
            <p>Kelola sesi dan pantau kehadiran siswa.</p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('absensi.manual') }}"
            class="btn btn-primary"
            style="text-decoration:none;">
                + Absensi Manual
            </a>

            <a href="{{ route('absensi.create') }}"
            class="btn btn-primary"
            style="text-decoration:none;">
                + Buat Sesi Absensi
            </a>
        </div>
    </div>

    <div class="dash-card" style="margin-top:25px; padding:20px;">
        <h3 class="dash-section-title">Sesi Absensi Hari Ini</h3>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Kode Absensi</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sesi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                            <td>
                                <strong>{{ $item->kode_absensi }}</strong>
                            </td>
                            <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_selesai }}</td>
                            <td>{{ ucfirst($item->status) }}</td>
                            <td>
                                <div style="display:flex; gap:8px; flex-wrap:wrap;">

                                    <a href="{{ route('absensi.edit', $item->id) }}"
                                    class="btn btn-primary"
                                    style="text-decoration:none;">
                                        Edit
                                    </a>

                                    <a href="{{ route('absensi.siswa', $item->id) }}"
                                    class="btn btn-primary"
                                    style="text-decoration:none;">
                                        Lihat Rekap
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8"
                                style="text-align:center; padding:30px;">
                                Belum ada sesi absensi hari ini.
                                <br>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection