<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahapanPenanganan extends Model
{
    protected $table = 'tahapan_penanganan';
    protected $fillable = ['urutan', 'nama_tahap', 'deskripsi', 'ikon', 'gambar', 'video_url'];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
