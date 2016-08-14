<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title', 'Javan Persian Restaurant')</title>
	<meta charset="utf-8">
	{{--<meta http-equiv="refresh" content="300">--}}
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="description" content="Top Quality Persian Cuisine in London"/>
	<meta name="keywords" content="Persian, Restaurant, London, Iranian, Cuisine"/>
	<meta name="copyright" content="javan-restaurant.co.uk">
	<meta name="author" content="Javan"/>
	<meta name="application-name" content="Javan"/>
	<!--Facebook Tags-->
	<meta property="og:url" content="{{ Request::path() }}"/>
	<meta property="og:title" content="Javan Restaurant"/>
	<meta property="og:type" content="article"/>
	<meta property="og:image" content="/images/misc/parsclick-logo.png"/>
	<meta property="article:author" content="https://www.facebook.com/JavanLondonLtd"/>
	<meta property="og:locale" content="en_UK"/>
	<meta property="og:description" content="Top Quality Persian Cuisine in London"/>
	<!--Twitter Tags-->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:title" content="Javan Restaurant"/>
	<meta name="twitter:description" content="Top Quality Persian Cuisine in London"/>
	<meta name="twitter:image" content="/images/misc/parsclick-logo.png"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ elixir('css/app.css') }}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="/images/favicon.png">
</head>
<body id="app-layout">
@include('partials.nav')
@include('partials.errors')
@yield('content')
@include('partials.modal')
@include('partials.footer')

<script src="https://use.fontawesome.com/ed7ef479e3.js"></script>
<script src="{{ elixir('js/all.js') }}"></script>
@yield('scripts')
@include('partials.flash')
@include('partials.addthis')
</body>
</html>
