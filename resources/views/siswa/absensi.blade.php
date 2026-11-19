@extends('layouts.app')

@section('title', 'Absensi Siswa')
@section('page-heading', 'Absensi Siswa')
@section('page-description', 'Masukkan kode absensi yang diberikan oleh guru.')

@section('content')
<div class="dash-content">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="dash-welcome">
        <div>
            <h2>Absensi {{ $siswa->nama }}</h2>
            <p>Masukkan kode yang diberikan guru untuk mengisi kehadiran.</p>
        </div>
    </div>

    <div class="dash-card" style="max-width:600px; padding:25px;">
        <h3 class="dash-section-title">Masukkan Kode Absensi</h3>

        <form action="{{ route('siswa.absensi.cek-kode') }}" method="POST">
            @csrf

            <div style="margin:20px 0;">
                <label for="kode_absensi">Kode Absensi</label>
                <input
                    type="text"
                    name="kode_absensi"
                    id="kode_absensi"
                    class="form-control"
                    maxlength="10"
                    placeholder="Contoh: AB12CD"
                    value="{{ old('kode_absensi') }}"
                    required
                    style="margin-top:8px; text-transform:uppercase;"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                Periksa Kode
            </button>
        </form>
    </div>

</div>
@endsection