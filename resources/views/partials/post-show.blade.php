@if ($post)
	<span class="pull-left">
		@foreach ($post->photos as $photo)
			<a href="/{{ $photo->path }}" data-lity class="hidden-xs">
				<img class="img-space img-responsive img-thumbnail img-raised"
				     style="margin-right:1em;"
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
	{{--<div class="col-sm-8">--}}
	<h2>{{ $post->subject }}</h2>
	{!! nl2br($post->body) !!}
	{{--</div>--}}
@endif
