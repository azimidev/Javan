@extends('layouts.app')

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
				<h2><i class="fa fa-info-circle"></i> Information</h2>
			</div>
		</aside>
	</main>
@stop
