@extends('app')

@section('content')
 <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	
 	<h1>Write your story</h1>
	<h4><small>&lt;No HTML please, but links are OK&gt;</small></h4>
 
	@include('errors.list')
	
	{!! Form::open(['route' => 'posts.store', 'files' => true], ['role' => 'form']) !!}
		
		@include('posts.form', ['submitButtonText' => 'Submit Post'])
		
	{!! Form::close() !!}
	 
	
	 
	 </div>
	 </div>
@stop

@section('footer')

 

@stop