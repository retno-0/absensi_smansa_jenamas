@extends('layouts.app')

@section('title', 'Rekap Absensi Siswa')
@section('page-heading', 'Rekap Absensi Siswa')
@section('page-description', 'Daftar siswa yang sudah mengisi absensi.')

@section('content')
<div class="dash-content">

    <div class="dash-welcome">
        <div>
            <h2>Rekap Absensi Siswa</h2>
            <p>
                Kelas: {{ $sesi->kelas->nama_kelas ?? '-' }}<br>
                Mata Pelajaran: {{ $sesi->mataPelajaran->nama ?? '-' }}<br>
                Tanggal: {{ $sesi->tanggal->format('d-m-Y') }}
            </p>
        </div>
    </div>

    <div class="dash-card" style="padding:20px; margin-top:20px;">

        <h3 class="dash-section-title">Daftar Kehadiran Siswa</h3>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f3efff; color:#6855ed;">
                        <th style="padding:14px; text-align:left;">No</th>
                        <th style="padding:14px; text-align:left;">Nama Siswa</th>
                        <th style="padding:14px; text-align:left;">NISN</th>
                        <th style="padding:14px; text-align:left;">Status</th>
                        <th style="padding:14px; text-align:left;">Waktu Absen</th>
                        <th style="padding:14px; text-align:left;">Bukti Sakit</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($absensi as $item)
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:14px;">{{ $loop->iteration }}</td>
                            <td style="padding:14px;">
                                {{ $item->siswa->nama ?? '-' }}
                            </td>
                            <td style="padding:14px;">
                                {{ $item->siswa->nisn ?? '-' }}
                            </td>
                            <td style="padding:14px;">
                                {{ ucfirst($item->status) }}
                            </td>
                            <td style="padding:14px;">
                                {{ $item->waktu_absen
                                    ? $item->waktu_absen->format('H:i')
                                    : '-' }}
                            </td>
                            <td style="padding:14px;">
                                @if($item->bukti_sakit)
                                    <a href="{{ asset('storage/' . $item->bukti_sakit) }}"
                                       target="_blank">
                                        Lihat Bukti
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                style="padding:25px; text-align:center;">
                                Belum ada siswa yang mengisi absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <a href="{{ route('siswa.dashboard') }}"
    class="btn-kembali-absensi">
        <span>←</span>
        Kembali
    </a>

</div>
@endsection