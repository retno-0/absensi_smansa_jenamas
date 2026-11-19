@extends('layouts.app')

@section('content')

<div class="container">

    <h3>Rekap Absensi Guru</h3>

    {{-- Filter tanggal --}}
    <form action="{{ route('admin.rekap-absensi-guru') }}"
          method="GET"
          class="row mb-4">

        <div class="col-md-4">
            <label>Tanggal Awal</label>
            <input type="date"
                   name="tanggal_awal"
                   class="form-control"
                   value="{{ request('tanggal_awal') }}">
        </div>

        <div class="col-md-4">
            <label>Tanggal Akhir</label>
            <input type="date"
                   name="tanggal_akhir"
                   class="form-control"
                   value="{{ request('tanggal_akhir') }}">
        </div>

        <div class="col-md-4 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary">
                Filter
            </button>

            <a href="{{ route('admin.rekap-absensi-guru') }}"
               class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>

    {{-- Tabel rekap --}}
    <div class="table-responsive">

        <table class="table table-bordered table-striped">

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
                        <td>
                            {{ $loop->iteration +
                               ($rekap->currentPage() - 1) *
                               $rekap->perPage() }}
                        </td>

                        <td>
                            {{ $item->guru->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->tanggal->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ $item->jam_masuk
                                ? $item->jam_masuk->format('H:i:s')
                                : '-' }}
                        </td>

                        <td>
                            {{ $item->jam_pulang
                                ? $item->jam_pulang->format('H:i:s')
                                : '-' }}
                        </td>

                        <td>
                            @if ($item->jam_masuk && $item->jam_pulang)
                                <span class="badge bg-success">
                                    Lengkap
                                </span>
                            @elseif ($item->jam_masuk)
                                <span class="badge bg-warning text-dark">
                                    Belum Absen Pulang
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Belum Lengkap
                                </span>
                            @endif
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data absensi guru.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{ $rekap->links() }}

</div>

@endsection