<!DOCTYPE html>
<html lang="en">
<head>
	<title>Receipt</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style>
		body {
			font-size     : 17px;
		}

		.heading {
			border-bottom  : 3px solid #000;
			text-align     : center;
			padding-bottom : 20px;
		}

		.subheading {
			text-align     : center;
			padding-bottom : 10px;
		}

		table {
			border-collapse : collapse;
			width           : 100%;
		}

		table td, table th {
			border  : 3px solid black;
			padding : 7px;
		}

		table tr:first-child th {
			border-top : 0;
		}

		table tr:last-child td {
			border-bottom : 0;
		}

		table tr td:first-child,
		table tr th:first-child {
			border-left : 0;
		}

		table tr td:last-child,
		table tr th:last-child {
			border-right : 0;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<h2 class="heading">Javan Restaurant</h2>

	<h3 class="subheading">Delivery Confirmation</h3>

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
</div>
</body>
</html>