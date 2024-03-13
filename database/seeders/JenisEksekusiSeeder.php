<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class JenisEksekusiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
		DB::table('jenis_eksekusis')->truncate();

        $isi = 	[
            [
                'nama' => 'Putusan Inkrah'
            ],

            [
                'nama' => 'Putusan Pidusia'
            ]
		];
		DB::table('jenis_eksekusis')->insert($isi);
		Schema::enableForeignKeyConstraints();
    }
}
