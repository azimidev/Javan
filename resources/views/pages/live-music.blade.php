@extends('layouts.app')
@section('title', 'Persian Live Music London - Javan Restaurant London')
@section('content')
	<header class="header header-filter"
	        style="background: url('/images/background/background-5.jpg') repeat;">
		<main class="container">
			@include('partials.notify-alert', ['data' => 'Seat Updated'])
			<h1 class="text-bright"><i class="fa fa-calendar fa-fw"></i> The Live Music Events</h1>

			<article class="col-md-8">

				<div class="row">
					@foreach ($events as $event)
						<div class="col-xs-12">
							<div class="thumbnail">
								<div class="caption center">
									<h1 class="hidden-xs" title="{{ $event->name }}" itemprop="name">{{ $event->name }}</h1>
									<h3>{{ $event->start->format('l jS F h:i A') }}</h3>
									<h3 class="text-primary" itemprop="price">£ {{ number_format($event->price / 100 , 2) }}
										<small>Per Person</small>
									</h3>
									@if ($event->seatsRemaining())
										<h3 class="text-danger">
											{{ $event->seatsRemaining() }}
											{{ str_plural('seat', $event->seatsRemaining()) }} Remaining
										</h3>
										<form action="{{ route('add.event.to.cart', $event) }}"
										      method="GET" class="form-inline">
											<div class="form-group">
												<div class="input-group">
													<label for="qty">How many seats would you like ?</label>
													<input type="number" class="form-control" id="qty" placeholder="Enter how many seats here"
													       name="qty"
													       min="0" max="{{ $event->seatsRemaining() }}" required>
													<span class="input-group-btn">
													<button type="submit" class="btn btn-success btn-raised">
														<i class="fa fa-plus fa-fw fa-lg"></i>
													</button>
													</span>
												</div>
											</div>
										</form>
									@else
										<h3 class="text-danger">
											No Seats Remaining
										</h3>
										<a href="javascript:void(0)" class="btn btn-danger btn-block btn-lg btn-raised disabled">Fully
											Booked !</a>
									@endif
									<p>{{ nl2br($event->description) }}</p>
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

			</article>
			<aside class="col-md-4">
			@include('partials.event-cart')

			<!-- Private Party Terms & Condition -->

				<div class="panel panel-default">
					<div class="panel-body">

						<img src="/images/restaurant/Javan_in_and_out.png" alt="Javan Restaurant Interior and Exterior"
						     width="100%">

						<h2><i class="fa fa-info fa-fw"></i> Private Parties Information</h2>
						<dl class="dl-horizontal">
							<dt>Location:</dt>
							<dd>Down Floor</dd>
							<dt>What's Included:</dt>
							<dd>Mixed Grilled</dd>
							<dd>Starter</dd>
							<dd>Soft Drink</dd>
						</dl>
						<h2><i class="fa fa-info fa-fw"></i> Before You Book</h2>
						<p>Please view and download the terms and conditions below to clear up everything before booking:</p>
						<a class="btn btn-raised btn-primary" href="/images/files/Javan-Terms-and-Conditions.pdf" target="_blank">Terms
							& Conditions (PDF)</a>
					</div>
				</div>
			</aside>
		</main>
	</header>
@stop