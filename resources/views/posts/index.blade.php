@extends('app')

@section('content')

<div class="container col-md-8 col-md-offset-2">
  @if(Session::has('flashmessage'))
<p class="alert alert-info">{{ Session::get('flashmessage') }}</p>
@endif
	<h1 class="page-header wow flipInX">All {{$posts->count()}} stories</h1>
 	<div class="row stories-row grid"> 
 		@foreach($posts as $post)
 			@include('partials.post-block')
 		@endforeach
 	</div>
 
	 
	
</div>	 
</div>
	
@stop
 