@extends('layouts.app')
@section('title', 'Edit User - Javan Restaurant London')
@section('content')
	<main class="container main">
		<article>
			<div class="col-sm-8">
				<h1>Edit Profile</h1>
				<form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST" role="form">
					<fieldset>
						<legend>Edit the form below</legend>
						@if ($user == auth()->user())
							<p class="text-info">
								You cannot change the role for yourself !
							</p>
						@endif
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						@include('partials.edit', ['user' => $user])
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
