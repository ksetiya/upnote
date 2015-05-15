@extends('app')

@section('content')

<div class="container col-md-8 col-md-offset-2">
  @if(Session::has('flashmessage'))
<p class="alert alert-info">{{ Session::get('flashmessage') }}</p>
@endif
	<h1 class="page-header">All {{$posts->count()}} Stories</h1>
	
	<ul>
	@foreach($posts as $post)
	@if(!$post->draft)
	<div class="story-wrapper wow fadeIn">
		<h2><a href="{{ action('PostsController@show', [$post->id]) }}">{{$post->title}} <small class="title-category title-category-{{$post->category}}">{{$post->category}}</small></a>
		
		<p> <small> by <a href="/users/{{$post->author}}">{{ $post->author }}</a> {{$post->created_at->format('d M. Y') }}</small></h2></p>
 
		<div class="row">
			<div class="col-md-8">
				 <a href="{{ action('PostsController@show', [$post->id]) }}" class="thumbnail">
				  <img src="{{$post->coverpic}}" alt="Finals coming up">
				  <p>{{substr($post->body, 0, 220)}}...</p>
				</a>
			</div>
		</div>
			
		<p> 
			<a href="{{ action('PostsController@show', [$post->id]) }}">
				<i class="fa fa-heart"></i> {{$post->hearts}}
			</a>
				<a href="{{url('posts')}}/{{$post->id}}"><i class="fa fa-comment"></i> </a>
				<a href="{{url('posts')}}/{{$post->id}}#disqus_thread"></a>
				
				 
			
		</p>
			
			@if($post->comments()->first())
				@foreach($post->comments as $comment)
					<p><a href="/users/{{$comment->author}}"><span class="comment-author">{{$comment->author}}</a>: </span>{{ $comment->body }}</p>
				@endforeach
			@endif
		
		</div>
		@endif
		@endforeach
		</ul>
	
	
	
@stop