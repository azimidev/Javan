<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Receipt</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<h2>Delivery Confirmation</h2>
		<table>
			<tr>
				<td><strong>Orders :</strong></td>
				<td>
					<ul>
						@foreach (unserialize($orders) as $order)
							<li>{{ $order->qty }} {{ $order->name }}</li>
						@endforeach
					</ul>
				</td>
			</tr>
			<tr>
				<td><strong>Total :</strong></td>
				<td>£{{ number_format($total / 100, 2) }}</td>
			</tr>
			<tr>
				<td><strong>Note :</strong></td>
				<td>{!! $note !!}</td>
			</tr>
			<tr>
				<td><strong>Status :</strong></td>
				<td>{!! $status ? '<span style="color:green;">Accepted & Paid</span>' : '<span style="color:red;">Rejected & Refunded</span>' !!}</td>
			</tr>
			<tr>
				<td><strong>Name :</strong></td>
				<td>{{ $user['name'] }}</td>
			</tr>
			<tr>
				<td><strong>Phone :</strong></td>
				<td>{{ $user['phone'] }}</td>
			</tr>
			<tr>
				<td><strong>Address :</strong></td>
				<td>{{ $user['address'] }}, {{ $user['city'] }}, {{ $user['post_code'] }}</td>
			</tr>
		</table>
	</body>
</html>