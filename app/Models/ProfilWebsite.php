<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilWebsite extends Model
{
    protected $table = 'profil_website';
    protected $fillable = ['judul', 'profil', 'visi', 'misi', 'gambar'];
}
