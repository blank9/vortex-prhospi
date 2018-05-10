<!DOCTYPE html>
<html>
	<head>
		<title>Accomodation</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		@include('nav')
		<div class="container">
			<div class="row" id="page-content">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<form action="/prhospi/check_pr" method="POST" class="form" role="form">
						<legend>Accomodation Form</legend>
						@include('errors')
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="id">Vortex ID:</label>
							<input type="text" class="form-control" id="id" name="id">
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>