<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 10000; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('part')->insert([
    			'name' => $faker->name,
    			'code' => $faker->unique()->numberBetween(100000000000,999999999999),
    			'specification' => $faker->text(50),
    			'maker' => $faker->company,
    			'part_number' => $faker->unique()->numberBetween(100000,999999),
    			'serial_number' => $faker->unique()->numberBetween(100000,999999),
    			'component_id' => $faker->numberBetween(1,2000),
    		]);

    	}
    }
}
