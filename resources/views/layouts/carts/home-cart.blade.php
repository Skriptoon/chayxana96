<div class="item">
    <div class="position-relative  p-4 m-1 bg-main pr-info shadow">
            <div class="pr-picture">
                <img src="{{Storage::url($position->img)}}" alt="{{$position->name}}">
            </div>
            <h5 class="text-truncate">{{$position->name}}</h5>
            <div class="d-flex pr-price" style="height: 40px;">
                <div class="position-absolute price"><h4>{{$position->price}} ₽</h4></div>
                <div class="position-absolute btn-amount">
                    @if(!isset(session('positions')[$position->id]))
                        <button class="btn btn-dark btn-inbusket" id="{{$position->id}}">В корзину</button>
                    @elseif(session('positions')[$position->id] > 0)
                        <button class="btn btn-dark btn-count btn-minus" id="{{$position->id}}">-</button>
                        <span class="px-2 pr-amount" id="{{$position->id}}">{{session('positions')[$position->id]}} </span>
                        <button class="btn btn-dark btn-count btn-plus" id="{{$position->id}}">+</button>
                    @else
                        <button class="btn btn-dark btn-inbusket" id="{{$position->id}}">В корзину</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
