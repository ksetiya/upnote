<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span class="beta-label"><small>Beta</small></span>
				<a class="navbar-brand" href="{{url('/')}}">Upnote <br/></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">	
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-question-circle"></i> About <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
				  	<li><a href="{{url('mission')}}"> Mission</a></li>
					<li><a href="{{url('team')}}"> Team</a></li>
					<li class="divider"></li>
					<li><a href="{{url('donate')}}"> Donate</a></li>
					<li><a href="http://upnote.uservoice.com/forums/317484-general" target="_blank"> Feedback</a></li>
					
				 
				  </ul>
				</li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-list"></i> Stories <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="{{url('posts')}}"> <i class="fa fa-book"></i> All</a></li>
					<li class="divider"></li>
				  	<li><a href="{{url('posts/latest')}}"> <i class="fa fa-clock-o"></i> Latest</a></li>
				  	<li><a href="{{url('posts/popular')}}"> <i class="fa fa-heart"></i> Popular</a></li>
				  	<li><a href="{{url('posts/trending')}}"> <i class="fa fa-line-chart"></i> Trending</a></li>
					
				<!--	<li class="divider"></li>
					<li><a href="{{url('posts/category/health')}}">Health</a></li>
					<li><a href="{{url('posts/category/relationships')}}">Relationships</a></li>
					<li><a href="{{url('posts/category/depression')}}">Depression</a></li>
					<li><a href="{{url('posts/category/school')}}">School</a></li>
					<li><a href="{{url('posts/category/light')}}">Light-hearted</a></li>
					<li><a href="{{url('posts/category/misc')}}">Miscellaneous</a></li>
					-->
				  </ul>
				</li>
				
				</ul>
				
					<ul class="nav navbar-nav">	
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-tag"></i> Tags <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					@foreach(\App\Tag::all() as $tag)
						<li><a href="{{url('posts/tag', $tag->name)}}">#{{ $tag->name }}</a></li>
					@endforeach
				  </ul>
				</li>
				
				</ul>
				
				
				<ul class="nav navbar-nav">
					<li><a href="/posts/create"><i class="fa fa-plus-circle"></i> Create</a></li>
				<!--	<li><a href="/donate"><i class="fa fa-dollar"></i> Donate</a></li> -->
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Register</a></li>
					@else
				 
					<li class="dropdown notifications-wrap">
							  <li class="dropdown notifications-container">
    	  						<a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#">  
		
									<div class="notification-unread">
										<i class="fa fa-bell"></i> 
										@unless($unreadNotifications->count()==0)
										<span id="notifications-count">{{$unreadNotifications->count()}}</span>
										@endunless
									</div>
								</a>   
							<ul class="notification dropdown-menu" role="menu">
						 	 	<li class="subject unread">
						 	 		@if($unreadNotifications->count() == 0)
						 	 			<a href="{{action('UsersController@show', Auth::user()->name)}}">  
										<span class="body">No unread notifications. View all.</span>
										</a>
										
									@else
									@foreach($unreadNotifications as $notification)
									
										@if($notification->hasValidObject())
											<a href="/posts/{{ $notification->getObject()->id }}"> {{ $notification->subject }}
											<span class="body">{{ $notification->body }}</span>
											</a>
											
										@endif
									
									@endforeach
								
								@endif
							  	</li>
						 	 
							</ul>
						</li>
						<li>
							<a>
								<span title='Generosity points' class="label label-info">{{Auth::user()->points}}</span>
								<span title='Generosity level' class="level">{{Auth::user()->level}}</span>
							</a>
						 
						</li>
						 
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							
							{{ Auth::user()->name }} <span class="caret"></span>
							<span><img class="img-circle avatar" src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}"/></span>
							</a>
							
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{action('PostsController@showUserPosts', Auth::user()->name)}}">My Stories</a></li>
								<li><a href="{{action('UsersController@show', Auth::user()->name)}}">Profile</a></li>
									<li class="divider"></li>
								<li><a href="{{url('auth/logout')}}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	
 
 @if(Auth::check() && $unreadNotifications->count() >0)
 <script type="text/javascript">
  
			 $('.notification-unread').click(markRead);
			 
			 function markRead() {
			        $('div').removeClass('notification-unread');
			        $('#notifications-count').empty();
					$.post('{{URL::action("UsersController@markRead")}}', {
					  read:1
					});
			  }
	 

	</script>
@endif
