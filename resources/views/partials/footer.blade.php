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
				<a href="https://www.facebook.com/JavanLondonLtd" class="btn-link" target="_blank">
					<i class="fa fa-facebook-square fa-fw fa-3x"></i>
				</a>
				<a href="https://www.instagram.com/javan_persian/" class="text-warning" target="_blank">
					<i class="fa fa-instagram fa-fw fa-3x"></i>
				</a>
				<a href="https://twitter.com/JavanLondon" class="text-info" target="_blank">
					<i class="fa fa-twitter-square fa-fw fa-3x"></i>
				</a>
				<a href="https://plus.google.com/b/107724180985175918891/" class="text-danger" target="_blank">
					<i class="fa fa-google-plus-square fa-fw fa-3x"></i>
				</a>
			</div>
		</nav>
	</div>
</footer>
