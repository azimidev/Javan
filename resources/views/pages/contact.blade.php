@extends('layouts.app')
@section('title', 'Contact Us - Javan Restaurant London')
@section('content')
	<div class="header">
		<div>
			<div class="info">
				<style scoped>
					.info {
						position         : absolute;
						top              : 150px;
						right            : 50px;
						background-color : rgba(0, 0, 0, .5);
						padding          : 10px;
						border-radius    : 4px;
						color            : white;
					}
				</style>
				<address>
					<strong class="lead text-bright">Javan Restaurant</strong> <br>
					291-293 King Street <br>
					Hammersmith <br>
					London
				</address>

				<address>
					<strong>Phone</strong> <br>
					<a class="lead text-bright" href="tel:02085638553">020 8563 8553</a> <br>
				</address>

				<address>
					<strong>Opening Hours</strong> <br>
					Monday to Sunday 12:00 - 23:00
				</address>
			</div>
			<iframe width="100%" height="500" frameborder="0"
			        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJm0npDkoOdkgR65Z2_pEgI3Y&key={{ config('services.google.key') }}"
			        allowfullscreen>
			</iframe>
		</div>
	</div>
@endsection
