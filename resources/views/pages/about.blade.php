@extends('layouts.app')
@section('title', 'About Us - Javan Restaurant London')
@section('content')
	<div class="header header-filter"
	     style="background-image: url('/images/background/background-2.jpg'); background-size: cover; height : 350px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="brand">
						<h1>Javan Restaurant</h1>
						<h3>About Us</h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<main class="container main main-raised">
		<article>
			<div class="col-sm-8">
				<article>
					<h1 class="hidden-xs">Why you should try our cuisine ?</h1>
					<h3 class="visible-xs">Why you should try our cuisine ?</h3>
					<p>Javan Restaurant is a Persian cuisine restaurant in a great location in King Street, West London. We serve
						top quality meals. This restaurant established with the aim of familiarising people within this area with
						Persian Cuisine.</p>
					<p>We recently changed the management, name, quality of food our staff and especially our head chef. Our head
						chef is one of the best chefs in Iranian communities with many years experience in working for top Persian
						restaurants in London. We now do food delivery to your home.</p>
					<h2 class="hidden-xs">We have space for your events</h2>
					<h4 class="visible-xs">We have space for your events</h4>
					<p>We have a bar floor downstairs of restaurant where you can book for your events such as parties, birthday
						parties, christmas celebrations, weddings, grauation parties, goodbye parties and so on</p>
					<p>We serve the best quality foods. We use finest baby lamb fillets, poussins, chickens and ingredients.
						Unlike previous management, there is no service charge included anymore and gratuity is at your discretion.
						Come visit us, call us, experience and enjoy the best Persian cuisine in West London.</p>
					<p>There is the panorama of restaurants interior as well as exterior. You are free to make it full screen and
						inteact with it. </p>
					<iframe width="100%" height="600" frameborder="0" style="border:0" allowfullscreen
					        src="https://www.google.com/maps/embed/v1/streetview?location=51.4933%2C-0.2397&key={{ env('GOOGLE_API_KEY') }}"></iframe>

				</article>
			</div>
		</article>
		<aside>
			<div class="col-sm-4">
				<a href="/images/restaurant/javan-day-right.JPG" data-lity>
					<img src="/images/restaurant/tn-javan-day-right.JPG"
					     class="pull-right img-space img-rounded img-raised img-responsive"
					     alt="javan Restaurant"></a>
				<a href="/images/restaurant/javan-night-left.JPG" data-lity>
					<img src="/images/restaurant/tn-javan-night-left.JPG"
					     class="pull-right img-space img-rounded img-raised img-responsive"
					     alt="javan Restaurant"></a>
				<a href="/images/restaurant/javan-day-left.JPG" data-lity>
					<img src="/images/restaurant/tn-javan-day-left.JPG"
					     class="pull-right img-space img-rounded img-raised img-responsive"
					     alt="javan Restaurant"></a>
				<a href="/images/restaurant/javan-day.JPG" data-lity>
					<img src="/images/restaurant/tn-javan-day.JPG"
					     class="pull-right img-space img-rounded img-raised img-responsive"
					     alt="javan Restaurant"></a>
				<a href="/images/restaurant/javan-night.JPG" data-lity>
					<img src="/images/restaurant/tn-javan-night.JPG"
					     class="pull-right img-space img-rounded img-raised img-responsive"
					     alt="javan Restaurant"></a>
			</div>
		</aside>
	</main>
@endsection
