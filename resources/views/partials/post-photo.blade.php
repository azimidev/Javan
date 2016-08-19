<aside>
	<div class="col-md-4">
		@if (auth()->check() && auth()->user()->owns($post))
			<h2><i class="fa fa-picture-o fa-fw"></i> Add Post Photos</h2>
			<form class="dropzone" action="{{ route('add.photo', $post->slug) }}" method="POST" id="addPhotosFrom"
			      enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="text-primary dz-message" data-dz-message>Upload Photos Here</div>
			</form>
		@endif
		@unless (auth()->user()->owns($post))
			<div class="alert alert-info">
				<div class="container-fluid">
					<div class="alert-icon"><i class="material-icons">info</i></div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="material-icons">clear</i></span>
					</button>
					You cannot edit the post or update ant photos because you don't have authorization.
				</div>
			</div>
		@endunless
		@unless ($post->photos->isEmpty())
			<h2><i class="fa fa-picture-o fa-fw"></i> Photos Uploaded</h2>
			@foreach ($post->photos->chunk(2) as $set)
				<div class="row">
					@foreach ($set as $photo)
						<div class="col-xs-6">
							<div class="img-wrap">
								@if (auth()->user()->owns($post))
									<form method="POST" action="{{ route('delete.photo', $photo->id) }}">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="close confirm" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
									</form>
								@endif
								<a href="/{{ $photo->path }}" data-lity>
									<img class="img-space img-responsive img-thumbnail img-raised pull-right"
									     src="/{{ $photo->thumbnail_path }}"
									     alt="{{ $photo->name }}">
								</a>
							</div>
						</div>
					@endforeach
				</div>
			@endforeach
		@endunless
	</div>
</aside>