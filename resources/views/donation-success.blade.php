@extends('app')

@section('content')
<div class="col-md-8 col-md-offset-2">
    @if(Session::has('flashmessage'))
        <p class="alert alert-info"><i class="fa fa-envelope"></i> {{ Session::get('flashmessage') }}</p>
     @endif
    
      <div class="row">
          
          <h1 class="page-header">Thank you for your donation to UpNote! </h1>
          <h2>We truly appreciate the support.</h2>
          <p>We rely on donations to keep the site <strong>free</strong> and up-and-running. Please tell a friend :)</p>
          <div class="joinz">
	  	<a class="btn btn-success btn-lg" href="{{url('./posts')}}" role="button">Browse stories <i class="fa-book fa"></i></a>
	  </div>
           
      </div>
       
    
</div>
@stop