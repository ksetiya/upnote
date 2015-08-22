@extends('app')

@section('content')
 <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	<h1>Edit: {!! $post->title !!}</h1>
	{!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
		<button type="submit">Delete</button>
	{!! Form::close() !!}
	<hr />
	
	{!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id], 'files' => true], ['role' => 'form']) !!}
	
		@include('posts.form', ['submitButtonText' => 'Update Post'])
		
	{!! Form::close() !!}
	
	@include('errors.list')
	</div>
	</div>
@stop