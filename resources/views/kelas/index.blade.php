@extends('layouts.app')

@section('title', 'Data Kelas')
@section('page-heading', 'Data Kelas')
@section('page-description', 'Kelola dan lihat daftar kelas SMAN 1 Jenamas.')

@section('content')

<div class="dash-content">

    {{-- Banner --}}
    <div class="dash-welcome">
        <div>
            <h2>Daftar Kelas</h2>
            <p>Informasi kelas yang tersedia di SMAN 1 Jenamas.</p>
        </div>
    </div>

    {{-- Kelompok kelas --}}
    @php
        $kelompokKelas = [
            'X' => $kelas->filter(fn($item) =>
                preg_match('/^X\s/', $item->nama_kelas)
            ),
            'XI' => $kelas->filter(fn($item) =>
                preg_match('/^XI\s/', $item->nama_kelas)
            ),
            'XII' => $kelas->filter(fn($item) =>
                preg_match('/^XII\s/', $item->nama_kelas)
            ),
        ];
    @endphp

    <h3 class="dash-section-title">Ringkasan Kelas</h3>

    <div class="kelas-summary-grid">

        @foreach($kelompokKelas as $tingkat => $daftar)

            <div class="kelas-summary-card">
                <div class="kelas-summary-icon">
                    <i class="fas fa-school"></i>
                </div>

                <div>
                    <p>Kelas {{ $tingkat }}</p>
                    <h2>{{ $daftar->count() }}</h2>
                    <span>Kelas terdaftar</span>
                </div>
            </div>

        @endforeach

    </div>

    <div class="kelas-heading">
        <div>
            <h3>Daftar Kelas</h3>
            <p>Seluruh kelas yang tersedia di sekolah.</p>
        </div>

        <div class="kelas-total">
            Total {{ $kelas->count() }} Kelas
        </div>
    </div>

    <div class="kelas-folder-grid">

        @foreach($kelompokKelas as $tingkat => $daftar)

            <div class="kelas-folder-card">

                <div class="kelas-folder-header">

                    <div class="kelas-folder-icon">
                        <i class="fas fa-book-open"></i>
                    </div>

                    <div>
                        <h3>Kelas {{ $tingkat }}</h3>
                        <p>{{ $daftar->count() }} kelas tersedia</p>
                    </div>

                </div>

                <div class="kelas-folder-list">

                    @forelse($daftar as $item)

                        <div class="kelas-folder-item">
                            <span>{{ $item->nama_kelas }}</span>
                            <i class="fas fa-check-circle"></i>
                        </div>

                    @empty

                        <p class="kelas-empty">
                            Belum ada kelas.
                        </p>

                    @endforelse

                </div>

                <div class="kelas-folder-footer">
                    SMAN 1 Jenamas
                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection