<aside>
	<div class="col-md-4">
		@if (auth()->check() && auth()->user()->owns($post))
			<h2><i class="fa fa-picture-o"></i> Add Post Photos</h2>
			<form class="dropzone" action="{{ route('add.photo', $post->slug) }}" method="POST" id="addPhotosFrom"
			      enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="text-primary dz-message" data-dz-message>Upload Photos Here</div>
			</form>
		@endif
		@unless ($post->photos->isEmpty())
			<h2><i class="fa fa-picture-o"></i> Photos Uploaded</h2>
			@foreach ($post->photos->chunk(2) as $set)
				<div class="row">
					@foreach ($set as $photo)
						<div class="col-xs-6">
							<a href="/{{ $photo->path }}" data-lity>
								<img class="img-space img-responsive img-thumbnail img-raised"
								     src="/{{ $photo->thumbnail_path }}"
								     alt="{{ $photo->name }}">
							</a>
							{{--<button type="submit" class="btn btn-sm btn-danger" data-dz-remove>&times;</button>--}}
						</div>
					@endforeach
				</div>
			@endforeach
		@endunless

	</div>
</aside>