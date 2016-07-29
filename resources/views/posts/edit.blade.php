@extends('layouts.app')

@section('content')
	<main class="container main">
		<article>
			<div class="col-sm-8">
				<h1>Edit Post</h1>
				<h3>By: {{ $post->user->name }}</h3>
				<form class="form-horizontal" action="{{ route('post.update', $post->id) }}" method="POST" role="form">
					<fieldset>
						<legend>Edit the form below</legend>
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						@include('partials.post-edit', ['post' => $post])
					</fieldset>
				</form>
			</div>
		</article>
		@include('partials.post-photo')
	</main>
@stop
