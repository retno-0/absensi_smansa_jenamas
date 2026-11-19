@extends('layouts.app')

@section('title', 'Dashboard - Absensi SMAN 1 Jenamas')
@section('page-heading', 'Dashboard')
@section('page-description', 'Selamat datang di sistem informasi absensi sekolah.')

@section('content')

<div class="dash-content">

    <div class="dash-welcome">
        <div>
            <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p>
                Kelola data dan kegiatan absensi SMAN 1 Jenamas melalui halaman ini.
            </p>
        </div>
    </div>

    <h3 class="dash-section-title">Ringkasan Data</h3>

    <div class="dash-stat-grid">

        <div class="dash-stat-card">
            <div class="dash-stat-icon blue">♙</div>
            <div>
                <p>Total Siswa</p>
                <h2>{{ $jumlahSiswa }}</h2>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-icon green">♧</div>
            <div>
                <p>Total Guru</p>
                <h2>{{ $jumlahGuru }}</h2>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-icon orange">▤</div>
            <div>
                <p>Total Kelas</p>
                <h2>{{ $jumlahKelas }}</h2>
            </div>
        </div>

    </div>

    <div class="dash-info-card">
        <h3>Informasi Sistem</h3>
        <p>
            Sistem informasi absensi SMAN 1 Jenamas digunakan
            untuk membantu pengelolaan data siswa, guru,
            kelas, dan kegiatan kehadiran.
        </p>
    </div>

</div>

@endsection