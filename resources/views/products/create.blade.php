@extends('layouts.app')

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
							@include('partials.product-create')
						</fieldset>
					</form>
				</div>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
				<h2><i class="fa fa-info-circle"></i> Information</h2>
			</div>
		</aside>
	</main>
@stop
