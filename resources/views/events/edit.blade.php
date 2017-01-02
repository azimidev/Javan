@extends('layouts.app')
@section('title', 'Edit Event - Javan Restaurant London')
@section('content')
	<main class="container main">
		<article>
			<div class="col-sm-7">
				<h1>Edit Event</h1>
				<form class="form-horizontal" action="{{ route('events.update', $events->id) }}" method="POST" role="form">
					<fieldset>
						<legend>Edit the form below</legend>
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						@include('partials.event-edit', ['events' => $events])
					</fieldset>
				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-5">
				@if ($events->image_path)
					<h2><i class="fa fa-picture-o fa-fw"></i> Photo Uploaded</h2>
					<div class="row">
						<div class="img-wrap">
							<form method="POST" action="{{ route('delete.event.photo', $events->id) }}">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="submit" class="close confirm" data-dismiss="modal" aria-hidden="true">&times;</button>
								<a href="/{{ $events->image_path }}" data-lity>
									<img class="img-space img-responsive img-thumbnail img-raised pull-right" width="100%"
									     src="/{{ $events->image_path }}" alt="{{ $events->title }}">
								</a>
							</form>
						</div>
					</div>
				@endif
				@unless ($events->image_path)
					<h2><i class="fa fa-picture-o fa-fw"></i> Add <span class="text-danger">One</span> Event Photo</h2>
					<form class="dropzone" action="{{ route('add.event.photo', $events->id) }}" method="POST"
					      id="addEventPhoto"
					      enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="text-primary dz-message" data-dz-message>Upload Photo Here</div>
					</form>
				@endunless
			</div>
		</aside>
	</main>
@stop