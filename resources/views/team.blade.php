@extends('app')

@section('content')
<div class="container col-md-10 col-md-offset-1">
  <h1 class="page-header">Meet the UpNote Team</h1>
    <div class="row teamcontainer">
		
        <div class="col-md-6">
            <div class="col-md-6">
                <div class="pull-left">
                    <img src="{{url('images/team/rohan.jpg')}}" alt="Rohan Wadhwa" class="teamportrait" />
                </div>
            </div>
            <div class="col-md-6">
                <h4>
                    Rohan Wadhwa</h4>
                <small>
                    <ul class="list-unstyled">
					<li>Co-Founder</li>
					  
					</ul>
					<a target="_blank" href="mailto:wadhwa.rohan@gmail.com"> <i class="fa fa-envelope-o fa-2x"></i></a>
					 
                </small>
				<p>
				
				
				</p>
				 
            </div>
           
        </div>
 
  <div class="col-md-6">
            <div class="col-md-6">
                <div class="pull-left">
                    <img src="{{url('images/team/karan.jpg')}}" alt="Karan Setiya" class="teamportrait" />
                </div>
            </div>
            <div class="col-md-6">
                <h4>
                   Karan Setiya</h4>
                <small>
                    <ul class="list-unstyled">
					<li>Co-Founder/Lead Webdeveloper</li>
					  
					</ul>
					<a target="_blank" href="https://www.linkedin.com/pub/karan-setiya/3b/70b/257"> <i class="fa fa-linkedin-square fa-2x"></i></a>
					<a target="_blank" href="https://twitter.com/iamkaransetiya"> <i class="fa fa-twitter fa-2x"></i></a>
					<a target="_blank" href="mailto:k.setiya91@gmail.com"> <i class="fa fa-envelope-o fa-2x"></i></a>
					 
                </small>
				<p>
				
				
				</p>
				 
            </div>
           
        </div>
		</div>
 
  	</div>
  	
  	@stop