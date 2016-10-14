@extends('layouts.app')

@section('content')
	<main class="container main">
		@include('partials.carousel')
		<article>
			<div class="col-md-8">
				<a href="{{ route('menu') }}" class="btn btn-success btn-raised btn-round btn-lg btn-block">
					Order Food Online
				</a>
				<h2 class="hidden-xs">Reservation</h2>
				<h3 class="visible-xs">Reservation</h3>
				@include('partials.yelp-reservation')
				<p class="text-justify">
					We value and love our customers and would like to welcome you and surprise you every time you visit us in your
					restaurant. We have online table reservation available online or over the phone:
					<a href="tel:02085638553" class="btn-link" target="_blank">02085638553</a> <br>
					<a href="{{ auth()->check() ? route('member.bookings') : route('create.reservation') }}"
					   class="btn btn-info btn-raised">
						Reserve Table Online
					</a>
				</p>
				<h2 class="hidden-xs">Delivery</h2>
				<h3 class="visible-xs">Delivery</h3>
				<p class="text-justify">
					Ae are trying to setup our food delivery system for you to be able to order directly from our website.
				</p>
				<p class="text-justify">
					If you order food delivery by phone or with this website, <span class="underline">all delivery fees are
						separate from the total food cost</span> and we deliver food only within London. <br>
					<a href="{{ url('menu') }}" class="btn btn-success btn-raised">
						Order Food Delivery
					</a>
				</p>
				<h2 class="hidden-xs">Opening Hours</h2>
				<h3 class="hidden-xs">Opening Hours</h3>
				<p class="text-justify">
					We are open <b>everyday</b> from <b>12:00</b> ro <b>23:00</b>
				</p>
				<h2 class="hidden-xs">Contact Number</h2>
				<h3 class="visible-xs">Contact Number</h3>
				<p class="text-justify">
					020 8563 8553
				</p>
			</div>
		</article>
		<aside>
			<div class="col-md-4">
				<div class="card card-nav-tabs card-plain">
					<div class="header header-primary">
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<ul class="nav nav-tabs" data-tabs="tabs">
									<li class="active">
										<a href="#instagram" data-toggle="tab">
											<i class="fa fa-instagram fa-2x fa-fw"></i>
										</a>
									</li>
									<li>
										<a href="#tweets" data-toggle="tab">
											<i class="fa fa-twitter fa-2x fa-fw"></i>
										</a>
									</li>
									<li>
										<a href="#facebook" data-toggle="tab">
											<i class="fa fa-facebook fa-2x fa-fw"></i>
										</a>
									</li>
									<li>
										<a href="#google" data-toggle="tab">
											<i class="fa fa-google-plus fa-2x fa-fw"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="tab-content text-center">
							<div class="tab-pane active" id="instagram">
								@foreach (array_chunk($images, 2) as $row)
									<div class="row">
										@foreach ($row as $image)
											<div class="col-sm-6 col-xs-12">
												<a href="{{ $image['images']['standard_resolution']['url'] }}" data-lity>
													<img class=" img-space img-rounded img-raised"
													     src="{{ $image['images']['thumbnail']['url'] }}"
													     alt="{{ $image['link'] }}">
												</a>
											</div>
										@endforeach
									</div>
								@endforeach
							</div>
							<div class="tab-pane" id="tweets">
								@include('partials.twitter')
							</div>
							<div class="tab-pane" id="facebook">
								@include('partials.facebook')
							</div>
							<div class="tab-pane" id="google">
								@include('partials.google+')
							</div>
						</div>
					</div>
				</div>
			</div>
		</aside>
	</main>
@endsection

