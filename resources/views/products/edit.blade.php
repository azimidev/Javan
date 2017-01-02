@extends('layouts.app')
@section('title', 'Edit Product - Javan Restaurant London')
@section('content')
	<main class="container main">
		<article>
			<div class="col-sm-8">
				<h1>Edit Product</h1>
				<form class="form-horizontal" action="{{ route('products.update', $products->id) }}" method="POST" role="form">
					<fieldset>
						<legend>Edit the form below</legend>
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						@include('partials.product-edit', ['products' => $products])
					</fieldset>
				</form>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
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
			</div>
		</aside>
	</main>
@stop
