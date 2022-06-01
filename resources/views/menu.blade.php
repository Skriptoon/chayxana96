@extends('layouts.app')

@section('style')
	@switch(Request::path())
		@case('chayhana')
			<link rel="stylesheet" href="/css/chayhana.style.css">
			@break
		@case('panasia')
			<link rel="stylesheet" href="/css/panasia.style.css">
			@break
		@case('mangal')
			<link rel="stylesheet" href="/css/mangal.style.css">
			@break
	@endswitch	
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/main.js"></script>
@endsection

@section('title')
    Меню
@endsection


@section('content')

@foreach ($categories as $category) 
	@php
		$catSort[$category->id] = $category;
	@endphp
@endforeach
<div class="container-fluid bg-main sticky-top">
	<div class="container d-flex py-2">
		<ul class="nav nav-pills flex-grow-1 overflow-auto flex-nowrap">
            @foreach ($categories as $category)
				<a class="nav-link text-nowrap link-dark fw-bold" href="#{{$category->id_name}}">{{$category->name}}</a>
            @endforeach
		</ul>
		<a class="btn btn-main btn-busket d-none d-lg-block" href="./cart">Корзина</a>
	</div>
</div>
<div class="container container-body">
<div class="bg-light px-2 menu-body">
@foreach ($categories as $category)
		<h3 class="p-5" id="{{$category->id_name}}">{{$category->name}}</h3>
		<div class="row">
		@foreach($positions as $position)
			@if($position->id_category == $category->id)
				@include('layouts.carts.menu-cart')
			
				<script>
				if(!prParam) var prParam = [];
				prParam[{{$position->id}}] = {
					price: {{$position->price}},
					amount: @if(isset(session('positions')[$position->id]))
							{{ session('positions')[$position->id] }} 
						@else
							0
						@endif
				}
				</script>
			@endif
		@endforeach
		</div>
@endforeach
</div>
</div>
<a class="btn btn-main btn-busket position-fixed start-50 translate-middle d-block d-lg-none" href="./cart" style="bottom: 50px;">Корзина</a>
<script>updateCart()</script>
<script src="./js/events.js"></script>
@endsection
