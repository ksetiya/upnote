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

use Stripe\Stripe;
 

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

// Mission
Route::get('mission', function(){
    return view('mission');
});

// Team
Route::get('team', function(){
    return view('team');
});

// Donations
Route::get('donate', function(){
    return view('donate');
});
 

Route::post('donate', function (){
     // print_r(Input::all());
     // echo '<hr/>';
      
      Stripe::setApiKey('sk_live_7OAQit9Qwqd8ZmI0K8v4he8C');
      $token = Input::get('stripeToken');
      $amount = Input::get('amount');
      
      try{
          $charge = \Stripe\Charge::create([
              "amount" => $amount,
              "currency" => "usd",
              "card" => $token,
              "description" => 'Donation'
              ]
              
              );
          
      } catch(Stripe_CardError $e){
          // card has been declined
          dd($e);
      }
      \Mail::send('emails.donation-success', [], function($message){
			          $message->to(Input::get('stripeEmail'))->subject('Thank you for your contribution!');
			      }); 
       return view('donation-success');
      
      
    });


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

