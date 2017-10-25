<?php


class Animal extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'animals';

	protected $required = ['image', 'title'];

	const PEXELS_URL = "https://www.pexels.com/search/";

	/**
	 * Fetch images from the Pexels main search page
	 * @param  string $search_term [description]
	 * @return array               [description]
	 */
	public static function fetch_from_pexels(string $search_term = ''):array{
		$animals = [];

  	$source = file_get_contents(self::PEXELS_URL.$search_term);
	  $links = preg_split("/".preg_quote("<article").'/', $website);
	  unset($links[0]);
	  foreach($links as $link){
	    $title = explode("alt=\"",$link);
	    $title = explode("\"", $title[1]);
	    $title = $title[0];

	    $image = explode("src=\"",$link);
	    $image = explode("\"", $image[1]);
	    $image = $image[0];

			$animals[] = ["image"=>$image, "title"=>$title];
	  }
	  return $animals;
	}

	public static function import(string $search_term){
		$animals = self::fetch_from_pexels($search_term);

		foreach($animals as $animal){
			$animal['image'] = file_get_contents($animal['image']);
			Animal::create($animal);
		}
	}

	public static function unique(string $search_term, $user_id){
		$animals = self::fetch_from_pexels($search_term);

		$rand = rand(0,count($animals)-1);
		$animal = $animals[$rand];
		$animal['image'] = Hash::make(file_get_contents($animal['image']));
		$animal['user_id'] = $user_id;
		$animal->save();
	}

	public function user()
  {
      return $this->hasOne('User');
  }
}
