<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	
	//Validation rules
	public static $rules = [
		 'title' => 'required'
	];
	
	protected $fillable = ['title', 'body', 'coverpic', 'category', 'tags'];

	
	//a post is owned by a user
	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	 
	//a post can have many comments
	public function comments() 
	{
		return $this->hasMany('App\Comment');
	}
}
