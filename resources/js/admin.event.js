$('.offcanvas-category').click(function(){
    var myOffcanvas = document.getElementById('categoryedit');
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
    if(!$(this).attr('id')) {
        $('input[name="name"]').val('');
        $('input[name="id"]').val(category.length);
        $('option').prop('selected', false);
    } else {
        $('input[name="name"]').val(category[$(this).attr('id')]['name']);
        $('input[name="id"]').val($(this).attr('id'));
        $('option[value="' + category[$(this).attr('id')]['menu'] + '"]').prop('selected', true);
    }
    bsOffcanvas.show();
});

$('input[type="submit"]').click(function() {
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
