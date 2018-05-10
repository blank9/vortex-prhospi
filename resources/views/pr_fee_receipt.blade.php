<!DOCTYPE html>
<html>
<head>
	<title>Fee Receipt</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	@include('nav')
	<div class="container">
		<div class="row" id="page-content">
			<table class="table">
				<tbody>
					<tr>
						<td>Registration Fees</td>
						<td>{{$reg_fees}}</td>
					</tr>
					<tr>
						<td>Workshop Fees ({{$workshop_name}})</td>
						<td>{{$workshop_fees}}</td>
					</tr>
					<tr>
						<td>Paid Online</td>
						<td>
							@if ($paid_online)
								Yes
							@else
								No
							@endif
						</td>
					</tr>
					<tr class="info">
						<td>Total (To be paid)</td>
						<td>{{$total_amt}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<a href="/prhospi/checkin"><button class="btn btn-primary">Check In</button></a>
	</div>
</body>
</html>