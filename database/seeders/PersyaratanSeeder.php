<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
		DB::table('persyaratans')->truncate();

        $isi = 	[
            [
                'nama' => 'Surat permohonan',
                'jenis_eksekusi_id' => 1,
                'ekstensi' => '.pdf',
                'wajib_diisi' => 1
            ],

            [
                'nama' => 'KTP',
                'jenis_eksekusi_id' => 1,
                'ekstensi' => '.jpg',
                'wajib_diisi' => 1
            ],

            [
                'nama' => 'Salinan putusan yang telah di BHT',
                'jenis_eksekusi_id' => 1,
                'ekstensi' => '.pdf',
                'wajib_diisi' => 1
            ],

            [
                'nama' => 'Kartu anggota advokat',
                'jenis_eksekusi_id' => 1,
                'ekstensi' => '.jpg',
                'wajib_diisi' => 0
            ],

            [
                'nama' => 'Berita acara sumpah advokat',
                'jenis_eksekusi_id' => 1,
                'ekstensi' => '.pdf',
                'wajib_diisi' => 0
            ]
		];
		DB::table('persyaratans')->insert($isi);
		Schema::enableForeignKeyConstraints();
    }
}
