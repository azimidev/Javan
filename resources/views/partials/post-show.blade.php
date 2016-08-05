@unless ($post)
	<h2>{{ $post->subject }}</h2>
	<div class="col-sm-8">
		{!! nl2br($post->body) !!}
	</div>
	<div class="col-sm-4 center">
		@foreach ($post->photos as $photo)
			<a href="/{{ $photo->path }}" data-lity>
				<img class="img-space img-responsive img-thumbnail img-raised"
				     src="/{{ $photo->thumbnail_path }}"
				     alt="{{ $photo->name }}">
			</a>
		@endforeach
	</div>
@endunless
