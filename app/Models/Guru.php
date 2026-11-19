<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'jabatan',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sesiAbsensi()
    {
        return $this->hasMany(SesiAbsensi::class, 'guru_id');
    }
}