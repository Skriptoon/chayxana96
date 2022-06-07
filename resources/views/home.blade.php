@extends('layouts.app')


@section('style')
    <link rel="stylesheet" href="css/owl.carusel.min.css">
    <style>
        .btn-main {
            color: #fff;
            background-color: #212529;
            border-color: #212529;
        }
    </style>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
@endsection

@section('title')
    Чайхана#96. Пан-Азия. Мангал#1
@endsection

@section('content')
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($banners as $banner)
                <div class="carousel-item
                @if ($loop->first)
                    active
                @endif
                ">
                <img src="{{Storage::url($banner->img)}}"></img>
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$banner->header}}</h5>
                    <p>{{$banner->text}}</p>
                </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row pt-4">
            <div class="col-lg-4 pb-2">
                <a href="{{ route('contacts') }}" class="btn btn-dark w-100">Контакты</a>
            </div>
            <div class="col-lg-4 pb-2">
                <a href="{{ route('hall') }}" class="btn btn-dark w-100">Банкетный зал</a>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('delivery') }}" class="btn btn-dark w-100">Условия доставки</a>
            </div>
        </div>

        @foreach($positions as $position)
        <script>
            if(!prParam) var prParam = [];
            prParam[{{$position->id}}] = {
                price: {{$position->price}},
                amount:
                @if(isset(session('positions')[$position->id]))
                    {{ session('positions')[$position->id] }}
                @else
                    0
                @endif
            }
        </script>
        @endforeach

        <div class="py-4 d-flex justify-content-between">
            <a href="/chayhana" class="fs-3 text-decoration-none text-dark fw-bold">Чайхана#96</a>
            <a href="/chayhana" class="btn btn-dark align-top">В меню</a>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach($positions as $position)
                @if($position->menu != 1 || !$position->main_page)
                    @continue
                @endif

                @include('layouts.carts.home-cart')
            @endforeach
        </div>
        <div class="py-4 d-flex justify-content-between">
            <a href="/panasia" class="fs-3 text-decoration-none text-dark fw-bold">Пан-азия</a>
            <a href="/panasia" class="btn btn-dark align-top">В меню</a>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach($positions as $position)
                @if($position->menu != 2 || !$position->main_page)
                    @continue
                @endif

                @include('layouts.carts.home-cart')
            @endforeach
        </div>
        <div class="py-4 d-flex justify-content-between">
            <a href="/mangal" class="fs-3 text-decoration-none text-dark fw-bold">Мангал#1</a>
            <a href="/mangal" class="btn btn-dark align-top">В меню</a>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach($positions as $position)
                @if($position->menu != 3 || !$position->main_page)
                    @continue
                @endif

                @include('layouts.carts.home-cart')
            @endforeach
        </div>
        <script>
            var items;
            if($("body").css("width").slice(0, -2) > 960)
                items = 4;
            else
                items = 1;
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                items: items,
                loop:false
            })
        </script>
    </div>
    <a class="btn btn-dark btn-busket position-fixed start-50 translate-middle d-block d-lg-none" href="./cart" style="bottom: 50px;z-index: 1000;">Корзина</a>
    <script>updateCart()</script>
    <script src="/js/events.js"></script>
@endsection
