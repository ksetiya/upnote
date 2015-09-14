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
use DB;

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
				return redirect('/auth/register');
				
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
				$img->save($pathtosave.$post->slug.$post->id.'.'.$ext);
				$post->coverpic = $post->slug.$post->id.'.'.$ext;
			 
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
		
		
		$moreComments = Comment::orderBy('created_at', 'DESC')->take(4)->get();
		return view('posts.show')->with(['post' => $post, 'moreComments' => $moreComments]);
		
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
	
	public function getPopular(){ //the 20 most popular posts by # of uphearts
	
		$popular = Post::select(DB::raw('posts.*, count(*) as "aggregate"'))
	    ->join('up_hearts', 'posts.id', '=', 'up_hearts.post_id')
	    ->groupBy('post_id')
	    ->orderBy('aggregate', 'desc')->take(20)->get();
    
		return view('posts.index')->with(['posts' => $popular]);

	}
	
	public function showTrending(){
		
	 	
		$trending = Post::select(DB::raw('posts.*, count(*) as "aggregate"'))
	    ->join('up_hearts', 'posts.id', '=', 'up_hearts.post_id')
	    ->groupBy('post_id')
	    ->orderBy('posts.created_at', 'desc')->get();
    
		return view('posts.index')->with(['posts' => $trending]);
	}
	
 

	 
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
			$post->coverpic = $post->slug.$post->id.'.'.$ext;
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
	
}
