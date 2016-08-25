@extends('layouts.app')
@section('content')
	<div class="header header-filter"
	     style="background-image: url('/images/carousel/chelo-chenjeh.jpg'); background-size: cover; height : 300px;">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1>Blog</h1>
						<h3>News, Events and Offers</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<main class="container main main-raised" id="pjax-container">
		@if( ! $posts->isEmpty())
			<article>
				<div class="col-md-8 col-xs-12">
					@if ($post)
						@section('title') {{ $post->subject }} @stop
						@include('partials.post-show', ['post' => $post])
						@include('partials.disqus')
					@else
						@include('partials.post-show', ['post' => $posts->first()])
					@endif
				</div>
			</article>
			<aside>
				<div class="col-md-4 col-xs-12">
					<h2><i class="fa fa-paper-plane-o"></i> Recent Posts</h2>
					<div class="list-group">
						@foreach ($posts as $post)
							<a class="list-group-item {{ route_parameter('slug', $post->slug) ? 'active' : '' }}"
							   id="pjax" href="{{ route('blog', $post->slug) }}">
								{!! status($post) !!} {{ $post->subject }}
							</a>
						@endforeach
					</div>
					<div class="center">
						{{ $posts->render() }}
						{{-- $posts->appends(request()->input())->links() --}}
					</div>
				</div>
			</aside>
		@else
			<div class="center">
				<h1>There is no post at the moment</h1>
				<h2>Check back later</h2>
			</div>
		@endif
	</main>
@stop
