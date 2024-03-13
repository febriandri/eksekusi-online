<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KelengkapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
		DB::table('kelengkapans')->truncate();

        $isi = 	[
            [
                'nama' => 'Foto objek eksekusi',
                'jenis_eksekusi_id' => 1
            ],

            [
                'nama' => 'Surat Kuasa',
                'jenis_eksekusi_id' => 1
            ]
		];
		DB::table('kelengkapans')->insert($isi);
		Schema::enableForeignKeyConstraints();
    }
}
