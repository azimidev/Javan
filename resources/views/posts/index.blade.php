@extends('layouts.app')
@section('title', 'All Posts - Javan Restaurant London')
@section('content')
	<main class="container main">
		@can('admin_manager', auth()->user())
			<a href="{{ route('post.create') }}" class="btn btn-raised btn-success pull-right">
				<i class="fa fa-plus fa-lg"></i>
			</a>
		@endcan
		@if ($posts->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>Nothing Yet !</h1>
				<h1><i class="fa fa-frown-o fa-lg"></i></h1>
			</div>
		@else
			<h1>{{ $posts->count() }} {{ str_plural('Post', $posts->count()) }}</h1>
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>Subject</th>
						<th>By</th>
						<th>Slug</th>
						<th>Visible</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($posts as $post)
						<tr>
							<td>{{ $post->subject }}</td>
							<td>{{ $post->user->name }}</td>
							<td><a href="{{ route('post.show', $post->slug) }}">{{ $post->slug }}</a></td>
							<td>{!! $post->visible ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' !!}</td>
							<td>
								<form action="{{ route('post.destroy', $post) }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<a href="{{ route('post.show', $post->slug) }}" class="btn btn-sm btn-info">
										<i class="fa fa-eye fa-lg"></i>
									</a>
									@if (auth()->check() && auth()->user()->owns($post))
										<a href="{{ route('post.edit', $post) }}" class="btn btn-sm btn-success">
											<i class="fa fa-lg fa-pencil-square-o"></i>
										</a>
										<button type="submit" class="btn btn-sm btn-danger">
											<i class="fa fa-lg fa-trash"></i>
										</button>
									@endif
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="center">
				{{ $posts->appends(Request::input())->links() }}
			</div>
		@endif
	</main>
@stop
