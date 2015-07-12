@extends('app')

@section('content')

<div class="container">
	
	<div class="row">
		<div class="col-md-12">
			
	
		<h1 class="page-header">@include('partials.avatar') {{$user->name}} {!! HTML::image('images/countryflags/'.$user->isoCountry.'.png') !!}</h1>
		
		<ul>
			<li>
				Name: {{$user->name}}
			</li>
			<li>
				Generosity Level: {{$user->level}}
			</li>
			<li>
				Generosity Points: {{$user->points }}
			</li>
			<li>
				UpNotes: {{$user->comments->count()}}
			</li>
		</ul>
		
		<div class="col-md-8">
		<h2>{{$user->name}}'s Stories</h2>
		
		<ul>
			@foreach($user->posts as $post)
				<li><a href="{{action('PostsController@show', $post->id)}}">{{$post->title}}</a> <small><i class="fa fa-comment"></i> {{$post->comments->count()}} &bull; <i class="fa fa-heart"></i> {{$post->hearts}}</small></li>
			@endforeach
			
		</ul>
		</div>
		
		@if(\Auth::check() && \Auth::user()->id == $user->id)
		<div class="col-md-4">
			<h2>Notifications</h2>
			<ul>
			@foreach($user->notifications as $notification)
			
				<li><a href="{{action('PostsController@show', $notification->object_id)}}"><strong>{{ $notification->subject }}</strong>: {{ $notification->body }}</a> </li>
			
			@endforeach
			</ul>
		</div>
		@endif
		</div>
	</div>
</div>
@stop