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
					<p>
						<a href="{{ route('member.orders') }}" class="btn btn-danger btn-raised btn-round btn-lg">
							Take Away Orders
						</a>
						<a href="{{ route('member.reservations') }}" class="btn btn-info btn-raised btn-round btn-lg">
							Restaurant Reservations
						</a>
					</p>
				@endcan
				@can('admin_manager', $user)
					<p class="lead">Role: {{ ucfirst($user->role) }}</p>
					<p>
						<a href="{{ route('reservations.index') }}" class="btn btn-info btn-raised btn-round">
							Reservations
						</a>
						<a href="{{ route('cart.index') }}" class="btn btn-danger btn-raised btn-round">
							Take Aways
						</a>
						<a href="{{ route('bookings.index') }}" class="btn btn-primary btn-raised btn-round">
							Event Bookings
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
						<a class="btn btn-primary" href="{{ route('member.reservations') }}">
							<i class="fa fa-calendar fa-lg fa-fw"></i> Your Booking
						</a>
					</li>
					<li>
						<a class="btn btn-primary" href="{{ route('member.orders') }}">
							<i class="fa fa-cutlery fa-lg fa-fw"></i> Your Orders
						</a>
					</li>
				</ul>
			</div>
		</aside>
	</main>
@stop
