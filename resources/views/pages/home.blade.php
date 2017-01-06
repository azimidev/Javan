@extends('layouts.app')

@section('content')
	<main class="container main">
		@include('partials.carousel')
		<article>
			<div class="col-md-8">
				<a href="{{ route('menu') }}" class="btn btn-inverse btn-raised btn-round btn-lg btn-block text-bright">
					Order Food Online
				</a>
				<a href="{{ auth()->check() ? route('member.reservations') : route('create.reservation') }}"
				   class="btn btn-inverse btn-raised btn-round btn-lg btn-block text-bright">
					Reserve Table Online
				</a>

				<br><br>

				<div class="clearfix"></div>

				<h1>Our Live Music Events</h1>

				<div class="row">
					@foreach ($events as $event)
						<div class="col-xs-12">
							<div class="thumbnail">
								<div class="caption center">
									<h2 class="hidden-xs" title="{{ $event->name }}" itemprop="name">{{ $event->name }}</h2>
									<h3>{{ $event->start->format('l jS F h:i A') }}</h3>
									<h3 class="text-primary" itemprop="price">£ {{ number_format($event->price / 100 , 2) }}
										<small>Per Person</small>
									</h3>
									@if ($event->seatsRemaining() > 0)
										<h3 class="text-danger">
											{{ $event->seatsRemaining() }} {{ str_plural('seat', $event->seatsRemaining()) }} Remaining
										</h3>
										<a href="{{ url('persian-live-music') }}"
										   class="btn btn-success btn-block btn-lg btn-raised">Book Now !</a>
									@else
										<h3 class="text-danger">
											No Seats Remaining
										</h3>
										<a href="javascript:void(0)" class="btn btn-danger btn-block btn-lg btn-raised disabled">Fully
											Booked !</a>
									@endif
									<h3>End Date: {{ $event->finish->format('l jS F h:i A') }}</h3>
									<h3>Capacity : {{ $event->capacity }}</h3>
								</div>
								@if ($event->image_path)
									<a href="/{{ $event->image_path }}" data-lity>
										<img src="/{{ $event->image_path }}" class="img-responsive" alt="mirza-ghasemi">
									</a>
								@endif
							</div>
						</div>
					@endforeach
				</div>

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
													<img class=" img-space img-thumbnail img-raised"
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
				<p class="bbcnassim text-danger center lead" dir="rtl">بهترین کیفیت غذای ایرانی</p>
				<p class="bbcnassim text-danger center lead" dir="rtl">قضاوت به عهده شما</p>
			</div>
		</aside>
	</main>
@endsection

