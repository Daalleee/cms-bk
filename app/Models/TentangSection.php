<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangSection extends Model
{
    protected $table = 'tentang_sections';
    protected $fillable = ['judul', 'deskripsi', 'video_url', 'urutan'];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
