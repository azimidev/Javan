@extends('layouts.app')
@section('title', 'All Products - Javan Restaurant London')
@section('content')
	<main class="main container">
		<a href="{{ route('products.create') }}" class="btn btn-raised btn-success pull-right">
			<i class="fa fa-plus fa-lg"></i>
		</a>
		@if ($products->isEmpty())
			<div class="clearfix"></div>
			<div class="center">
				<h1>Menu is empty !</h1>
				<h2>Click the plus button to add products to menu</h2>
			</div>
		@else
			<h1>{{ $products->count() }} {{ str_plural('Product', $products->count()) }}</h1>

			<div class="table-responsive">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>{!! sort_column_by('title', 'Title') !!}</th>
							<th width="50%">{!! sort_column_by('description', 'Description') !!}</th>
							<th>{!! sort_column_by('price', 'Price') !!}</th>
							<th>{!! sort_column_by('category', 'Category') !!}</th>
							<th width="10%" colspan="2">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
							<tr class="{{ $product->available ? 'success' : 'danger' }}">
								<td>{{ $product->title }}</td>
								<td>{{ $product->description }}</td>
								<td><span class="label label-danger">£ {{ number_format($product->price / 100, 2) }}</span></td>
								<td><span class="label label-info">{{ $product->category }}</span></td>
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
			</div><!-- /.table-responsive -->
		@endif
	</main>
@stop
