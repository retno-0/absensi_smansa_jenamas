@extends('layouts.app')

@section('title', 'Data Siswa')
@section('page-heading', 'Data Siswa')
@section('page-description', 'Kelola data siswa dan kelas.')

@section('content')
<div class="dash-content">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="dash-card">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
            <h3 class="dash-section-title">Daftar Siswa</h3>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($siswa as $item)
                        <tr>
                            <td>{{ $siswa->firstItem() + $loop->index }}</td>
                            <td>{{ $item->nisn }}</td>
                            <td>{{ $item->nama }}</td>

                            <td>
                                @if(Auth::user()->role === 'admin')
                                    <form action="{{ route('siswa.updateKelas', $item->id) }}"
                                          method="POST">
                                        @csrf

                                        <select name="kelas_id"
                                                onchange="this.form.submit()"
                                                style="padding:8px; border-radius:6px; border:1px solid #ccc;">

                                            <option value="">Pilih Kelas</option>

                                            @foreach($kelas as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ $item->kelas_id == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </form>
                                @else
                                    {{ $item->kelas->nama_kelas ?? 'Belum ditentukan' }}
                                @endif
                            </td>

                            <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $item->tempat_lahir ?? '-' }}</td>

                            <td>
                                {{ $item->tanggal_lahir
                                    ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y')
                                    : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;">
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="custom-pagination">
                <div class="pagination-info">
                    Menampilkan {{ $siswa->firstItem() ?? 0 }}
                    - {{ $siswa->lastItem() ?? 0 }}
                    dari {{ $siswa->total() }} siswa
                </div>

                <div class="pagination-buttons">

                    @if ($siswa->onFirstPage())
                        <span class="page-btn disabled">‹</span>
                    @else
                        <a href="{{ $siswa->previousPageUrl() }}" class="page-btn">‹</a>
                    @endif

                    @foreach ($siswa->getUrlRange(1, $siswa->lastPage()) as $page => $url)

                        @if ($page == $siswa->currentPage())
                            <span class="page-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-btn">
                                {{ $page }}
                            </a>
                        @endif

                    @endforeach

                    @if ($siswa->hasMorePages())
                        <a href="{{ $siswa->nextPageUrl() }}" class="page-btn">›</a>
                    @else
                        <span class="page-btn disabled">›</span>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection