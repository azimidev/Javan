@extends('layouts.app')

@section('content')
	<div class="register">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form class="form" role="form" method="POST" action="{{ url('/register') }}">
							{{ csrf_field() }}

							<div class="header header-primary text-center">
								<div class="brand">
									<h3>Sign Up</h3>
									<h5>
										It litterally takes 10 seconds <br>
										By signing up you can book tables and order food
									</h5>
								</div>
							</div>
							<div class="content">
								<div class="input-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<span class="input-group-addon">
									<i class="fa fa-user fa-lg"></i>
								</span>

									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
									       placeholder="Full Name" required pattern="[a-zA-Z\s]+">

									@if ($errors->has('name'))
										<span class="text-danger">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>

								<div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<span class="input-group-addon">
									<i class="fa fa-envelope fa-lg"></i>
								</span>

									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
									       placeholder="Email" required>

									@if ($errors->has('email'))
										<span class="text-danger">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>

								<div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
									<span class="input-group-addon">
										<i class="fa fa-lock fa-lg"></i>
									</span>

									<input id="password" type="password" class="form-control" name="password" placeholder="Password"
									       required minlength="6" maxlength="30" pattern="(?=^.{6,}$)((?=.*\W+))(?![.\n]).*$">

									@if ($errors->has('password'))
										<span class="text-danger">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>

								<div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								<span class="input-group-addon">
									<i class="fa fa-lock fa-lg"></i>
								</span>

									<input id="password-confirm" type="password" class="form-control" name="password_confirmation"
									       placeholder="Confirm Your Password" required minlength="6" maxlength="30"
									       pattern="(?=^.{6,}$)((?=.*\W+))(?![.\n]).*$">

									@if ($errors->has('password_confirmation'))
										<span class="text-danger">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
									@endif
								</div>

								<div class="footer text-center">
									<button type="submit" class="btn btn-raised btn-primary">
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
@endsection
