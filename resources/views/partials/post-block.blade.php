@if(!$post->draft)
<article class="col-md-4 story-wrapper">
	@unless($post->coverpic == null)
	<div class="story-thumbphoto">
		 <a href="{{ action('PostsController@show', [$post->id]) }}"><img src="{{$post->coverpic}}" alt="{{$post->title}}"></a>
	</div>
	@endunless
	
	@unless($post->tags->isEmpty())
	<span class="taglabel label-success label"><a href="{{action('PostsController@showByTag', [$post->tags->first()->name])}}" title="View all stories about {{$post->tags->first()->name}}">#{{$post->tags->first()->name}}</a></span>
	@endunless
	<div class="story-thumbdata">
				 
				   <h4 class="story-title"><a href="{{ action('PostsController@show', [$post->id]) }}">{{$post->title}}</a></h4>
				   <h4><small class="story-thumbauthor"><a href="/users/{{$post->author}}">{{ $post->author }} {!! HTML::image('images/countryflags/'.$post->user->isoCountry.'.png',  $post->user->country, ['title'=>$post->user->country, 'class'=>'post-block-countryflag']) !!}</a> {{$post->created_at->format('d M. Y') }}</small></h4>
				  <p class="story-excerpt">{{substr($post->body, 0, 140)}}...</p>
				
				 
				<div class="thumbnail-footer">
					
					<a href="{{ action('PostsController@show', [$post->id]) }}">
						<i class="fa fa-heart"></i> {{$post->hearts}}
					</a>
						<a href="{{url('posts')}}/{{$post->id}}"><i class="fa fa-comment"></i> </a>
					 {!! $post->comments->count() !!} 
					 
				</div>
	</div>
</article>
	
	 
			
		
			<!--
			@if($post->comments()->first())
				@foreach($post->comments as $comment)
					<p><a href="/users/{{$comment->author}}"><span class="comment-author">{{$comment->author}}</a>: </span>{{ $comment->body }}</p>
				@endforeach
			@endif
		-->
		 
		@endif