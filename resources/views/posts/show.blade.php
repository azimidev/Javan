@extends('layouts.app')

@section('content')
	<main class="main container">
		<article>
			<div class="col-md-8">
				<h1>{{ $post->subject }}</h1>
				<dl class="dl-horizontal">
					<dt>By:</dt>
					<dd>{{ $post->user->name ?: '-' }}</dd>
					<dt>Slug:</dt>
					<dd>{{ $post->slug ?: '-' }}</dd>
					<dt>Visible:</dt>
					<dd>{!! $post->visible ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' !!}</dd>
					<dt>Body:</dt>
					<dd>{!! nl2br($post->body) ?: '-' !!}</dd>
				</dl>
				<div class="col-lg-offset-2">
					@if (auth()->check() && auth()->user()->owns($post))
						<a href="{{ route('post.index') }}" class="btn btn-raised btn-danger">
							<i class="fa fa-ban"></i> Cancel
						</a>
						<a href="{{ route('post.edit', $post->id) }}" class="btn btn-raised btn-success">
							<i class="fa fa-pencil-square-o"></i> Edit
						</a>
					@else
						<a href="{{ route('post.index') }}" class="btn btn-raised btn-primary">
							<i class="fa fa-arrow-left"></i> Back
						</a>
					@endif
				</div>
			</div>
		</article>
		@include('partials.post-photo')
	</main>
@stop
