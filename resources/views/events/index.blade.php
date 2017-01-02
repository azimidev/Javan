@extends('layouts.app')
@section('title', 'All Event Booking - Javan Restaurant London')
@section('content')
	<main class="main container">
		<a href="{{ route('events.create') }}" class="btn btn-raised btn-success pull-right">
			<i class="fa fa-plus fa-lg"></i>
		</a>
		@if ($events->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>You have no event yet !</h1>
				<h2>Click the plus button to add an event</h2>
			</div>
		@else
			<h1>{{ $events->count() }} {{ str_plural('Event', $events->count()) }}</h1>

			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>Event Name</th>
						<th>Capacity</th>
						<th>Price</th>
						<th>Active?</th>
						<th>Image?</th>
						<th>Start</th>
						<th>Finish</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($events as $event)
						<tr>
							<td>{{ $event->name }}</td>
							<td>{{ $event->capacity }}</td>
							<td>£ {{ number_format($event->price / 100, 2) }}</td>
							<td>{!! $event->active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' !!}</td>
							<td>{!! empty($event->image_path) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>' !!}</td>
							<td>{{ $event->start->toDayDateTimeString() }}</td>
							<td>{{ $event->finish->toDayDateTimeString() }}</td>
							<td>
								@can('admin_manager', auth()->user())
									<form action="{{ route('events.destroy', $event) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<a href="{{ route('events.show', $event->slug) }}" class="btn btn-sm btn-info">
											<i class="fa fa-eye fa-lg"></i>
										</a>
										<a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-success">
											<i class="fa fa-lg fa-pencil-square-o"></i>
										</a>
										<button type="submit" class="btn btn-sm btn-danger">
											<i class="fa fa-lg fa-trash"></i>
										</button>
									</form>
								@endcan
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="center">
				{{ $events->appends(request()->input())->links() }}
			</div>
		@endif
	</main>
@stop
