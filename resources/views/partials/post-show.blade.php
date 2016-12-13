@if ($post)
	<div class="pull-right">
		@foreach ($post->photos as $photo)
			<a href="/{{ $photo->path }}" data-lity>
				<img class="img-space img-responsive img-thumbnail img-raised"
				     style="margin-left:1em;"
				     src="/{{ $photo->thumbnail_path }}"
				     alt="{{ $photo->name }}">
			</a>
			<br>
		@endforeach
	</div>
	<h2>{{ $post->subject }}</h2>
	{!! nl2br($post->body) !!}
@endif
