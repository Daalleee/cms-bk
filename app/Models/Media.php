<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'model_id',
        'model_type',
        'koleksi',
        'nama',
        'sumber',
        'path',
        'url',
        'youtube_id',
        'tipe_mime',
        'ukuran',
        'urutan',
    ];

    protected $appends = ['url_media', 'thumbnail'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlMediaAttribute(): ?string
    {
        return match ($this->sumber) {
            'unggah' => $this->path ? Storage::disk('public')->url($this->path) : null,
            'youtube' => $this->youtube_id ? 'https://www.youtube.com/watch?v=' . $this->youtube_id : null,
            'tautan' => $this->url,
            default => null,
        };
    }

    public function getThumbnailAttribute(): ?string
    {
        return match ($this->sumber) {
            'unggah' => str($this->tipe_mime)->startsWith('video/')
                ? Storage::disk('public')->url($this->path) . '#t=0.1'
                : ($this->path ? Storage::disk('public')->url($this->path) : null),
            'youtube' => $this->youtube_id
                ? 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg'
                : null,
            'tautan' => $this->url,
            default => null,
        };
    }

    public function isVideo(): bool
    {
        return $this->koleksi === 'video';
    }

    public function isImage(): bool
    {
        return $this->koleksi === 'foto';
    }
}
