<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User; 
use GeoIP as Geo;

class SessionsController extends Controller {
 	
 	public function loginWithFacebook($facebook = 'facebook')
 	{
 		 // Get the provider instance
	    $provider = \Socialize::with($facebook);
		
	    // Check, if the user authorised previously.
	    // If so, get the User instance with all data,
	    // else redirect to the provider auth screen.
	    if (\Input::has('code'))
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
			        
			      \Mail::send('emails.welcome', ['user'=>$theUser], function($message) use($theUser){
			          $message->to($theUser->email)->subject('Welcome to UpNote');
			      }); 
			} else{ $theUser = User::where('email', $user->email)->first(); }
			
			\Auth::login($theUser);
			return redirect('posts');
	    } else {
	        return $provider->redirect();
	    }
 	}
 	
 	public function loginWithGoogle($google = 'google')
 	{
 		
	 	// Get the provider instance
	    $provider = \Socialize::with($google);
	
	    // Check, if the user authorised previously.
	    // If so, get the User instance with all data,
	    // else redirect to the provider auth screen.
	    if (\Input::has('code'))
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
			      \Mail::send('emails.welcome', ['user'=>$theUser], function($message) use($theUser){
			          $message->to($theUser->email)->subject('Welcome to UpNote');
			      }); 
			} else{ $theUser = User::where('email', $user->email)->first(); }
			
			\Auth::login($theUser);
			return redirect('posts');
	    } else {
	        return $provider->redirect();
	    }
 	}
}
