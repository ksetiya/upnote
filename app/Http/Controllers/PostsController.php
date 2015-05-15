<?php namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Request as Req;
use App\Notification;
use Carbon\Carbon;

class PostsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::latest()->where('draft', 0)->get();
		$latestPosts = Post::orderBy('created_at', 'DESC')->take(7)->get();
		return view('posts.index')->with(['posts' => $posts, 'latestPosts' => $latestPosts ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(\Auth::guest()){
				return redirect('/auth/login');
				
			} else return view('posts.create'); 
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostRequest $request)
	{
	 
		$post = Post::create($request->all());
		$post->user_id = \Auth::user()->id;
		$post->author = \Auth::user()->name;
		$post->slug = Str::slug($post->title);
		$post->hearts = 0;
		$post->save();

		return redirect('posts')->withFlashmessage('Thanks for your story! We will review it and let you know when we can publish it.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post =  Post::findOrFail($id);
		
		$hearted = 0;
		 
		if(\Auth::check()){
			$user = \Auth::user();
			foreach(explode(',', $user->hearted) as $heartedPost) 
			{
				if($heartedPost == $post->id) {
					$hearted = 1;
				}
			}
		}
		
		if(Comment::with('post_id', $id)->exists()){
			$comments = Comment::where('post_id', $id)->get();
			
			return view('posts.show')->with(['post' => $post, 'comments' => $comments, 'hearted' => $hearted]);
		}
		
		return view('posts.show')->with(['post' => $post, 'hearted' => $hearted]);
		
	}
	
	public function showCategory($category) {
	
	 
		$posts = Post::where('category', $category)
				->where('draft', 0)->get();
		
		 
		return view('posts.index')->with(['posts' => $posts]);
	}

	 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::findOrFail($id);
		if(\Auth::user()->id == $post->user_id){
			return view('posts.edit', compact('post'));
			}
		return redirect('posts'); 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, PostRequest $request)
	{
		$post = Post::findOrFail($id);
		
		$post->update($request->all());
		
		return redirect('posts');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		
		return redirect('posts');
		
	}
	
	public function upHeart()
	{
		
		if(\Auth::guest()){
				return redirect('/auth/login');
		} 
		
		$postID = Req::input('postid');
		$post = Post::where('id', $postID)->first();
		
		$post->hearts++;
		
		\Auth::user()->hearted.=$postID.','; //register that the auth user has hearted this post
		\Auth::user()->addToPoints(50);
		
		if(\Auth::user()->setLevel()){
			if(\Auth::user()->setLevel()){
				\Auth::user()->newNotification()
				->withSubject('Congrats! You are now '.\Auth::user()->getLevel())
				->deliver();
			}
		}
		
		\Auth::user()->save();
		
		$post->save();
		
		$user = User::find($post->user_id);
		
		$user->newNotification()
		//->withType('uphearted') --this breaks it
		->withSubject('New upheart!')
		->withBody(\Auth::user()->name.' uphearted your story: '.$post->title)
		->regarding($post)
		->deliver();
 
		
		return redirect()->back()->withFlashmessage("+50 points. Thanks! Your love means a lot. If you haven't already, please leave a few uplifting words for ".$post->author." too.");
		 
		
	}

}
