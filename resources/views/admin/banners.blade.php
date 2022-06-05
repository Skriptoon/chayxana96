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
    <button class="btn btn-dark my-2" data-bs-toggle="modal" data-bs-target="#modnew">Добавить банер</button>
    <div class="modal fade" id="modnew" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить банер</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Изображение</label>
                            <input class="form-control" type="file" name="img" id="formFile">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="header" class="form-control" placeholder="Заголовок">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="text" rows="3" placeholder="Текст"></textarea>
                        </div>
                        <input type="hidden" name="action" value="add_baner">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-pos-add" form="form">Добавить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3 border-top">
        @foreach($banners as $banner)
            <div class="border-bottom py-2"><img src="{{$banner->img}}" width="400"></div>
        @endforeach
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="categoryedit" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">Категория</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="formnew">
                @csrf
                <div class="mb-3 position-relative">
                    <input type="text" name="name" class="form-control" placeholder="Название">
                    <div class="invalid-tooltip">
                    </div>
                </div>
                <select class="form-select mb-3" name="menu" aria-label="Default select example">
                    <option value="1">ЧайХана#96</option>
                    <option value="2">Пан-азия</option>
                    <option value="3">Мангал#1</option>
                </select>
                <input class="btn btn-dark btn-save" type="submit" value="Сохранить">
                <input class="btn btn-danger btn-delete" type="button" value="Удалить">
                <input type="hidden" name="id">
            </form>
        </div>
    </div>
</div>
@endsection
