<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Receipt</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<h2>Javan Restaurant</h2>
		<h3>Reservation Confirmation</h3>
		<table>
			<tr>
				<td><strong>Date :</strong></td>
				<td>{{ $date->format('l jS \\of F Y') }}</td>
			</tr>
			<tr>
				<td><strong>Time :</strong></td>
				<td>{{ $time }}</td>
			</tr>
			<tr>
				<td><strong>Seats :</strong></td>
				<td>{{ $seats }}</td>
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
				<td><strong>Email :</strong></td>
				<td>{{ $user['email'] }}</td>
			</tr>
		</table>
	</body>
</html>