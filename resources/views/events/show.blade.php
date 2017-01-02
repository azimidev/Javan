@extends('layouts.app')
@section('title', $event->name . ' - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article class="col-md-7">
			<h2>Event Details</h2>
			<dl class="dl-horizontal">
				<dt>Name:</dt>
				<dd>{{ $event->name }}</dd>
				<dt>Slug:</dt>
				<dd>{{ $event->slug }}</dd>
				<dt>Price:</dt>
				<dd>£ {{ number_format($event->price / 100, 2) }}</dd>
				<dt>Capacity:</dt>
				<dd><span class="badge">{{ $event->capacity }}</span></dd>
				<dt>Active:</dt>
				<dd>{!! $event->active ? '<span class="label label-success">YES</span>' : '<span class="label label-danger">NO</span>' !!}</dd>
				<dt>Start:</dt>
				<dd>{{ $event->start->toDayDateTimeString() }}</dd>
				<dt>Finish:</dt>
				<dd>{{ $event->finish->toDayDateTimeString() }}</dd>
				<dt>Description:</dt>
				<dd>{{ $event->description ?: '-' }}</dd>
			</dl>
			<div class="col-lg-offset-2">
				<a href="{{ route('events.index') }}" class="btn btn-raised btn-primary">
					<i class="fa fa-arrow-left"></i> Back
				</a>
				<a href="{{ route('events.edit', $event->id) }}" class="btn btn-raised btn-success">
					<i class="fa fa-pencil-square-o"></i> Edit
				</a>
			</div>
		</article>
		<aside class="col-md-5">
			@if ($event->image_path)
				<h2><i class="fa fa-picture-o fa-fw"></i> Photo Uploaded</h2>
				<div class="row">
					<div class="img-wrap">
						<form method="POST" action="{{ route('delete.event.photo', $event->id) }}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="close confirm" data-dismiss="modal" aria-hidden="true">&times;</button>
							<a href="/{{ $event->image_path }}" data-lity>
								<img class="img-space img-responsive img-thumbnail img-raised pull-right" width="100%"
								     src="/{{ $event->image_path }}" alt="{{ $event->title }}">
							</a>
						</form>
					</div>
				</div>
			@endif
			@unless ($event->image_path)
				<h2><i class="fa fa-picture-o fa-fw"></i> Add <span class="text-danger">One</span> Event Photo</h2>
				<form class="dropzone" action="{{ route('add.event.photo', $event->id) }}" method="POST"
				      id="addEventPhoto"
				      enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="text-primary dz-message" data-dz-message>Upload Photo Here</div>
				</form>
			@endunless
		</aside>
	</main>
@stop
