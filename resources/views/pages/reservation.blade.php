@extends('layouts.app')
@section('title', 'Reservation - Javan Restaurant London')
@section('content')
	<div class="header header-filter"
	     style="background-image: url('/images/background/reservation.jpg'); background-size: cover; height : 300px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="brand">
						<h1>Guest Reservation</h1>
						<h3>Book a table as a guest</h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<main class="main main-raised container">
		<article>
			<div class="col-sm-8">
				<h2><i class="fa fa-yelp fa-fw"></i> Use Yelp Reservation</h2>
				<div class="alert alert-inverse">
					<p class="text-justify">
						<i class="fa fa-info-circle fa-lg fa-fw"></i>
						If you don't like to register simply use Yelp Reservation
					</p>
				</div>
				@include('partials.yelp-reservation')
				<hr>
				<form class="form-horizontal" action="{{ route('store.reservation') }}" method="POST" role="form">
					{{ csrf_field() }}
					<div class="alert alert-inverse">
						<p class="text-justify">
							<i class="fa fa-info-circle fa-lg fa-fw"></i>
							If you are a member please <a class="alert-link" href="{{ url('/login') }}">login here</a>
							to book a table, otherwise use the form below to book tables
						</p>
					</div>

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="date" class="control-label col-sm-2">Name</label>
						<div class="col-sm-5">
							<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
							       placeholder="Full Name" minlength="3" maxlength="50" pattern="[a-zA-Z\s]+" required>
							@if ($errors->has('name'))
								<span class="help-block text-danger"><strong>{{ $errors->first('name') }}</strong></span>
							@else
								<span class="help-block text-primary">Your full name here</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="date" class="control-label col-sm-2">Email</label>
						<div class="col-sm-5">
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
							       placeholder="Email" required>
							@if ($errors->has('email'))
								<span class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></span>
							@else
								<span class="help-block text-primary">Your email here</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
						<label for="date" class="control-label col-sm-2">Phone</label>
						<div class="col-sm-5">
							<input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}"
							       placeholder="Phone" required minlength="6" maxlength="20" pattern="^0[0-9\s]+">
							@if ($errors->has('phone'))
								<span class="help-block text-danger"><strong>{{ $errors->first('phone') }}</strong></span>
							@else
								<span class="help-block text-primary">Your phone here in case we want to contact you</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="date" class="control-label col-sm-2">Password</label>
						<div class="col-sm-5">
							<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}"
							       required placeholder="Password" minlength="6" maxlength="30"
							       pattern="(?=^.{6,}$)((?=.*\W+))(?![.\n]).*$">
							@if ($errors->has('password'))
								<span class="help-block text-danger"><strong>{{ $errors->first('password') }}</strong></span>
							@else
								<span class="help-block text-primary">Your password here</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<label for="date" class="control-label col-sm-2">Confirm Password</label>
						<div class="col-sm-5">
							<input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
							       value="{{ old('password_confirmation') }}" placeholder="Password Confirmation" required
							       minlength="6" maxlength="30" pattern="(?=^.{6,}$)((?=.*\W+))(?![.\n]).*$">
							@if ($errors->has('password_confirmation'))
								<span
										class="help-block text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
							@else
								<span class="help-block text-primary">Your password here again</span>
							@endif
						</div>
					</div>

					@include('partials.reservations-create')

				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
				<img src="/images/restaurant/Javan_in_and_out.png" alt="Javan Restaurant Interior and Exterior" width="100%">
				{{--<h2><i class="fa fa-info fa-fw"></i> Private Dining and Parties</h2>
				<p class="text-justify">
					We have a space for about 60 people downstairs which is ideal for your celebrations and private parties.
					To book this place for your events please call us on <a href="tel:02085638553">02085638553</a> and arrange a
					good time to meet the manager and discuss the booking date, time and deposit.
				</p>
				<h2><i class="fa fa-info fa-fw"></i> Private Parties Information</h2>
				<dl class="dl-horizontal">
					<dt>Location:</dt>
					<dd>Down Floor</dd>
					<dt>Cost Per Person:</dt>
					<dd>£ 25</dd>
					<dt>Minimum People:</dt>
					<dd>20</dd>
					<dt>Maximum People:</dt>
					<dd>50</dd>
					<dt>Earliest Start Time:</dt>
					<dd>3 PM</dd>
					<dt>Latest End Time:</dt>
					<dd>10:30 PM</dd>
					<dt>What's Included:</dt>
					<dd>1 Mixed Grilled for 4 Person</dd>
					<dd>1 Portion Rice for Everyone</dd>
					<dd>1 Starter for Everyone</dd>
					<dd>1 Soft Drink for Everyone</dd>
				</dl>
				<h2><i class="fa fa-info fa-fw"></i> Before You Book</h2>
				<p>Please view and download the terms and conditions below to clear up everything before booking:</p>
				<a class="btn btn-raised btn-primary" href="/images/files/Javan-Terms-and-Conditions.pdf" target="_blank">Terms
					& Conditions (PDF)</a>--}}
			</div>
		</aside>
	</main>
@stop
