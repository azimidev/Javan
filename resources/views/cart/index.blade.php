@extends('layouts.app')

@section('content')
	<main class="main container">
		@can('member', auth()->user())
			<a href="{{ url('menu') }}" class="btn btn-raised btn-info pull-right">
				Continue Shopping
			</a>
		@endcan
		@can('admin_manager', auth()->user())
			<div class="togglebutton">
				<label>
					<input type="checkbox" id="refresh">
					<i class="fa fa-refresh fa-lg"></i> Auto Refresh
				</label>
			</div>
		@endcan
		@if ($carts->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>There is no order yet!</h1>
			</div>
		@else
			@can('admin_manager', auth()->user())
				<h1>{{ $carts->count() }} {{ str_plural('Order', $carts->count()) }}</h1>
			@endcan

			@can('member', auth()->user())
				<h1>{{ str_plural('Your Recent Order', $carts->count()) }}</h1>
			@endcan

			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>Details</th>
						<th>Orders</th>
						<th>{!! sort_column_by('total', 'Total') !!}</th>
						<th width="30%">Note</th>
						<th>{!! sort_column_by('status', 'Status') !!}</th>
						@can('admin_manager', auth()->user())
							<th colspan="2">Actions</th>
						@endcan
					</tr>
				</thead>
				<tbody>
					@foreach ($carts as $cart)
						<tr>
							<td>
								<strong class="text-info">{{ $cart->user->name }}</strong> <br>
								<strong class="text-primary">
									{{ $cart->user->address }} <br>
									{{ $cart->user->city }} <br>
									{{ $cart->user->post_code }}
								</strong> <br>
								<strong class="text-danger">{{ $cart->user->phone }}</strong>
							</td>
							<td>
								<ul class="list-unstyled">
									@foreach ($cart->orders as $order)
										<li>{{ $order->qty }} {{ $order->name }}</li>
									@endforeach
								</ul>
							</td>
							<td>£{{ number_format($cart->total / 100, 2) }}</td>
							<td>{!! nl2br($cart->note) !!}</td>
							<td>{!! $cart->status ? '<span class="label label-success">Accepted & Paid</span>' : '<span class="label label-danger">Rejected & Refunded</span>' !!}</td>
							@can('admin_manager', auth()->user())
								<td>
									<form action="{{ route('cart.destroy', $cart) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										@if ($cart->status)
											<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
											        data-target="#refundModal">
												<i class="fa fa-exchange fa-lg"></i>
											</button>
										@endif
										@if (expired($cart->created_at))
											<button type="submit" class="btn btn-sm btn-danger confirm" title="Delete">
												<i class="fa fa-trash fa-lg"></i>
											</button>
										@endif
									</form>
								</td>
							@endcan
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="center">
				{{ $carts->appends(request()->input())->links() }}
			</div>
		@endif
	</main>
@stop

@section('scripts')
	<div class="modal fade" id="refundModal" tabindex="-1" role="dialog"
	     aria-labelledby="refundModalLabel"
	     aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="refundModalLabel">Reason To Refund</h2>
				</div>
				<div class="modal-body">
					<form class="form" action="{{ route('cart.update', $cart) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<textarea name='refund_reason' class='form-control'
						          placeholder='Reason to Reject'></textarea>
						<button type='submit' class='btn btn-danger btn-raised' title='Refund'>Refund</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@stop
