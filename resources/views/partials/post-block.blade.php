@if(!$post->draft)
<article class="row story-wrapper">
	<div class="upheart-button col-md-1">	@include('partials.upheartButton') {!! $post->uphearts()->count() !!}</div>
	
	@if($post->coverpic != null)
		 <a href="{{ action('PostsController@show', [$post->id]) }}">
		<div class="col-md-2 story-thumbphoto" style="background-image:url(images/coverpics/{{$post->coverpic}}">
		</div>
		 	</a>
 	<div class="col-md-7 story-thumbdata">
	@else			 
	<div class="col-md-9 story-thumbdata">
	@endif
				   <h4 class="story-title"><a href="{{ action('PostsController@show', [$post->id]) }}">{{$post->title}}</a></h4>
				   <h4 class="author-wrap"><small class="story-thumbauthor"><a href="/users/{{$post->author}}">{{ $post->author }} {!! HTML::image('images/countryflags/'.$post->user->isoCountry.'.png',  $post->user->country, ['title'=>$post->user->country, 'class'=>'post-block-countryflag']) !!}</a> {{$post->created_at->format('d M. Y') }}</small></h4>
				  <p class="story-excerpt">{{substr($post->body, 0, 90)}}...</p>
					@unless($post->tags->isEmpty())
					<div class="tagwrap">
					@foreach($post->tags as $tag)
					<span class="taglabel label-success label"><a href="{{action('PostsController@showByTag', [$tag->name])}}" title="View all stories about {{$tag->name}}">#{{$tag->name}}</a></span>
					@endforeach
					@endunless
				 	</div>
				
				<!--
					@if($post->comments)
						@foreach($post->comments as $comment)
						@unless(Route::getCurrentRoute()->getActionName() == 'show')
								@include('partials.comment', ['excerpt' => true])
							@endunless
							@break	
						 
							
						@endforeach
				@endif
				-->
			
	</div>
	
	<div class="col-md-2 comments-link">
					 
						<a class="comment-link" href="{{action('PostsController@show', $post->id)}}#comments"><i class="fa fa-comment"></i> {!! $post->comments->count() !!} </a>
			
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