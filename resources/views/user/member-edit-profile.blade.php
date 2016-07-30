
@extends('layouts.app')

@section('content')
	<main class="container main">
		<article>
			<div class="col-sm-8">
				<h1>Member's Edit Profile</h1>
				<form class="form-horizontal" action="{{ route('member.update', $user->id) }}" method="POST" role="form">
					<fieldset>
						<legend>Change Your Profile Details</legend>
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
				<p class="text-justify">
					Please make sure your details such as mobile and address are up-to-date for delivery and reservation.
				</p>
			</div>
		</aside>
	</main>
@stop
