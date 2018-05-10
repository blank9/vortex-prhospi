<form action="/prhospi/{{$form_route_ext}}" method="POST" role="form">
	<legend>User Form</legend>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<label for="id">Vortex ID:</label>
		<input type="text" class="form-control" id="id" name="id">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>