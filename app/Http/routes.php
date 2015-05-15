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

Route::resource('users', 'UsersController');
Route::get('posts/category/{category}', 'PostsController@showCategory');  
Route::resource('posts', 'PostsController'); 
Route::resource('comments', 'CommentsController'); 
Route::post('heart', array('as'=> 'heart', 'uses' => 'PostsController@upHeart'));

Route::post('handleComment', array('as'=> 'handleComment', 'uses' => 'UsersController@handleComment'));
//Route::post('users.store-points', array('as' => 'users.store-points', 'uses' => 'UsersController@storePoints'));
 
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

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
		 
		$theUser = User::firstOrCreate(array(
			'name' => $user->name,
			'email' => $user->email	));
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
	
        $user = $provider->user();
		 
		$theUser = User::firstOrCreate(array(
			'name' => $user->name,
			'email' => $user->email	));
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

