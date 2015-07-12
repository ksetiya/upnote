<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $fillable = ['user_id', 'comment_id', 'vote'];

	
	//a post is owned by a user
	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	
	//a post is owned by a user
	public function comment() 
	{
		return $this->belongsTo('App\Comment');
	}


}
