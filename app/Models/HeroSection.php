<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $table = 'hero_section';
    protected $fillable = ['judul', 'sub_judul', 'gambar', 'whatsapp_tujuan'];
}
