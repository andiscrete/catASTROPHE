<?php

class AnimalController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Animal::whereNull('user_id')->get();
	}

	public function show($id){
		$animal = Animal::findOrFail($id);
		if(is_null($animal->user_id)){
			return Response::download("images/{$animal->image}");
		}elseif(Auth::check() && $animal->user_id == Auth::id()){
			$image = Crypt::decrypt($animal->image);
			return Response::download(storage_path()."/members/{$image}");
		}else{
			return Redirect::to('/403');
		}
	}

}
