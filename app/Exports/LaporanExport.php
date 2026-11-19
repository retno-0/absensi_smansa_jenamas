<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromQuery, WithHeadings, WithMapping
{
    protected $tanggal;
    protected $kelasId;

    public function __construct($tanggal = null, $kelasId = null)
    {
        $this->tanggal = $tanggal;
        $this->kelasId = $kelasId;
    }

    public function query(): Builder
    {
        $query = DB::table('absensi')
            ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->join('sesi_absensi', 'absensi.sesi_absensi_id', '=', 'sesi_absensi.id')
            ->join('kelas', 'sesi_absensi.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.nisn',
                'siswa.nama',
                'kelas.nama_kelas',
                'sesi_absensi.tanggal',
                'absensi.status'
            );

        if ($this->tanggal) {
            $query->where('sesi_absensi.tanggal', $this->tanggal);
        }

        if ($this->kelasId) {
            $query->where('kelas.id', $this->kelasId);
        }

        return $query->orderBy('sesi_absensi.tanggal', 'desc');
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama Siswa',
            'Kelas',
            'Tanggal',
            'Status Kehadiran',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nisn,
            $row->nama,
            $row->nama_kelas,
            $row->tanggal,
            ucfirst($row->status),
        ];
    }
}