<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$storesFaker = FakerFactory::create();
		foreach (range (1,10) as $index) {
			DB::table('stores')->insert([
				'name' => $storesFaker->company,
				'address' => $storesFaker->address
			]);
		}

		$articlesFaker = FakerFactory::create();
		foreach (range (1,50) as $index) {
			DB::table('articles')->insert([
				'name' => $articlesFaker->colorName,
        		'description' => $articlesFaker->sentence($nbWords = 5, $variableNbWords = true),
        		'price' => $articlesFaker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 500),
        		'total_in_shelf' => $articlesFaker->numberBetween($min = 0, $max = 100),
        		'total_in_vault' => $articlesFaker->numberBetween($min = 20, $max = 1000),
        		'store_id' => $articlesFaker->numberBetween($min = 1, $max = 10)
			]);
		}
	}
}