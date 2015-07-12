<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = ['user_id', 'post_id', 'body'];

	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	
	// a comment can have many votes
	public function votes() 
	{
		return $this->hasMany('App\Vote');
	}
	
	//a post belongs to a post
	public function post() 
	{
		return $this->belongsTo('App\Post');
	}
}
