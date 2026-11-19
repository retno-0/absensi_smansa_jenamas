@extends('layouts.app')

@section('title', 'Rekap Absensi Guru')
@section('page-heading', 'Rekap Absensi Guru')
@section('page-description', 'Rekap dan pantau data kehadiran guru SMAN 1 Jenamas.')

@section('content')

<div class="dash-content">

    <div class="report-heading">
        <div>
            <h1>Rekap Absensi Guru</h1>
            <p>Rekap dan pantau data kehadiran guru SMAN 1 Jenamas.</p>
        </div>

        <a href="{{ route('laporan.absensi-guru.export', request()->query()) }}"
           class="btn-excel">
            📥 Export Excel
        </a>
    </div>

    <div class="report-filter-card">
        <h3>Filter Rekap Absensi</h3>

        <form method="GET"
              action="{{ route('laporan.absensi-guru') }}"
              class="report-filter-form">

            <div class="report-form-group">
                <label>Tanggal Awal</label>
                <input type="date"
                       name="tanggal_awal"
                       value="{{ request('tanggal_awal') }}">
            </div>

            <div class="report-form-group">
                <label>Tanggal Akhir</label>
                <input type="date"
                       name="tanggal_akhir"
                       value="{{ request('tanggal_akhir') }}">
            </div>

            <div class="report-filter-actions">
                <button type="submit" class="report-btn">
                    Filter
                </button>

                <a href="{{ route('laporan.absensi-guru') }}"
                   class="report-reset">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <div class="report-table-card">

        <div class="report-table-heading">
            <div>
                <h3>Data Kehadiran Guru</h3>
                <p>Daftar rekap absensi berdasarkan rentang tanggal.</p>
            </div>

            <span class="report-total">
                {{ $rekap->total() }} Data
            </span>
        </div>

        <div class="table-responsive">
            <table class="report-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rekap as $item)
                        <tr>
                            <td>{{ $rekap->firstItem() + $loop->index }}</td>

                            <td class="report-student">
                                {{ $item->guru->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->tanggal->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ $item->jam_masuk?->format('H:i:s') ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jam_pulang?->format('H:i:s') ?? '-' }}
                            </td>

                            <td>
                                @if ($item->jam_masuk && $item->jam_pulang)
                                    <span class="status-badge status-hadir">
                                        Lengkap
                                    </span>
                                @elseif ($item->jam_masuk)
                                    <span class="status-badge status-izin">
                                        Belum Absen Pulang
                                    </span>
                                @else
                                    <span class="status-badge status-alpa">
                                        Belum Lengkap
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="report-empty">
                                Belum ada data absensi guru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{ $rekap->links() }}

    </div>

</div>

@endsection