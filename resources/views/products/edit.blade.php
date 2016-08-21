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
			</div>
		</aside>
	</main>
@stop
