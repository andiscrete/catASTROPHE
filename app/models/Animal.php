<?php


class Animal extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'animals';

	protected $required = ['image', 'title'];
	protected $fillable = ['image', 'title'];


	const PEXELS_URL = "https://www.pexels.com/search/";

	/**
	 * Fetch images from the Pexels main search page
	 * @param  string $search_term the term that we'll enter into the pexels search criteria
	 * @return array               [description]
	 */
	public static function fetch_from_pexels(string $search_term = ''):array{
		$animals = [];

  	$source = file_get_contents(self::PEXELS_URL.$search_term);
	  $links = preg_split("/".preg_quote("<article").'/', $source);
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

	/**
	 * Import some fetched images from Pexels into our database
	 * @param  string $search_term the term that we'll enter into the pexels search criteria
	 * @return array              array of animal objects
	 */
	public static function import(string $search_term):array{
		$animals = self::fetch_from_pexels($search_term);
		$new_animals = [];
		foreach($animals as $animal){
			$new_animal = Animal::create($animal);
			$image = file_get_contents($animal['image']);
			$chopped_pexel_url = self::harvest_pexel_url($animal['image']);
			$new_animal->image = $new_animal->id.".".$chopped_pexel_url['extension'];
			if(file_put_contents(public_path()."/images/{$new_animal->image}",$image)){
				$new_animal->save();
				$new_animals[] = $new_animal;
			}else $new_animal->delete();
		}
		return $new_animals;
	}

	/**
	 * Generate and save a unique
	 *
	 * @param  string  $search_term the term that we'll enter into the pexels search criteria
	 * @param  integer $user_id     the id of the member
	 * @return [type]               [description]
	 */
	public static function create_unique(string $search_term, int $user_id){
		$search_animals = self::fetch_from_pexels($search_term);

		if(!empty($search_animals)){
			$random_animal_key = rand(0,count($search_animals)-1);
			$random_animal = $search_animals[$random_animal_key];

			$unique_animal = new Animal;
			$unique_animal->title = $random_animal['title'];
			$unique_animal->user_id = $user_id;
			$image = file_get_contents($random_animal['image']);
			$chopped_pexel_url = self::harvest_pexel_url($random_animal['image']);
			$image_filename = bin2hex(random_bytes(10)).$user_id.".".$chopped_pexel_url['extension']; // Encrypt the url for extra security
			$unique_animal->image = Crypt::encrypt($image_filename); // Crypt this, just to mix things up

			if(file_put_contents(storage_path()."/members/{$image_filename}",$image)){
				$unique_animal->save();
			}else throw new Exception('Could not create file. Please contact system admin or something');
		}else{
			throw new Exception('Search term returned empty set');
		}
	}

	/**
	 * Chop up the url to obtain some usefull elements
	 *
	 * @param  string $pexel_url The url of the image
	 * @return array            array with keys: full_size_url = url without compression | extension = file image type
	 */
	private static function harvest_pexel_url(string $pexel_url){
		$url_parts = explode("?",$pexel_url);
		$return['full_size_url'] = $url_parts[0];
		$exploded_url = explode(".", $url_parts[0]); //split for the extension
		$return['extension'] = $exploded_url[sizeof($exploded_url)-1];
		return $return;
	}

	public function user()
  {
      return $this->hasOne('User');
  }
}
