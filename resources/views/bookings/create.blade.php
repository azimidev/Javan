@extends('layouts.app')
@section('title', 'Buy Live Music Ticket - Javan Restaurant')
@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/background/background-5.png');">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Ticket Updated'])
			<h1 class="text-bright"><i class="fa fa-shopping-cart fa-fw fa-lg"></i> Ticket Checkout</h1>

			<article class="col-md-8">

				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-credit-card fa-fw fa-lg"></i> Payment Information
						</div>
					</div>
					<div class="panel-body">
						@if(auth()->user()->name && auth()->user()->phone)

							<form action="{{ route('bookings.store') }}" method="POST" role="form"
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
										<input type="text" id="cardnumber" minlength="16" maxlength="19" placeholder="16 digits card number"
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
														{{ $i + 1 }} - {{ get_month_name($i + 1) }}
													</option>
												@endfor
											</select>
											<span> /&nbsp;&nbsp;&nbsp;</span>
											<select name="select2" data-stripe="exp_year" id="exp-date"
											        class="card-expiry-year stripe-sensitive required form-control" required>
												@for ($i = 0; $i <= 25; $i++)
													<option value="{{ $i + date('Y') }}" {{ $i === 0 ? 'selected' : '' }}>
														{{ $i + date('Y') }}
													</option>
												@endfor
											</select>
										</div>
									</div>
								</div>

								<!-- CVV -->
								<div class="form-group">
									<label class="col-xs-3 control-label" for="cvc">Security Code</label>
									<div class="col-xs-3">
										<input type="text" id="cvc" placeholder="CVC / CVV" size="4" class="card-cvc form-control"
										       data-stripe="cvc" pattern="[0-9]{1,4}" minlength="1" maxlength="4" required>
										<span class="help-block text-primary"> 3 or 4 digits on back of your card</span>
									</div>
									<i class="fa fa-question-circle fa-lg fa-fw text-info" data-toggle="tooltip" data-placement="right"
									   title='<img src="/images/cvv.png" alt="CVV CVC" width="100%">
									   <h4>Visa, Mastercard or Discover</h4>
									   The CVV ("Card Verification Value") on your card is a 3 or 4 digit
									   number printed on the back of your card. It appears after and to the right of your card number.
									   <h4>American Express</h4>
									   The American Express security code is a 4-digit number printed on the front of your card.
									   It appears after and to the right of your card number.'></i>
								</div>

								<p class="lead text-center text-danger payment-errors animated pulse infinite"></p>

								<div class="control-group">
									<div class="controls">
										<div class="center">
											<button class="btn btn-success btn-raised submit" type="submit">Pay & Book</button>
										</div>
									</div>
								</div>
							</form>

							<div class="col-xs-6 text-muted text-left">
								<i title="Visa" class="fa fa-cc-visa fa-fw fa-2x"></i>
								<i title="Master Card" class="fa fa-cc-mastercard fa-fw fa-2x"></i>
								<i title="Discover Card" class="fa fa-cc-discover fa-fw fa-2x"></i>
								<i title="American Express" class="fa fa-cc-jcb fa-fw fa-2x"></i>
							</div>

							<div class="col-xs-6 text-muted text-right">
								<i class="fa fa-lock fa-fw fa-lg"></i>
								<span>256-bit SSL encryption</span>
							</div>

						@else
							<div class="alert alert-danger">
								<div class="alert-icon"><i class="material-icons">error</i></div>
								Payment form is not visible because one of your <strong>Name</strong> or <strong>Phone</strong> is empty
								<a class="btn btn-sm btn-default btn-raised btn-round"
								   href="{{ route('member.edit', auth()->user()) }}">Please Update Your Details</a>
							</div>
						@endif
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							<i title="Stripe" class="fa fa-cc-stripe fa-fw fa-lg pull-right"></i>
							<i class="fa fa-lock fa-fw fa-lg"></i> Security and Privacy
						</div>
					</div>
					<div class="panel-body">
						<p class="text-justify">
							Just a friendly reminder about security and card payments in this website:
						</p>
						<p class="text-justify">
							We use a service called <a href="//stripe.com/gb/privacy" target="_blank">Stripe</a> for our
							payments. This means <u>your credit card information does not touch our server</u> and it is passed
							through <a href="//en.wikipedia.org/wiki/Transport_Layer_Security" target="_blank">SSL</a>
							encryption connection. Therefore, no matter if you are a member and regular customer <u>we never store
								your credit card details</u> that is why everytime you purchase, you need to enter your credit card
							details again.We know this is tedious but it's for your own and our customers security.
						</p>
					</div>
				</div>
			</article>
			<aside class="col-md-4">

				@include('partials.event-cart')

				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="fa fa-info-circle fa-fw fa-lg"></i> Check Your Information
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-condensed table-striped">
							<tr>
								<td><strong>Name</strong></td>
								<td>{{ auth()->user()->name ?: '-' }}</td>
							</tr>
							<tr>
								<td><strong>Email</strong></td>
								<td>{{ auth()->user()->email ?: '-' }}</td>
							</tr>
							<tr>
								<td><strong>Address</strong></td>
								<td>{{ auth()->user()->address ?: '-' }}</td>
							</tr>
							<tr>
								<td><strong>City</strong></td>
								<td>{{ auth()->user()->city ?: '-' }}</td>
							</tr>
							<tr>
								<td><strong>Post Code</strong></td>
								<td>{{ auth()->user()->post_code ?: '-' }}</td>
							</tr>
							<tr>
								<td><strong>Phone</strong></td>
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