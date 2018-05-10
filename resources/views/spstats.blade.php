<!DOCTYPE html>
<html>
	<head>
		<title>Stats</title>
		@include('links')
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<table class="table table-striped">
						<legend> Footfall Stats </legend>
						<tbody>
							<tr>
								<td>Total Footfall</td>
								<td>{{ $total_ff }}</td>
							</tr>
							<tr>
								<td>Total registrations</td>
								<td>{{ $total_reg }}</td>
							</tr>
							<tr>
								<td>Currently Checked In</td>
								<td>{{ $curr_checked_in }}</td>
							</tr>
							<tr>
								<td>Currently Checked Out</td>
								<td>{{ $curr_checked_out }}</td>
							</tr>
							<tr>
								<td>Paid Online</td>
								<td>{{ $paid_online }}</td>
							</tr>
							<tr>
								<td>PR Money</td>
								<td>{{ $pr_money }}</td>
							</tr>
							<tr>
								<td>Hospi Money</td>
								<td>{{ $hospi_money }}</td>
							</tr>
							<tr>
								<td>Caution Money</td>
								<td>{{ $caution_fees }}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6">
					<table class="table">
						<legend> Hostel Stats </legend>
						<thead>
							<tr>
								<th>Hostel</th>
								<th>Floor</th>
								<th>Available</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($hostels as $h)
							<tr>
								<td>{{ $h->hostel_name }}</td>
								<td>{{ $h->floor }}</td>
								<td>{{ $h->available }}</td>
								<td>{{ $h->total }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<table class="table">
							<legend> Workshop Stats </legend>
							<thead>
								<tr>
									<th>Workshop</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($w_total as $w)
								<tr>
									<td>{{ $w->workshop_name }}</td>
									<td>{{ $w->total }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<table class="table">
							<legend> Online</legend>
							<thead>
								<tr>
									<th>Online</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($w_online as $w)
								<tr>
									<td>{{ $w->online }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<table class="table">
							<legend> Offline </legend>
							<thead>
								<tr>
									<th>Offline</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($w_offline as $w)
								<tr>
									<td>{{ $w->offline }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<table class="table">
						<legend> Checked In </legend>
						<thead>
							<tr>
								<th>ID</th>
								<th>Hostel ID</th>
								<th>Caution Fees</th>
								<th>Aco Fees</th>
								<th>Workshop Fees</th>
								<th>Registration fees</th>
								<th>Total Amount</th>
								<th>Workshop Name</th>
								<th>Paid Online</th>
								<th>PR Paid</th>
								<th>Accco Paid</th>
								<th>Checkin</th>
								<th>Checkout</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($ff_details as $w)
							<tr>
								<td>{{ $w->id }}</td>
								<td>{{ $w->hostel_id }}</td>
								<td>{{ $w->caution_fees }}</td>
								<td>{{ $w->acco_fees }}</td>
								<td>{{ $w->workshop_fees }}</td>
								<td>{{ $w->reg_fees }}</td>
								<td>{{ $w->total_amt }}</td>
								<td>{{ $w->workshop_name }}</td>
								<td>{{ $w->paid_online }}</td>
								<td>{{ $w->pr_paid }}</td>
								<td>{{ $w->acco_paid }}</td>
								<td>{{ date('d-m-Y g:i a', $w->checkin) }}</td>
								<td>
								@if (is_null($w->checkout))
									NULL
								@else
									{{ date('d-m-Y g:i a', $w->checkout) }}
								@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</body>
</html>