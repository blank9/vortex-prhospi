<!DOCTYPE html>
<html>
	<head>
		<title>Participant Details</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		@include('nav')
		<div class="container">
			@include('errors')
			<div class="row" id="page-content">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Vortex ID</td>
								<td>{{$data->id}}</td>
							</tr>
							<tr>
								<td>Username</td>
								<td>{{$data->username}}</td>
							</tr>
							<tr>
								<td>Full Name</td>
								<td>{{$data->fullname}}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>{{$data->email}}</td>
							</tr>
							<tr>
								<td>Sex</td>
								<td>{{$data->sex}}</td>
							</tr>
							<tr>
								<td>Nationality</td>
								<td>{{$data->nationality}}</td>
							</tr>
							<tr>
								<td>College</td>
								<td>{{$data->college}}</td>
							</tr>
							<tr>
								<td>Degree</td>
								<td>{{$data->degree}}</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>{{$data->year}}</td>
							</tr>
							<tr>
								<td>Branch</td>
								<td>{{$data->branch}}</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td>{{$data->phone}}</td>
							</tr>
							<tr>
								<td>Is Ambassador</td>
								<td>@if ($data->ambassador == 1)
									Yes
									@else
									No
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<hr />
				<div class="col-sm-6 col-md-6 col-lg-6">
					<form action="/prhospi/pr_form" method="GET">
						<div class="form-row align-items-center">
							<div class="col-auto my-1">
								<label class="mr-sm-2" for="workshop_select">Workshops</label>
								<select class="custom-select mr-sm-2" id="workshop_select" name="workshop_select">
									@foreach ($workshops as $key=>$value)
									<option value="{{$key}}">{{$key}}({{$value}})</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="paid_online" value="paid_online">Paid Online</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="nitt" value="nitt">From NITT</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="amb" value="amb">Ambassador Reference</label>
						</div>
						<div class="form-group">
							<label for="amb_id">Ambassador ID:</label>
							<input type="text" class="form-control" id="amb_id" name="amb_id">
						</div>
						<button type="submit" class="btn btn-primary">Continue</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>