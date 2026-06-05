<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';
    protected $fillable = ['alamat', 'telepon', 'whatsapp', 'email', 'google_maps', 'jam_operasional'];
}
