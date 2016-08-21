@extends('layouts.app')
@section('title', 'Create Post - Javan Restaurant London')
@section('content')
	<section class="main container">
		<div class="col-sm-8">
			<div class="container">
				<h1>Create Post</h1>
				<form class="form-horizontal" action="{{ route('post.store') }}" method="POST" role="form">
					<fieldset>
						<legend>Please fill out this form</legend>
						{{ csrf_field() }}
						@include('partials.post-create')
					</fieldset>
				</form>
			</div>
		</div>
		<div class="col-sm-4">
		</div>
	</section>
@stop
