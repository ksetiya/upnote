<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

	<body>

	Hey, {{$user->name}}!
	
	<p>Thanks for registering and welcome to the UpNote family! :)  </p>
	
	 <p>You have joined the conspiracy of kindness.</p>
	  
	 <h3>Show some love:</h3>
	 <ul>
	     <li><a href="{{url()}}/posts/latest">Latest stories.</a></li>
	     <li><a href="{{url()}}/posts/trending">Trending stories.</a></li>
	     <li><a href="{{url()}}/posts/create">Create your own story.</a></li>
	 </ul>
	 
	<p>Have Fun!</p>
	
	
	<p>Rohan Wadhwa and Karan Setiya <br />Founders of UpNote</p>
	
	
	</body>

</html>
