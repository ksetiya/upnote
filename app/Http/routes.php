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
 
Route::resource('users', 'UsersController');
Route::get('users/{username}/posts', 'PostsController@showUserPosts');
//Route::get('posts/category/{category}', 'PostsController@showCategory');  
Route::get('posts/latest', 'PostsController@showLatest');  
Route::get('posts/trending', 'PostsController@showTrending'); 

//contact form
Route::get('contact', 'ContactController@create');
Route::post('contact', ['as' => 'contact', 'uses' => 'ContactController@store']);

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
Route::get('auth/facebook', 'SessionsController@loginWithFacebook');
Route::get('auth/google', 'SessionsController@loginWithGoogle');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

