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
    @switch($page->page)
        @case('contacts')
            Контакты
            @break
        @case('delivery')
            Доставка
            @break
        @case('hall')
            Банкетный зал
            @break
    @endswitch
@endsection

@section('content')
<div class="container">
    {!! $page->code !!}
</div>
@endsection
