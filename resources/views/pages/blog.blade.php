@extends('layouts.app')
@section('title', ($post ? $post->subject : 'Blog') . ' - Javan Restaurant London')
@section('content')
	<div class="header header-filter"
	     style="background-image: url('/images/background/background-3.jpg'); background-size: cover; height : 300px;">
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
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>{{ $post ? $post->subject : 'Recent News' }}</h3>
						</div>
						<div class="panel-body">
							@if ($post)
								@include('partials.post-show', ['post' => $post])
							@else
								@include('partials.post-show', ['post' => $posts->first()])
							@endif
						</div>
						@if ($post)
							<div class="panel-footer">
								@include('partials.disqus')
							</div>
						@endif
					</div>
				</div>
			</article>
			<article>
				<div class="col-md-4 col-xs-12">
					<div class="panel panel-default">
						  <div class="panel-heading">
								<h3><i class="fa fa-paper-plane-o"></i> Recent Posts</h2></h3>
						  </div>
						  <div class="panel-body">
							  <div class="list-group">
								  @foreach ($posts as $post)
									  <a class="list-group-item list-group-item-success {{ route_parameter('slug', $post->slug) ? 'active' : '' }}"
									     id="pjax" href="{{ route('blog', $post->slug) }}">
										  {!! status($post) !!} {{ $post->subject }}
									  </a>
								  @endforeach
							  </div>
						  </div>
						<div class="panel-footer center">
							{{ $posts->render() }}
							{{-- $posts->appends(request()->input())->links() --}}
						</div>
					</div>
			</article>
		@else
			<div class="center">
				<h1>There is no post at the moment</h1>
				<h2>Check back later</h2>
			</div>
		@endif
	</main>
@stop
