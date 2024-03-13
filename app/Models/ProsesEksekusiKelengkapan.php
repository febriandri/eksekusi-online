<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesEksekusiKelengkapan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelengkapan()
    {
        return $this->belongsTo(Kelengkapan::class);
    }

    public function prosesEksekusi()
    {
        return $this->belongsTo(ProsesEksekusi::class);
    }

    public function prosesEksekusiKelengkapanDetail($proses_eksekusi_id)
    {
        $output = '';
        if(!is_null($proses_eksekusi_id) && $proses_eksekusi_id != '') {
            $data = $this->where('proses_eksekusi_id', $proses_eksekusi_id)->get();
            $dt2 = '';
            foreach ($data as $d) {
                $isi = ($d->isi) ? '<a href="' . asset('storage/'. $d->isi) . '" target="_blank" class="text-decoration-none text-success"> <i class="fa-solid fa-download"></i></a>' : '';
                $dt = $d->kelengkapan->nama . $isi . '<br/>';
                $dt2 = $dt2 . ' ' . $dt;
            }
            $output = $dt2;
        }
        return $output;
    }
}
