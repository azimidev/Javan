<footer class="footer">
	<div class="container">
		<nav class="pull-left">
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
			</ul>
			<div class="clearfix hidden-xs">
				@include('partials.google+')
			</div>
		</nav>
		<nav class="copyright pull-right">
			&copy; {{ date('Y') }} Javan Restaurant
			<div class="clearfix">
				<a href="https://www.facebook.com/JavanLondonLtd" class="btn-link" target="_blank" title="Facebook">
					<i class="fa fa-facebook-square fa-fw fa-3x"></i>
				</a>
				<a href="https://www.instagram.com/javan_persian/" class="text-warning" target="_blank" title="Instagram">
					<i class="fa fa-instagram fa-fw fa-3x"></i>
				</a>
				<a href="https://twitter.com/JavanLondon" class="text-info" target="_blank" title="Twitter">
					<i class="fa fa-twitter-square fa-fw fa-3x"></i>
				</a>
				<a href="https://plus.google.com/b/107724180985175918891/" class="text-danger" target="_blank"
				   title="Google Plus">
					<i class="fa fa-google-plus-square fa-fw fa-3x"></i>
				</a>
				<a href="https://www.tripadvisor.co.uk/Restaurant_Review-g186338-d10515099-Reviews-Javan_Restaurant-London_England.html-m24177"
				   class="text-success" target="_blank" title="Trip Advisor">
					<span class="fa-stack fa-lg" style="height: 3.5em; width: 2.7em;">
					  <i class="fa fa-square fa-stack-2x" style="font-size: 2.3em;"></i>
					  <i class="fa fa-tripadvisor fa-stack-1x" style="color: #000; font-size: 1.3em;	line-height: 1.7em;"></i>
					</span>
				</a>
			</div>
		</nav>
	</div>
</footer>
