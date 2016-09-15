{!! '<?xml version="1.0" encoding="utf-8" ?>' !!}
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Javan Persian Restaurant London</title>
	<subtitle>Authentic Persian Cuisine Licenced Restaurant in West London, Hammersmith, Chiswick With Live Music on
		Weekends and Great Traditional Interior Design and Shisha
	</subtitle>
	<link href="https://javan-restaurant.co.uk/feed" rel="self"/>
	<updated>{{ Carbon\Carbon::now()->toAtomString() }}</updated>
	<author>
		<name>Javan Restaurant London</name>
	</author>
	<id>tag:javan-restaurant.co.uk,{{ date('Y') }}:/feed</id>
	@foreach ($posts as $post)
		<entry>
			<title>{{ $post->subject }}</title>
			<link>{{ route('blog', $post->slug) }}</link>
			<id>{{ rss_tag_uri($post) }}</id>
			<summary>{!! str_limit($post->body, 200) !!}</summary>
		</entry>
	@endforeach
</feed>