<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\User; 
use GeoIP as Geo;
Route::get('geo', 'WelcomeController@geo');
Route::resource('users', 'UsersController');
Route::get('users/{username}/posts', 'PostsController@showUserPosts');
//Route::get('posts/category/{category}', 'PostsController@showCategory');  
Route::get('posts/latest', 'PostsController@showLatest');  
Route::get('posts/trending', 'PostsController@showTrending'); 
Route::resource('posts', 'PostsController'); 
Route::resource('comments', 'CommentsController'); 
Route::post('heart', array('as'=> 'heart', 'uses' => 'PostsController@upHeart'));
Route::post('vote', array('as'=> 'vote', 'uses' => 'VotesController@store'));
 
Route::get('posts/tag/{tag}', 'PostsController@showByTag');

Route::post('posts/{id}/comments', [
    'as' => 'comment_path',
    'uses' => 'CommentsController@store'
    
    ]);
//Route::post('handleComment', array('as'=> 'handleComment', 'uses' => 'UsersController@handleComment'));
//Route::post('users.store-points', array('as' => 'users.store-points', 'uses' => 'UsersController@storePoints'));
 
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

// Mark all notifications as read when users clicks on notification dropdown
Route::post('users.markRead', array('as' => 'users.markRead', 'uses' => 'UsersController@markRead'));

// Social logins


Route::get('auth/facebook', function ($facebook = "facebook")
{
    // Get the provider instance
    $provider = Socialize::with($facebook);
	
    // Check, if the user authorised previously.
    // If so, get the User instance with all data,
    // else redirect to the provider auth screen.
    if (Input::has('code'))
    {
        $user = $provider->user();
		 
		if(!User::where('email', $user->email)->exists()) {
		   $location = Geo::getLocation();
			
		   $theUser =  User::create([
		        'name' => $user->name,
			    'email' => $user->email,
			    'avatar' => $user->getAvatar(),
			    'country' => $location['country'],
			    'isoCountry'=> strtolower($location['isoCode'])
		        ]
		        );
		      Mail::send('emails.welcome', ['user'=>$theUser], function($message) use($theUser){
		          $message->to($theUser->email)->subject('Welcome to UpNote');
		      }); 
		} else{ $theUser = User::where('email', $user->email)->first(); }
		
		Auth::login($theUser);
		return redirect('posts');
    } else {
        return $provider->redirect();
    }
});

Route::get('auth/google', function ($google = 'google')
{
	
    // Get the provider instance
    $provider = Socialize::with($google);

    // Check, if the user authorised previously.
    // If so, get the User instance with all data,
    // else redirect to the provider auth screen.
    if (Input::has('code'))
    {
    	 $location = Geo::getLocation();
	    $user = $provider->user();
		if(!User::where('email', $user->email)->exists()) {
		   $theUser =  User::create([
		        'name' => $user->name,
			    'email' => $user->email,
			    'avatar' => $user->getAvatar(),
			    'country' => $location['country'],
			    'isoCountry'=> strtolower($location['isoCode'])
		        ]
		        );
		      Mail::send('emails.welcome', ['user'=>$theUser], function($message) use($theUser){
		          $message->to($theUser->email)->subject('Welcome to UpNote');
		      }); 
		} else{ $theUser = User::where('email', $user->email)->first(); }
		
		Auth::login($theUser);
		return redirect('posts');
    } else {
        return $provider->redirect();
    }
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

