<!DOCTYPE html>
<html>
<head>
	<title>Hospi Fee Receipt</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	@include('nav')
	<div class="container">
		<div class="row" id="page-content">
			<table class="table">
				<tbody>
					<tr>
						<td>Accomodation Fees</td>
						<td>{{$acco_fees}}</td>
					</tr>
					<tr>
						<td>Caution Fees</td>
						<td>{{$caution_fees}}</td>
					</tr>
					<tr class="info">
						<td>Total (Hospi)</td>
						<td>{{$total_amt}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<a href="/prhospi/acco_confirm"><button class="btn btn-primary">Register</button></a>
	</div>
</body>
</html>