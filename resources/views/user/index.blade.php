@extends('layouts.app')

@section('content')
	<main class="container main">
		@can('admin', auth()->user())
			<a href="{{ route('user.create') }}" class="btn btn-raised btn-info pull-right">
				<i class="fa fa-plus fa-lg"></i>
			</a>
		@endcan
		@if ($users->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>Nothing Yet !</h1>
				<h1><i class="fa fa-frown-o fa-lg"></i></h1>
			</div>
		@else
			<h1>List of {{ $users->count() }} {{ str_plural('User', $users->count()) }}</h1>
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>City</th>
						<th>Post Code</th>
						<th>Phone</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr class="{{ $user->active ? '' : 'danger'}}">
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->address }}</td>
							<td>{{ $user->city }}</td>
							<td>{{ $user->post_code }}</td>
							<td>{{ $user->phone }}</td>
							<td>
								@can('admin', $user)
									<form action="{{ route('user.destroy', $user) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-raised btn-success">
											<i class="fa fa-lg fa-pencil-square-o"></i>
										</a>
										@unless($user->isSelf())
											<button type="submit" class="btn btn-sm btn-raised btn-danger confirm">
												<i class="fa fa-lg fa-trash"></i>
											</button>
										@endunless
									</form>
								@endcan
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="center">
				{{ $users->appends(Request::input())->links() }}
			</div>
		@endif
	</main>
@stop
