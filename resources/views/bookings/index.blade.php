@extends('layouts.app')
@section('title', 'Your Tickets')
@section('content')
	<main class="main container">
		@can('member', auth()->user())
			<a href="{{ url('music') }}" class="btn btn-raised btn-success pull-right">
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
		@if ($bookings->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>There is no ticket yet!</h1>
			</div>
		@else
			@can('admin_manager', auth()->user())
				<h1>{{ $bookings->count() }} {{ str_plural('Ticket', $bookings->count()) }}</h1>
			@endcan

			@can('member', auth()->user())
				<h1>{{ str_plural('Your Recent Ticket', $bookings->count()) }}</h1>
			@endcan

			<div class="table-responsive">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Details</th>
							<th>{!! sort_column_by('event_id', 'Event Name') !!}</th>
							<th>{!! sort_column_by('total', 'Total') !!}</th>
							<th>{!! sort_column_by('seats', 'Seats') !!}</th>
							<th>Ticket Number</th>
							<th>{!! sort_column_by('active', 'Status') !!}</th>
							@can('admin_manager', auth()->user())
								<th colspan="2">Actions</th>
							@endcan
						</tr>
					</thead>
					<tbody>
						@foreach ($bookings as $booking)
							<tr>
								<td>
									<strong class="text-primary">{{ $booking->user->name }}</strong> <br>
									<strong class="text-info">{{ $booking->user->phone }}</strong>
								</td>
								<td>{{ $booking->event->name }}</td>
								<td>£{{ number_format($booking->total / 100, 2) }}</td>
								<td>{{ $booking->seats }}</td>
								<td><span class="badge">{{ $booking->ticket }}</span></td>
								<td>{!! $booking->active ? '<span class="label label-success">Paid & Confirmed</span>' : '<span class="label label-danger">Refunded & Rejected</span>' !!}</td>
								@can('admin', auth()->user())
									<td>
										@if ($booking->active)
											<form action="{{ route('bookings.update', $booking) }}" method="POST" class="center"
											      data-remote>
												{{ csrf_field() }}
												{{ method_field('PATCH') }}
												<button type='submit' name="submit" class='btn btn-sm btn-primary' title='Refund'
												        data-loading-text="One Moment... <i class='fa fa-spinner fa-pulse'></i>"
												        onclick="return confirm('Are you sure?')">
													<i class="fa fa-exchange fa-lg"></i>
												</button>
											</form>
										@endif
										<form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="center">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-sm btn-danger confirm" title="Delete">
												<i class="fa fa-trash fa-lg"></i>
											</button>
										</form>
									</td>
								@endcan
							</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			<div class="center">
				{{ $bookings->appends(request()->input())->links() }}
			</div>
		@endif
	</main>
@stop