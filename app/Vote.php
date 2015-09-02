<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $fillable = ['user_id', 'comment_id', 'vote'];

	
	//a vote is owned by a user
	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	
	//a vote is belongs to a comment
	public function comment() 
	{
		return $this->belongsTo('App\Comment');
	}


}
