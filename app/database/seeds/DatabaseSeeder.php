<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CatFactsTableSeeder');
		$this->command->info('Cat Facts table seeded!');

		$this->call('AnimalsTableSeeder');
		$this->command->info('Animals table seeded!');

	}
}

class CatFactsTableSeeder extends Seeder{
	public function run(){
		\DB::table('cat_facts')->delete();

		\DB::table('cat_facts')->insert([
			["fact" => "Cats are the most popular pet in the United States: There are 88 million pet cats and 74 million dogs."],
			["fact" => "There are cats who have survived falls from over 32 stories (320 meters) onto concrete."],
			["fact" => "A group of cats is called a clowder."],
			["fact" => "Cats have over 20 muscles that control their ears."],
			["fact" => "Cats sleep 70% of their lives."],
			["fact" => "A cat has been mayor of Talkeetna, Alaska, for 15 years. His name is Stubbs."],
			["fact" => "In tigers and tabbies, the middle of the tongue is covered in backward-pointing spines, used for breaking off and gripping meat."],
			["fact" => "When cats grimace, they are usually \"taste-scenting.\" They have an extra organ that, with some breathing control, allows the cats to taste-sense the air. "],
			["fact" => "Cats can't taste sweetness"],
			["fact" => "Owning a cat can reduce the risk of stroke and heart attack by a third."],
			["fact" => "Evidence suggests domesticated cats have been around since 3600 B.C., 2,000 years before Egypt's pharaohs. "],
			["fact" => "Adult cats only meow to communicate with humans. "],
			["fact" => "A cat's purr may be a form of self-healing, as it can be a sign of nervousness as well as contentment. "],
			["fact" => "Cats are often lactose intolerant"],
			["fact" => "Female cats are typically right-pawed while male cats are typically left-pawed."],
			["fact" => "Cats and humans have nearly identical sections of the brain that control emotion."],
			["fact" => "A cat's brain is 90% similar to a human's — more similar than to a dog's. "],
			["fact" => "Hearing is the strongest of cat's senses: They can hear sounds as high as 64 kHz — compared with humans, who can hear only as high as 20 kHz. "],
			["fact" => "Cats only sweat through their foot pads."],
			["fact" => "Cats have free-floating clavicle bones that attach their shoulders to their forelimbs, which allows them to squeeze through very small spaces. "]
		]);
	}

}

class AnimalsTableSeeder extends Seeder{
	public function run(){
		\DB::table('animals')->delete();

		Animal::import('animals');
	}

}
