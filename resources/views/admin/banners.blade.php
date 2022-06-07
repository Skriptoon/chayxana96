@extends('layouts.admin.app')

@section('script')
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.ui.touch-punch.min.js"></script>
@endsection

@section('title')
    Редактор банеров
@endsection

@section('content')
<div class="container">
    <button class="btn btn-dark my-2 offcanvas-banner">Добавить банер</button>
    <div class="mt-3 border-top">
        @foreach($banners as $banner)
            <div class="border-bottom py-2 offcanvas-banner" id="{{$banner->id}}"><img src="{{Storage::url($banner->img)}}" width="400"></div>
            <script>
                if(!banner) var banner = [];
                banner[{{$banner->id}}] = {{ Illuminate\Support\Js::from($banner) }};
                banner[{{$banner->id}}]['img'] = '{{Storage::url($banner->img)}}';
            </script>
        @endforeach
    </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="banneredit" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Банер</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="formnew">
            @csrf
            <div class="mb-3 position-relative">
                <input type="text" name="header" class="form-control" placeholder="Заголовок">
                <div class="invalid-tooltip">
                </div>
            </div>
            <div class="mb-3 position-relative">
                <input type="text" name="text" class="form-control" placeholder="Текст">
                <div class="invalid-tooltip">
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Изображение позиции</label>
                <input class="form-control" type="file" name="img" id="formFile">
            </div>
            <input class="btn btn-dark btn-save-banner" type="submit" value="Сохранить">
            <input class="btn btn-danger btn-delete-banner" type="button" value="Удалить">
            <input type="hidden" name="id">
        </form>
    </div>
</div>
<script src="/js/app.js"></script>
@endsection
