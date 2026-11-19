<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'sesi_absensi_id',
        'siswa_id',
        'waktu_absen',
        'status',
        'metode',
        'bukti_sakit',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'waktu_absen' => 'datetime',
    ];

    public function sesiAbsensi()
    {
        return $this->belongsTo(SesiAbsensi::class, 'sesi_absensi_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatAbsensi::class, 'absensi_id');
    }
}