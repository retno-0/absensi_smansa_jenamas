@extends('layouts.app')

@section('content')
<div class="dash-body">
    <div class="dash-main">

        <div class="dash-topbar">
            <h2>Data Guru</h2>
        </div>

        <div class="dash-content">
            <div class="dash-card">

                <h3>Daftar Guru</h3>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Guru</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($guru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jabatan ?? '-' }}</td>
                                    <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Belum ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection