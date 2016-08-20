@extends('layouts.app')

@section('content')
	<div class="header">
		<div>
			<iframe width="100%" height="450" frameborder="0" allowfullscreen
			        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJm0npDkoOdkgR65Z2_pEgI3Y&key={{ env('GOOGLE_API_KEY') }}">
			</iframe>
		</div>
	</div>
	<main class="container main main-raised">
		<article>
			<section class="col-md-offset-1 col-md-7">

				<form class="contactus form-horizontal" action="{{ route('send.email') }}" method="POST" role="form"
				      data-remote>
					{{ csrf_field() }}
					<fieldset>
						<legend>Please <span class="text-primary">don't</span> use this form for reservations or delivery</legend>

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="date" class="control-label col-sm-1">
								<i class="text-primary fa fa-user fa-2x f-fw"></i>
							</label>
							<div class="col-sm-11">
								<input type="text" name="name" class="form-control" id="name" placeholder="Your Full Name"
								       value="{{ auth()->check() ? auth()->user()->name : old('name') }}" minlength="3"
								       pattern="[a-zA-Z\s]+" required>
								@if ($errors->has('name'))
									<span class="help-block text-danger"><strong>{{ $errors->first('name') }}</strong></span>
								@else
									<span class="form-control-feedback"><i class="fa fa-times fa-lg"></i></span>
									<span class="help-block text-info">Please Enter Your Name</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="control-label col-sm-1">
								<i class="text-primary fa fa-envelope fa-2x f-fw"></i>
							</label>
							<div class="col-sm-11">
								<input type="email" name="email" class="form-control" id="email" placeholder="Email"
								       value="{{ auth()->check() ? auth()->user()->email : old('email') }}" minlength="5" required>
								@if ($errors->has('email'))
									<span class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></span>
								@else
									<span class="form-control-feedback"><i class="fa fa-times fa-lg"></i></span>
									<span class="help-block text-info">Please Enter Your Email</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('user_message') ? ' has-error' : '' }}">
							<label for="user_message" class="control-label col-sm-1">
								<i class="text-primary fa fa-pencil fa-2x f-fw"></i>
							</label>
							<div class="col-sm-11">
								<textarea class="form-control" name="user_message" id="user_message" rows="9"
								          placeholder="Please Enter Your Message" required>{{ old('user_message') }}</textarea>
								@if ($errors->has('email'))
									<span class="help-block text-danger"><strong>{{ $errors->first('user_message') }}</strong></span>
								@else
									<span class="form-control-feedback"><i class="fa fa-times fa-lg"></i></span>
									<span class="help-block text-info">Please Enter Your Message</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-1">
								<button type="submit" name="submit" class="btn btn-raised btn-primary"
								        data-loading-text="One Moment... <i class='fa fa-spinner fa-pulse'></i>">
									Send
								</button>
							</div>
						</div>

					</fieldset>
				</form>
			</section>
		</article>
		<aside>
			<section class="col-md-4">
				<h2>How to find us</h2>

				<address>
					<strong>Javan Restaurant</strong> <br>
					291-293 King Street <br>
					Hammersmith <br>
					London <br>
					<abbr title="Phone">Phone:</abbr> 020 8563 8553
				</address>

				<address>
					<strong>Email</strong> <br>
					<a href="mailto:info@javan-restaurant.co.uk">info@javan-restaurant.co.uk</a>
				</address>
			</section>
		</aside>
	</main>
@endsection
