<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Vortex</a>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="{{ Session::get('nav_checkin') }}"><a href="/prhospi">Checkin</a></li>
				<li class="{{ Session::get('nav_acco') }}"><a href="/prhospi/acco">Accomodation</a></li>
      			<li class="{{ Session::get('nav_checkout') }}"><a href="/prhospi/checkout">Checkout</a></li>
      			<li class="{{ Session::get('nav_amb') }}"><a href="/prhospi/ambassador">Ambassador</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
	      		<a href="#">
	      			<span class="glyphicon glyphicon-user"></span>
	      			{{Session::get('mgr_name')}}
	      		</a>
	      		</li>
	      		<li>
	      		<a href="/prhospi/logout">
	      			<span class="glyphicon glyphicon-log-in"></span> 
	      				Logout
	      		</a>
	      	</li>
			</ul>
		</div>
	</div>
</nav>