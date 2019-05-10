<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $jns = array(1 => 'B', 2 =>'ST', 3 => 'SE', 4 => 'DP');
        $jenis = array(1 => 'Biasa', 2 =>'Surat Tugas', 3 => 'Surat Edaran', 4 => 'Dispensasi');
        
        $date = date("Y-m-d H:i:s");
        for ($i=0; $i < 30; $i++) { 
            $no = rand(1,4);
            DB::table('surat')->insert([
                'no_surat' =>  $jns[$no] . "/WDIII/" . $i . "/" . $faker->century ."/2019",
                'tanggal' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jenis_id' => $no,
                'perihal' => $jenis[$no] . " " . $no,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
