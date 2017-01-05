<p style="position: fixed; z-index: 100; right: 3%; top: 8%; font-size: 40px;" class="visible-xs">
	<a class="text-info" href="#pjax-container"><i class="fa fa-shopping-cart fa-fw"></i></a>
</p>
<div class="panel panel-success" id="pjax-container">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="fa fa-shopping-cart fa-fw fa-lg"></i> Shopping Cart
			@if (Cart::instance('event')->count())
				<span class="badge">{{ Cart::instance('event')->count() }}</span>
				<a id="destroyCart" title="Clear Cart" class="close" href="{{ route('destroy.event.cart') }}"
				   data-toggle="tooltip">
					<i class="material-icons">clear</i>
				</a>
			@endif
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="5%">Seat</th>
					<th>Event</th>
					<th>Price</th>
					<th width="5%">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach (Cart::instance('event')->content() as $row)
					<tr>
						<td>{{ $row->qty }}</td>
						<td>{{ $row->name }}</td>
						<td>£{{ number_format($row->price, 2) }}</td>
						<td>
							<a id="removeFromCart" href="{{ route('remove.event.from.cart', [$row->rowId, $row->qty]) }}"
							   class="text-danger">
								<i class="material-icons">clear</i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td>&nbsp;</td>
					<td class="text-right">VAT :</td>
					<td><s>£{{ Cart::instance('event')->tax() }}</s></td>
					<td>&nbsp;</td>
				</tr>
				<tr class="lead">
					<td>&nbsp;</td>
					<td class="text-right"><strong>Total :</strong></td>
					<td><strong>£{{ Cart::instance('event')->subtotal() }}</strong></td>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
		</table>
		<a href="{{ route('cart.create') }}" class="btn btn-block btn-success btn-raised">
			Checkout
		</a>
	</div>
</div>

@section('scripts')
	<script>
	  $(function() {
		  $('a[href*="#"]:not([href="#appetizers"]):not([href="#main_courses"]):not([href="#extras"]):not([href="#beverages"]):not([href="#juices"]):not([href="#desserts"])').click(function() {
			  if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				  var target = $(this.hash);
				  target     = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				  if (target.length) {
					  $('html, body').animate({
						  scrollTop : target.offset().top
					  }, 1000);
					  return false;
				  }
			  }
		  });
	  });
	</script>
	<script src="https://js.stripe.com/v2/"></script>
	<script>
		/* <![CDATA[ */
	(function() {
		var StripeBilling = {

			init : function() {
				this.form              = $('#payment-form');
				this.submitButton      = this.form.find('.submit');
				this.submitButtonValue = this.submitButton.val();
				Stripe.setPublishableKey('{{ config('services.stripe.key') }}');
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