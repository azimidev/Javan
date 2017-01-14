@extends('layouts.app')
@section('title', 'Create Product - Javan Restaurant London')
@section('content')
	<main class="main container">
		<article>
			<div class="col-sm-8">
				<div class="container">
					<h1>Create Menu Product</h1>
					<form class="form-horizontal" action="{{ route('products.store') }}" method="POST" role="form">
						<fieldset>
							<legend>Please fill out this form</legend>
							{{ csrf_field() }}
							@include('partials.product-form', ['products' => new Javan\Product()])
						</fieldset>
					</form>
				</div>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
			</div>
		</aside>
	</main>
@stop
