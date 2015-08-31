@extends('app')

@section('content')

	
	<div class="jumbotron" id="home-banner">
		<div id="home-banner-content">
		  <h1 id="welcome-title">Upnote</h1>
		  <div class="crowdsourcing-list">
			<h2>Crowdsourcing </h2>
				<div>Moral Support</div>
				<div>Love</div>
				<div>Encouragement</div>
				<div>Spirit</div>
				<div>Strength</div>
			
		  </div>
	  
	  </div>
	  <p>
	  <!--<a class="btn btn-danger btn-lg" href="/posts/create" role="button">Receive  <i class="fa-heart fa"></i></a>
	  <span style="color:white; font-weight:600"> or </span>-->
	  <div class="joinz">
	  	<a class="btn btn-success btn-lg" href="/posts/" role="button">Browse stories <i class="fa-book fa"></i></a>
	  </div>
	  </p>
	</div>
	
 
		<div class="row text-center">
			<h2 id="home-slogan" class="wow fadeIn"><a href="{{ URL::to('/auth/register') }}">Join the conspiracy of kindness</a>
			<br/>
			<small>
		(<strong>Closed Beta</strong>, we have <strong>@if($users->count()>1000) 0 @else {{1000 - $users->count()}} @endif</strong> out of 1000 accounts left)</small>
			</h2>
			 <a class="btn btn-primary btn-lg" href="/auth/register" role="button"><strong>Join </strong><i class="fa-heart fa"></i></a>
			</div>
			<hr>
		<div class="row text-center">
			<!-- newsletter -->
			@include('partials.newsletter')
		</div>
		
	
 
	
	<div class="row wow fadeIn">
		<div class="col-md-4 home-thumb">
			 <a href="posts/tag/school" class="thumbnail">
			  <img src="/images/finals.png" alt="Finals coming up">
			  <span>Finals are coming up</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/tag/grief" class="thumbnail">
			  <img src="/images/gran.png" alt="Lost a loved one">
			  <span>Lost a loved one</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/tag/lighthearted" class="thumbnail">
			  <img src="/images/newcity.png" alt="Moving to a new city">
			  <span>Moving to a new city</span>
			</a>
		</div>
	</div>	

	<div class="typed jumbotron home-banner home-typed">
		<span id="sampleUpnotes"></span>
	 
	 	<h3>Here, we crowdsource positivity for all those who need it. Just a few words can go a long way. </h3>
	 	<div class="joinz">
	 		<a class="btn btn-success btn-lg" href="/posts/" role="button">Browse stories <i class="fa-book fa"></i></a>
	  		
	    <a class="btn btn-primary btn-lg" href="/auth/register" role="button">Join <i class="fa-heart fa"></i></a>
	    </div>
	</div> 
	
	<div class="row wow fadeIn"></div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/tag/health" class="thumbnail">
			  <img src="/images/cancer.png" alt="Coping with cancer">
			  <span>Coping with cancer</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/tag/relationships" class="thumbnail">
			  <img src="/images/heartbreak.png" alt="Tough break-up">
			  <span>Tough break-up</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/tag/family" class="thumbnail">
			  <img src="/images/baby.png" alt="Going to be a parent">
			  <span>Going to be a parent!</span>
			</a>
		</div>
		 
	</div>
	
	<script type="text/javascript">
			(function() {

			var topics = $(".crowdsourcing-list div");
			var topicIndex = -1;
			
			function showNextTopic() {
				++topicIndex;
				topics.eq(topicIndex % topics.length)
					.fadeIn(1000).css("display","inline-block")
					.delay(1500)
					.fadeOut(1000, showNextTopic);
			}
			
			showNextTopic();
			
		})();
			

	</script>	
	
@stop

@section('footer')
<script> 
function typed(){
   $("#sampleUpnotes").typed({
        strings: [
        	@foreach(Config::get('constants.sampleUpnotes') as $sampleUpnote)
        		"{{$sampleUpnote}}",
        	@endforeach
        ],
        typeSpeed: 0
    })
  };
	      
 
setInterval(function(){ 
	if($('#sampleUpnotes').visible()){
			typed();
		 
		}
	}, 1500);
	
	
</script>
 
@stop

