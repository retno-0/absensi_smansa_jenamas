<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiAbsensi extends Model
{
    protected $table = 'sesi_absensi';

    protected $fillable = [
        'kelas_id',
        'guru_id',
        'mata_pelajaran_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
        'kode_absensi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'sesi_absensi_id');
    }
}