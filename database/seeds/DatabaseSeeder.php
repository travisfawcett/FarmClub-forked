<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$faker = FakerFactory::create();
		foreach (range (1,50) as $index) {
			DB::table('articles')->insert([
				'name' => $faker->colorName,
	        	'description' => $faker->sentence($nbWords = 5, $variableNbWords = true),
	        	'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 500),
	        	'total_in_shelf' => $faker->numberBetween($min = 0, $max = 100),
	        	'total_in_vault' => $faker->numberBetween($min = 20, $max = 1000),
	        	'store_id' => $faker->numberBetween($min = 12, $max = 21)
			]);
		}
	}
}
		// $faker = FakerFactory::create();
		// foreach (range (1,10) as $index) {
		// 	DB::table('stores')->insert([
		// 		'name' => $faker->company,
  		//		'address' => $faker->address
		// 	]);
		// }
