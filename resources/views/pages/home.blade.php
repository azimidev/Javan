@extends('layouts.app')

@section('content')
	<main class="container main">
		@include('partials.carousel')
		<article>
			<div class="col-md-8">
				<h1>Welcome to Javan Restaurant's Page</h1>
				<h2>Reservation</h2>
				<p class="text-justify">
					We value and love our customers and would like to welcome you and surprise you every time you visit us in your
					restaurant. We have online table reservation available online or over the phone:
					<a href="tel:02085638553" class="btn-link" target="_blank">02085638553</a> <br>
					<a href="{{ route('member.bookings') }}" class="btn btn-info btn-raised">
						Reserve Tabel Online
					</a>
				</p>
				<h2>Delivery</h2>
				<p class="text-justify">
					Ae are trying to setup our food delivery system for you to be able to order directly from our website. We also
					have our <a href="#" class="btn-link">Deliveroo</a> system where you can order from.
				</p>
				<p class="text-justify">
					If you order food delivery by phone or with this website, <span class="underline">all delivery fees are
						separate from the total food cost</span> and we deliver food within London. <br>
					<a href="/images/files/Javan-Terms-and-Conditions.pdf" class="btn btn-success btn-raised" target="_blank">
						Order Food Delivery
					</a>
				</p>
				<h2>Private Dining and Party</h2>
				<p class="text-justify">
					We also have space for large birthday events, celebrations and christmas parties and other events available.
					However to book down floor for these large events we invite you to kindly call us or visit us to read the
					terms and conditions. You may want to read these terms and conditions online below or use our
					<a href="{{ url('/contact') }}" class="btn-link">contact page</a> to ask any questions you may have. <br>
					<a href="/images/files/Javan-Terms-and-Conditions.pdf" class="btn btn-danger btn-raised" target="_blank">
						Terms & Conditions
					</a>
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
								@foreach ($images as $image)
									<div class="col-xs-6">
										<a href="{{ $image['images']['standard_resolution']['url'] }}" data-lity>
											<img class=" img-space img-rounded img-raised"
											     src="{{ $image['images']['thumbnail']['url'] }}"
											     alt="{{ $image['link'] }}">
										</a>
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
