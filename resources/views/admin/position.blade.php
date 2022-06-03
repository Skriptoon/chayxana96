@extends('layouts.admin.app')

@section('script')
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.ui.touch-punch.min.js"></script>
@endsection

@section('content')
<div class="container">
	<h3>Позиции</h3>
	<button class="btn btn-dark my-2 offcanvas-position">Добавить позицию</button>

	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item" role="presentation">
			<button class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1" aria-selected="true">ЧайХана#96</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">Пан-азиа</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="pills-3-tab" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3" aria-selected="false">Мангал#1</button>
		</li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
			<div class="mt-3 border-top">
				@foreach($categories[0] as $category)
					<div class="border-bottom py-2 str-cat">{{$category->name}}</div>
					<div class="row" id="sortable{{$category->id}}">
					@foreach ($positions[0] as $position)
						@if($position->id_category == $category->id)
						@php
							$position->img = Storage::url($position->img);
						@endphp
						<div class="col-xl-3 my-2 pos-cart offcanvas-position" id="{{$position->id}}">
							<div class="position-relative h-100 p-4 m-1 bg-main pr-info shadow">
								<div class="pr-picture">
									<img src="{{$position->img}}" alt="{{$position->name}}">
								</div>
								<h5 class="pt-3">{{$position->name}}</h5>
								<div class="pr-desc pb-2">
									{{$position->desc}}
								</div>
								<div class="d-flex pr-price" style="height: 40px;">
									<div class="position-absolute price"><h4>{{$position->price}} ₽</h4></div>
								</div>
							</div>
						</div>
						<script>
							if(!positions) var positions = [];
                			positions[{{$position->id}}] = {{ Illuminate\Support\Js::from($position) }};
						</script>
						@endif
					@endforeach
					</div>
					<script>
						if(!catIds) var catIds = [];
						if(!catIds[0]) catIds[0] = [];
						catIds[0].push({{$category->id}});
						$( "#sortable{{$category->id}}" ).sortable({
							update: function( event, ui ) {
								var sortedIDs = [];
								
								for(k = 0; k < catIds.length; k++) {
									var sort = [];
									for(i = 0; i < catIds[k].length; i++) {
										var arr = $( "#sortable" + catIds[k][i]).sortable( "toArray" );
										sort = sort.concat(arr);
									}
									sortedIDs.push(sort);
								}
								$.ajax({
									url: "/ajax/positionadmin/updateSort",
									type: "POST",
									data: 'sort='+JSON.stringify(sortedIDs),
									cache: false,
									headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									}
								});
							}
						});
					</script>
				@endforeach
			</div>
		</div>
		<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
			<div class="mt-3 border-top">
				@foreach($categories[1] as $category)
				<div class="border-bottom py-2 str-cat">{{$category->name}}</div>
				<div class="row" id="sortable{{$category->id}}">
				@foreach ($positions[1] as $position)
					@if($position->id_category == $category->id)
					<div class="col-xl-3 my-2 pos-cart offcanvas-position" id="{{$position->id}}">
						<div class="position-relative h-100 p-4 m-1 bg-main pr-info shadow">
							<div class="pr-picture">
								<img src="{{$position->img}}" alt="{{$position->name}}">
							</div>
							<h5 class="pt-3">{{$position->name}}</h5>
							<div class="pr-desc pb-2">
								{{$position->desc}}
							</div>
							<div class="d-flex pr-price" style="height: 40px;">
								<div class="position-absolute price"><h4>{{$position->price}} ₽</h4></div>
							</div>
						</div>
					</div>
					<script>
						if(!positions) var positions = [];
						positions[{{$position->id}}] = {{ Illuminate\Support\Js::from($position) }};
					</script>
					@endif
				@endforeach
				</div>
				<script>
					if(!catIds) var catIds = [];
					if(!catIds[1]) catIds[1] = [];
					catIds[1].push({{$category->id}});
					$( "#sortable{{$category->id}}" ).sortable({
						update: function( event, ui ) {
							var sortedIDs = [];
							
							for(k = 0; k < catIds.length; k++) {
								var sort = [];
								for(i = 0; i < catIds[k].length; i++) {
									var arr = $( "#sortable" + catIds[k][i]).sortable( "toArray" );
									sort = sort.concat(arr);
								}
								sortedIDs.push(sort);
							}
							$.ajax({
								url: "/ajax/positionadmin/updateSort",
								type: "POST",
								data: 'sort='+JSON.stringify(sortedIDs),
								cache: false,
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								}
							});
						}
					});
				</script>
				@endforeach
			</div>
		</div>
		<div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
			<div class="mt-3 border-top">
				@foreach($categories[2] as $category)
				<div class="border-bottom py-2 str-cat">{{$category->name}}</div>
				<div class="row" id="sortable{{$category->id}}">
				@foreach ($positions[2] as $position)
					@if($position->id_category == $category->id)
					<div class="col-xl-3 my-2 pos-cart offcanvas-position" id="{{$position->id}}">
						<div class="position-relative h-100 p-4 m-1 bg-main pr-info shadow">
							<div class="pr-picture">
								<img src="{{$position->img}}" alt="{{$position->name}}">
							</div>
							<h5 class="pt-3">{{$position->name}}</h5>
							<div class="pr-desc pb-2">
								{{$position->desc}}
							</div>
							<div class="d-flex pr-price" style="height: 40px;">
								<div class="position-absolute price"><h4>{{$position->price}} ₽</h4></div>
							</div>
						</div>
					</div>
					<script>
						if(!positions) var positions = [];
						positions[{{$position->id}}] = {{ Illuminate\Support\Js::from($position) }};
					</script>
					@endif
				@endforeach
				</div>
				<script>
					if(!catIds) var catIds = [];
					if(!catIds[2]) catIds[2] = [];
					catIds[2].push({{$category->id}});
					$( "#sortable{{$category->id}}" ).sortable({
						update: function( event, ui ) {
							var sortedIDs = [];
							
							for(k = 0; k < catIds.length; k++) {
								var sort = [];
								for(i = 0; i < catIds[k].length; i++) {
									var arr = $( "#sortable" + catIds[k][i]).sortable( "toArray" );
									sort = sort.concat(arr);
								}
								sortedIDs.push(sort);
							}
							$.ajax({
								url: "/ajax/positionadmin/updateSort",
								type: "POST",
								data: 'sort='+JSON.stringify(sortedIDs),
								cache: false,
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								}
							});
						}
					});
					
				</script>
			@endforeach
			</div>
		</div>
	</div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="positionedit" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Категория</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="formpos">
            @csrf
            <div class="mb-3">
				<input type="text" name="name" class="form-control" placeholder="Название">
				<div class="invalid-tooltip">
				</div>
			</div>
			<div class="mb-3">
				<label for="formFile" class="form-label">Изображение позиции</label>
				<input class="form-control" type="file" name="img" id="formFile">
			</div>
			<div class="mb-3">
				<input type="text" name="price" class="form-control" placeholder="Цена">
				<div class="invalid-tooltip">
				</div>
			</div>
			<select class="form-select mb-3" name="menu">
				<option disabled>ЧайХана#96</option>
				@foreach($categories[0] as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
				<option disabled>Пан-азиа</option>
				@foreach($categories[1] as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				<option disabled>Мангал#1</option>
				@foreach($categories[2] as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
			</select>
			<div class="mb-3">
				<textarea class="form-control" name="desc" rows="3" placeholder="Опиcание"></textarea>
			</div>
			<div class="form-check mb-4">
				<input class="form-check-input" type="checkbox"  id="flexCheckDefault" name="main_page">
				<label class="form-check-label" for="flexCheckDefault">
					Отображать на главной странице
				</label>
			</div>
            <input class="btn btn-dark btn-save-pos" type="submit" value="Сохранить">
            <input class="btn btn-danger btn-delete-pos" type="button" value="Удалить">
            <input type="hidden" name="id">
        </form>
    </div>
</div>
<script src="/js/app.js"></script>
@endsection
