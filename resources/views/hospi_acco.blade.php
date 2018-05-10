<!DOCTYPE html>
<html>
	<head>
		<title>Accomodation</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<style>
			.inner_card {
				display: inline-block;
				margin: 10px;
			}
		</style>
	</head>
	<body>
		@include('nav')
		<div class="container">
			<div class="row" id="page-content">
				@foreach ($hostels as $h)
					@if ($h->available > 0)
						<button class="btn btn-default inner_card" id="{{ $h->id }}" onclick="setAcco({{ $h->id }}, '{{ $h->hostel_name }}', {{ $h->floor }})"> {{ $h->hostel_name }}<br>Floor: {{ $h->floor }}<br>{{ $h->available }}/{{ $h->total }} </li></button>
					@endif
				@endforeach	
		</div>
		<form id="hostel_form" action="/prhospi/fix_acco" method="GET">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="hostel_id" id="hostel_id">
			<input type="text" name="hostel_name" id="hostel_name" readonly>
			<div class="form-group">
				<label for="night_count">Number of Nights:</label>
				<input type="number" class="form-control" id="night_count" name="night_count" max="3" min="1">
			</div>
			<button type="submit" class="btn btn-primary">Assign</button>
		</form>
	</div>
	<script>
		function setAcco(hid, hname, floor) {
			$('#hostel_id').val(hid);
			$('#hostel_name').val(hname + ' Floor: '+ floor);
			console.log(hid);
		}
	</script>
</body>
</html>