<hr>
<footer class="container footer">    
 
  <div class="row">
    <div class="col-lg-12">
      <div class="col-md-3">
        <ul class="list-unstyled">
         <li><strong>About us</strong></li>
         <li><a href="{{url('mission')}}">Our Mission</a></li>
          <li><a href="{{url('team')}}">Team</a></li> 
        	  
        
	  </ul>
      </div>      
	  <div class="col-md-3">
        <ul class="list-unstyled">
			<li><strong>Contact us</strong></li>
			<li><a href="{{url('/contact')}}">E-Mail</a></li>
         </ul>
      </div>
      <div class="col-md-3">
        <ul class="list-unstyled">
		<li><strong><a href="{{url('/donate')}}">Donate</a></strong></li>
			<li><a href="#"></a></li>
		 
         
                       
        </ul>
      </div>  
	       <div class="col-md-3">
        <ul class="list-unstyled">
		    <li><strong>Follow us</strong></li>
			<li><a target="_blank" href="https://twitter.com/iamkaransetiya">Twitter</a></li>
		  
        <!-- <li><a href="#">Forum</a></li>-->
        </ul>
      </div> 
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-12">
      <div class="col-md-8">
	  <ul class="list-unstyled">
	  	<li><a target="_blank" href="#">Terms and Conditions</li>
	  	<li><a target="_blank" href="#">Privacy Policy</a></li>
	  	
	  	 
	  </ul>
        
       
         
      </div>
      <div class="col-md-4">
        <p class="muted pull-right">&copy; {{date('Y') }} UpNote. All rights reserved.</p>
      </div>
    </div>
  </div>
  
  <div class="row" style="text-align:center">
  
  Made with <span class="glyphicon glyphicon-heart"></span>, for you.
  
  
  </div>
</footer>

@include("analyticstracking")