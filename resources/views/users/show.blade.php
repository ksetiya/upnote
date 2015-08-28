@extends('app')

@section('content')
<div class="container">
  <div class="row">
  	<div class="col-md-8 col-md-offset-2">
    
      <div class="panel panel-default">
			<div class="panel-body">
              		<div class="row">
                      <div class="col-xs-12 col-sm-4 text-center">
                      		 
                                <img src="{{$user->avatar}}" alt="" class="profile-avatar center-block img-circle img-responsive">
                                
                        </div><!--/col--> 
                      
                      
                        <div class="col-xs-12 col-sm-8">
                            <h2>{{$user->name}}  {!! HTML::image('images/countryflags/'.$user->isoCountry.'.png') !!}</h2>
                            <p> 
                            </p>
                        </div><!--/col-->          
                       

                       
                        <div class="col-xs-12 col-sm-3">
                            <h2><strong>{{$user->level}}</strong></h2>                    
                            <p><small>Generosity Level</small></p>
                             
                        </div><!--/col-->
                        <div class="col-xs-12 col-sm-3">
                            <h2><strong>{{$user->points }}</strong></h2>                    
                            <p><small>Generosity Points</small></p>
                          
                        </div><!--/col-->
                         <div class="col-xs-12 col-sm-2">
                            <h2><strong>  {{$user->comments->count()}} </strong></h2>                    
                            <p><small>UpNotes</small></p>
                             
                        </div><!--/col-->
              		</div><!--/row-->
              		<div class="row">
              			
              			<div class="col-md-8">
              				
              				<h3>{{$user->name}}'s Stories</h3>
		
								<ul class="list-unstyled">
									@foreach($user->posts as $post)
										<li><a href="{{action('PostsController@show', $post->id)}}">{{$post->title}}</a> <small><i class="fa fa-comment"></i> {{$post->comments->count()}} &bull; <i class="fa fa-heart"></i> {{$post->hearts}}</small></li>
									@endforeach
									
								</ul>
		
              			</div>
              		@if(\Auth::check() && \Auth::user()->id == $user->id)
					<div class="col-md-4">
						<h3>Notifications</h3>
						<ul class="list-unstyled">
						@foreach($user->notifications as $notification)
						
							<li><a href="{{action('PostsController@show', $notification->object_id)}}"><strong>{{ $notification->subject }}</strong>: {{ $notification->body }}</a> </li>
						
						@endforeach
						</ul>
					</div>
					@endif
              		</div>
              		
              </div><!--/panel-body-->
          </div><!--/panel-->

    
    
    </div>
  </div>
</div>
 
@stop