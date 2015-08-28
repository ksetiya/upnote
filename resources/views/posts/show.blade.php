@extends('app')

@section('content')
 <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	 <script src="http://veduo.nl/js/jquery.counterup.min.js"></script>
	
 <script>
    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
            delay: 10,
            time: 750
        });
    });
  </script> 
  
<div class="container col-md-8 col-md-offset-2">
 @if(Session::has('flashmessage'))
<p class="alert alert-info">{{ Session::get('flashmessage') }}</p>
 @endif

	<h1 class="page-header text-center">{{$post->title}}  </h1>
	<h2 class="text-center"><small> by <a href="/users/{{$post->author}}">{{ strtok($post->author, " ") }}</a> ({{$post->user->country}})</small> </h2> 

	@if(\Auth::check() && $post->author == \Auth::user()->name)	 
	<small class="pull-right">
	<a href="{{Request::url()}}/edit"><button class="btn btn-default pull-right"><i class="fa fa-edit"></i> Edit</button></a>
		 

	</small>
	@endif
	
	
 
	<div class="story-container">
	
	@unless($post->coverpic == null)
	<div class="row">
		<div class="col-md-12">
			<img class="post-cover-pic wow fadeIn" src="{{$post->coverpic}}" alt="{{$post->title}}" />
		</div>
	</div>
	@endunless
	
	<div class="row">
			
			<article class="col-md-12 post-body wow flipInX">
				<p><small><i>Created on: {{$post->created_at->format('d M. Y') }}</i></small></p>
				{!! $post->body !!}
				
				@unless($post->tags->isEmpty())
				<p>
					@foreach($post->tags as $tag)
						<a href="{!! action('PostsController@showByTag', $tag->name) !!}"><span class="label label-default post-tag"> #{{ $tag->name }}</span></a>
					@endforeach 
				</p>
				@endunless
			</article>
	</div>
		 
		 
	<div class="row">
	<div class="comment-counter-wrap col-md-6 wow fadeIn">
			<span class="comment-counter"><i class="post-comment fa fa-comment"></i>  </span>
		<!--	<h3><a href="{{url('posts')}}/{{$post->id}}#disqus_thread"></a> UpNotes</h3> -->
			<h4> {!! $post->comments->count() !!} UpNotes</h4> 
		
	 </div>
	 
		
	 <div class="heartswrap col-md-6 wow fadeIn">
	 
			<span title="{{$post->hearts}} people have shown love, have you?" class="hearts">
				<i class="post-heart fa fa-heart"></i>
			</span> 
			<h4><span class="counter">{{$post->hearts}}</span> UpHearts</h4>
	 
	 	</div> 
	</div>	 
		
	 	<div class="row">
			<div class="col-md-12">
		@if(Auth::check())
			{!! Form::open(['route' => ['comment_path', $post->id], 'class' => 'comments__create-form']) !!}
				{!! Form::hidden('post_id', $post->id) !!}
				
				<div class="form-group row">
					<h2>Say a few kind words for <a href="{{action('UsersController@show', $post->user->name)}}"> {{strtok($post->author, " ")}}</a></h2>
					 <div class="col-md-1">@include('partials.avatar', ['user' => \Auth::user(), 'class' => 'media-object img-circle'])</div>
					 <div class="col-md-11">
					{!! Form::textarea('body', null, ['id' => 'sampleUpnotes', 'class' => 'form-control comment-textarea', 'rows' => 2]) !!}
					</div>
				</div>
			{!! Form::close() !!}
		@else
			<div class="comments__create-form">
				<h4><a href="{!! url('/auth/login') !!}">Log in</a> to leave an UpNote for <a href="{{action('UsersController@show', $post->user->name)}}">{!! $post->author !!}</a></h4>	 
			</div>
		@endif
		
		@if($post->comments)
			<div class="comments">
			
				@foreach($post->comments as $comment)
					@include('partials.comment')
				@endforeach
				
			</div>
		@endif
		
		
	<h2>What others are saying</h2>
			@if(\Auth::check())
				@foreach($moreComments as $comment)
					@unless($comment->user->id == \Auth::user()->id)
						<h5> <a href="{!! action('PostsController@show', $comment->post->id) !!}">{!! $comment->post->title !!}</a> </h5>
						@include('partials.comment')
					@endunless
				@endforeach
			@else
				@foreach($moreComments as $comment)
					<h5> <a href="{!! action('PostsController@show', $comment->post->id) !!}">{!! $comment->post->title !!}</a> </h5>
					@include('partials.comment')
				@endforeach
			@endif
		
		
		
	</div>
	</div>	
	</div>
 
		 
		</div>
	 
	
	@if(!$hearted) 
		{!! Form::open(array('route' => 'heart', 'role' => 'form', 'id' => 'heartform'))!!}
			{!! Form::hidden('postid', $post->id) !!}
		{!! Form::close() !!}
		
		<script type="text/javascript">

		$(document).ready(function(){
			var heartform = $("#heartform");
			$('.post-heart').click(function(e) {
				
				heartform.submit();
				e.preventDefault();
				
				
			});
		 });
		 
		 </script>
	 @else
	 <script type="text/javascript">
	 	$('.post-heart').css('color', 'red');
	 	
	 </script>
	 @endif
	 
	 </div>
@stop

@section('footer')
<script> 
function typed(){
   $("#sampleUpnotes").typed({
        strings: ["{{
        		Config::get('constants.sampleUpnotes')[array_rand(Config::get('constants.sampleUpnotes'))]
        }}"],
        typeSpeed: 0
    })
  };
	      
 
setInterval(function(){ 
	if($('#sampleUpnotes').visible()){
			typed();
			$('.typed-cursor').css('display', 'none');
		}
	}, 1500);
	
$("#sampleUpnotes").click(function(){
	$(this).text('');
})
	
</script>
 
@stop