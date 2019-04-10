@extends('layouts.app')

@section('content')

<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active">
  <img class="d-block w-100" src="{{URL::asset('/images/1.png')}}" alt="First slide">
  <div class="carousel-caption {{-- d-none --}} d-flex justify-content-start text-left" style="top: 40%; left: 5%;">
    <p class="text-dark captiontext">Nourish the body<br>and soul</p>
  </div>
</div>
<div class="carousel-item">
  <img class="d-block w-100" src="{{URL::asset('/images/2.png')}}" alt="Second slide">
  <div class="carousel-caption {{-- d-none --}} d-flex justify-content-start text-left" style="top: 40%; left: 5%;">
    <p class="captiontext">Local produce<br>within reach</p>
  </div>
</div>
<div class="carousel-item">
  <img class="d-block w-100" src="{{URL::asset('/images/3.png')}}" alt="Third slide">
  <div class="carousel-caption {{-- d-none --}} d-flex justify-content-start text-left" style="top: 40%; left: 5%;">
    <p class="captiontext">Bridging technology <br>and farmers</p>
</div>
</div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>

    {{-- link to custom js --}}
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}

@endsection
