@extends('layouts.app')

@section('content')
	<main class="main container">
		<article>
			<div class="col-sm-8">
				<h1>Make Reservation</h1>
				<form class="form-horizontal" action="{{ route('reservations.store') }}" method="POST" role="form">
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
				<h2><i class="fa fa-info-circle"></i> Information</h2>
			</div>
		</aside>
	</main>
@stop
