<?php


class CatFact extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cat_facts';

	/**
	 * State whether or not timestamps are required for this model
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * The required fields for cat facts
	 * @var array
	 */
	protected $required = ['fact'];

}
