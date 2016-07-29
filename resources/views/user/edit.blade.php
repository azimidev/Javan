@extends('layouts.app')

@section('content')
	<main class="container main">
		<article>
			<div class="col-sm-8">
				<h1>Edit Your Profile</h1>
				<form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST" role="form">
					<fieldset>
						<legend>Edit the form below</legend>
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						@include('partials.edit', ['user' => $user])
					</fieldset>
				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
				<h2><i class="fa fa-info-circle"></i> Information</h2>
				@if ($user == auth()->user())
					<p class="text-info">
						You cannot change the role for yourself!
					</p>
				@endif
			</div>
		</aside>
	</main>
@stop
