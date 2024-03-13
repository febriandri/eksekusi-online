<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permohonan extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function jenisEksekusi()
    {
        return $this->belongsTo(JenisEksekusi::class);
    }

    public function permohonanPersyaratan()
    {
        return $this->hasMany(PermohonanPersyaratan::class);
    }

    public function prosesEksekusi()
    {
        return $this->hasMany(ProsesEksekusi::class);
    }

    public function latestProsesEksekusi()
    {
        return $this->hasOne(ProsesEksekusi::class)->latestOfMany();
    }
}
