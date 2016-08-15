@extends('layouts.app')

@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/menu-background.png');">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Cart is updated'])
			<h1 class="text-warning">The Menu</h1>
			<p class="text-warning">If you'd like to see the food details, download the PDF version of menu :
				<a class="btn btn-sm btn-warning" href="/images/menu/Javan-Restaurant-Menu.pdf" target="_blank"
				   title="Javan Restaurant Menu">please click here</a>
			</p>
			<article class="col-md-7 col-md-offset-1">
				@unless (javan_is_open())
					<div class="alert alert-danger">
						<div class="alert-icon"><i class="material-icons">error</i></div>
						We are closed now and cannot accept orders unless you want specific delivery time between 13:00 - 23:00
					</div>
				@endunless
				<div class="brand menu">
					<h3>Appetizers</h3>
					<div class="row">
						<div class="col-sm-9">
							<ul class="list-unstyled">
								@foreach ($appetizers as $appetizer)
									<li>
										<div class="pull-left">
											{{ $appetizer->title }}
										</div>
										<div class="pull-right">
											£ {{ number_format($appetizer->price / 100 , 2) }} &nbsp;
											<a id="addToCart" href="{{ route('add.to.cart', $appetizer) }}"
											   class="btn btn-xs btn-success btn-round btn-raised">
												<i class="fa fa-plus fa-lg"></i>
											</a>
										</div>
									</li>
									<div class="clearfix"></div>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Main Course</h3>
					<div class="row">
						<div class="col-sm-9">
							<ul class="list-unstyled">
								@foreach ($main_courses as $main_course)
									<li>
										<div class="pull-left">
											{{ $main_course->title }}
										</div>
										<div class="pull-right">
											£ {{ number_format($main_course->price / 100 , 2) }} &nbsp;
											<a id="addToCart" href="{{ route('add.to.cart', $main_course) }}"
											   class="btn btn-xs btn-success btn-round btn-raised">
												<i class="fa fa-plus fa-lg"></i>
											</a>
										</div>
									</li>
									<div class="clearfix"></div>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Sides & Extras</h3>
					<div class="row">
						<div class="col-sm-9">
							<ul class="list-unstyled">
								@foreach ($extras as $extra)
									<li>
										<div class="pull-left">
											{{ $extra->title }}
										</div>
										<div class="pull-right">
											£ {{ number_format($extra->price / 100 , 2) }} &nbsp;
											<a id="addToCart" href="{{ route('add.to.cart', $extra) }}"
											   class="btn btn-xs btn-success btn-round btn-raised">
												<i class="fa fa-plus fa-lg"></i>
											</a>
										</div>
									</li>
									<div class="clearfix"></div>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Beverages</h3>
					<div class="row">
						<div class="col-sm-9">
							<ul class="list-unstyled">
								@foreach ($beverages as $beverage)
									<li>
										<div class="pull-left">
											{{ $beverage->title }}
										</div>
										<div class="pull-right">
											£ {{ number_format($beverage->price / 100 , 2) }} &nbsp;
											<a id="addToCart" href="{{ route('add.to.cart', $beverage) }}"
											   class="btn btn-xs btn-success btn-round btn-raised">
												<i class="fa fa-plus fa-lg"></i>
											</a>
										</div>
									</li>
									<div class="clearfix"></div>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Juice</h3>
					<div class="row">
						<div class="col-sm-9">
							<ul class="list-unstyled">
								@foreach ($juices as $juice)
									<li>
										<div class="pull-left">
											{{ $juice->title }}
										</div>
										<div class="pull-right">
											£ {{ number_format($juice->price / 100 , 2) }} &nbsp;
											<a id="addToCart" href="{{ route('add.to.cart', $juice) }}"
											   class="btn btn-xs btn-success btn-round btn-raised">
												<i class="fa fa-plus fa-lg"></i>
											</a>
										</div>
									</li>
									<div class="clearfix"></div>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Desserts</h3>
					<div class="row">
						<div class="col-sm-9">
							<ul class="list-unstyled">
								@foreach ($juices as $juice)
									<li>
										<div class="pull-left">
											{{ $juice->title }}
										</div>
										<div class="pull-right">
											£ {{ number_format($juice->price / 100 , 2) }} &nbsp;
											<a id="addToCart" href="{{ route('add.to.cart', $juice) }}"
											   class="btn btn-xs btn-success btn-round btn-raised">
												<i class="fa fa-plus fa-lg"></i>
											</a>
										</div>
									</li>
									<div class="clearfix"></div>
								@endforeach
							</ul>
						</div>
					</div>

					<div class="clearfix"></div>
					<p class="lead pull-right">We Serve Shisha</p>

				</div>
			</article>
			<aside class="col-md-4">
				@include('partials.cart')
				<div class="center">
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/kookoo-sabzi.jpg" data-lity>
								<img src="/images/foods/tn-kookoo-sabzi.jpg" width="100"
								     class="img-raised img-space img-space img-thumbnail img-responsive" alt="kookoo-sabzi">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/ash-reshteh.jpg" data-lity>
								<img src="/images/foods/tn-ash-reshteh.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="ash-reshteh">
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/mirza-ghasemi.jpg" data-lity>
								<img src="/images/foods/tn-mirza-ghasemi.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="mirza-ghasemi">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/hummus.jpg" data-lity>
								<img src="/images/foods/tn-hummus.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="hummus">
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/panirsabzi.jpg" data-lity>
								<img src="/images/foods/tn-panirsabzi.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="panirsabzi">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/salad-olivie.jpg" data-lity>
								<img src="/images/foods/tn-salad-olivie.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="salad-olivie">
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/salad-shirazi.jpg" data-lity>
								<img src="/images/foods/tn-salad-shirazi.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="salad-shirazi">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/mast-o-khiar.jpg" data-lity>
								<img src="/images/foods/tn-mast-o-khiar.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="mast-o-khiar">
							</a>
						</div>
					</div>

					<div class="clearfix"></div>
					<br><br><br>

					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/chelo-kabab.jpg" data-lity>
								<img src="/images/foods/tn-chelo-kabab.jpg" width="100"
								     class="img-raised img-space img-space img-thumbnail img-responsive" alt="chelo-kabab">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/fesenjan.jpg" data-lity>
								<img src="/images/foods/tn-fesenjan.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="fesenjan">
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/gheymeh.jpg" data-lity>
								<img src="/images/foods/tn-gheymeh.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="gheymeh">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/ghormeh-sabzi.jpg" data-lity>
								<img src="/images/foods/tn-ghormeh-sabzi.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive"
								     alt="ghormeh-sabzi">
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/loobia-polo.jpg" data-lity>
								<img src="/images/foods/tn-loobia-polo.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive"
								     alt="loobia-polo">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/shishlik.jpg" data-lity>
								<img src="/images/foods/tn-shishlik.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="shishlik">
							</a>
						</div>
					</div>

					<div class="clearfix"></div>
					<br><br><br>

					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/baklava.jpg" data-lity>
								<img src="/images/foods/tn-baklava.jpg" width="100"
								     class="img-raised img-space img-space img-thumbnail img-responsive" alt="baklava">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/bastani-sonati-zafarani.jpg" data-lity>
								<img src="/images/foods/tn-bastani-sonati-zafarani.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="bastani-sonati-zafarani">
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<a href="/images/foods/faloodeh.jpg" data-lity>
								<img src="/images/foods/tn-faloodeh.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="faloodeh">
							</a>
						</div>
						<div class="col-xs-6">
							<a href="/images/foods/Zoolbia-bamieh.jpg" data-lity>
								<img src="/images/foods/tn-Zoolbia-bamieh.jpg" width="100"
								     class="img-raised img-space img-thumbnail img-responsive" alt="Zoolbia-bamieh">
							</a>
						</div>
					</div>
				</div>
			</aside>
		</main>
	</header>
@stop