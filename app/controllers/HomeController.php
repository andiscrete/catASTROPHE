<?php

class HomeController extends BaseController {

	public function index()
	{
		$animals = Animal::whereNull('user_id')->take(6)->get();

		$facts = CatFact::all();
		$shuffled_facts = $facts->shuffle();
		foreach($animals as $key=>&$animal){
			$animal->cat_fact = $shuffled_facts[$key]->fact;
		}
		return View::make('home', ["animals" => $animals, "facts"=>$facts]);
	}

}
