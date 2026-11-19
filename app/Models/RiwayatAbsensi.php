<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAbsensi extends Model
{
    protected $table = 'riwayat_absensi';

    protected $fillable = [
        'absensi_id',
        'status_lama',
        'status_baru',
        'alasan',
        'diubah_oleh',
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
    }

    public function pengubah()
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }
}