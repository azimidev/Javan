@extends('layouts.app')

@section('content')
	<header class="header header-filter"
	        style="background-image: url('/images/menu-background.png');">
		<main class="container">
			<h1 class="text-warning">The Menu</h1>
			<p class="text-warning">If you'd like to see the food details, download the PDF version of menu :
				<a class="btn btn-sm btn-warning" href="/images/menu/Javan-Restaurant-Menu.pdf" target="_blank"
				   title="Javan Restaurant Menu">please click here</a>
			</p>
			<section class="col-sm-8 col-sm-offset-1">
				<div class="brand">
					<h3>Appetizers</h3>
					<div class="row">
						<div class="col-xs-8">
							<ol>
								<li>Naan</li>
								<li>Panir Sabzi</li>
								<li>Mast-o-Khiar</li>
								<li>Mast Mosir</li>
								<li>Hummus</li>
								<li>Torshi Makhlot</li>
								<li>Gherkins Olive</li>
								<li>Salad Shirazi</li>
								<li>Salad Fasl</li>
								<li>Salad Olivieh</li>
								<li>Kookoo Sabzi</li>
								<li>Mirza Ghasemi</li>
								<li>Kashk Bademjan</li>
								<li>Chicken Wings</li>
								<li>Ash Reshteh</li>
								<li>Oat Soup</li>
								<li>Dolma</li>
							</ol>
						</div>
						<div class="col-xs-4">
							<ul class="list-unstyled">
								<li>£ 1.50</li>
								<li>£ 4</li>
								<li>£ 3.95</li>
								<li>£ 3.95</li>
								<li>£ 3.95</li>
								<li>£ 3.50</li>
								<li>£ 3.50</li>
								<li>£ 3.95</li>
								<li>£ 4</li>
								<li>£ 3.95</li>
								<li>£ 5</li>
								<li>£ 4</li>
								<li>£ 4</li>
								<li>£ 5</li>
								<li>£ 5</li>
								<li>£ 5</li>
								<li>£ 5</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Main Course</h3>
					<div class="row">
						<div class="col-xs-8">
							<ol start="18">
								<li>Koobideh & Bread</li>
								<li>Chelo Koobideh</li>
								<li>Chelo Barg</li>
								<li>Chelo Chenjeh</li>
								<li>Soltani Makhsoos</li>
								<li>Chenjeh Koobideh</li>
								<li>Momtaz</li>
								<li>Chelo Joojeh (Boneless)</li>
								<li>Chelo Joojeh</li>
								<li>Shishlik (Lamb Chops)</li>
								<li>Mixed Grill</li>
								<li>Loobia Polo</li>
								<li>Chelo Mahi</li>
								<li>Zereshk Polo Ba Morgh</li>
								<li>Baghali Polo Ba Mahicheh</li>
								<li>Chelo Khoresh Gheymeh</li>
								<li>Chelo Khoresh Bademjan | Gheymeh Bademjan</li>
								<li>Chelo Khoresh Ghormeh Sabzi</li>
								<li>Chelo Khoresh Fesenjan</li>
								<li>Chelo Khoresh Bamieh</li>
							</ol>
						</div>
						<div class="col-xs-4">
							<ul class="list-unstyled">
								<li>£ 9</li>
								<li>£ 9</li>
								<li>£ 12</li>
								<li>£ 12</li>
								<li>£ 14</li>
								<li>£ 14</li>
								<li>£ 14</li>
								<li>£ 10</li>
								<li>£ 10</li>
								<li>£ 12</li>
								<li>£ 25</li>
								<li>£ 10</li>
								<li>£ 15</li>
								<li>£ 10</li>
								<li>£ 12</li>
								<li>£ 10</li>
								<li>£ 10</li>
								<li>£ 10</li>
								<li>£ 12</li>
								<li>£ 10</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Sides & Extras</h3>
					<div class="row">
						<div class="col-xs-8">
							<ol start="38">
								<li>Tahdig</li>
								<li>Rice Portion</li>
								<li>Zereshk</li>
								<li>Grilled Tomato</li>
								<li>Grilled Onion</li>
							</ol>
						</div>
						<div class="col-xs-4">
							<ul class="list-unstyled">
								<li>£ 5</li>
								<li>£ 3</li>
								<li>£ 3</li>
								<li>£ 3</li>
								<li>£ 3</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Beverages</h3>
					<div class="row">
						<div class="col-xs-8">
							<ul class="list-unstyled" style="margin-left: 1.5em;">
								<li>Coke</li>
								<li>Diet Coke</li>
								<li>Pepsi</li>
								<li>Fanta</li>
								<li>7up</li>
								<li>Glass of Dough</li>
								<li>Jug of Dough</li>
							</ul>
						</div>
						<div class="col-xs-4">
							<ul class="list-unstyled">
								<li>£ 1</li>
								<li>£ 1</li>
								<li>£ 1</li>
								<li>£ 1</li>
								<li>£ 1</li>
								<li>£ 1.50</li>
								<li>£ 4.50</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Juice</h3>
					<div class="row">
						<div class="col-xs-8">
							<ul class="list-unstyled" style="margin-left: 1.5em;">
								<li>Orange Juice</li>
								<li>Apple Juice</li>
								<li>Grapefruit Juice</li>
							</ul>
						</div>
						<div class="col-xs-4">
							<ul class="list-unstyled">
								<li>£ 3</li>
								<li>£ 2</li>
								<li>£ 3</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
					<h3>Desserts</h3>
					<div class="row">
						<div class="col-xs-8">
							<ul class="list-unstyled" style="margin-left: 1.5em;">
								<li>Zulbia Bamieh</li>
								<li>Faloodeh</li>
								<li>Zaffron Ice Cream</li>
								<li>Faloodeh Ice Cream Mixed</li>
								<li>Baklava</li>
							</ul>
						</div>
						<div class="col-xs-4">
							<ul class="list-unstyled">
								<li>£ 3</li>
								<li>£ 3</li>
								<li>£ 3</li>
								<li>£ 3</li>
								<li>£ 3</li>
							</ul>
						</div>
					</div>

					<div class="clearfix"></div>
					<p class="lead pull-right">We Serve Shisha</p>

				</div>
			</section>
			<section class="col-sm-3 hidden-xs">
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/kookoo-sabzi.jpg" data-lity>
							<img src="/images/foods/tn-kookoo-sabzi.jpg" width="100"
							     class="img-raised img-space img-space img-thumbnail img-responsive" alt="kookoo-sabzi">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/ash-reshteh.jpg" data-lity>
							<img src="/images/foods/tn-ash-reshteh.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive"
							     alt="ash-reshteh">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/mirza-ghasemi.jpg" data-lity>
							<img src="/images/foods/tn-mirza-ghasemi.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="mirza-ghasemi">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/hummus.jpg" data-lity>
							<img src="/images/foods/tn-hummus.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive"
							     alt="hummus">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/panirsabzi.jpg" data-lity>
							<img src="/images/foods/tn-panirsabzi.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive"
							     alt="panirsabzi">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/salad-olivie.jpg" data-lity>
							<img src="/images/foods/tn-salad-olivie.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="salad-olivie">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/salad-shirazi.jpg" data-lity>
							<img src="/images/foods/tn-salad-shirazi.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="salad-shirazi">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/mast-o-khiar.jpg" data-lity>
							<img src="/images/foods/tn-mast-o-khiar.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="mast-o-khiar">
						</a>
					</div>
				</div>

				<div class="clearfix"></div>
				<br><br><br>

				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/chelo-kabab.jpg" data-lity>
							<img src="/images/foods/tn-chelo-kabab.jpg" width="100"
							     class="img-raised img-space img-space img-thumbnail img-responsive" alt="chelo-kabab">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/fesenjan.jpg" data-lity>
							<img src="/images/foods/tn-fesenjan.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive"
							     alt="fesenjan">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/gheymeh.jpg" data-lity>
							<img src="/images/foods/tn-gheymeh.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="gheymeh">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/ghormeh-sabzi.jpg" data-lity>
							<img src="/images/foods/tn-ghormeh-sabzi.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive"
							     alt="ghormeh-sabzi">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/loobia-polo.jpg" data-lity>
							<img src="/images/foods/tn-loobia-polo.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive"
							     alt="loobia-polo">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/shishlik.jpg" data-lity>
							<img src="/images/foods/tn-shishlik.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="shishlik">
						</a>
					</div>
				</div>

				<div class="clearfix"></div>
				<br><br><br>

				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/baklava.jpg" data-lity>
							<img src="/images/foods/tn-baklava.jpg" width="100"
							     class="img-raised img-space img-space img-thumbnail img-responsive" alt="baklava">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/bastani-sonati-zafarani.jpg" data-lity>
							<img src="/images/foods/tn-bastani-sonati-zafarani.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="bastani-sonati-zafarani">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/foods/faloodeh.jpg" data-lity>
							<img src="/images/foods/tn-faloodeh.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="faloodeh">
						</a>
					</div>
					<div class="col-sm-6">
						<a href="/images/foods/Zoolbia-bamieh.jpg" data-lity>
							<img src="/images/foods/tn-Zoolbia-bamieh.jpg" width="100"
							     class="img-raised img-space img-thumbnail img-responsive" alt="Zoolbia-bamieh">
						</a>
					</div>
				</div>

			</section>
		</main>
	</header>
@stop