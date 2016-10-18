@extends('layouts.app')
@section('title', 'Login To Javan Restaurant')
@section('content')
	<div class="login">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form class="form" role="form" method="POST" action="{{ url('/login') }}">
							{{ csrf_field() }}
							<div class="header header-primary text-center">
								<div class="brand"><h4>Login</h4></div>
								<div class="social-line">
									<a href="https://www.facebook.com/JavanLondonLtd" class="btn btn-just-icon" target="_blank">
										<i class="fa fa-facebook-square"></i>
									</a>
									<a href="https://twitter.com/JavanLondon" class="btn btn-just-icon" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="https://plus.google.com/107724180985175918891" class="btn btn-just-icon" target="_blank">
										<i class="fa fa-google-plus"></i>
									</a>
								</div>
							</div>

							<div class="content">

								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-envelope fa-lg fa-fw"></i>
										</span>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
									       placeholder="Email" required>

									@if ($errors->has('email'))
										<span class="text-danger">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-lock fa-lg fa-fw"></i>
										</span>
									<input id="password" type="password" class="form-control" name="password"
									       placeholder="Password" required>

									@if ($errors->has('password'))
										<span class="text-danger">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember"> Remember Me
										</label>
									</div>
								</div>

								<div class="footer text-center">
									<button type="submit" class="btn btn-raised btn-primary">
										Login
									</button>
									<div class="clearfix"></div>
									<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
									<a class="btn btn-link" href="{{ url('/register') }}">Sign Up</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
