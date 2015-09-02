<article class="comments__comment media status-media">
    <div class="pull-left">
        @include('partials.avatar', ['user' => $comment->user, 'class' => 'media-object img-circle'])
        
    </div>
    
    <div class="media-body">
        <h4 class="media-heading"> <a href="{{action('UsersController@show', $comment->user->name)}}">{!! $comment->user->name !!} </a> <small class="comment-timestamp">{!! \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() !!}</small><br/>
	       </h4>
        <div class="row">
	        <div class="col-md-12">
	        <div class="comment-body"> {!! $comment->body !!}</div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="col-md-12">
	
			     @if(Auth::check() && Auth::user()->id == $comment->user_id)
		        	{!! Form::open(['method' => 'DELETE', 'action' => ['CommentsController@destroy', $comment->id]]) !!}
    				   <span class="commentscore"> {!!  $comment->upvotes !!}</span>
    				   <button id="comment-delete-button" type="submit"><i class="fa fa-trash-o" /></i></button>
		    		{!! Form::close() !!}
		             
		        @else
			   {!! Form::open(array('route' => 'vote', 'role' => 'form', 'id' => 'vote'.$comment->id, 'class' => 'voteForm'))!!}
			   		<span class="commentscore"> {!! $comment->upvotes !!}</span>
			    	{!! Form::hidden('commentid', $comment->id) !!}
			    	{!! Form::hidden('vote', '',  ['class'=>'voteValue']) !!}
			    	<button><i class="vote fa fa-arrow-up" id="upvote" /></i></button>
			    	<button><i class="vote fa fa-arrow-down" id="downvote" /></i></button>
				{!! Form::close() !!}
			    @endif
	        </div>
	    </div>
     
		<script type="text/javascript">

		$(document).ready(function(){
			var voteForm = $("#vote{!! $comment->id !!}");
			$('.vote').click(function(e) {
				$('.voteValue').val(e.target.id);
				voteForm.submit();
				e.preventDefault();
				
				
			});
		 });
		 
		 </script>
		 
	    
       
        
    </div>
    
</article>