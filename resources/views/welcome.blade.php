@extends('app')

@section('content')
	<div class="jumbotron" id="home-banner">
		<div id="home-banner-content">
		  <h1 id="welcome-title">UpNote</h1>
		  <div class="crowdsourcing-list">
			<h2>Crowdsourcing </h2>
				<div>Moral Support</div>
				<div>Love</div>
				<div>Encouragement</div>
				<div>Spirit</div>
				<div>Strength</div>
			<h3 class="slogan">Just a few words can go a long way</h3>
		  </div>
	  
	  </div>
	  <p>
	  <!--<a class="btn btn-danger btn-lg" href="/posts/create" role="button">Receive  <i class="fa-heart fa"></i></a>
	  <span style="color:white; font-weight:600"> or </span>-->
	  <a class="btn btn-success btn-lg" href="/posts/" role="button">Give <i class="fa-heart fa"></i></a>
	  
	  </p>
	</div>
	
	<div class="container">
		<div class="row">
			<h2 id="home-slogan" class="wow fadeIn">Join the conspiracy of kindness</h2>
		</div>
	</div>
	
	<div class="row wow fadeIn">
		<div class="col-md-4 home-thumb">
			 <a href="posts/category/school" class="thumbnail">
			  <img src="/images/finals.png" alt="Finals coming up">
			  <span>Finals are coming up</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/" class="thumbnail">
			  <img src="/images/gran.png" alt="Lost a loved one">
			  <span>Lost a loved one</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/category/light" class="thumbnail">
			  <img src="/images/newcity.png" alt="Moving to a new city">
			  <span>Moving to a new city</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/category/health" class="thumbnail">
			  <img src="/images/cancer.png" alt="Coping with cancer">
			  <span>Coping with cancer</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/category/relationships" class="thumbnail">
			  <img src="/images/heartbreak.png" alt="Tough break-up">
			  <span>Tough break-up</span>
			</a>
		</div>
		 <div class="col-md-4 home-thumb">
			 <a href="posts/category/relationships" class="thumbnail">
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