@extends('app')

@section('content')
<div class="col-md-12">
    @if(Session::has('flashmessage'))
        <p class="alert alert-info"><i class="fa fa-envelope"></i> {{ Session::get('flashmessage') }}</p>
     @endif
    
      <div class="row">
          
          <div class="jumbotron green-jumbo ">
              
              <h2>Our mission is to provide a <strong>global</strong> platform <br/>
              to support one another with <strong>positive thoughts</strong></h2>
              
          </div>
      </div>    
          <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <h2>Life can be tough at times, but even a few good messages can help makes things a whole lot easier!</h2>
               <p class="donation-text">
              We believe that everyone is happy to give to someone in need. On UpNote we are crowdsourcing this positivity for all those who need it.
            We rely on donations to keep the site <strong>free</strong> and up-and-running running. <a href="{{url('/donate')}}">Donations</a> of all sizes are more than welcome.  
          </p>
          </div>
         </div>
         
         <div class="row"> 
           
       </div>
    
</div>
@stop