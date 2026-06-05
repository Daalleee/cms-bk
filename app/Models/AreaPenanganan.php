<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaPenanganan extends Model
{
    protected $table = 'area_penanganan';
    protected $fillable = ['nama_area', 'deskripsi', 'ikon', 'gambar', 'status'];
}
