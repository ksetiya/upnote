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
use Intervention\Image\ImageManagerStatic as Image;
use App\Tag;

class PostsController extends Controller {

 
	public function __construct()
	{
	 Image::configure(['driver' => 'imagick']);
	}

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
	
	public function showUserPosts($username){
		$posts = User::findByUsernameOrFail($username)->posts;
		return view('posts.index', compact('posts'));
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
				
			} else {
				$tags = Tag::lists('name', 'id');	
				return view('posts.create', compact('tags')); 
				
			}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostRequest $request)
	{
		
	  
		$validator = \Validator::make($request->all(), $request->rules());
		
		if ($validator->fails()){
			
			 return redirect('posts/create')
			 			->withErrors($validator)
                        ->withInput();
		}
	 	//validation succeeds
			$post = Post::create($request->except('coverpic', 'tags'));
			$post->body = $this->insertLinksInText($post->body);
			$post->user_id = \Auth::user()->id;
			$post->author = \Auth::user()->name;
			$post->slug = Str::slug($post->title);
			$post->hearts = 0;
			$post->draft = 0;
			
			//handle the uploaded coverpic
			if($request->hasFile('coverpic')){
				
				$img = $this->handleCoverpic($request->file('coverpic'), $request);
				
				$pathtosave = public_path().'/images/coverpics/';
				$ext = $request->file('coverpic')->getClientOriginalExtension();
		
				$img->save($pathtosave.$post->slug.'.'.$ext);
				$post->coverpic = url().'/images/coverpics/'.$post->slug.'.'.$ext;
			}
			
		
			$this->syncTags($post, $request);
		
			$post->save();
                        
		//	return redirect('posts')->withFlashmessage('Thanks for your story! We will review it and let you know when we can publish it.');
			return redirect('posts')->withFlashmessage('Thanks for your story! It has been published for the world to see.');
			
	}

	private function handleCoverpic($img, $request){
		$img = Image::make($request->file('coverpic'));
		// resize the image to a width of 300 and constrain aspect ratio (auto height)
		$img->resize(560, null, function ($constraint) {
		 $constraint->aspectRatio();
		});
		return $img;
			 
	}
	private function insertLinksInText($text){
		
		$regex = '@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.\,]*(\?\S+)?)?)*)@';
		$replacement = '<a href="$1" class="link1" target="_blank">$1</a>';
		$text = preg_replace($regex, $replacement, $text);
		
		return $text;
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
		
		$moreComments = Comment::orderBy('created_at', 'DESC')->take(4)->get();
		return view('posts.show')->with(['post' => $post, 'hearted' => $hearted, 'moreComments' => $moreComments]);
		
	}
	
	public function showLatest(){
	 	$posts = $this->getLatest(10);
		return view('posts.index', compact('posts'));
	}
	
	private function getLatest($numberofPosts){
		$posts =  Post::where('draft', 0)->take($numberofPosts)->orderBy('created_at','DESC')->get();
		return $posts;
	}
	public function showByTag($tag){
		
		$tag = Tag::where('name', $tag)->first();
		$posts = $tag->posts;
	 	 
		return view('posts.index')->with(['posts' => $posts, 'tag'=>$tag]);

	}
	
	public function showTrending(){
		$latest = $this->getLatest(30);
		$trending = $latest->sortByDesc('hearts');
		
		return view('posts.index')->with(['posts' => $trending]);
	}
	
	// public function showCategory($category) {
	
	 
	// 	$posts = Post::where('category', $category)
	// 			->where('draft', 0)->get();
		
		 
	// 	return view('posts.index')->with(['posts' => $posts, 'category'=>$category]);
	// }

	 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tags = Tag::lists('name', 'id');
		$post = Post::findOrFail($id);
		if(\Auth::user()->id == $post->user_id || \Auth::user()->name = 'Karan Solo'){
			return view('posts.edit', compact('post', 'tags'));
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
		
		if($request->hasFile('coverpic')){
		
			$img = $this->handleCoverpic($request->file('coverpic'), $request);
			
			$pathtosave = public_path().'/images/coverpics/';
		 
			$ext = $request->file('coverpic')->getClientOriginalExtension();
	
			$img->save($pathtosave.$post->slug.$post->id.'.'.$ext);
			$post->coverpic = url().'/images/coverpics/'.$post->slug.$post->id.'.'.$ext;
			$post->save();
		} 
		$post->update($request->except('coverpic'));
		$this->syncTags($post, $request);
	 
		return redirect('posts');
	}
	
 
	private function syncTags($post, $request)
	{
	    if ( ! $request->has('tag_list'))
	    {
	        $post->tags()->detach();
	        return;
	    }
	
	    $allTagIds = array();
	
	    foreach ($request->tag_list as $tagId)
	    {
	        if (substr($tagId, 0, 4) == 'new:')
	        {
	            $newTag = Tag::create(['name' => substr($tagId, 4)]);
	            $allTagIds[] = $newTag->id;
	            continue;
	        }
	        $allTagIds[] = $tagId;
	    }
	
	    $post->tags()->sync($allTagIds);
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
		
		// if(\Auth::guest()){
		// 		return redirect('/auth/login');
		// } 
		
		$postID = Req::input('postid');
		$post = Post::where('id', $postID)->first();
		
		$post->hearts++;
		$post->save();
		
		$user = User::find($post->user_id);
		
		if(\Auth::check()){
			\Auth::user()->hearted.=$postID.','; //register that the auth user has hearted this post
			\Auth::user()->addToPoints(50);
			
			if(\Auth::user()->setLevel()){
				\Auth::user()->newNotification()
				->withSubject('Congrats! You are now '.\Auth::user()->getLevel())
				->regarding($post) 
				->deliver();
			}
			
			$user->newNotification()
			//->withType('uphearted') --this breaks it
			->withSubject('New upheart!')
			->withBody(\Auth::user()->name.' uphearted your story: '.$post->title)
			->regarding($post)
			->deliver();
		} else{
			$user->newNotification()
			//->withType('uphearted') --this breaks it
			->withSubject('New upheart!')
			->withBody('Someone (anonymous) uphearted your story: '.$post->title)
			->regarding($post)
			->deliver();
		} 
		
		return redirect()->back()->withFlashmessage("+50 points. Thanks! Your love means a lot. If you haven't already, please login and leave a few uplifting words for ".$post->author." too.");
		 
		
	}

}
