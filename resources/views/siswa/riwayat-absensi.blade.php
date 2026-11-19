@extends('layouts.app')

@section('title', 'Riwayat Absensi')
@section('page-heading', 'Riwayat Absensi')
@section('page-description', 'Lihat catatan kehadiran seluruh sesi pelajaran.')

@section('content')

<div class="dash-content">

    <div class="dash-welcome">
        <div>
            <h2>Riwayat Absensi</h2>
            <p>Halo, {{ $siswa->nama }}! Berikut catatan kehadiran kamu.</p>
        </div>
    </div>

    <div class="dash-card">

        <h3>Daftar Riwayat Kehadiran</h3>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Jam</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($riwayat as $item)

                        @php
                            $status = ucfirst($item->status);

                            $statusClass = match(strtolower($item->status)) {
                                'hadir' => 'status-hadir',
                                'izin' => 'status-izin',
                                'sakit' => 'status-sakit',
                                'alpa' => 'status-alpa',
                                default => 'status-belum',
                            };
                        @endphp

                        <tr>
                            <td>{{ $riwayat->firstItem() + $loop->index }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->waktu_absen)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ $item->sesiAbsensi->mataPelajaran->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->sesiAbsensi->guru->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->sesiAbsensi->jam_mulai ?? '-' }}
                                -
                                {{ $item->sesiAbsensi->jam_selesai ?? '-' }}
                            </td>

                            <td>
                                <span class="student-status {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="report-empty">
                                Belum ada riwayat absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="custom-pagination">
            <div class="pagination-info">
                Menampilkan {{ $riwayat->firstItem() ?? 0 }}
                - {{ $riwayat->lastItem() ?? 0 }}
                dari {{ $riwayat->total() }} data
            </div>

            <div class="pagination-buttons">
                @if($riwayat->onFirstPage())
                    <span class="page-btn disabled">‹</span>
                @else
                    <a href="{{ $riwayat->previousPageUrl() }}" class="page-btn">‹</a>
                @endif

                @foreach($riwayat->getUrlRange(1, $riwayat->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                       class="page-btn {{ $riwayat->currentPage() == $page ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach

                @if($riwayat->hasMorePages())
                    <a href="{{ $riwayat->nextPageUrl() }}" class="page-btn">›</a>
                @else
                    <span class="page-btn disabled">›</span>
                @endif
            </div>
        </div>

    </div>

</div>

@endsection