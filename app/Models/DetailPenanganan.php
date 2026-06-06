<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

class DetailPenanganan extends Model
{
    use HasMedia;

    protected $table = 'detail_penanganan';
    protected $fillable = ['area_kecanduan_id', 'link_youtube', 'artikel_penanganan'];

    public function areaKecanduan()
    {
        return $this->belongsTo(AreaKecanduan::class, 'area_kecanduan_id');
    }
}
