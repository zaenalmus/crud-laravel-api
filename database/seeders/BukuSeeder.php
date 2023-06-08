<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i=0; $i<10; $i++){
            Buku::create([
                'judul' => $faker->sentence,
                'pengarang' => $faker->name,
                'tanggalpublis' => $faker->date,
            ]);
        }
    }
}
