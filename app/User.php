<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'avatar', 'country', 'isoCountry'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	   /**
     * Find by username, or throw an exception.
     *
     * @param string $username The username.
     * @param mixed $columns The columns to return.
     *
     * @throws ModelNotFoundException if no matching User exists.
     *
     * @return User
     */
    public static function findByUsernameOrFail($username, $columns = array('*')) {
       
	   if ( ! is_null($user = static::whereName($username)->first($columns))) {
            return $user;
        }

        throw new ModelNotFoundException;
    }
	
	// a user can have many uphearts
	 
	public function uphearts() 
	{
		return $this->hasMany('App\UpHeart');
	}
	
	// a user can have many posts
	 
	public function posts() 
	{
		return $this->hasMany('App\Post');
	}
	
	// a user can have many votes
	public function votes() 
	{
		return $this->hasMany('App\Vote');
	}
	
	//a user can have many comments
	public function comments() 
	{
		return $this->hasMany('App\Comment');
	}
	
	// In your User model - 1 User has Many Notifications
	public function notifications()
	{
		return $this->hasMany('App\Notification');
	}

	public function newNotification()
	{
		
		$notification = new Notification;
		 
		$notification->user()->associate($this);
		
		return $notification;
	}
	
	 public function countUnreadNotifications($id){
		$user = User::find($id);
 
		$notifications = $user->notifications()->count();
	}
	
	public function getUnreadNotifications($id){
		$user = User::find($id);
 
		$notifications = $user->notifications()->unread()->get();
		
		return $notifications;
	}
	
	// points 'generosity'
	
	private function pointsFormat($num) {
	
		if($num<1000) return $num;
		
		  $x = round($num);
		  $x_number_format = number_format($x);
		  $x_array = explode(',', $x_number_format);
		  $x_parts = array('k', 'm', 'b', 't');
		  $x_count_parts = count($x_array) - 1;
		  $x_display = $x;
		  $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
		  $x_display .= $x_parts[$x_count_parts - 1];
		  return $x_display;
	}
	
	public function addToPoints($amount)
	{
		$this->points += $amount; 
		$this->save();
		return;
	}
	
	public function getPoints(){
		$points = $this->pointsFormat($this->points);
		
		return $points;
	}
	
	 public function setLevel()
	{
		$currentLevel = $this->level;
		$promotion = 0;
		
		if($this->points < 1500) $this->level = 'Neighborly';
		if($this->points < 10000 && $this->points > 1500 ) $this->level = 'Friendly';
		if($this->points < 25000 && $this->points > 10000) $this->level = 'Good Samaritan';
		if($this->points < 50000 && $this->points > 25000) $this->level = 'Honorable Helper';
		if($this->points < 85000 && $this->points > 50000) $this->level = 'Role Model';
		if($this->points < 100000 && $this->points > 85000) $this->level = 'Munificent';
		if($this->points < 200000 && $this->points > 100000) $this->level = 'Worldly Saint';
		if($this->points > 200000) $this->level = 'True Altruist';
		
		// if level changed (promoted) then send a notification
		
		if($currentLevel !== $this->level){
			$promotion = 1;
		}
		$this->save();
		return $promotion;
	}
	
	public function getLevel()
	{
		return $this->level;
	}
}
