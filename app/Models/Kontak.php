<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';
    protected $fillable = ['alamat', 'telepon', 'whatsapp', 'email', 'instagram', 'tiktok', 'youtube', 'facebook', 'twitter', 'tampilkan_youtube', 'tampilkan_instagram', 'tampilkan_facebook', 'tampilkan_twitter', 'tampilkan_tiktok'];
}
