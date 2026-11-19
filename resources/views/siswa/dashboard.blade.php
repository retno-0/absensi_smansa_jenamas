@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('page-heading', 'Dashboard Siswa')
@section('page-description', 'Selamat datang di sistem absensi SMAN 1 Jenamas.')

@section('content')

<div class="dash-content">

    {{-- Sambutan siswa --}}
    <div class="dash-welcome">
        <div>
            <h2>Halo, {{ $siswa->nama }}!</h2>
            <p>Selamat datang di dashboard absensi SMAN 1 Jenamas.</p>
            <p>NISN: {{ $siswa->nisn }}</p>
            <p>Status: <strong style="color:#38a169;">Siswa Aktif</strong></p>
        </div>
    </div>

    {{-- Ringkasan absensi --}}
    <h3 class="dash-section-title">Ringkasan Absensi</h3>

    <div class="student-summary-grid">

        <div class="student-summary-card summary-hadir">
            <span>HADIR</span>
            <h2>{{ $jumlahHadir }}</h2>
            <p>Total kehadiran</p>
        </div>

        <div class="student-summary-card summary-izin">
            <span>IZIN</span>
            <h2>{{ $jumlahIzin }}</h2>
            <p>Total izin</p>
        </div>

        <div class="student-summary-card summary-sakit">
            <span>SAKIT</span>
            <h2>{{ $jumlahSakit }}</h2>
            <p>Total sakit</p>
        </div>

        <div class="student-summary-card summary-alpa">
            <span>ALPA</span>
            <h2>{{ $jumlahAlpa }}</h2>
            <p>Total alpa</p>
        </div>

        <div class="student-summary-card summary-belum">
            <span>BELUM ABSEN</span>
            <h2>{{ $jumlahBelumAbsen }}</h2>
            <p>Menunggu absensi</p>
        </div>

        <div class="student-summary-card summary-terlewat">
            <span>TERLEWAT</span>
            <h2>{{ $jumlahTerlewat }}</h2>
            <p>Waktu sudah berakhir</p>
        </div>

    </div>

    {{-- Absensi hari ini --}}
    <h3 class="dash-section-title" style="margin-top:30px;">
        Absensi Hari Ini
    </h3>

    <div class="dash-card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Jam</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sesiHariIni as $sesi)
                        <tr>
                            <td>{{ $sesi->mataPelajaran->nama ?? '-' }}</td>
                            <td>{{ $sesi->guru->nama ?? '-' }}</td>
                            <td>
                                {{ $sesi->jam_mulai }} -
                                {{ $sesi->jam_selesai }}
                            </td>
                            <td>
                                @php
                                    $statusClass = match($sesi->status_siswa) {
                                        'Hadir' => 'status-hadir',
                                        'Izin' => 'status-izin',
                                        'Sakit' => 'status-sakit',
                                        'Alpa', 'Terlewat' => 'status-alpa',
                                        default => 'status-belum',
                                    };
                                @endphp

                                <span class="student-status {{ $statusClass }}">
                                    {{ $sesi->status_siswa }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="report-empty">
                                Belum ada sesi absensi hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

{{-- Grafik ringkasan --}}
@php
    $totalGrafik = $jumlahHadir + $jumlahIzin + $jumlahSakit + $jumlahAlpa;

    $dataGrafik = [
        ['nama' => 'Hadir', 'jumlah' => $jumlahHadir, 'warna' => '#83cf68'],
        ['nama' => 'Izin', 'jumlah' => $jumlahIzin, 'warna' => '#efbd62'],
        ['nama' => 'Sakit', 'jumlah' => $jumlahSakit, 'warna' => '#69b5df'],
        ['nama' => 'Alpa', 'jumlah' => $jumlahAlpa, 'warna' => '#df8299'],
    ];
@endphp

<h3 class="dash-section-title" style="margin-top:30px;">
    Grafik Ringkasan Kehadiran
</h3>

<div class="dash-card student-chart-card">

    <div class="student-chart-heading">
        <div>
            <h3>Statistik Kehadiran</h3>
            <p>Perbandingan jumlah kehadiran berdasarkan status.</p>
        </div>

        <div class="student-chart-total">
            <span>Total</span>
            <strong>{{ $totalGrafik }}</strong>
        </div>
    </div>

    <div class="student-chart">

        @foreach($dataGrafik as $data)
            @php
                $persentase = $totalGrafik > 0
                    ? ($data['jumlah'] / $totalGrafik) * 100
                    : 0;
            @endphp

            <div class="student-chart-row">

                <div class="student-chart-label">
                    <span>{{ $data['nama'] }}</span>
                    <strong>{{ $data['jumlah'] }}</strong>
                </div>

                <div class="student-chart-track">
                    <div
                        class="student-chart-bar"
                        @style([
                            'width' => $persentase . '%',
                            'background-color' => $data['warna']
                        ])
                    ></div>
                </div>

                <small>{{ number_format($persentase, 1) }}%</small>

            </div>
        @endforeach

    </div>
</div>

</div>

@endsection