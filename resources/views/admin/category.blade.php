@extends('layouts.admin.app')

@section('script')
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.ui.touch-punch.min.js"></script>
@endsection

@section('title')
    Редактор категорий
@endsection

@section('content')
<div class="container">
	<h3>Категории</h3>
	<button class="btn btn-dark offcanvas-category">Создать категорию</button>
	<script>
        $( function() {
          $( "#sortable1" ).sortable({
            items: "div:not(.ui-state-disabled)",
            update: function( event, ui ) {
                var sortedIDs = [];
                sortedIDs[0] = $( "#sortable1" ).sortable( "toArray" );
                sortedIDs[1] = $( "#sortable2" ).sortable( "toArray" );
                sortedIDs[2] = $( "#sortable3" ).sortable( "toArray" );
                $.ajax({
                    url: "/ajax/categoryadmin/updateSort",
                    type: "POST",
                    data: 'sort='+JSON.stringify(sortedIDs),
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
          });

          $( "#sortable2" ).sortable({
            items: "div:not(.ui-state-disabled)",
            update: function( event, ui ) {
                var sortedIDs = [];
                sortedIDs[0] = $( "#sortable1" ).sortable( "toArray" );
                sortedIDs[1] = $( "#sortable2" ).sortable( "toArray" );
                sortedIDs[2] = $( "#sortable3" ).sortable( "toArray" );
                $.ajax({
                    url: "/ajax/categoryadmin/updateSort",
                    type: "POST",
                    data: 'sort='+JSON.stringify(sortedIDs),
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
          });

          $( "#sortable3" ).sortable({
            items: "div:not(.ui-state-disabled)",
            update: function( event, ui ) {
                var sortedIDs = [];
                sortedIDs[0] = $( "#sortable1" ).sortable( "toArray" );
                sortedIDs[1] = $( "#sortable2" ).sortable( "toArray" );
                sortedIDs[2] = $( "#sortable3" ).sortable( "toArray" );
                $.ajax({
                    url: "/ajax/categoryadmin/updateSort",
                    type: "POST",
                    data: 'sort='+JSON.stringify(sortedIDs),
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
          });
        });
    </script>
    @for($i = 0; $i < count($categories); $i++)
        @foreach ($categories[$i] as $category)
            <script>
                if(!category) var category = [];
                category[{{$category->id}}] = {{ Illuminate\Support\Js::from($category) }};
            </script>
        @endforeach
    @endfor
    <div class="row">
        <div class="mt-3 border-top col-lg-4" id="sortable1">
            <div class="border-bottom py-2 ui-state-disabled ui-state-default">ЧайХана#96</div>
            @foreach ($categories[0] as $category)
                <div class="border-bottom py-2 ps-3 str-cat offcanvas-category" id="{{$category->id}}">{{$category->name}}</div>
            @endforeach
        </div>
        <div class="mt-3 border-top col-lg-4" id="sortable2">
            <div class="border-bottom py-2 ui-state-disabled ui-state-default">Пан-азия</div>
            @foreach ($categories[1] as $category)
                <div class="border-bottom py-2 ps-3 str-cat offcanvas-category" id="{{$category->id}}">{{$category->name}}</div>
            @endforeach
        </div>
        <div class="mt-3 border-top col-lg-4" id="sortable3">
            <div class="border-bottom py-2 ui-state-disabled ui-state-default">Мангал#1</div>
            @foreach ($categories[2] as $category)
                <div class="border-bottom py-2 ps-3 str-cat offcanvas-category" id="{{$category->id}}">{{$category->name}}</div>
            @endforeach
        </div>
    </div>
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
<script src="/js/app.js"></script>
@endsection
