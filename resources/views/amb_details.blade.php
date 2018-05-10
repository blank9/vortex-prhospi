<!DOCTYPE html>
<html>
<head>
	<title>PR and Hospi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	@include('nav')
	<div class="container">
		<div id="page-content">
			<table class="table table-striped">
				<tbody>
					<tr> 
						<td>Vortex ID</td>
						<td>{{$data->id}}</td>
					</tr>
					<tr> 
						<td>Full Name</td>
						<td>{{$data->fullname}}</td>
					</tr> 
						<td>Reference Count</td>
						<td>{{$data->ref_count}}</td>
					</tr>
					<tr> 
						<td>Discount</td>
						<td>{{$discount}}%</td>
					</tr>
					<tr> 
						<td>Discount Eligible Amount</td>
						<td>{{$total_amt}}</td>
					</tr>
					<tr> 
						<td>Final Amount</td>
						<td>{{$final_amt}}</td>
					</tr>
					<tr> 
						<td>Refund</td>
						<td>{{$total_amt - $final_amt}}</td>
					</tr>
					<tr>
						<td> Refunded</td>
						<td>
							@if ($data->refunded)
								Yes
							@else
								No
							@endif
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<a href="/prhospi/confirm_refund"><button id="refunded" class="btn btn-primary"> Refund </button></a>
	</div>
</body>
</html>