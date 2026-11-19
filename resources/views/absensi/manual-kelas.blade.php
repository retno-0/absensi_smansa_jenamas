@extends('layouts.app')

@section('title', 'Pilih Kelas')
@section('page-heading', 'Absensi Manual')
@section('page-description', 'Pilih kelas untuk mengisi absensi siswa.')

@section('content')
<div class="dash-content">

    <div class="dash-welcome">
        <div>
            <h2>{{ $mataPelajaran->nama }}</h2>
            <p>Pilih kelas yang akan diabsen.</p>
        </div>

        <a href="{{ route('absensi.manual') }}"
           class="btn btn-primary"
           style="text-decoration:none;">
            Kembali
        </a>
    </div>

    <div class="kelas-manual-grid">

        @forelse($kelas as $item)
            <a href="{{ route('absensi.manual.siswa', [
                    'mapel' => $mataPelajaran->id,
                    'kelas' => $item->id
                ]) }}"
               class="kelas-manual-card">

                <div class="kelas-manual-icon">
                    <span>🏫</span>
                </div>

                <div class="kelas-manual-name">
                    {{ $item->nama_kelas }}
                </div>

                <div class="kelas-manual-action">
                    
                </div>

            </a>
        @empty
            <p>Belum ada data kelas.</p>
        @endforelse

    </div>

</div>
@endsection