@extends('layouts.app')
@section('title', 'Create Reservation - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article>
			<div class="col-sm-8">
				<h1>Make Reservation</h1>
				<form class="form-horizontal" action="{{ route('reservations.store') }}" method="POST" role="form" data-remote>
					<fieldset>
						<legend>Please fill out this form</legend>
						{{ csrf_field() }}
						@include('partials.reservations-create')
					</fieldset>
				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
				<h2><i class="fa fa-info-circle fa-fw"></i> Information</h2>
				<p class="text-justify">
					This <u>is not for live music</u> booking. This is for restaurant's table bookings (upstairs) ONLY.
				</p>
				<p>
					For parties more than <u>25</u> people please call us on <a href="tel:02085638553">02085638553</a>
				</p>
				<p class="text-justify">
					Please make sure you have inserted your <u>email</u> address and <u>mobile</u> number correctly to receive
					confirmation. Sometimes we need to see confirmation.
				</p>
				<p class="text-justify">
					Your booking active status is important to be <span class="label label-success">Yes</span>. If the active
					status is set to <span class="label label-danger">No</span>, it means
					your reservation is canceled.
				</p>
				<p>
					<a href="{{ route('member.edit', auth()->user()) }}" class="btn btn-primary btn-raised btn-block">
						Update Your Details
					</a>
				</p>

			</div>
		</aside>
	</main>
@stop
