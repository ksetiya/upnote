<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request as Req;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\UpHeart;

class UpheartsController extends Controller {
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$postID = Req::input('postid');
		$post = Post::where('id', $postID)->first(); 
		$user = User::find($post->user_id);
		
        if(\Auth::check()){
			$upheart =	UpHeart::create([
				'post_id' => Req::input('postid'),
				'user_id' => \Auth::user()->id
				]);
			\Auth::user()->addToPoints(50);
			
			$user->newNotification()
			//->withType('uphearted') --this breaks it
			->withSubject('New UpHeart: ')
			->withBody(\Auth::user()->name.' has UpHearted your post! '.substr($post->body, 0, 30).'...')
			->regarding($post)
			->deliver();
			
			if(\Auth::user()->setLevel()){
				\Auth::user()->newNotification()
				->withSubject('Congrats! You are now '.\Auth::user()->getLevel())
				->regarding($post) 
				->deliver();
			}
        }else{
        	$upheart =	UpHeart::create([
				'post_id' => Req::input('postid')
				]);
        	$user->newNotification()
			//->withType('uphearted') --this breaks it
			->withSubject('New UpHeart: ')
			->withBody('Someone (anonymously) UpHearted your post! '.substr($post->body, 0, 30).'...')
			->regarding($post)
			->deliver();
        }
		
		return redirect()->back()->withFlashmessage("+50 points. Thanks! Your love means a lot. If you haven't already, please login and leave a few uplifting words for ".$post->author." as well.");
	}

  
  	 

}
