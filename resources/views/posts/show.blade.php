@extends('app')

@section('content')
	
<div class="container col-md-8 col-md-offset-2">
 @if(Session::has('flashmessage'))
<p class="alert alert-info">{{ Session::get('flashmessage') }}</p>
 @endif

	<h1 class="page-header">{{$post->title}}  <small> by <a href="/users/{{$post->author}}">{{ $post->author }}</a></small> <br />
	<small class="title-category title-category-{{$post->category}}">{{$post->category}}</small>
	
	<small class="pull-right">
	@if(\Auth::check() && $post->author == \Auth::user()->name)
		<a href="{{Request::url()}}/edit"><i class="fa fa-edit"></i> Edit story</a>
	@endif
	</small>
	</h1>
	 
	<p><small>{{$post->created_at->format('d M. Y') }}</small></p>
	
	<div class="col-md-12">
	
		<img class="post-cover-pic wow fadeIn" src="{{$post->coverpic}}" alt="{{$post->title}}" />
	
		<article class="post-body wow flipInX">{{$post->body}}</article>
		 
		 <div class="heartswrap wow bounceInUp">
		@if(\Auth::guest())
			<span title="{{$post->hearts}} people have shown love, have you?" class="hearts"><a href="/auth/login"><i class="post-heart fa fa-heart-o"></i> {{$post->hearts}}</a></span>
		@elseif($hearted)
			<span title="{{$post->hearts}} people have shown love, have you?" class="hearts"><i class="post-heart fa fa-heart"></i> {{$post->hearts}}</span>
		@elseif(!$hearted)
			<span title="{{$post->hearts}} people have shown love, have you?" class="hearts"><i class="post-heart fa fa-heart-o"></i> {{$post->hearts}}</span>
		@endif
	 	</div>
		
		<div id="disqus_thread" class="wow slideInRight"></div>
		<script type="text/javascript">
			/* * * CONFIGURATION VARIABLES * * */
			var disqus_shortname = 'give-a-little';
			
			@if(\Auth::check())
			var disqus_config = function() {
				this.callbacks.onNewComment = [function(comment) { 
				 
				$.post("{{ action('UsersController@handleComment') }}", {
						  postID : {{$post->id}},
						  body : comment.text
						}); 
					}];
			  };
			@endif
			/* * * DON'T EDIT BELOW THIS LINE * * */
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
				 
	</div>
	
		 
		</div>
	 
	
	@if(!$hearted) 
		{!! Form::open(array('route' => 'heart', 'role' => 'form', 'id' => 'heartform'))!!}
			{!! Form::hidden('postid', $post->id) !!}
		{!! Form::close() !!}
		
		<script type="text/javascript">

		$(document).ready(function(){
			var heartform = $("#heartform");
			$('.fa-heart-o').click(function(e) {
				
				heartform.submit();
				e.preventDefault();
				
				
			});
		 });
		 
		 </script>
	 @endif
	 
	 </div>
@stop