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
	return request()->is($path) ? $active : '';
}

/**
 * @return string
 */
function select_times_of_day()
{
	$open_time  = (new DateTime())->setTime(12, 30);
	$close_time = (new DateTime())->setTime(22, 45);
	$interval   = new DateInterval('PT15M');
	$date_range = new DatePeriod($open_time, $interval, $close_time);

	$output = '';
	foreach ($date_range as $date) {
		$output .= '<option value="' . $date->format('H:i') . '">' . $date->format('H:i') . '</option>';
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
	$javan_schedule = [
		'Mon' => ['04:00 PM' => '11:00 PM'],
		'Tue' => ['12:30 PM' => '11:00 PM'],
		'Wed' => ['12:30 PM' => '11:00 PM'],
		'Thu' => ['12:30 PM' => '11:00 PM'],
		'Fri' => ['12:30 PM' => '11:00 PM'],
		'Sat' => ['12:00 PM' => '11:00 PM'],
		'Sun' => ['12:00 PM' => '11:00 PM'],
	];

	$now = (new DateTime('Europe/London'))->setTimestamp(time());

	foreach ($javan_schedule[date('D', time())] as $opening_time => $closing_time) {

		$opening_time = DateTime::createFromFormat('h:i A', $opening_time);
		$closing_time = DateTime::createFromFormat('h:i A', $closing_time);

		if ($opening_time <= $now && $now <= $closing_time) {
			return TRUE;
			break;
		}
	}

	return FALSE;
}

/**
 * @return bool
 */
function less_than_minimum_order()
{
	$total = (int) str_replace(',', '', \Cart::instance('menu')->total());

	return $total < config('app.min-order');
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
 * Example of JSON response:
 *
 * @param $destination
 * @return array
 */
function deliverable($destination)
{
	// {
	// 	"destination_addresses" : [ "London W14, UK" ],
	// 	"origin_addresses" : [ "291 King St, London W6 9NH, UK" ],
	// 	"rows" : [
	//       {
	// 	      "elements" : [
	//             {
	// 	            "distance" : {
	// 	            "text" : "1.9 mi",
	//                   "value" : 3082
	//                },
	//                "duration" : {
	// 	                "text"  : "7 mins",
	//                  "value" : 429
	//                },
	//                "status" : "OK"
	//             }
	//          ]
	//       }
	//    ],
	//    "status" : "OK"
	// }
	$address = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' .
		'291+King+Street+W6+9NH' . '&destinations=' . $destination . 'London+UK' . '&key=' .
		config('services.google.key');

	$client   = new GuzzleHttp\Client();
	$request  = $client->get($address);
	$response = json_decode($request->getBody()->getContents(), TRUE);

	if ($response['status'] === 'OK' && $response['rows'][0]['elements'][0]['status'] === 'OK') {

		// $response['rows'][0]['elements'][0]['distance']['value'] // gets the value
		$distanse = $response['rows'][0]['elements'][0]['distance']['text'];
		// $response['rows'][0]['elements'][0]['duration']['text'] // gets the text // 20min * 60sec = 1200
		$duration = ceil(($response['rows'][0]['elements'][0]['duration']['value'] + 1200) / 60) . ' minutes';

		if ($response['rows'][0]['elements'][0]['distance']['value'] <= 5000) {

			return [
				'status' => TRUE,
				'title'  => '<span class="text-success"><i class="fa fa-smile-o"></i> Yes! You are very close.</span>',
				'text'   => '<b>Your address:</b> ' .
					'<b class="text-primary">' . array_shift($response['destination_addresses']) . '</b><br>' .
					"<b>Estimated Distance: </b><b class=\"text-success\">{$distanse}</b><br>" .
					"<b>Estimated Delivery: </b><b class=\"text-success\">{$duration}</b>",
			];
		}

		return [
			'status' => FALSE,
			'title'  => '<span class="text-danger"><i class="fa fa-frown-o"></i> You are a little far!</span>',
			'text'   => '<b>Your address:</b> ' .
				'<b class="text-primary">' . array_shift($response['destination_addresses']) . '</b><br>' .
				"<b>Estimated Distance: </b><b class=\"text-danger\">{$distanse}</b><br><br>" .
				'<b class="text-success">Order and pay by phone with delivery charge.</b>' . '<br>' .
				'<b>020 8563 8553</b>',
		];
	}

	return [
		'status' => FALSE,
		'title'  => 'We couldn\'t find your address !',
		'text'   => 'Please type your post code correctly Ex: XXX XXX',
	];
}