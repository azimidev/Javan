@extends('layouts.app')

@section('content')
	<main class="main container header">
		<div class="jumbotron row header-filter profile">
			<div class="container">
				<h1>Welcome {{ $user->name }}</h1>
				@can('member', $user)
					@unless ($user->address && $user->post_code)
						<p class="text-bright">It appears your address is not completed yet ! </p>
						<p class="text-bright"> Please make sure your address is correct for delivery before you order otherwise we
							cannot deliver to you.</p>
					@endunless
					<p>For reservations or delivery please click on the buttons below</p>
					<p>
						<a href="#" class="btn btn-danger btn-raised btn-round btn-lg" data-toggle="modal" data-target="#myModal">
							Take Away Orders
						</a>
						<a href="{{ route('member.bookings') }}" class="btn btn-info btn-raised btn-round btn-lg">
							Bookings
						</a>
					</p>
				@endcan
				@can('admin', $user)
					<p class="text-danger">You are the owner or administrator with the full privilege</p>
					<p>
						<a href="{{ route('reservations.index') }}" class="btn btn-primary btn-raised btn-round">
							Manage Bookings
						</a>
						<a href="#" class="btn btn-primary btn-raised btn-round">
							Manage Take Aways
						</a>
					</p>
				@endcan
				@can('manager', $user)
					<p class="text-success">You are the manager of the restaurnat who can:</p>
					<p>
						<a href="{{ route('reservations.index') }}" class="btn btn-info btn-raised btn-round">
							Manage Bookings
						</a>
						<a href="#" class="btn btn-danger btn-raised btn-round">
							Manage Take Aways
						</a>
					</p>
				@endcan
			</div>
		</div>
		<article>
			<div class="col-md-8">
				<h2>Your Details</h2>
				<dl class="dl-horizontal">
					<dt>Name:</dt>
					<dd>{{ $user->name ?: '-' }}</dd>
					<dt>Email:</dt>
					<dd>{{ $user->email ?: '-' }}</dd>
					<dt>Address:</dt>
					<dd>{{ $user->address ?: '-' }}</dd>
					<dt>City:</dt>
					<dd>{{ $user->city ?: '-' }}</dd>
					<dt>Post Code:</dt>
					<dd>{{ $user->post_code ?: '-' }}</dd>
					<dt>Phone:</dt>
					<dd>{{ $user->phone ?: '-' }}</dd>
				</dl>
				<div class="col-lg-offset-2">
					<a href="{{ route('member.edit', $user->id) }}" class="btn btn-raised btn-primary">
						<i class="fa fa-pencil-square-o"></i> Edit
					</a>
				</div>
			</div>
		</article>
		<aside>
			<div class="col-md-4">
				<h2><i class="fa fa-info-circle"></i> Navigation</h2>
				<ul class="list-unstyled">
					<li>
						<a class="btn btn-primary" href="{{ route('member.bookings') }}">
							<i class="fa fa-calendar fa-lg fa-fw"></i> Your Booking
						</a>
					</li>
					<li>
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-cutlery fa-lg fa-fw"></i> Your Orders
						</a>
					</li>
				</ul>
			</div>
		</aside>
	</main>
@stop
