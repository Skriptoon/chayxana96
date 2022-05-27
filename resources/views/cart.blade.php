@extends('layouts.app')

@section('style')	
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/main.js"></script>
@endsection

@section('title')
    Корзина
@endsection

@section('content')
    <div class="container container-body">
        <div class="">
            <h3 class="p-4">Корзина</h3>
            <div class="bg-light cart-info shadow p-4">
                @if(session('positions'))
                    @foreach($positions as $position)
                    <div class="row border-bottom py-2 cart-info" id="{{$position->id}}">
                        <div class="cart-img col-auto"><img src="{{$position->img}}"></div>
                        <div class="col align-self-center fw-bold">{{$position->name}}</div>
                        <div class="col-auto align-self-center">
                            <button class="btn btn-dark btn-count btn-minus cart" id="{{$position->id}}">-</button>
                            <span class="px-3 pr-amount" id="{{$position->id}}">{{session('positions')[$position->id]}}</span>
                            <button class="btn btn-dark btn-count btn-plus cart" id="{{$position->id}}">+</button>
                        </div>
                        <div class="pr-price col-auto align-self-center" id="{{$position->id}}">
                            {{session('positions')[$position->id]*$position->price}}
                        </div>
                        
                    </div>
                    <script>
                    if(!prParam) var prParam = [];
                    prParam[{{$position->id}}] = {
                        price: {{$position->price}},
                        amount: {{session('positions')[$position->id]}}
                    }
                    </script>
                    @endforeach
                
                <div class="fs-3 fw-bold text-end">
                    Итого: <span class="pr-sum"></span>
                    <script>
                        updateSum()
                    </script>
                </div>
                @else
                    Корзина пуста
                @endif
            </div>
            <div>
                <ul class="nav nav-pills justify-content-center my-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active link-dark" id="home-tab" data-bs-toggle="tab" data-bs-target="#pickup" type="button" role="tab" aria-controls="home" aria-selected="true">Самовывоз</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link link-dark" id="profile-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="profile" aria-selected="false">Доставка</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pickup" role="tabpanel" aria-labelledby="home-tab">
                    <form class="row">
                        <div class="col-lg-6 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Имя">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Номер телефона">
                        </div>
                        <div class="col-lg-12 mb-3">
                                <textarea type="text" name="comm" class="form-control" placeholder="Комментарий"></textarea>
                        </div>
                        <div class="form-check mx-3">
                            <input class="form-check-input" type="radio" name="paypickup" value="1" id="radio11" checked>
                            <label class="form-check-label" for="radio11">
                                Картой на сайте
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input class="form-check-input" type="radio" name="paypickup" value="2" id="radio21">
                            <label class="form-check-label" for="radio21">
                                При получении
                            </label>
                        </div>
                        <button type="submit" class="btn btn-dark w-50 m-auto btn-order">Заказать</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="profile-tab">
                    <form class="row">
                            <div class="col-lg-6 mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Имя">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="tel" name="phone" class="form-control" placeholder="Номер телефона">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="text" name="street" class="form-control" placeholder="Улица">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <input type="text" name="house" class="form-control" placeholder="Дом">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <input type="text" name="building" class="form-control" placeholder="Корпус">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="entrance" class="form-control" placeholder="Подъезд">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="flat" class="form-control" placeholder="Квартира">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" name="floor" class="form-control" placeholder="Этаж">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <textarea type="text" name="comm" class="form-control" placeholder="Комментарий"></textarea>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="paydelivery" value="1" id="radio1" value="1" >
                                <label class="form-check-label" for="radio1">
                                    Картой на сайте
                                </label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="paydelivery" value="2" id="radio2" value="2">
                                <label class="form-check-label" for="radio2">
                                    Катой курьеру
                                </label>
                            </div>
                            <div class="form-check mx-3">
                                <input class="form-check-input" type="radio" name="paydelivery" value="3" id="radio3" value="3">
                                <label class="form-check-label" for="radio3">
                                    Наличными курьеру
                                </label>
                                <div class="mb-3 row change" style="display: none;">
                                    <label for="staticEmail" class="col-auto col-form-label">С какой суммы приготовить сдачу</label>
                                    <div class="col-auto">
                                        <input type="number" class="form-control" name="change" id="staticEmail">
                                    </div>
                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="checkbox" name="no_change" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            У меня без сдачи
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark w-50 m-auto btn-order">Заказать</button>
                        </form>
                    </div>
                </div>
            </div>
        <script src="./js/events.js"></script>
        </div>
    </div>
@endsection