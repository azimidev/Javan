@extends('layouts.app')

@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/menu-background.png');">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Cart is updated'])
			<h1 class="text-warning">Shopping Cart</h1>
			<article class="col-md-8">
				@unless (javan_is_open())
					<div class="alert alert-danger">
						<div class="alert-icon"><i class="material-icons">error</i></div>
						We are closed now and cannot accept orders unless you want specific delivery time between 12:00 - 23:00
					</div>
				@endunless
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							Your Details
						</div>
					</div>
					<div class="panel-body">
						<div class="alert alert-warning">
							<div class="container-fluid">
								<div class="alert-icon">
									<i class="material-icons">warning</i>
								</div>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true"><i class="material-icons">clear</i></span>
								</button>
								Make sure your details are correct before you make a payment if you see your details are incorrect
								please
								update them by <a class="alert-link" href="{{ route('member.edit', auth()->user()) }}">clicking here</a>
							</div>
						</div>

						<dl class="dl-horizontal">
							<dt>Name:</dt>
							<dd>{{ auth()->user()->name ?: '-' }}</dd>
							<dt>Email:</dt>
							<dd>{{ auth()->user()->email ?: '-' }}</dd>
							<dt>Address:</dt>
							<dd>{{ auth()->user()->address ?: '-' }}</dd>
							<dt>City:</dt>
							<dd>{{ auth()->user()->city ?: '-' }}</dd>
							<dt>Post Code:</dt>
							<dd>{{ auth()->user()->post_code ?: '-' }}</dd>
							<dt>Phone:</dt>
							<dd>{{ auth()->user()->phone ?: '-' }}</dd>
						</dl>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							Payment Details
						</div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="{{ route('cart.store') }}" method="POST" role="form"
						      id="payment-form">
							{{ csrf_field() }}

							<noscript>
								<div class="bs-callout bs-callout-danger">
									<h4>JavaScript is not enabled!</h4>
									<p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript
										and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a>
										for more informations.</p>
								</div>
							</noscript>

							<!-- Card Holder Name -->
							<div class="form-group">
								<label class="col-sm-3 control-label" for="card-holder-name">Card Holder's Name</label>
								<div class="col-sm-7">
									<input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name"
									       class="card-holder-name form-control" id="card-holder-name" value="Amir Azimi">
									<span class="help-block text-primary"></span>
								</div>
							</div>

							<!-- Card Number -->
							<div class="form-group">
								<label class="col-sm-3 control-label" for="cardnumber">Card Number</label>
								<div class="col-sm-7">
									<input type="text" id="cardnumber" minlength="16" maxlength="19" placeholder="Card Number"
									       class="card-number form-control" value="4242424242424242" data-stripe="number">
									<span class="help-block text-primary"></span>
								</div>
							</div>

							<!-- Expiry-->
							<div class="form-group">
								<label class="col-sm-3 control-label" for="exp-date">Card Expiry Date</label>
								<div class="col-sm-9">
									<div class="form-inline">
										<select name="select2" data-stripe="exp_month" id="exp-date"
										        class="card-expiry-month stripe-sensitive required form-control">
											@for ($i = 0; $i < 12; $i++)
												<option
														value="{{ $i + 1 }}" {{ $i + 1 == date('m') + 1 ? 'selected' : '' }}>{{ $i + 1 }}</option>
											@endfor
										</select>
										<span> / </span>
										<select name="select2" data-stripe="exp_year" id="exp-date"
										        class="card-expiry-year stripe-sensitive required form-control">
											@for ($i = 0; $i < 12; $i++)
												<option
														value="{{ $i + date('Y') }}" {{ $i === 0 ? 'selected' : '' }}>{{ $i + date('Y') }}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>

							<!-- CVV -->
							<div class="form-group">
								<label class="col-sm-3 control-label" for="cvv">CVV/CVV2</label>
								<div class="col-sm-3">
									<input type="text" id="cvv" placeholder="CVV" size="4" class="card-cvc form-control" value="123"
									       data-stripe="cvc">
									<span class="help-block text-primary"></span>
								</div>
							</div>

							<div class="form-group">
								<label for="note" class="control-label col-sm-3">Instructions</label>
								<div class="col-sm-7">
									<textarea type="text" class="form-control" name="note" id="note"
									          placeholder="Type Delivery Instruction"></textarea>
									<span class="help-block text-primary">Ex: time of delivery, the house bell and etcetera</span>
								</div>
							</div>

							<p class="lead text-center text-danger payment-errors animated pulse infinite"></p>

							<div class="control-group">
								<div class="controls">
									<div class="center">
										<button class="btn btn-success btn-raised submit" type="submit">Pay Now</button>
									</div>
								</div>
							</div>

						</form>

					</div>
				</div>
			</article>
			<aside class="col-md-4">
				@include('partials.cart')
			</aside>
		</main>
	</header>
@stop
@section('scripts')
	<script src="https://js.stripe.com/v2/"></script>
	<script>
		Stripe.setPublishableKey('{{ env('STRIPE_KEY') }}');

		$(function() {

			var $form = $('#payment-form');
			$form.submit(function(event) {
				// Disable the submit button to prevent repeated clicks:
				$form.find('.submit').prop('disabled', true);

				// Request a token from Stripe:
				Stripe.card.createToken($form, stripeResponseHandler);

				// Prevent the form from being submitted:
				return false;
			});

			function stripeResponseHandler(status, response) {
				// Grab the form:
				var $form = $('#payment-form');
				if (response.error) { // Problem!

					// Show the errors on the form:
					$form.find('.payment-errors').text(response.error.message);
					$form.find('.submit').prop('disabled', false); // Re-enable submission

				} else { // Token was created!

					// Get the token ID:
					var token = response.id;

					// Insert the token ID into the form so it gets submitted to the server:
					$form.append($('<input type="hidden" name="stripeToken">').val(token));

					// Submit the form:
					$form.get(0).submit();
				}
			}

		});

	</script>
@stop