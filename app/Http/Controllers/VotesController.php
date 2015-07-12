<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request as Req;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Vote;

class VotesController extends Controller {
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(\Auth::guest()){
				return redirect('/auth/login');
		} 
		$voteValue = Req::input('vote');
		$commentID = Req::input('commentid');
		$comment = Comment::where('id', $commentID)->first();
		$vote =	Vote::create([
					'comment_id' => Req::input('commentid'),
					'user_id' => \Auth::user()->id
					]);
					
		if($voteValue == 'upvote'){
			$comment->upvotes++;
			$vote->vote = 1;
			
		} elseif($voteValue == 'downVote'){
			$comment->upvotes--;
			$vote->vote = 0;
		}
		$comment->save();
		$vote->save();
		
		$user = User::find($comment->user_id);
		$post = Post::where('id', $comment->post_id)->first();
		
		$user->newNotification()
		//->withType('uphearted') --this breaks it
		->withSubject('New vote')
		->withBody(\Auth::user()->name.' has '.$voteValue.'d your comment: '.substr($comment->body, 0, 30).'...')
		->regarding($post)
		->deliver();
 
		
		return redirect()->back();
	}

  
  	 

}
