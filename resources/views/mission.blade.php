@extends('app')

@section('content')
<div class="col-md-8 col-md-offset-2">
    @if(Session::has('flashmessage'))
        <p class="alert alert-info"><i class="fa fa-envelope"></i> {{ Session::get('flashmessage') }}</p>
     @endif
    
      <div class="jumbotron black-jumbo">
          
          <h2>Our mission is to provide a global platform to support one another with positive thoughts</h2>
           <h3><em> Life can be tough at times, but even a few good messages can help makes things a whole lot easier!</em></h3>
    
    
      </div>
       
    
</div>
@stop