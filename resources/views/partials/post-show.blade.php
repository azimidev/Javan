@if ($post)
	<div class="col-sm-4 center">
		@foreach ($post->photos as $photo)
			<a href="/{{ $photo->path }}" data-lity>
				<img class="img-space img-responsive img-thumbnail img-raised"
				     src="/{{ $photo->path }}"
				     alt="{{ $photo->name }}">
			</a>
			<br>
		@endforeach
	</div>
	<div class="col-sm-8">
		<h2>{{ $post->subject }}</h2>
		{!! nl2br($post->body) !!}
	</div>
@endif
