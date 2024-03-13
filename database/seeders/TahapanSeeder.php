<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
		DB::table('tahapans')->truncate();

        $isi = 	[
            [
                'nama' => 'Mengajukan Permohonan',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Verifikasi Kelengkapan Dokumen',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Penelaahan Dokumen',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Hasil Tim Penelaahan',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Bayar PNBP',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Pemanggilan Aanmaning',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Hasil Aanmaning',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Pelaksanaan Eksekusi',
                'jenis_eksekusi_id' => 1
            ],
		];
		DB::table('tahapans')->insert($isi);
		Schema::enableForeignKeyConstraints();
    }
}
