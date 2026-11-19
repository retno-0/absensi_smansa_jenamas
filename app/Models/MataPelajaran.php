<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama',
    ];

    public function sesiAbsensi()
    {
        return $this->hasMany(SesiAbsensi::class, 'mata_pelajaran_id');
    }
}