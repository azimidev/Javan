@extends('layouts.app')
@section('title', 'Create Event - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article>
			<div class="container">
				<h1>Create Event</h1>
				<form class="form-horizontal" action="{{ route('events.store') }}" method="POST" role="form">
					<fieldset>
						<legend>Please fill out this form</legend>
						{{ csrf_field() }}
						@include('partials.event-form', ['events' => new Javan\Event()])
					</fieldset>
				</form>
			</div>
		</article>
	</main>
@stop
