<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaKecanduan extends Model
{
    protected $table = 'area_kecanduan';
    protected $fillable = ['nama_kecanduan', 'ikon', 'urutan', 'status'];

    public function detailPenanganan()
    {
        return $this->hasOne(DetailPenanganan::class, 'area_kecanduan_id');
    }
}
