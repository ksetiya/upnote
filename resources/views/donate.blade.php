@extends('app')

@section('content')
<div class="col-md-12">
    @if(Session::has('flashmessage'))
        <p class="alert alert-info"><i class="fa fa-envelope"></i> {{ Session::get('flashmessage') }}</p>
     @endif
    
      <div class="row">
          
          <div class="jumbotron black-jumbo ">
              
              <h1>Join the conspiracy of Kindness</h1>
              <h2>Help us reach more people</h2>
          </div>
      </div>  
      
      <div class="row"> 
           <div class="col-md-10 col-md-offset-1">
               <h2 class="text-center"><small>Donate now!</small></h2>
            <div class="donate-form">
                <div class="amount-choices">
                   @foreach(Config::get('constants.donationAmounts') as $amount)
                   
                     <div class="col-md-2"><a data-amount="{{$amount/100}}">${{$amount/100}}</a>
                     <form action="" method="POST">
                         {!! Form::hidden('amount', $amount) !!}
                      <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="pk_live_WRJArY6rmibHEfd3LVunmWio"
                        data-amount= "{{$amount}}"
                        data-name="UpNote"
                        data-description="Donation"
                        data-image="{{URL::to('images/256_logo.png')}}"
                        data-locale="auto">
                      </script>
                    </form>
                
                    </div>
                     
                   @endforeach
                   
                     
                </div>
             
              </div>
          </div>
       </div>
       
       
          <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <h2>UpNote is a small nonprofit with a <a href="{{url('/mission')}}">mission</a> to improve the world.</h2>
               <p class="donation-text">
              We believe that everyone is happy to give to someone in need. On UpNote we are crowdsourcing this positivity for all those who need it.
             We rely on donations to keep the site <strong>free</strong> and up-and-running. Donations of all sizes are more than welcome. 
          </p>
          </div>
         </div>
         
         
    
</div>
@stop