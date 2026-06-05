<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['judul', 'tipe', 'sumber', 'path_atau_link', 'keterangan'];
}
