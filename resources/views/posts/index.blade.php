@extends('app')

@section('content')

<div class="container col-md-8 col-md-offset-2">
  @if(Session::has('flashmessage'))
<p class="alert alert-info">{{ Session::get('flashmessage') }}</p>
@endif
	<h1 class="page-header wow slideInLeft">All {{$posts->count()}} stories @if(isset($category)) about <strong>{{$category}}</strong> @endif</h1>
 
 @foreach(array_chunk($posts->all(), 3) as $row)
			 
	<div class="row stories-row"> 
		 @foreach($row as $post)
			 
			@include('partials.post-block')
								 
		@endforeach
		 
	</div>
	 
	@endforeach
	 
	
</div>	 
</div>
	
@stop
 