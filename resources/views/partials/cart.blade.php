<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="fa fa-shopping-cart fa-fw fa-lg"></i> Shopping Cart
			@if (Cart::count())
				<span class="badge">{{ Cart::count() }}</span>
				<a id="destroyCart" title="Clear Cart" class="close" href="{{ route('destroy.cart') }}">
					<i class="material-icons">clear</i>
				</a>
			@endif
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="5%">Qty</th>
					<th>Item</th>
					<th>Price</th>
					<th width="5%">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach (Cart::content() as $row)
					<tr>
						<td>{{ $row->qty }}</td>
						<td>{{ $row->name }}</td>
						<td>£{{ number_format($row->price, 2) }}</td>
						<td>
							<a id="removeFromCart" href="{{ route('remove.from.cart', [$row->rowId, $row->qty]) }}"
							   class="text-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td>&nbsp;</td>
					<td class="text-right">Tax :</td>
					<td>£{{ Cart::tax() }}</td>
					<td>&nbsp;</td>
				</tr>
				<tr class="lead">
					<td>&nbsp;</td>
					<td class="text-right"><strong>Total :</strong></td>
					<td><strong>£{{ Cart::total() }}</strong></td>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
		</table>
		@if (request()->is('cart/create'))
			<a href="{{ url('/menu') }}" class="btn btn-block btn-primary btn-raised">
				<i class="fa fa-arrow-left fa-lg fa-fw"></i> Go Back to Menu
			</a>
		@elseif (less_than_minimum_order())
			<p class="label label-info">minimum order is £20</p>
		@else
			<a href="{{ route('cart.create') }}" class="btn btn-block btn-success btn-raised">
				Checkout
			</a>
		@endif
	</div>
</div>