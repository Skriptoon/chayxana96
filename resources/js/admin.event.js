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
    $(this).prop("disabled", true)
    $.ajax({
        url: '/ajax/categoryadmin/save',
        type: 'POST',
        cache: false,
        data: data,
        success: function() {
            location.reload();
        }
    });
    return false;
});
$('.btn-delete').click(function() {
    var data = $(this).parent().serialize();
    $(this).prop("disabled", true)
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
