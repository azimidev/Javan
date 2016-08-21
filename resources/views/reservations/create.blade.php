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
				<p class="text-justify alert alert-info">
					For parties more than 25 people please call us on <a href="tel:02085638553" class="alert-link">02085638553</a>
				</p>
				<p class="text-justify">
					Please make sure you have inserted yur number <strong>preferably mobile number</strong> correctly in your
					profile in case we want to contact you urgently to avoid any disappointments.
				</p>
				<p class="text-justify">
					Please make sure you have inserted your <strong>email</strong> address correctly to receive email
					confirmation. Sometimes we need to see email confirmation, without a valid one, we won't be able to book you.
				</p>
				<p class="text-justify">
					Your booking active status is important to be <span class="label label-success">Yes</span> and only can be
					modified by the manager. If the active status is set to <span class="label label-danger">No</span> it means
					your reservation is not valid for the reason(s) can be explained by the manager.
				</p>
				<p class="text-justify">
					If you are not sure whether this information is correct please update your profile. <br>
					<a href="{{ route('member.edit', auth()->user()) }}" class="btn btn-primary btn-raised">
						Update Your Details
					</a>
				</p>

			</div>
		</aside>
	</main>
@stop
