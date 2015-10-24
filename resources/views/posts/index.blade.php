@extends('app')

@section('content')

<div class="container col-md-10 col-md-offset-1">
  @if(Session::has('flashmessage'))
<p class="alert alert-info">{{ Session::get('flashmessage') }}</p>
@endif
	<h1 class="page-header wow flipInX">All {{$posts->count()}} stories</h1>
 	<div class="row"> 
 		@foreach($posts as $post)
 			@include('partials.post-block')
 		@endforeach
 	</div>
 
	 
	
</div>	 
</div>
	
@stop
 