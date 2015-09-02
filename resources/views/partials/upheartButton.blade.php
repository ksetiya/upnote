	@if(Auth::check() && !$post->uphearts()->where('user_id', Auth::user()->id)->exists())	
				
					 {!! Form::open(array('route' => 'posts', 'role' => 'form', 'id' => 'post'.$post->id, 'class' => 'upheartForm'))!!}
			   	
				    	{!! Form::hidden('postid', $post->id) !!}
				    
					{!! Form::close() !!}
					<i class="fa fa-heart-o post-heart post{!! $post->id !!}"></i> 
					 
					  	<script type="text/javascript">

									$(document).ready(function(){
										var upheartForm{!! $post->id !!} = $("#post{!! $post->id !!}");
										$('.post{!! $post->id !!}').click(function(e) {
											 
											upheartForm{!! $post->id !!}.submit();
											e.preventDefault();
											
											
										});
									 });
									 
								</script>
								
				@else
					<i class="post-heart fa fa-heart hearted"></i>  
				@endif
				