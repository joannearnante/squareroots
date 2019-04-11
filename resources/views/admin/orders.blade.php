@extends('layouts.app')
@section('content')
@section('content')
    @if(Auth::user()->isAdmin == 'true')
    	 <div class="container">
		        <div class="row justify-content-center">
		            <div class="col-md-12">
		                <div class="card">
		                    <div class="card-header"><h4>Orders</h4></div>

		                    <div class="card-body">
						    	<table class="table">
									<thead>
										<tr>
											<td>Reference Number</td>
											<td>Date</td>
											<td>Products</td>
											<td>Quantity</td>
											<td>Total</td>
											<td>Status</td>
										</tr>
									</thead>
									<tbody>
										@foreach($orders as $order)
                                            <tr>
                                            	<td>{{$order->refNo}}</td>
												<td>{{$order->created_at}}</td>
												<td>{{$order->product}}</td>
												<td>{{$order->quantity}}</td>
												<td>{{$order->total}}</td>
												<td>
													<form method="POST" action="/orders/{{$order->id}}" class="d-inline-block">
                                                        @csrf
                                                        <select name="status">
                                                        	<option value="{{$order->status}}">{{$order->status}}</option>
                                                        	<option value="confirmed">confirmed</option>
                                                        	<option value="confirmed">completed</option>
                                                        	<option value="confirmed">cancelled</option>
                                                        </select>
                                                    </form>
                                                </td>
                                            </tr>
	                                    @endforeach
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
			</div>	
    @else
	    <div class="container">
	        <div class="row justify-content-center">
	            <div class="col-md-12">
	                <div class="card">
	                    <div class="card-header"><h4>Your Orders</h4></div>
	                    <div class="card-body">
					    	<table class="table">
								<thead>
									<tr>
										<td>Ref No.</td>
										<td>Date</td>
										<td>User Id</td>
										<td>Products</td>
										<td>Quantity</td>
										<td>Total</td>
										<td>Status</td>
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $order)
									  	 @if(Auth::user()->id == $order->user_id)
                                            <tr>
                                            	<td>{{$order->refNo}}</td>
												<td>{{$order->created_at}}</td>
												<td>{{$order->user_id}}</td>
												<td>{{$order->product}}</td>
												<td>{{$order->quantity}}</td>
												<td>{{$order->total}}</td>
												<td></td>
                                            </tr>
                                        @endif
                                    @endforeach
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif	
@endsection