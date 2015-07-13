<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Request as Req;
use \App\Classes\ProfanityFilter\Check as ProfanityFilter;

class CommentsController extends Controller {

 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateCommentRequest $request)
	{
		$filter = new ProfanityFilter();
		if($filter->hasProfanity($request->input('body'))){
			return redirect()->back()->withFlashmessage('Please refrain from profanity');
		}
		$comment = Comment::create($request->all());
		$user = \Auth::user();
		
		$comment->author = $user->name;
		$comment->user_id = $user->id;
		$comment->upvotes= 0;

		$comment->save();
		
		// assign points and send notifications
		$postID = $comment->post_id;
		$post = Post::where('id',$postID)->first();  
	 
		$user->addToPoints(150);
		
		if($user->setLevel()){
			$user->newNotification()
			->withSubject('Congrats! You are now '.$user->getLevel())
			->deliver();
		}
		$user->save();
		
		if($comment->user_id !== $post->user_id){
			$user->newNotification()
				->withSubject('+150 points for your kind words.')
				->regarding($post)
				->deliver();	
			
			$toAuthor = User::where('id',$post->user_id)->first();
			$toAuthor->newNotification()
				->withSubject('You received a comment on your story from '. $user->name)
				->regarding($post)
				->deliver();
		}
			
		return redirect()->back();
	}

	public function upVoteComment(){
		if(\Auth::guest()){
				return redirect('/auth/login');
		} 
		
		$commentID = Req::input('commentid');
		$comment = Comment::where('id', $commentID)->first();
		
		$comment->upvotes++;
		
		\Auth::user()->commentvotes.=$commentID.':+1,'; //register that the auth user has upvoted this comment
	  
		\Auth::user()->save();
		
		$comment->save();
		
		$user = User::find($comment->user_id);
		$post = Post::where('id', $comment->post_id)->first();
		
		$user->newNotification()
		//->withType('uphearted') --this breaks it
		->withSubject('New upVote!')
		->withBody(\Auth::user()->name.' has upvoted your comment: '.substr($comment->body, 0, 30).'...')
		->regarding($post)
		->deliver();
 
		
		return redirect()->back();
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$comment = Comment::find($id);
		$comment->delete();
		
		return redirect()->back()->withFlashmessage('Your comment has been deleted');
		
	}

}
