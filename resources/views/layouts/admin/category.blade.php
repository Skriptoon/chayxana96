<div class="modal fade" id="mod{{$position->id}}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{$position->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form{{$position->id}}">
              <div class="mb-3">
                <input type="text" name="name" class="form-control" value="{{$position->name}}">
              </div>
              <select class="form-select mb-3" name="menu" aria-label="Default select example">
                <option value="1" selected>ЧайХана#96</option>
                <option value="2">Пан-азия</option>
                <option value="3">Мангал#1</option>
              </select>
              <div class="mb-3">
                <input type="text" name="order" class="form-control" aria-describedby="order" value="{{$position->order}}">
                <div id="order" class="form-text">Укажите номер, который задаст порядок отображения категории на сайте</div>
              </div>
              <input type="hidden" name="action" value="edit_cat">
              <input type="hidden" name="id" value="{{$position->id}}">
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-cat-delete" id="{{$position->id}}">Удалить</button>
          <button type="submit" class="btn btn-primary btn-cat-save" form="form{{$position->id}}">Сохранить</button>
        </div>
      </div>
    </div>
  </div>