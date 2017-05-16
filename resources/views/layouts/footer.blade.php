<footer class="footer">
	<div class="container">
		<nav class="navbar-left">
			<ul>
				<li>
					<a href="{{ url('/about') }}">
						About Us
					</a>
				</li>
				<li>
					<a href="{{ url('/menu') }}">
						Menu
					</a>
				</li>
				<li>
					<a href="{{ url('/contact') }}">
						Contact
					</a>
				</li>
				<li>
					<a href="{{ url('/blog') }}">
						Blog
					</a>
				</li>
				<li>
					<a href="{{ url('/information') }}">
						Terms & Conditions
					</a>
				</li>
				<li>
					<a href="{{ url('/feed') }}">
						RSS
					</a>
				</li>
			</ul>
			<ul class="hidden-xs">
				<li>
					<i title="Visa" class="fa fa-cc-visa fa-fw fa-3x"></i>
				</li>
				<li>
					<i title="Master Card" class="fa fa-cc-mastercard fa-fw fa-3x"></i>
				</li>
				<li>
					<i title="Discover" class="fa fa-cc-discover fa-fw fa-3x"></i>
				</li>
				<li>
					<i title="American Express" class="fa fa-cc-jcb fa-fw fa-3x"></i>
				</li>
				<li>
					<i title="Stripe" class="fa fa-cc-stripe fa-fw fa-3x"></i>
				</li>
				<li>
					<i title="PayPal" class="fa fa-cc-paypal fa-fw fa-3x"></i>
				</li>
			</ul>
			<br>
			<a target="_blank" href="{{ route('uber') }}">
				<img src="/images/UberEats-logo.png" alt="UberEats-logo" width="25%">
			</a>
			&nbsp;&nbsp;&nbsp;
			<a target="_blank" href="{{ route('deliveroo') }}">
				<img src="/images/Deliveroo-logo.png" alt="Deliveroo-logo" width="25%">
			</a>
			{{--<p>&copy; {{ date('Y') }} Javan Restaurant London</p>--}}
		</nav>
		<nav class="copyright navbar-right">
			<div>
				<a href="//www.facebook.com/JavanLondonLtd" class="btn-link" target="_blank" title="Facebook">
					<i class="fa fa-facebook-square fa-fw fa-3x"></i>
				</a>
				<a href="//www.instagram.com/javan_persian/" class="text-warning" target="_blank" title="Instagram">
					<i class="fa fa-instagram fa-fw fa-3x"></i>
				</a>
				<a href="//twitter.com/JavanLondon" class="text-info" target="_blank" title="Twitter">
					<i class="fa fa-twitter-square fa-fw fa-3x"></i>
				</a>
				<a href="//plus.google.com/107724180985175918891" class="text-danger" target="_blank"
				   title="Google Plus">
					<i class="fa fa-google-plus-square fa-fw fa-3x"></i>
				</a>
				<a href="//www.tripadvisor.co.uk/Restaurant_Review-g186338-d10515099-Reviews-Javan_Restaurant-London_England.html-m24177"
				   class="text-success" target="_blank" title="Trip Advisor">
					<span class="fa-stack fa-lg" style="height: 3.5em; width: 2.7em;">
					  <i class="fa fa-square fa-stack-2x" style="font-size: 2.3em;"></i>
					  <i class="fa fa-tripadvisor fa-stack-1x" style="color: #000; font-size: 1.3em;	line-height: 1.7em;"></i>
					</span>
				</a>
				<a href="javascript:void(0)" class="text-bright" target="_blank" title="Free Wi-Fi">
					<span class="fa-stack fa-lg" style="height: 3.5em; width: 2.7em;">
					  <i class="fa fa-square fa-stack-2x" style="font-size: 2.3em;"></i>
					  <i class="fa fa-wifi fa-stack-1x" style="color: #000; font-size: 1.3em;	line-height: 1.8em;"></i>
					</span>
				</a>
			</div>
			{{--@include('partials.news')--}}
		</nav>
	</div>

</footer>
