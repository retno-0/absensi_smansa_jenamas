@extends('layouts.app')

@section('content')
<div class="guru-absensi">

    <div class="absensi-header">
        <div>
            <h2>Absensi Kehadiran Guru</h2>
            <p>Catat waktu kehadiran dan kepulangan Anda.</p>
        </div>
        <div class="tanggal">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="profil-guru">
        <div class="profil-icon">👨‍🏫</div>
        <div>
            <h3>{{ $guru->nama }}</h3>
            <p>NIP: {{ $guru->nip }}</p>
        </div>
    </div>

    <div class="absensi-cards">

        <div class="absensi-card">
            <div class="card-icon masuk">↘</div>
            <h3>Absen Masuk</h3>

            <div class="jam">
                {{ $absensiHariIni?->jam_masuk?->format('H:i') ?? '--:--' }}
            </div>

            @if($absensiHariIni?->jam_masuk)
                <span class="status sudah">Sudah Absen</span>
            @else
                <span class="status belum">Belum Absen</span>

                <form id="formMasuk"
                      action="{{ route('guru.absensi.masuk') }}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="latitude">
                    <input type="hidden" name="longitude">

                    <button type="button"
                            onclick="ambilLokasi('formMasuk')">
                        Absen Masuk
                    </button>
                </form>
            @endif
        </div>

        <div class="absensi-card">
            <div class="card-icon pulang">↗</div>
            <h3>Absen Pulang</h3>

            <div class="jam">
                {{ $absensiHariIni?->jam_pulang?->format('H:i') ?? '--:--' }}
            </div>

            @if($absensiHariIni?->jam_pulang)
                <span class="status sudah">Sudah Absen</span>
            @elseif(!$absensiHariIni?->jam_masuk)
                <span class="status belum">Absen Masuk Dahulu</span>
            @else
                <span class="status belum">Belum Absen</span>

                <form id="formPulang"
                      action="{{ route('guru.absensi.pulang') }}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="latitude">
                    <input type="hidden" name="longitude">

                    <button type="button"
                            onclick="ambilLokasi('formPulang')">
                        Absen Pulang
                    </button>
                </form>
            @endif
        </div>

    </div>

    <div class="riwayat-card">
        <h3>Riwayat Absensi</h3>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $item)
                        <tr>
                            <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $item->jam_masuk?->format('H:i') ?? '-' }}</td>
                            <td>{{ $item->jam_pulang?->format('H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Belum ada riwayat absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function ambilLokasi(formId) {
    if (!navigator.geolocation) {
        alert('Browser tidak mendukung GPS.');
        return;
    }

    if (!confirm('Izinkan pengambilan lokasi untuk absensi?')) {
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function(position) {
            const form = document.getElementById(formId);

            form.querySelector('[name="latitude"]').value =
                position.coords.latitude;

            form.querySelector('[name="longitude"]').value =
                position.coords.longitude;

            form.submit();
        },
        function(error) {
            alert('Lokasi gagal diambil. Pastikan GPS aktif dan izin lokasi diberikan.');
        },
        {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 0
        }
    );
}
</script>

@endsection
