@extends('app')

@section('content')
<div class="container">

<h1 class="text-center">Log in to UpNote with</h1>
<div class="row">
		<div class="text-center col-md-4 col-md-offset-4">
		<hr class="colorgraph">
			<a href="{{url('auth/facebook')}}" class="btn btn-block btn-social btn-lg btn-facebook">
				<i class="fa fa-facebook"></i> Facebook 
			  </a>
			  
			  <a href="{{url('auth/google')}}" class="btn btn-block btn-social btn-lg btn-google-plus">
				<i class="fa fa-google"></i> Google 
			  </a>
			<h4> <small>Don't worry. We'll <strong>never</strong> post without your permission.</small>
			 </h4>	
 
			 <div class="horizontal-separator"><span class="separator-text">OR</span></div>
		</div>
		
	</div>
	
	 
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<h4><a data-toggle="collapse" data-target="#collapseOne" 
           href="#collapseOne">
         <div class="panel-heading text-center">Log in with email</div>
        </a></h4>
			<div class="panel panel-default user-registration-panel">

        
        <div id="collapseOne" class="panel-collapse collapse out">
				 
			 	<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Login
								</button>

								<a href="/password/email">Forgot Your Password?</a>
							</div>
						</div>
					</form>
					 
				</div>
			</div>
		 <h5 class="text-center"><small>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</small></h5>
		</div>
	</div>
</div>
@endsection
