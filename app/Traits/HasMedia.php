<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')->orderBy('urutan');
    }

    public function foto(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')->where('koleksi', 'foto')->orderBy('urutan');
    }

    public function video(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')->where('koleksi', 'video')->orderBy('urutan');
    }
}
