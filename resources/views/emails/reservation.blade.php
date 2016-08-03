<!DOCTYPE html>
<html lang="en">
<head>
	<title>Receipt</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style>
		body {
			font-size     : 20px;
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
	<h1 class="heading">Javan Restaurant</h1>

	<h3 class="subheading">Booking Confirmation</h3>

	<table class="table table-condensed">
		<tr>
			<td><strong>Date</strong></td>
			<td>{{ $date->format('l jS \\of F Y') }}</td>
		</tr>
		<tr>
			<td><strong>Time</strong></td>
			<td>{{ $time }}</td>
		</tr>
		<tr>
			<td><strong>Seats</strong></td>
			<td>{{ $seats }}</td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td>{{ $user['name'] }}</td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td>{{ $user['phone'] }}</td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td>{{ $user['email'] }}</td>
		</tr>
	</table>
</div>
</body>
</html>