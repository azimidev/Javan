@extends('layouts.app')
@section('title', 'Order Food Delivery - Javan Restaurant')
@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/menu-background.png');">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Cart Updated'])
			<h1 class="text-bright"><i class="fa fa-shopping-cart fa-fw fa-lg"></i> Cart Checkout</h1>
			<article class="col-md-8">
				@unless(javan_is_open())
					<div class="alert alert-danger">
						<div class="alert-icon"><i class="material-icons">error</i></div>
						We are closed now and cannot accept orders unless you want specific delivery time between
						<time datetime="12:30">12:30</time>
						&mdash;
						<time datetime="22:00">22:30</time>
					</div>
				@endunless
				<div class="panel panel-success">
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
									<label class="col-xs-3 control-label" for="cardnumber">Card Number</label>
									<div class="col-xs-7">
										<input type="text" id="cardnumber" minlength="16" maxlength="19" placeholder="Card Number"
										       class="card-number form-control" data-stripe="number" pattern="[0-9]{16,19}" required>
										<span class="help-block text-primary">16 digits card number in front of your card</span>
									</div>
								</div>

								<!-- Expiry-->
								<div class="form-group">
									<label class="col-xs-3 control-label" for="exp-date">Card Expiry Date</label>
									<div class="col-xs-7">
										<div class="form-inline">
											<select name="select2" data-stripe="exp_month" id="exp-date"
											        class="card-expiry-month stripe-sensitive required form-control" required>
												@for ($i = 0; $i < 12; $i++)
													<option value="{{ $i + 1 }}" {{ $i + 1 == date('m') + 1 ? 'selected' : '' }}>
														{{ $i + 1 }}
													</option>
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
									<label class="col-xs-3 control-label" for="cvc">CVC / CVV</label>
									<div class="col-xs-3">
										<input type="text" id="cvc" placeholder="CVC" size="4" class="card-cvc form-control"
										       data-stripe="cvc" pattern="[0-9]{1,4}" minlength="1" maxlength="4" required>
										<span class="help-block text-primary"> 3 or 4 digits on back of your card</span>
									</div>
									<i class="fa fa-question-circle fa-lg fa-fw text-info" data-toggle="tooltip" data-placement="right"
									   style="cursor:pointer;"
									   title='<img src="/images/cvv.png" alt="CVV CVC" width="100%">
									   <h4>Visa, Mastercard or Discover</h4>
									   The CVV ("Card Verification Value") on your card is a 3 or 4 digit
									   number printed on the back of your card. It appears after and to the right of your card number.
									   <h4>American Express</h4>
									   The American Express security code is a 4-digit number printed on the front of your card.
									   It appears after and to the right of your card number.'></i>
								</div>

								<div class="form-group">
									<label for="note" class="control-label col-xs-3">Instructions</label>
									<div class="col-xs-7">
									<textarea type="text" class="form-control" name="note" id="note"
									          {{ javan_is_open() ? '' : 'required minlength=6' }}
									          placeholder="{{ javan_is_open() ? 'Optional Delivery Instructions' : 'Schedule the delivery time here any day between 12:30 to 23:00'}}"></textarea>
										@if (javan_is_open())
											<span class="help-block text-primary">Ex: time of delivery, the house bell and etcetera</span>
										@else
											<span class="help-block text-danger">We are closed! Please schedule the delivery time here any day between 12:30 to 23:00</span>
										@endif
									</div>
								</div>

								<p class="lead text-center text-danger payment-errors animated pulse infinite"></p>

								<div class="control-group">
									<div class="controls">
										<div class="center">
											<button class="btn btn-success btn-raised submit" type="submit">Pay & Place Order</button>
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
			</article>
			<aside class="col-md-4">

				@include('partials.product-cart')

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

						<table class="table table-condensed table-striped">
							<tr>
								<td>Name</td>
								<td>{{ auth()->user()->name ?: '-' }}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>{{ auth()->user()->email ?: '-' }}</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>{{ auth()->user()->address ?: '-' }}</td>
							</tr>
							<tr>
								<td>City</td>
								<td>{{ auth()->user()->city ?: '-' }}</td>
							</tr>
							<tr>
								<td>Post Code</td>
								<td>{{ auth()->user()->post_code ?: '-' }}</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td>{{ auth()->user()->phone ?: '-' }}</td>
							</tr>
						</table>

						<a class="btn btn-raised btn-primary btn-block" href="{{ route('member.edit', auth()->user()) }}">
							Update
						</a>

					</div>
				</div>

			</aside>
		</main>
	</header>
@stop