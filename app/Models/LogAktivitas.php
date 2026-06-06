<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $fillable = ['pengguna_id', 'aktivitas', 'alamat_ip'];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
