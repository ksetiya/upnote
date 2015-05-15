<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{url('/')}}">UpNote</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">	
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-list"></i> Stories <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="{{url('posts')}}">All</a></li>
					<li class="divider"></li>
					<li><a href="{{url('posts/category/health')}}">Health</a></li>
					<li><a href="{{url('posts/category/relationships')}}">Relationships</a></li>
					<li><a href="{{url('posts/category/depression')}}">Depression</a></li>
					<li><a href="{{url('posts/category/school')}}">School</a></li>
					<li><a href="{{url('posts/category/light')}}">Light-hearted</a></li>
					<li><a href="{{url('posts/category/misc')}}">Miscellaneous</a></li>
					
				  </ul>
				</li>
				
				</ul>
				
				<ul class="nav navbar-nav">
					<li><a href="/posts/create"><i class="fa fa-plus-circle"></i> Create</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Register</a></li>
					@else
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bell"></i>{{$unreadNotifications->count()}}</a>
							<ul class="notification dropdown-menu" role="menu">
							@if(!$unreadNotifications->count()>0)
								<li class="divider"></li>
								<li><a href="#">No recent notifications</a></li>
							@else
								@foreach($unreadNotifications as $notification)
									<li class="subject">
									@if($notification->hasValidObject())
										<a href="/posts/{{ $notification->getObject()->id }}"> {{ $notification->subject }}
										<span class="body">{{ $notification->body }}</span>
										</a>
										
									@endif
									</li>
								@endforeach
							@endif	 
							</ul>
						</li>
												
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<span title='Generosity points' class="label label-info">{{Auth::user()->points}}</span>
							<span title='Generosity level' class="level">
							{{Auth::user()->level}}
							</span>
							{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
