@extends('layouts.app')
@section('title', $user->name . 'Profile - Javan Restaurant London')
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
						@include('partials.user-form', ['user' => $user, 'submit_button' => 'Update Profile'])
					</fieldset>
				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
				<h2><i class="fa fa-info fa-fw fa-lg"></i> Information</h2>
				<p class="text-justify">
					Please make sure your details such as mobile and address are up-to-date for delivery and reservation.
				</p>
				<h2><i class="fa fa-lock fa-fw fa-lg"></i> Password Change</h2>
				<p class="text-justify">
					If you'd like to change your password please type your new password in the password field. If you do not wish
					to change your password please leave the <strong>password field blank</strong>.
					<span class="text-danger">Please be careful because some browsers have auto field populate.</span>
				</p>
				<h2><i class="fa fa-phone fa-fw fa-lg"></i> Mobile Number</h2>
				<p class="text-justify">
					Your mobile number (preferably) is important to us and yourself. If it's inserted incorrectly, your booking,
					take away collection or delivery orders <strong>will not</strong> take place.
				</p>
				<h2><i class="fa fa-gavel fa-fw fa-lg"></i> Terms & Conditions</h2>
				<p class="text-justify">
					Please visit <a class="btn-link" href="{{ url('/information') }}" target="_blank" title="Terms & Conditions">here</a> and read
					our terms and conditions
				</p>
			</div>
		</aside>
	</main>
@stop
