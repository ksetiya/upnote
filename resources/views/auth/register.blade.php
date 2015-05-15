@extends('app')

@section('content')
<div class="container">
<h1 class="page-header text-center"><i class="fa fa-user"></i></h1>
<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<a href="{{url('auth/facebook')}}" class="btn btn-block btn-social btn-lg btn-facebook">
				<i class="fa fa-facebook"></i> Log in with Facebook 
			  </a>
			  
			  <a href="{{url('auth/google')}}" class="btn btn-block btn-social btn-lg btn-google-plus">
				<i class="fa fa-google-plus"></i> Log in with Google 
			  </a>
		</div>
		</div>
		
		<div class="row clearfix">
			<p class="text-center">- OR -</p>
		</div>
	
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<a data-toggle="collapse" data-target="#collapseOne" 
           href="#collapseOne">
         <div class="panel-heading">Register with email</div>
        </a>
      </h4>

        
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

					<form class="form-horizontal" role="form" method="POST" action="/auth/register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

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
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
@endsection
