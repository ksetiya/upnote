@extends('app')

@section('content')
 <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	
 	<h1>Write new Story</h1>
	
	<hr />
	
	{!! Form::open(['route' => 'posts.store'], ['role' => 'form']) !!}
		
		@include('posts.form', ['submitButtonText' => 'Submit Post'])
		
	{!! Form::close() !!}
	 
	
	@include('errors.list')
	 
	 </div>
	 </div>
@stop
