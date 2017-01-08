<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Receipt</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<h2>Booking Confirmation</h2>
		<table>
			<tr>
				<td><strong>Event :</strong></td>
				<td>{{ $event['name'] }}</td>
			</tr>
			<tr>
				<td><strong>Seats :</strong></td>
				<td>{{ $seats }}</td>
			</tr>
			<tr>
				<td><strong>Total :</strong></td>
				<td>£{{ number_format($total / 100, 2) }}</td>
			</tr>
			<tr>
				<td><strong>Ticket Number :</strong></td>
				<td>{{ $ticket }}</td>
			</tr>
			<tr>
				<td><strong>Status :</strong></td>
				<td>{!! $active ? '<span style="color:green;">Accepted & Paid</span>' : '<span style="color:red;">Rejected & Refunded</span>' !!}</td>
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