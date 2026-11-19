@extends('layouts.app')

@section('title', 'Buat Sesi Absensi')
@section('page-heading', 'Buat Sesi Absensi')
@section('page-description', 'Atur jadwal dan informasi sesi absensi siswa.')

@section('content')
<div class="dash-content">

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="absensi-form-wrapper">
        <div class="absensi-form-card">

            <h2>Buat Sesi Absensi</h2>
            <p class="form-description">
                Lengkapi informasi berikut untuk membuat sesi absensi baru.
            </p>

            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf

                <div class="absensi-form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $item)
                            <option value="{{ $item->id }}"
                                {{ old('kelas_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="absensi-form-group">
                    <label for="mata_pelajaran_id">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id"
                            id="mata_pelajaran_id" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mataPelajaran as $item)
                            <option value="{{ $item->id }}"
                                {{ old('mata_pelajaran_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="absensi-form-group">
                    <label for="tanggal">Tanggal Absensi</label>
                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="absensi-form-grid">
                    <div class="absensi-form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input
                            type="time"
                            name="jam_mulai"
                            id="jam_mulai"
                            value="{{ old('jam_mulai') }}"
                            required
                        >
                    </div>

                    <div class="absensi-form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input
                            type="time"
                            name="jam_selesai"
                            id="jam_selesai"
                            value="{{ old('jam_selesai') }}"
                            required
                        >
                    </div>
                </div>

                <button type="submit" id="btnSubmit">
                    Buat Sesi Absensi
                </button>

            </form>
        </div>
    </div>

</div>
<script>
document.querySelector('form').addEventListener('submit', function () {
    const tombol = document.getElementById('btnSubmit');

    tombol.disabled = true;
    tombol.innerText = 'Sedang Membuat Sesi...';
});
</script>
@endsection