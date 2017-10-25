<?php

use App\Animal;
use App\User;
use DB;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('SpeciesTableSeeder');

	}

	public function SpeciesTableSeeder extends Seeder(){
		public function run(){
			DB::table('animals')->delete();

			Animal::create([
				"type" => "Lion",
				"species" => "Cat"
				"image" => "https://images.pexels.com/photos/247502/pexels-photo-247502.jpeg?h=350&auto=compress&cs=tinysrgb"
			]);
		}
	}

}
