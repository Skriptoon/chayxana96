<div class="col-xl-3 my-2">
    <div class="position-relative h-100 p-4 m-1 bg-main pr-info shadow">
        <div class="pr-picture">
            <img src="{{Storage::url($position->img)}}" alt="{{$position->name}}">
        </div>
        <h5 class="pt-3">{{$position->name}}</h5>
        <div class="pr-desc pb-2">
            {{$position->desc}}
        </div>
        <div class="d-flex pr-price" style="height: 40px;">
            <div class="position-absolute price"><h4>{{$position->price}} &#8381; </h4></div>
            <div class="position-absolute btn-amount">
                @if(!isset(session('positions')[$position->id]))
                    <button class="btn btn-main btn-inbusket" id="{{$position->id}}">В корзину</button>
                @elseif(session('positions')[$position->id] > 0)
                    <button class="btn btn-main btn-count btn-minus" id="{{$position->id}}">-</button>
                    <span class="px-2 pr-amount" id="{{$position->id}}">{{session('positions')[$position->id]}} </span>
                    <button class="btn btn-main btn-count btn-plus" id="{{$position->id}}">+</button>
                @else
                    <button class="btn btn-main btn-inbusket" id="{{$position->id}}">В корзину</button>
                @endif
            </div>
        </div>
    </div>
</div>
