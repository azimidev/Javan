@extends('layouts.app')

@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/menu-background.png');">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Cart is updated'])
			<h1 class="text-warning">The Menu</h1>
			<p class="text-warning">To view PDF version of menu :
				<a class="btn btn-sm btn-warning" href="/images/menu/Javan-Restaurant-Menu.pdf" target="_blank"
				   title="Javan Restaurant Menu">please click here</a>
			</p>
			<p class="text-warning">Please hover your mouse on each food to see the descriptions</p>
			<article class="col-md-8">
				@unless (javan_is_open())
					<div class="alert alert-danger">
						<div class="alert-icon"><i class="material-icons">error</i></div>
						We are closed now and cannot accept orders unless you want specific delivery time between 13:00 - 23:00
					</div>
				@endunless
				<div class="brand menu">
					<h2>Appetizers</h2>

					<div class="row">
						@foreach ($appetizers as $appetizer)
							<div class="col-xs-4">
								<div class="thumbnail">
									@if ($appetizer->image_path)
										<a href="/{{ $appetizer->image_path }}" data-lity>
											<img src="/{{ $appetizer->image_path }}" class="img-responsive" alt="mirza-ghasemi">
										</a>
									@endif
									<div class="caption">
										<h3 style="cursor:help;" title="{{ $appetizer->description }}" data-toggle="tooltip"
										    data-placement="top">{{ $appetizer->title }}</h3>
										£ {{ number_format($appetizer->price / 100 , 2) }}
										<a id="addToCart" href="{{ route('add.to.cart', $appetizer) }}"
										   class="btn btn-sm btn-success btn-raised pull-right">
											<i class="fa fa-plus fa-lg"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>

					<div class="clearfix"></div>
					<h2>Main Course</h2>
					<div class="row">
						@foreach ($main_courses as $main_course)
							<div class="col-xs-4">
								<div class="thumbnail">
									@if ($main_course->image_path)
										<a href="/{{ $main_course->image_path }}" data-lity>
											<img src="/{{ $main_course->image_path }}" class="img-responsive" alt="mirza-ghasemi">
										</a>
									@endif
									<div class="caption">
										<h3 style="cursor:help;" title="{{ $main_course->description }}" data-toggle="tooltip"
										    data-placement="top">{{ $main_course->title }}</h3>
										£ {{ number_format($main_course->price / 100 , 2) }}
										<a id="addToCart" href="{{ route('add.to.cart', $main_course) }}"
										   class="btn btn-sm btn-success btn-raised pull-right">
											<i class="fa fa-plus fa-lg"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="clearfix"></div>
					<h2>Sides & Extras</h2>
					<div class="row">
						@foreach ($extras as $extra)
							<div class="col-xs-4">
								<div class="thumbnail">
									@if ($extra->image_path)
										<a href="/{{ $extra->image_path }}" data-lity>
											<img src="/{{ $extra->image_path }}" class="img-responsive" alt="mirza-ghasemi">
										</a>
									@endif
									<div class="caption">
										<h3 style="cursor:help;" title="{{ $extra->description }}" data-toggle="tooltip"
										    data-placement="top">{{ $extra->title }}</h3>
										£ {{ number_format($extra->price / 100 , 2) }}
										<a id="addToCart" href="{{ route('add.to.cart', $extra) }}"
										   class="btn btn-sm btn-success btn-raised pull-right">
											<i class="fa fa-plus fa-lg"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="clearfix"></div>
					<h2>Juice</h2>
					<div class="row">
						@foreach ($juices as $juice)
							<div class="col-xs-4">
								<div class="thumbnail">
									@if ($juice->image_path)
										<a href="/{{ $juice->image_path }}" data-lity>
											<img src="/{{ $juice->image_path }}" class="img-responsive" alt="mirza-ghasemi">
										</a>
									@endif
									<div class="caption">
										<h3 style="cursor:help;" title="{{ $juice->description }}" data-toggle="tooltip"
										    data-placement="top">{{ $juice->title }}</h3>
										£ {{ number_format($juice->price / 100 , 2) }}
										<a id="addToCart" href="{{ route('add.to.cart', $juice) }}"
										   class="btn btn-sm btn-success btn-raised pull-right">
											<i class="fa fa-plus fa-lg"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="clearfix"></div>
					<h2>Desserts</h2>
					<div class="row">
						@foreach ($desserts as $dessert)
							<div class="col-xs-4">
								<div class="thumbnail">
									@if ($dessert->image_path)
										<a href="/{{ $dessert->image_path }}" data-lity>
											<img src="/{{ $dessert->image_path }}" class="img-responsive" alt="mirza-ghasemi">
										</a>
									@endif
									<div class="caption">
										<h3 style="cursor:help;" title="{{ $dessert->description }}" data-toggle="tooltip"
										    data-placement="top">{{ $dessert->title }}</h3>
										£ {{ number_format($dessert->price / 100 , 2) }}
										<a id="addToCart" href="{{ route('add.to.cart', $dessert) }}"
										   class="btn btn-sm btn-success btn-raised pull-right">
											<i class="fa fa-plus fa-lg"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>

					<div class="clearfix"></div>
					<p class="lead pull-right">We Serve Shisha</p>

				</div>
			</article>
			<aside class="col-md-4">
				@include('partials.cart')
				<div class="clearfix"></div>
				<h2 class="text-warning">Beverages</h2>
				<ul class="list-unstyled" style="line-height: 2em;">
					@foreach ($beverages as $beverage)
						<li>
							<span class="text-warning">{{ $beverage->title }}</span>
							<span class="text-right pull-right text-warning">
								£ {{ number_format($beverage->price / 100 , 2) }} &nbsp;
								<a id="addToCart" href="{{ route('add.to.cart', $beverage) }}"
								   class="btn btn-xs btn-success btn-raised">
									<i class="fa fa-plus fa-lg"></i>
								</a>
							</span>
						</li>
					@endforeach
				</ul>
			</aside>
		</main>
	</header>
@stop