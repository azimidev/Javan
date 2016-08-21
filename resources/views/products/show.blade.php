@extends('layouts.app')
@section('title', $products->title . ' - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article class="col-md-8">
			<h2>Product Details</h2>
			<dl class="dl-horizontal">
				<dt>Title:</dt>
				<dd>{{ $products->title ?: '-' }}</dd>
				<dt>Description:</dt>
				<dd>{{ $products->description ?: '-' }}</dd>
				<dt>Price:</dt>
				<dd>£ {{ number_format($products->price / 100, 2) }}</dd>
				<dt>Category:</dt>
				<dd><span class="label label-info">{{ $products->category }}</span></dd>
			</dl>
			<div class="col-lg-offset-2">
				<a href="{{ route('products.index') }}" class="btn btn-raised btn-danger">
					<i class="fa fa-ban"></i> Cancel
				</a>
				<a href="{{ route('products.edit', $products->id) }}" class="btn btn-raised btn-success">
					<i class="fa fa-pencil-square-o"></i> Edit
				</a>
			</div>
		</article>
		<aside class="col-md-4">
			@if ($products->image_path)
				<h2><i class="fa fa-picture-o fa-fw"></i> Photo Uploaded</h2>
				<div class="row">
					<div class="img-wrap">
						<form method="POST" action="{{ route('delete.product.photo', $products->id) }}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="close confirm" data-dismiss="modal" aria-hidden="true">&times;</button>
							<a href="/{{ $products->image_path }}" data-lity>
								<img class="img-space img-responsive img-thumbnail img-raised pull-right" width="100%"
								     src="/{{ $products->image_path }}" alt="{{ $products->title }}">
							</a>
						</form>
					</div>
				</div>
			@endif
			@unless ($products->image_path)
				<h2><i class="fa fa-picture-o fa-fw"></i> Add <span class="text-danger">One</span> Product Photo</h2>
				<form class="dropzone" action="{{ route('add.product.photo', $products->id) }}" method="POST"
				      id="addProductPhoto"
				      enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="text-primary dz-message" data-dz-message>Upload Photos Here</div>
				</form>
			@endunless
		</aside>
	</main>
@stop
