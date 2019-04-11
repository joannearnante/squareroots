@extends('layouts.app')

@section('content')
 	<div class="container">
 		<div class="row justify-content-center">
			<div class="col-md-12">
 				<h1 class="text-center">How to Order</h1>
			</div>
			<br><br>
			<div class="container col-md-10">
			<div class="card mt-3">
				<table class="table table-striped">
					<tr><td><h5>Delivery Schedule</h5></td></tr>
		            <tr><td>Saturday from 10 am to 4pm</td></tr>

		            <tr><td><h5>Minimum Order</h5></td></tr>
					<tr><td>There should be a minimum order of PHP 500.00</td></tr>

					<tr><td><h5>Delivery Charge</h5></td></tr>
					<tr><td>There will be a delivery charge of PHP 100.00 and any orders made above Php 2,000 will have free delivery charge.</td></tr>

					<tr><td><h5>Order Placement</h5></td></tr>
					<tr><td>Orders must be placed on or before 8:00 pm at least 1 day prior to your scheduled delivery day. Any orders made after that will be moved to the next delivery date.</td></tr>

					<tr><td><h5>Payment Methods</h5></td></tr>
					<tr><td>We'll be sending you details on how to settle payment upon approval of your order request</td></tr>

					<tr><td><h5>Disclaimer</h5></td></tr>
					<tr><td>All prices are subject to change due to the availability and season of the produce.​<br>
					For further questions, please contact us through our Customer Support email.
					</td></tr>
	       		</table>
       		</div>
   		</div>
	</div>
@endsection