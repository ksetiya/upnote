<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = ['post_id', 'body'];

	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	
	//a post belongs to a post
	public function post() 
	{
		return $this->belongsTo('App\Post');
	}
}
