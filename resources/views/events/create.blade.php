@extends('layouts.app')
@section('title', 'Create Event - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article>
			<div class="col-sm-8">
				<div class="container">
					<h1>Create Event</h1>
					<form class="form-horizontal" action="{{ route('events.store') }}" method="POST" role="form">
						<fieldset>
							<legend>Please fill out this form</legend>
							{{ csrf_field() }}
							@include('partials.event-create')
						</fieldset>
					</form>
				</div>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
			</div>
		</aside>
	</main>
@stop
