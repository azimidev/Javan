<?php

/**
 * @param null $title
 * @param null $message
 * @return \Illuminate\Foundation\Application|\Javan\Http\Flash|mixed
 */
function flash($title = NULL, $message = NULL)
{
	$flash = app(Javan\Http\Flash::class);

	if ( ! func_num_args()) {
		return $flash;
	}

	return $flash->info($title, $message);
}

/**
 * @param $path
 * @param string $active
 * @return string
 */
function active($path, $active = 'active')
{
	return Request::is($path) ? $active : '';
}

/**
 * @return string
 */
function select_times_of_day()
{
	$open_time  = strtotime('12:00');
	$close_time = strtotime('23:00');
	$interval   = 15 * 60;
	$output     = '';

	for ($i = $open_time; $i < $close_time; $i += $interval) {
		$output .= '<option ';
		if (time() < $open_time) {
			$output .= 'selected';
		}
		$output .= ' value="' . date('H:i', $i) . '">' . date('H:i', $i) . '</option>';
	}

	return $output;
}

/**
 * @param $date
 * @return mixed
 */
function expired($date)
{
	return $date->lt(Carbon\Carbon::today());
}

/**
 * @param $date
 * @return mixed
 */
function today($date)
{
	return $date->eq(Carbon\Carbon::today());
}

/**
 * @return bool
 */
function javan_is_open()
{
	$date_time    = new DateTime('Europe/London');
	$opening_time = $date_time->setTime(12, 15)->getTimestamp();
	$closing_time = $date_time->setTime(22, 45)->getTimestamp();

	return time() >= $opening_time && time() <= $closing_time;
}

/**
 * @return bool
 */
function less_than_minimum_order()
{
	$total = (int) str_replace(',', '', \Cart::total());

	return $total < env('MINIMUM_ORDER');
}

/**
 * @param $column
 * @param $body
 * @return string
 */
function sort_column_by($column, $body)
{
	$direction = (request()->get('direction') == 'ASC') ? 'DESC' : 'ASC';

	$route = route(request()->route()->getAction()['as'], ['sortBy' => $column, 'direction' => $direction]);

	return '<a href=' . $route . '>' . $body . '</a>';
}

/**
 * @param $string
 * @return mixed
 */
function persian($string)
{
	$western = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
	$eastern = ['۰', '١', '٢', '٣', '۴', '۵', '۶', '۷', '۸', '۹'];

	return str_replace($western, $eastern, $string);
}

/**
 * @param $parameter
 * @param $slug
 * @return bool
 */
function route_parameter($parameter, $slug)
{
	return request()->route()->parameter($parameter) === $slug;
}

/**
 * @param $model
 * @return string
 */
function status($model)
{
	if ($model->recent()) {
		return '<span class="badge">NEW</span>';
	}

	if ($model->uptodate()) {
		return '<span class="badge">UPDATED</span>';
	}
}

/**
 * @param $post
 * @return string
 */
function rss_tag_uri($post)
{
	$parsedUrl = parse_url(route('blog', $post->slug));
	$output[]  = 'tag:';
	$output[]  = $parsedUrl['host'] . ',';
	$output[]  = $post->updated_at->format('Y-m-d') . ':';
	$output[]  = $parsedUrl['path'];

	return implode('', $output);
}

/**
 * @param $destination
 * @return array
 */
function deliverable($destination)
{
	$address = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' .
		'291+King+Street+W6+9NH' . '&destinations=' . $destination . 'London+UK' . '&key=' . env('GOOGLE_API_KEY');

	$client   = new GuzzleHttp\Client();
	$request  = $client->get($address);
	$response = json_decode($request->getBody()->getContents(), TRUE);

	if ($response['status'] === 'OK' && $response['rows'][0]['elements'][0]['status'] === 'OK') {

		if ($response['rows'][0]['elements'][0]['distance']['value'] <= 5000) {

			return [
				'status' => TRUE,
				'title'  => '<span class="text-success">Yes We Deliver in Your Area</span>',
				'text'   => '<b>Your address:</b> ' .
					array_shift($response['destination_addresses']) . '<br>' .
					'<b>Estimated Distance:</b> ' . $response['rows'][0]['elements'][0]['distance']['text'] . '<br>' .
					'<b>Estimated Delivery:</b> ' . $response['rows'][0]['elements'][0]['duration']['text'],
			];
		}

		return [
			'status' => FALSE,
			'title'  => '<span class="text-danger">Sorry We Don\'t Deliver in Your Area</span>',
			'text'   => '<b>Your address:</b> ' .
				array_shift($response['destination_addresses']) . '<br>' .
				'<b>Estimated Distance:</b> ' . $response['rows'][0]['elements'][0]['distance']['text'] . '<br><br>' .
				'Order by phone if you\'re willing to pay for the delivery charge' . '<br>' .
				'<b>020 8563 8553</b>',
		];
	}

	return [
		'status' => FALSE,
		'title'  => 'We couldn\'t find your address !',
		'text'   => 'Please type your post code correctly Ex: XXX XXX',
	];
}