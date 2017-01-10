@if ($post)
	<h2>{{ $post->subject }}</h2>
	<span class="pull-right">
		@foreach ($post->photos as $photo)
			<a href="/{{ $photo->path }}" data-lity class="hidden-xs">
				<img class="img-space img-responsive img-thumbnail img-raised"
				     style="margin-left:1em;"
				     src="/{{ $photo->thumbnail_path }}"
				     alt="{{ $photo->name }}">
			</a>
			<a href="/{{ $photo->path }}" data-lity class="visible-xs">
				<img class="img-space img-responsive img-thumbnail img-raised"
				     src="/{{ $photo->path }}"
				     alt="{{ $photo->name }}">
			</a>
			<br>
		@endforeach
	</span>
	{!! nl2br($post->body) !!}
@endif
