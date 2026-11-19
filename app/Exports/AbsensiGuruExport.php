<?php

namespace App\Exports;

use App\Models\AbsensiGuru;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiGuruExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $tanggalAwal;
    protected $tanggalAkhir;

    public function __construct($tanggalAwal = null, $tanggalAkhir = null)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function query(): Builder
    {
        $query = AbsensiGuru::with('guru');

        if ($this->tanggalAwal) {
            $query->whereDate('tanggal', '>=', $this->tanggalAwal);
        }

        if ($this->tanggalAkhir) {
            $query->whereDate('tanggal', '<=', $this->tanggalAkhir);
        }

        return $query->orderBy('tanggal', 'desc')
                    ->orderBy('guru_id');
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Guru',
            'Tanggal',
            'Jam Masuk',
            'Jam Pulang',
            'Status',
        ];
    }

    protected $no = 0;
    public function map($absensi): array
    {
        $this->no++;

        $status = $absensi->jam_masuk && $absensi->jam_pulang
            ? 'Lengkap'
            : ($absensi->jam_masuk
                ? 'Belum Absen Pulang'
                : 'Belum Lengkap');

        return [
            $this->no,
            $absensi->guru->nama ?? '-',
            $absensi->tanggal?->format('d-m-Y'),
            $absensi->jam_masuk?->format('H:i:s') ?? '-',
            $absensi->jam_pulang?->format('H:i:s') ?? '-',
            $status,
        ];
    }
}