<p style="position: fixed; z-index: 100; right: 3%; top: 8%; font-size: 40px;" class="visible-xs">
	<a class="text-info" href="#pjax-container"><i class="fa fa-shopping-cart fa-fw"></i></a>
</p>
<div class="panel panel-success" id="pjax-container">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="fa fa-shopping-cart fa-fw fa-lg"></i> Shopping Cart
			@if (Cart::count())
				<span class="badge">{{ Cart::count() }}</span>
				<a id="destroyCart" title="Clear Cart" class="close" href="{{ route('destroy.cart') }}" data-toggle="tooltip">
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
			<a href="{{ route('menu') }}" class="btn btn-block btn-raised">
				<i class="fa fa-cart-plus fa-lg fa-fw"></i> Continue Shopping
			</a>
		@elseif (less_than_minimum_order())
			<p class="label label-success">minimum order is £{{ env('MINIMUM_ORDER') }}</p>
		@else
			<a href="{{ route('cart.create') }}" class="btn btn-block btn-success btn-raised">
				Checkout
			</a>
		@endif
	</div>
</div>
