<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $jenis = array('Biasa', 'Surat Tugas', 'Surat Edaran', 'Dispensasi');
        $date = date("Y-m-d H:i:s");
        foreach ($jenis as $value) {
            DB::table('jenis')->insert([
                'jenis' => $value,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
