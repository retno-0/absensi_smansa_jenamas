@extends('layouts.app')

@section('title', 'Absensi Manual')
@section('page-heading', 'Absensi Manual')
@section('page-description', 'Pilih mata pelajaran untuk mengisi absensi siswa.')

@section('content')
<div class="dash-content">

    <div class="dash-welcome">
        <div>
            <h2>Pilih Mata Pelajaran</h2>
            <p>Pilih mata pelajaran untuk melanjutkan absensi manual.</p>
        </div>

        <a href="{{ route('absensi.index') }}"
           class="btn btn-primary"
           style="text-decoration:none;">
            Kembali
        </a>
    </div>

    <div class="mapel-grid">

        @foreach($mataPelajaran as $mapel)

            @php
                $gambar = $gambarMapel[$mapel->nama] ?? null;
            @endphp

            <a href="{{ route('absensi.manual.kelas', $mapel->id) }}"
               class="mapel-card">

                <div class="mapel-image">
                    @if($gambar)
                        <img src="{{ asset('images/mapel/' . $gambar) }}"
                             alt="{{ $mapel->nama }}">
                    @else
                        <div class="mapel-no-image">
                            📚
                        </div>
                    @endif
                </div>

                <div class="mapel-name">
                    {{ $mapel->nama }}
                </div>

            </a>

        @endforeach

    </div>

</div>
@endsection