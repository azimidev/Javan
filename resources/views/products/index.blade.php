@extends('layouts.app')

@section('content')
	<main class="main container">
		<a href="{{ route('products.create') }}" class="btn btn-raised btn-info pull-right">
			<i class="fa fa-plus fa-lg"></i>
		</a>
		@if ($products->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>You have no booking yet !</h1>
				<h2>Click the plus button to book a table</h2>
			</div>
		@else
			<h1>{{ $products->count() }} {{ str_plural('Product', $products->count()) }}</h1>

			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>{!! sort_products_by('title', 'Title') !!}</th>
						<th>{!! sort_products_by('description', 'Description') !!}</th>
						<th>{!! sort_products_by('price', 'Price') !!}</th>
						<th>{!! sort_products_by('category', 'Category') !!}</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>{{ $product->title }}</td>
							<td>{{ $product->description }}</td>
							<td>{{ $product->price }}</td>
							<td>{{ $product->category }}</td>
							<td>
								<form action="{{ route('products.destroy', $product) }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">
										<i class="fa fa-eye fa-fw"></i>
									</a>
									<a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-success">
										<i class="fa fa-pencil-square-o fa-fw"></i>
									</a>
									<button type="submit" class="btn btn-sm btn-danger confirm">
										<i class="fa fa-trash fa-fw"></i>
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</main>
@stop
