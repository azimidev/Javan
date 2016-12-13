@if ($post)
	<div>
		@foreach ($post->photos as $photo)
			{{--<a href="/{{ $photo->path }}" data-lity>--}}
				<img class="img-space img-responsive img-thumbnail img-raised"
				     src="/{{ $photo->path }}"
				     alt="{{ $photo->name }}">
			{{--</a>--}}
		@endforeach
	</div>
	<h2>{{ $post->subject }}</h2>
	{!! nl2br($post->body) !!}
@endif
