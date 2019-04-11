@extends('layouts.app')

@section('content')
 	<div class="container">
 		<div class="row justify-content-center">
			<div class="col-md-12">
 				<h1 class="text-center">About Us</h1>
			</div>
 		</div>
	</div>
	<br>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card flex-row flex-wrap">
					<div class="card-block border-0">
						<img src="{{URL::asset('/images/1.png')}}" alt="" style="height: 300px; width: auto;">
					</div>
					<div class="card-block px-4 pt-5 d-inline-block col-5">
						<h4 class="card-title">Nourish the body and soul</h4>
						<p class="card-text">Our team believes that if we want to see change, we have to be the first to stand up and spark that said change. For the longest time the agricultural industry has been plummeting, forcing local farmers who do not work for large corporations to sell their lands in search for a better future. We believe that agriculture is not of the past, but a means to help the future of the Philippines.</p>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card flex-row flex-wrap">
					<div class="card-block border-0">
						<img src="{{URL::asset('/images/2.png')}}" alt="" style="height: 300px; width: auto;">
					</div>
					<div class="card-block px-4 pt-5 d-inline-block col-5">
						<h4 class="card-title">Local produce within reach</h4>
						<p class="card-text">Our vision is to uplift the agricultural industry and champion local farmers. Thus, it has become our mission to help our local farmers feed our nation. With every order, you are making a conscious decision to support our cause. Together we can champion local farmers, save agriculture, and rebuild the Philippines.</p>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card flex-row flex-wrap">
					<div class="card-block border-0">
						<img src="{{URL::asset('/images/3.png')}}" alt="" style="height: 300px; width: auto;">
					</div>
					<div class="card-block px-4 pt-5 d-inline-block col-5">
						<h4 class="card-title">Bridging technology and farmers</h4>
						<p class="card-text">We help farmers gain access to Aquaponic systems. From boosting the local economy by creating jobs, to creating healthy sustainable food for communities, this sustainable farming method is a game changer. For many local farmers, rainy seasons usually mean starvation. But with aquaponics, security to families financially, physically and emotionally are within reach. </p>
					</div>
				</div>
			</div>
		</div>

@endsection