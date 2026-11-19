@extends('layouts.app')

@section('title', 'Edit Sesi Absensi')
@section('page-heading', 'Edit Sesi Absensi')
@section('page-description', 'Perbaiki jadwal dan informasi sesi absensi.')

@section('content')
<div class="dash-content">

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="absensi-form-wrapper">
        <div class="absensi-form-card">

            <h2>Edit Sesi Absensi</h2>
            <p class="form-description">
                Ubah informasi sesi jika terdapat kesalahan jadwal.
                Kode absensi tidak akan berubah.
            </p>

            <form action="{{ route('absensi.update', $sesi->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="absensi-form-group">
                    <label>Kode Absensi</label>
                    <input type="text"
                           value="{{ $sesi->kode_absensi }}"
                           readonly>
                </div>

                <div class="absensi-form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" required>
                        @foreach($kelas as $item)
                            <option value="{{ $item->id }}"
                                {{ old('kelas_id', $sesi->kelas_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="absensi-form-group">
                    <label for="mata_pelajaran_id">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id"
                            id="mata_pelajaran_id" required>
                        @foreach($mataPelajaran as $item)
                            <option value="{{ $item->id }}"
                                {{ old('mata_pelajaran_id', $sesi->mata_pelajaran_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="absensi-form-group">
                    <label for="tanggal">Tanggal Absensi</label>
                    <input type="date"
                           name="tanggal"
                           id="tanggal"
                           value="{{ old('tanggal', $sesi->tanggal->format('Y-m-d')) }}"
                           required>
                </div>

                <div class="absensi-form-grid">
                    <div class="absensi-form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time"
                               name="jam_mulai"
                               id="jam_mulai"
                               value="{{ old('jam_mulai', $sesi->jam_mulai) }}"
                               required>
                    </div>

                    <div class="absensi-form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time"
                               name="jam_selesai"
                               id="jam_selesai"
                               value="{{ old('jam_selesai', $sesi->jam_selesai) }}"
                               required>
                    </div>
                </div>

                <button type="submit">
                    Simpan Perubahan
                </button>

                <a href="{{ route('absensi.index') }}"
                   style="margin-left:12px; color:#6855ed; text-decoration:none;">
                    Batal
                </a>

            </form>
        </div>
    </div>

</div>
@endsection