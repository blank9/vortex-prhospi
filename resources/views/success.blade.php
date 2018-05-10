<!DOCTYPE html>
<html>
<head>
	<title>Participant Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	@include('nav')
	<div class="container">
		<div class="row">
			Successfully {{$msg}} !!
		</div>
		<div class="row">
			<a href="{{$route}}"><button class="btn btn-success"> Another {{$btn_msg}}</button></a>
		</div>
	</div>
</body>
</html>