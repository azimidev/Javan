@extends('layouts.app')
@section('title', 'Edit Reservation - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article>
			<div class="col-sm-8">
				<h1>Edit Your Profile</h1>
				<form class="form-horizontal" action="{{ route('reservations.update', $reservations->id) }}"
				      method="POST" role="form">
					<fieldset>
						<legend>Please fill out the form below</legend>
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						@include('partials.reservations-form', ['reservations' => $reservations, 'submit_button' => 'Change Reservation'])
					</fieldset>
				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
			</div>
		</aside>
	</main>
@stop
