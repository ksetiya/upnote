@if(!$post->draft)
<article class="grid-item col-md-4 story-wrapper">
	@unless($post->coverpic == null)
	<div class="story-thumbphoto">
		 <a href="{{ action('PostsController@show', [$post->id]) }}">
		 	{!! HTML::image('images/coverpics/'.$post->coverpic,  $post->title, ['title'=>$post->title, 'class'=>'']) !!}
		 	
		 	</a>
	</div>
	@endunless
	

	<div class="story-thumbdata">
				 
				   <h4 class="story-title"><a href="{{ action('PostsController@show', [$post->id]) }}">{{$post->title}}</a></h4>
				   <h4><small class="story-thumbauthor"><a href="/users/{{$post->author}}">{{ $post->author }} {!! HTML::image('images/countryflags/'.$post->user->isoCountry.'.png',  $post->user->country, ['title'=>$post->user->country, 'class'=>'post-block-countryflag']) !!}</a> {{$post->created_at->format('d M. Y') }}</small></h4>
				  <p class="story-excerpt">{{substr($post->body, 0, 140)}}...</p>
					@unless($post->tags->isEmpty())
					<div class="tagwrap">
					@foreach($post->tags as $tag)
					<span class="taglabel label-success label"><a href="{{action('PostsController@showByTag', [$tag->name])}}" title="View all stories about {{$tag->name}}">#{{$tag->name}}</a></span>
					@endforeach
					@endunless
				 	</div>
				<div class="thumbnail-footer">
					
						@include('partials.upheartButton') {!! $post->uphearts()->count() !!}
				
						
						<a class="comment-link" href="{{action('PostsController@show', $post->id)}}#comments"><i class="fa fa-comment"></i> {!! $post->comments->count() !!} </a>
			
				</div>
				@foreach($post->comments as $comment)
					@unless(Route::getCurrentRoute()->getActionName() == 'show')
					@include('partials.comment', ['excerpt' => true])
					@endunless
					@break
					
				@endforeach
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