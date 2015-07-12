<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {


    protected $fillable = ['name'];
    //get posts associated with given tag
    
	public function posts(){
	    return $this->belongsToMany('\App\Post')->withTimestamps();
	}

}
