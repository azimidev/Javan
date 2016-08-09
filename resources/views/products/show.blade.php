@extends('layouts.app')

@section('content')
	<main class="main container">
		<article>
			<div class="col-md-8">
				<h1>{{ $products->title }}</h1>
				<dl class="dl-horizontal">
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
			</div>
		</article>
		{{--@include('partials.products-photo')--}}
	</main>
@stop
