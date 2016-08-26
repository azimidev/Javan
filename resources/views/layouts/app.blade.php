<!DOCTYPE html>
<html lang="en">
<head>
	{{--<meta http-equiv="refresh" content="300">--}}
	<title>@yield('title', 'Javan Persian Restaurant London')</title>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="description" content="Authentic Persian Cuisine Licenced Restaurant in West London, Hammersmith, Chiswick With Live Music on Weekends and Great Traditional Interior Design and Shisha"/>
	<meta name="keywords" content="Persian, Restaurant, London, Chelo, Kabab, Iranian, Cuisine, Take-Aways, Naan, Delivery, Hammersmith, Chiswick"/>
	<meta name="copyright" content="javan-restaurant.co.uk">
	<meta name="author" content="Javan Restaurant London"/>
	<meta name="application-name" content="Javan Restaurant London"/>
	<!--GEO Tags-->
	<meta name="geo.region" content="GB-HMF"/>
	<meta name="geo.placename" content="London"/>
	<meta name="geo.position" content="51.5;-0.2"/>
	<meta name="ICBM" content="51.5, -0.2"/>
	<!--Facebook Tags-->
	<meta property="og:url" content="{{ request()->fullUrl() }}"/>
	<meta property="og:title" content="Javan Restaurant"/>
	<meta property="og:type" content="article"/>
	<meta property="og:image" content="{{ request()->root() }}/images/Javan-Facebook-Logo.png"/>
	<meta property="article:author" content="https://www.facebook.com/JavanLondonLtd"/>
	<meta property="og:locale" content="en_UK"/>
	<meta property="og:description" content="Authentic Persian Cuisine Licenced Restaurant in West London, Hammersmith, Chiswick With Live Music on Weekends and Great Traditional Interior Design and Shisha"/>
	<!--Twitter Tags-->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:title" content="Javan Restaurant"/>
	<meta name="twitter:description" content="Authentic Persian Cuisine Licenced Restaurant in West London, Hammersmith, Chiswick With Live Music on Weekends and Great Traditional Interior Design and Shisha"/>
	<meta name="twitter:image" content="{{ request()->root() }}/images/Javan-Twitter-Logo.png"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ elixir('css/app.css') }}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="/images/favicon.png">
</head>
<body id="app-layout">
@include('partials.nav')
@include('partials.errors')
@yield('content')
{{--@include('partials.modal')--}}
@include('partials.footer')
<script src="https://use.fontawesome.com/ed7ef479e3.js"></script>
<script src="{{ elixir('js/all.js') }}"></script>
@yield('scripts')
@include('partials.flash')
@include('partials.addthis')
</body>
</html>
