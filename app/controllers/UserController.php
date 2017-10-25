<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating the member
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}


	/**
	 * Validate, store and login the user and return home, or return to the member creation form
	 *
	 * @return Response
	 */
	public function store()
	{
		$request = Input::all();

		$return = User::store($request);

		if(is_a($return, 'User')){
			Auth::login($return);
			return Redirect::to('/home');
		}elseif(is_a($return,'Illuminate\Validation\Validator')){
			return Redirect::to('/user/create')->withErrors($return)->withInput(Input::except('password'));;
		}else return Redirect::to('/home');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Authenticate the User and go to the homepage
	 * or return back to the form with errors
	 *
	 * @return Response Homepage view or Form with Errors
	 */
	public function authenticate(){
		$input = Input::all();
		if($input){
			$return = User::authenticate($input);
			if(is_a($return, 'User')){
				Auth::login($return);
				return Redirect::to('/home');
			}else{
				return Redirect::to('login')->withInput(Input::except('password'));
			}
		}else{
			return Redirect::to('/home');
		}
	}

	public function validate(){

		$input = Input::all();
		$user = User::find(Auth::id());
		$user->member = 1;
		if(isset($input['payment']))$user->payment = serialize($input['payment']);
		$user->save();

		return "<h2>Congratulations {$user->forename} {$user->surname}!</h2><p>You've successfully become a member, which means you can now enter the <a href='/user/{$user->id}/member'>secret page</a>!</p>";
	}

	public function member(){
		$animal_id = Animal::where("user_id",Auth::id())->pluck('id');
		return View::make('user.member', ["animal_id" => $animal_id]);
	}

	/**
	 * Show the user login form
	 * @return Response Login Form
	 */
	public function login(){

		return View::make('user.login');
	}

	/**
	 * Logout the current Authed user and return to the homepage
	 * @return Response Homepage View
	 */
	public function logout(){
		Auth::logout();
		return Redirect::to('/home');
	}


}
