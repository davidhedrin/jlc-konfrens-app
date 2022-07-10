<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jemaat;
use App\Models\JenisFixedAsset;

class FixedAsset extends Model
{
    use HasFactory;

    public $table = "fixed_assets";

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id');
    }
    public function jenisAsset()
    {
        return $this->belongsTo(JenisFixedAsset::class, 'jenis_fixed_id');
    }
}
