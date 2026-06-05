<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hypnocounseling extends Model
{
    protected $table = 'hypnocounseling';
    protected $fillable = ['judul', 'deskripsi', 'manfaat', 'prosedur', 'gambar'];
}
