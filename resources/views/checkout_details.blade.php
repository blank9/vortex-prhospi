<!DOCTYPE html>
<html>
<head>
	<title>PR and Hospi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	@include('nav')
	<div class="container">
		<div class="row" id="page-content">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td>Vortex ID</td>
						<td>{{$user_details->id}}</td>
					</tr>
					<tr>
						<td>Caution Fees</td>
						<td>{{$user_details->caution_fees}}</td>
					</tr>
					<tr>
						<td>Accomodation Fees</td>
						<td>{{$user_details->acco_fees}}</td>
					</tr>
					<tr>
						<td>Check In Time </td>
						<td>{{$checkin}}</td>
					</tr>
					<tr>
						<td>Check Out Time </td>
						<td>{{$checkout}}</td>
					</tr>
					<tr>
						<td>Night Count </td>
						<td>{{$actual_night_count}}</td>
					</tr>
				</tbody>
			</table>
			<a href="/prhospi/confirm_checkout"><button id="confirm_checkout" class="btn btn-primary">Confirm Checkout</button></a>
		</div>
	</div>
</body>
</html>