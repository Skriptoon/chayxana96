$('.offcanvas-category').click(function(){
    var myOffcanvas = document.getElementById('categoryedit');
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
    if(!$(this).attr('id')) {
        $('input[name="name"]').val('');
        $('input[name="id"]').val(category.length);
        $('option').prop('selected', false);
        $('.btn-delete').addClass('invisible');
    } else {
        $('input[name="name"]').val(category[$(this).attr('id')]['name']);
        $('input[name="id"]').val($(this).attr('id'));
        $('option[value="' + category[$(this).attr('id')]['menu'] + '"]').prop('selected', true);
        $('.btn-delete').removeClass('invisible');
    }
    bsOffcanvas.show();
});

$('.btn-save').click(function() {
    var data = $(this).parent().serialize();
    var elem = $(this);
    $(this).prop("disabled", true)
    $.ajax({
        url: '/ajax/categoryadmin/save',
        type: 'POST',
        cache: false,
        data: data,
        success: function() {
            location.reload();
        },
        error: function(data) {
            elem.prop("disabled", false);
            
            for (var key in data.responseJSON.errors) {
                $('input[name="' + key + '"]').addClass('is-invalid');
                $('input[name="' + key + '"]').parent().children('.invalid-tooltip').text(data.responseJSON.errors[key]);
            }
        }
    });
    return false;
});

$('input[type="text"]').focus(function(){
    $(this).removeClass('is-invalid')
});

$('.btn-delete').click(function() {
    var data = $(this).parent().serialize();
    $(this).prop("disabled", true);
    $.ajax({
        url: '/ajax/categoryadmin/delete',
        type: 'POST',
        cache: false,
        data: data,
        success: function() {
            location.reload();
        }
    });
    return false;
});

/////////////////////////////////////////////////

$('.offcanvas-position').click(function(){
    var myOffcanvas = document.getElementById('positionedit');
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
    if(!$(this).attr('id')) {
        $('input[name="name"]').val('');
        $('input[name="price"]').val('');
        $('label[for="formFile"]').html('Изображение позиции');
        $('textarea[name="desc"]').val('');
        $('input[name="id"]').val(positions.length);
        $('option').prop('selected', false);
        $('.btn-delete-pos').addClass('invisible');
        $('input[name="main_page"]').prop('checked', false);
    } else {
        $('input[name="name"]').val(positions[$(this).attr('id')]['name']);
        $('input[name="price"]').val(positions[$(this).attr('id')]['price']);
        $('label[for="formFile"]').html('<img src="' + positions[$(this).attr('id')]['img'] + '" width="100">');
        $('textarea[name="desc"]').val(positions[$(this).attr('id')]['desc']);
        $('input[name="id"]').val($(this).attr('id'));
        $('option[value="' + positions[$(this).attr('id')]['id_category'] + '"]').prop('selected', true);
        $('.btn-delete-pos').removeClass('invisible');
        if(positions[$(this).attr('id')]['main_page'])
            $('input[name="main_page"]').prop('checked', true);
        else
            $('input[name="main_page"]').prop('checked', false);
    }
    bsOffcanvas.show();
});

$('.btn-delete-pos').click(function() {
    var data = $(this).parent().serialize();
    $(this).prop("disabled", true);
    $.ajax({
        url: '/ajax/positionadmin/delete',
        type: 'POST',
        cache: false,
        data: data,
        success: function() {
            location.reload();
        }
    });
    return false;
});

$('.btn-save-pos').click(function() {
    var file_data = $(this).parent().children("div").children("input[type='file']").prop("files")[0];
	var query = new FormData(document.getElementById($(this).parent().attr("id")));
	query.append('menu_img', file_data);
    var elem = $(this);
    $(this).prop("disabled", true)
    $.ajax({
        url: '/ajax/positionadmin/save',
        type: 'POST',
        cache: false,
        data: query,
        processData : false,
		contentType : false, 
        success: function() {
            location.reload();
        },
        error: function(data) {
            elem.prop("disabled", false);
            
            for (var key in data.responseJSON.errors) {
                $('input[name="' + key + '"]').addClass('is-invalid');
                $('input[name="' + key + '"]').parent().children('.invalid-tooltip').text(data.responseJSON.errors[key]);
            }
        }
    });
    return false;
});