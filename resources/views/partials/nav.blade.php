<nav class="navbar" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">

			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="{{ url('/') }}">
				Javan Restaurant
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				<li class="{{ active('about') }}"><a href="{{ url('/about') }}">About</a></li>
				<li class="{{ active('menu') }}"><a href="{{ url('/menu') }}">Menu</a></li>
				@if (auth()->guest())
					<li class="{{ active('guest/reservation') }}"><a href="{{ route('create.reservation') }}">Reservation</a></li>
				@else
					<li class="{{ active('member/bookings') }}"><a href="{{ route('member.bookings') }}">Reservation</a></li>
				@endif
				<li class="{{ active('contact') }}"><a href="{{ url('/contact') }}">Contact</a></li>
				<li class="{{ active('blog') }}"><a href="{{ route('blog') }}">Blog</a></li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (auth()->guest())
					<li class="{{ active('login') }}"><a href="{{ url('/login') }}">Login</a></li>
					<li class="{{ active('register') }}"><a href="{{ url('/register') }}">Register</a></li>
				@else
					<li class="{{ active('cart/create') }}"><a href="{{ route('cart.create') }}"><i class="fa fa-shopping-cart"></i> Cart</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ auth()->user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('member.show') }}">
									<i class="fa fa-user fa-fw"></i> Profile
								</a></li>
							@can ('member', auth()->user())
								<li><a href="{{ route('member.bookings') }}">
										<i class="fa fa-calendar fa-fw"></i> Your Booking
									</a></li>
								<li><a href="{{ route('member.orders') }}">
										<i class="fa fa-cutlery fa-fw"></i> Your Orders
									</a></li>
							@endcan
							@can ('admin_manager', auth()->user())
								<li class="divider"></li>
								<li>
									<a href="{{ route('reservations.index') }}">
										<i class="fa fa-calendar fa-fw"></i> Manage Bookings
									</a>
								</li>
								<li><a href="{{ url('#') }}">
										<i class="fa fa-btn fa-cutlery fa-fw"></i> Manage Take Aways
									</a></li>
								<li><a href="{{ route('post.index') }}">
										<i class="fa fa-newspaper-o fa-fw"></i> Manage Blog
									</a></li>
							@endcan
							@can ('admin', auth()->user())
								<li class="divider"></li>
								<li><a href="{{ route('user.index') }}">Manage Members</a></li>
								<li><a href="{{ route('manager.index') }}">Manage Managers</a></li>
								<li><a href="{{ route('admin.index') }}">Manage Admins</a></li>
								<li><a href="{{ route('products.index') }}">Manage Products</a></li>
							@endcan
							<li class="divider"></li>
							<li><a href="{{ url('/logout') }}"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>

