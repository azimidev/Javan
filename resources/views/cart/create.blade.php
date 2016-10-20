@extends('layouts.app')
@section('title', 'Order Food Delivery - Javan Restaurant')
@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/menu-background.png');">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Cart Updated'])
			<h1 class="text-warning">Shopping Cart</h1>
			<article class="col-md-8">
				@unless(javan_is_open())
					<div class="alert alert-danger">
						<div class="alert-icon"><i class="material-icons">error</i></div>
						We are closed now and cannot accept orders unless you want specific delivery time between
						<time datetime="13:00">13:00</time>
						-
						<time datetime="23:00">23:00</time>
					</div>
				@endunless
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-info-circle fa-fw fa-lg"></i> Check Your Information
						</div>
					</div>
					<div class="panel-body">
						@unless(deliverable(auth()->user()->post_code)['status'])
							<div class="alert alert-warning">
								<div class="container-fluid">
									<div class="alert-icon">
										<i class="material-icons">warning</i>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true"><i class="material-icons">clear</i></span>
									</button>
									Is your information correct? It seems we cannot deliver to your address!
								</div>
							</div>
						@endunless

						<dl class="dl-horizontal">
							<dt>Name :</dt>
							<dd>{{ auth()->user()->name ?: '-' }}</dd>
							<dt>Email :</dt>
							<dd>{{ auth()->user()->email ?: '-' }}</dd>
							<dt>Address :</dt>
							<dd>{{ auth()->user()->address ?: '-' }}</dd>
							<dt>City :</dt>
							<dd>{{ auth()->user()->city ?: '-' }}</dd>
							<dt>Post Code :</dt>
							<dd>{{ auth()->user()->post_code ?: '-' }}</dd>
							<dt>Phone :</dt>
							<dd>{{ auth()->user()->phone ?: '-' }}</dd>
							<dt>&nbsp;</dt>
							<dd><a class="btn btn-raised btn-primary" href="{{ route('member.edit', auth()->user()) }}">Update</a>
							</dd>
						</dl>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-credit-card fa-fw fa-lg"></i> Payment Information
						</div>
					</div>
					<div class="panel-body">
						@if(auth()->user()->address && auth()->user()->post_code && auth()->user()->phone)
							<form action="{{ route('cart.store') }}" method="POST" role="form"
							      class="form-horizontal" id="payment-form">
								{{ csrf_field() }}

								<noscript>
									<div class="alert alert-danger">
										<h4>JavaScript is not enabled!</h4>
										<p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript
											and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a>
											for more informations.</p>
									</div>
								</noscript>

								<!-- Card Number -->
								<div class="form-group">
									<label class="col-sm-3 control-label" for="cardnumber">Card Number</label>
									<div class="col-sm-7">
										<input type="text" id="cardnumber" minlength="16" maxlength="19" placeholder="Card Number"
										       class="card-number form-control" data-stripe="number" pattern="[0-9]{16,19}" required>
										<span class="help-block text-primary">16 digits card number in front of your card</span>
									</div>
								</div>

								<!-- Expiry-->
								<div class="form-group">
									<label class="col-sm-3 control-label" for="exp-date">Card Expiry Date</label>
									<div class="col-sm-7">
										<div class="form-inline">
											<select name="select2" data-stripe="exp_month" id="exp-date"
											        class="card-expiry-month stripe-sensitive required form-control" required>
												@for ($i = 0; $i < 12; $i++)
													<option
															value="{{ $i + 1 }}" {{ $i + 1 == date('m') + 1 ? 'selected' : '' }}>{{ $i + 1 }}</option>
												@endfor
											</select>
											<span> / </span>
											<select name="select2" data-stripe="exp_year" id="exp-date"
											        class="card-expiry-year stripe-sensitive required form-control" required>
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
									<label class="col-sm-3 control-label" for="cvc">CVC / CVV</label>
									<div class="col-sm-3">
										<input type="text" id="cvc" placeholder="CVC" size="4" class="card-cvc form-control"
										       data-stripe="cvc" pattern="[0-9]{1,4}" minlength="1" maxlength="4" required>
										<span class="help-block text-primary"> 3 or 4 digits on back of your card</span>
									</div>
								</div>

								<div class="form-group">
									<label for="note" class="control-label col-sm-3">Instructions</label>
									<div class="col-sm-7">
									<textarea type="text" class="form-control" name="note" id="note"
									          {{ javan_is_open() ? '' : 'required minlength=6' }}
									          placeholder="{{ javan_is_open() ? 'Type Delivery Instruction' : 'We are closed now so please specify the delivery time here between 12:00 to 23:00'}}"></textarea>
										@if (javan_is_open())
											<span class="help-block text-primary">Ex: time of delivery, the house bell and etcetera</span>
										@else
											<span
													class="help-block text-primary">Please specify the delivery time here between 13:00 to 23:00</span>
										@endif
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
						@else
							<div class="alert alert-danger">
								<div class="alert-icon"><i class="material-icons">error</i></div>
								Payment form is not visible because one of your <strong>Address</strong>, <strong>Post
									Code</strong> or <strong>Phone</strong> is empty
								<a class="btn btn-sm btn-default btn-raised btn-round"
								   href="{{ route('member.edit', auth()->user()) }}">Please Update Your Details</a>
							</div>
						@endif
					</div>
				</div>
			</article>
			<aside class="col-md-4">
				@include('partials.cart')
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-lock fa-fw fa-lg"></i> Security and Privacy
						</div>
					</div>
					<div class="panel-body">
						<p class="text-justify">
							Just a friendly reminder about security and card payments in this website:
						</p>
						<p class="text-justify">
							We use a service called <a href="https://stripe.com/gb/privacy" target="_blank">Stripe</a> for our
							payments. This means <u>your credit card information does not touch our server</u> and it is passed
							through <a href="https://en.wikipedia.org/wiki/Transport_Layer_Security" target="_blank">SSL</a>
							connection. Therefore, no matter if you are a member and regular customer <u>we never store your credit
								card details</u> that is why everytime you purchase, you need to enter your credit card details again.
							We know this is tedious but it's for your own and our customers security.
						</p>
					</div>
				</div>
			</aside>
		</main>
	</header>
@stop
@section('scripts')
	<script src="https://js.stripe.com/v2/"></script>
	<script>
		/* <![CDATA[ */
		(function() {
			var StripeBilling = {

				init : function() {
					this.form              = $('#payment-form');
					this.submitButton      = this.form.find('.submit');
					this.submitButtonValue = this.submitButton.val();
					Stripe.setPublishableKey('{{ env('STRIPE_KEY') }}');
					this.bindEvents();
				},

				bindEvents : function() {
					this.form.on('submit', $.proxy(this.sendToken, this));
				},

				sendToken : function(event) {
					this.submitButton.val('One Moment').prop('disabled', true);
					Stripe.createToken(this.form, $.proxy(this.stripeResponseHandler, this));
					event.preventDefault();
				},

				stripeResponseHandler : function(status, response) {
					if (response.error) {
						this.form.find('.payment-errors').show().text(response.error.message);
						return this.submitButton.prop('disabled', false).val(this.submitButtonValue);
					}

					$('<input>', {
						type  : 'hidden',
						name  : 'stripe-token',
						value : response.id
					}).appendTo(this.form);

					this.form[0].submit();
				}
			};

			StripeBilling.init();
		})();
		/* ]]> */
	</script>
@stop