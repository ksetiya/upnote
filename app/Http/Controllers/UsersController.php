<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as Req;

use App\Post;
use App\User;
use App\Comment;
use App\Notification;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users =  User::all();
		return view('users.index', compact('users'));
	}

	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
	
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($username)
	{
		$user =  User::findByUsernameOrFail($username);
		 
		return view('users.show', compact('user'));
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
		$user = User::find($id);
		$user->delete();
		
		return redirect('posts');
		
	}
	
	 public function handleComment() //add 150 points for posting comment and send a notification
	 {
		$postID = Req::input('postID');
		$post = Post::where('id',$postID)->first();  
		$user = \Auth::user();
		$commentBody = Req::input('body');
		 
		$user->addToPoints(150);
		if($user->setLevel()){
			$user->newNotification()
			//->withType('')
			->withSubject('Congrats! You are now '.$user->getLevel())
			//->withBody('')
			//->regarding($recipe)
			->deliver();
		}
		$user->save();
		
		$user->newNotification()
			//->withType('')
			->withSubject('+150 points for your kind words.')
			//->withBody('')
			->regarding($post)
			->deliver();	
		
		$toAuthor = User::where('name',$post->author)->first();
		$toAuthor->newNotification()
			//->withType('')
			->withSubject('You received a comment on your story from '. $user->name)
			//->withBody('')
			->regarding($post)
			->deliver();
	 }
	
	 
}
