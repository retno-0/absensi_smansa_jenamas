@extends('layouts.app')

@section('content')
<div class="absensi-form-wrapper">

    <div class="absensi-form-card">

        <h2>Form Absensi Siswa</h2>
        <p class="form-description">
            Silakan isi kehadiran sesuai kondisi kamu.
        </p>

        {{-- Informasi sesi absensi --}}
        <div class="absensi-info">
            <p>
                <strong>Nama:</strong>
                {{ $siswa->nama }}
            </p>

            <p>
                <strong>Kelas:</strong>
                {{ $sesi->kelas->nama_kelas ?? '-' }}
            </p>

            <p>
                <strong>Mata Pelajaran:</strong>
                {{ $sesi->mataPelajaran->nama ?? '-' }}
            </p>

            <p>
                <strong>Guru:</strong>
                {{ $sesi->guru->nama ?? '-' }}
            </p>

            <p>
                <strong>Tanggal:</strong>
                {{ $sesi->tanggal->format('d-m-Y') }}
            </p>
        </div>

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form
            action="{{ route('siswa.absensi.simpan', $sesi->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            {{-- Kode absensi --}}
            <input
                type="hidden"
                name="kode_absensi"
                value="{{ session('kode_absensi') }}"
            >

            {{-- Pilihan status --}}
            <div class="absensi-form-group">
                <label for="status">Status Kehadiran</label>

                <select name="status" id="status" required>
                    <option value="">-- Pilih Status --</option>

                    <option value="hadir"
                        {{ old('status') == 'hadir' ? 'selected' : '' }}>
                        Hadir
                    </option>

                    <option value="izin"
                        {{ old('status') == 'izin' ? 'selected' : '' }}>
                        Izin
                    </option>

                    <option value="sakit"
                        {{ old('status') == 'sakit' ? 'selected' : '' }}>
                        Sakit
                    </option>
                </select>
            </div>

            {{-- Upload bukti sakit --}}
            <div
                class="absensi-form-group"
                id="buktiSakit"
                @if(old('status') !== 'sakit') hidden @endif
            >
                <label for="bukti_sakit">
                    Foto Surat Keterangan Sakit
                </label>

                <input
                    type="file"
                    name="bukti_sakit"
                    id="bukti_sakit"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                >

                <small>
                    Wajib dilampirkan jika memilih status sakit.
                    Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                </small>
            </div>

            {{-- Tombol --}}
            <div class="absensi-form-actions">
                <button type="submit">
                    Kirim Absensi
                </button>

                <a href="{{ route('siswa.absensi') }}"
                   class="btn-kembali-absensi">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const statusSelect = document.getElementById('status');
    const buktiSakit = document.getElementById('buktiSakit');
    const inputBukti = document.getElementById('bukti_sakit');

    function toggleBuktiSakit() {
        const pilihSakit = statusSelect.value === 'sakit';

        buktiSakit.hidden = !pilihSakit;
        inputBukti.required = pilihSakit;

        if (!pilihSakit) {
            inputBukti.value = '';
        }
    }

    statusSelect.addEventListener('change', toggleBuktiSakit);

    toggleBuktiSakit();

});
</script>
@endsection