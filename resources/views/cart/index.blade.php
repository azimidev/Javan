@extends('layouts.app')

@section('content')
	<main class="main container">
		<a href="{{ route('cart.create') }}" class="btn btn-raised btn-info pull-right">
			<i class="fa fa-plus fa-lg"></i>
		</a>
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
			@can('adminManager', auth()->user())
				<h1>{{ $carts->count() }} {{ str_plural('Order', $carts->count()) }}</h1>
			@endcan

			@can('member', auth()->user())
				<h1>{{ str_plural('Your Recent Order', $carts->count()) }}</h1>
			@endcan

			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>Details</th>
						<th width="30%">Orders</th>
						<th>{!! sort_carts_by('total', 'Total') !!}</th>
						<th width="30%">Note</th>
						<th>{!! sort_carts_by('status', 'Status') !!}</th>
						@can('adminManager', auth()->user())
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
							<td>{{ nl2br($cart->note) }}</td>
							<td>{!! $cart->status ? '<span class="label label-success">Accepted</span>' : '<span class="label label-danger">Rejected</span>' !!}</td>
							@can('adminManager', auth()->user())
								<td>
									<form action="{{ route('cart.destroy', $cart) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<a href="{{ route('carts.edit', $cart) }}" class="btn btn-sm btn-raised btn-success">
											Change
										</a>
										<button type="submit" class="btn btn-sm btn-raised btn-danger confirm">
											Delete
										</button>
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
