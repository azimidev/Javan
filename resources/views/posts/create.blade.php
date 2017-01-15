@extends('layouts.app')
@section('title', 'Create Post - Javan Restaurant London')
@section('content')
	<section class="main container">
		<div class="container">
			<h1>Create Post</h1>
			<form class="form-horizontal" action="{{ route('post.store') }}" method="POST" role="form">
				<fieldset>
					<legend>Please fill out this form</legend>
					{{ csrf_field() }}
					@include('partials.post-form', ['post' => new Javan\Post()])
				</fieldset>
			</form>
		</div>
	</section>
@stop
