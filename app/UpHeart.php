<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UpHeart extends Model {

	protected $fillable = ['user_id', 'post_id'];

	
	//a upheart is owned by a user
	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	
	//a upheart  belongs to a post
	public function posts() 
	{
		return $this->belongsTo('App\Post');
	}

}
