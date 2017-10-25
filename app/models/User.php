<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	/**
	 * The fillable attributes for storing/updating the user
	 * @var array
	 */
	protected $fillable = ['forename', 'surname', 'species', 'email', 'password'];

	/**
	 * Static array to be used alongisde the built in Validator class
	 * @var array
	 */
	protected static $validation = [
		'forename' => 'required|min:3',
		'surname' => 'required|min:3',
		'email' => 'required|email|unique:users',
		'password' => 'required|min:16'
	];

	/**
	 * Static array of variables expected in authentication
	 * @var array
	 */
	protected static $authentication = ['email', 'password'];

	/**
	 * Authenticate user. Class mainly exists to be overriden by
	 * an extended class which uses an SSL based authentication method
	 *
	 * @param array $fields Authentication fields
	 * @return User The authenticated User
	 * @return Boolean False on failure
	 */
	public function authenticate(array $fields){
		foreach(self::$authentication as $key){
			if(!isset($fields[$key])) return false;
			else $auth_vars[$key] = $fields[$key];
		}

		$user = User::where('email',$auth_vars['email'])->first();
		if($user){
			if(password_verify($auth_vars['password'], $user->password)){
				return $user;
			}else return false;
		}else return false;
	}

	/**
	 * Store user or return errors. Class mainly exists here to
	 * centralise aspects like validation, as well as make the
	 * process easily overriden
	 *
	 * @param  array  $request array of fields for new User model
	 * @return User        		 Newly created User model
	 * @return Vaidator        Errors returned by the validator
	 */
	public static function store(array $request){

		$validator = Validator::make($request, self::$validation);

		if($validator->fails()){
			return $validator;
		}else{
			$request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
			$user = User::create($request);
			return $user;
		}
	}

	public function animal()
  {
      return $this->hasOne('Animal');
  }

}
