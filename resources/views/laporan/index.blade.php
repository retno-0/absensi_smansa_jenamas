@extends('layouts.app')

@section('content')

<div class="dash-content">

    <div class="report-heading">
        <div>
            <h1>Laporan Absensi</h1>
            <p>Rekap dan pantau data kehadiran siswa dan guru SMAN 1 Jenamas.</p>
        </div>

        <div style="display: flex; gap: 10px; flex-wrap: wrap;">

            <a href="{{ route('laporan.absensi-guru') }}"
            class="btn-excel">
                📥 Export Excel Guru
            </a>

            <a href="{{ route('laporan.export', request()->query()) }}"
            class="btn-excel">
                📥 Export Excel Siswa
            </a>

        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <!-- FILTER -->
    <div class="report-filter-card">
        <h3>Filter Laporan</h3>

        <form method="GET" action="{{ route('laporan.index') }}"
              class="report-filter-form">

            <div class="report-form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal"
                       value="{{ request('tanggal') }}">
            </div>

            <div class="report-form-group">
                <label>Kelas</label>
                <select name="kelas_id">
                    <option value="">Semua Kelas</option>

                    @foreach ($kelas as $item)
                        <option value="{{ $item->id }}"
                            @selected(request('kelas_id') == $item->id)>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="report-filter-actions">
                <button type="submit" class="report-btn">
                    Filter
                </button>

                <a href="{{ route('laporan.index') }}"
                   class="report-reset">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="report-table-card">

        <div class="report-table-heading">
            <div>
                <h3>Data Kehadiran Siswa</h3>
                <p>Daftar rekap absensi berdasarkan filter yang dipilih.</p>
            </div>

            <span class="report-total">
                {{ $laporan->count() }} Data
            </span>
        </div>

        <div class="table-responsive">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nisn }}</td>
                            <td class="report-student">
                                {{ $item->nama }}
                            </td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($item->status) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="report-empty">
                                Belum ada data absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
