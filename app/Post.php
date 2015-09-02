<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model {
	
	//Validation rules are in PostRequest.php
 
	
	protected $fillable = ['title', 'body', 'coverpic', 'tags', 'user_id', 'created_at', 'author', 'hearts'];

	public function uphearts()
	{
		return $this->hasMany('App\UpHeart');
	}
	//a post is owned by a user
	public function user() 
	{
		return $this->belongsTo('App\User');
	}
	 
	//a post can have many comments
	public function comments() 
	{
		return $this->hasMany('App\Comment')->orderBy('created_at', 'DESC');
	}
	
	/**
	 * Get the tags associated with the given article
	 *
	 * @return \Illuminate\Datebase\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}
	
	//get list of tag ids associated with the current post
	//returns array
	public function getTagListAttribute(){
		return $this->tags->lists('id');
	}
}
