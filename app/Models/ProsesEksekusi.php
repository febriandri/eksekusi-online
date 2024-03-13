<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesEksekusi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class);
    }

    public function prosesEksekusiKelengkapan()
    {
        return $this->hasMany(ProsesEksekusiKelengkapan::class);
    }
}
