$("body").on("click", ".btn-inbusket", function() {
	var elem = $(this).parent();
	//menu[menu.length] = Number($(this).attr("id"));
	prParam[Number($(this).attr("id"))]["amount"]++
	elem.html('<button class="btn btn-main btn-count btn-minus" id="' + Number($(this).attr("id")) + '">-</button>\
	<span class="px-2 pr-amount" id="' + Number($(this).attr("id")) + '"> 1 </span>\
	<button class="btn btn-main btn-count btn-plus" id="' + Number($(this).attr("id")) + '">+</button>');
	updateCart();
	$.ajax({
		url: "/ajax/session/set",
		type: "POST",
		data: "amount=" + prParam[Number($(this).attr("id"))]["amount"] + "&id=" + Number($(this).attr("id")),
		cache: false,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});

$("body").on("click", ".btn-minus", function() {
	if(prParam[Number($(this).attr("id"))]["amount"] == 1) {
		$(this).parent().html('<button class="btn btn-main btn-inbusket" id="' + Number($(this).attr("id")) + '">В корзину</button>');
	} else {
		$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"] - 1);
	}
	prParam[Number($(this).attr("id"))]["amount"]--
	$.ajax({
		url: "/ajax/session/set",
		type: "POST",
		data: "amount=" + prParam[Number($(this).attr("id"))]["amount"] + "&id=" + Number($(this).attr("id")),
		cache: false,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	updateCart();
});

$("body").on("click", ".btn-plus", function() {
	prParam[Number($(this).attr("id"))]["amount"]++
	$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"]);
	$.ajax({
		url: "/ajax/session/set",
		type: "POST",
		data: "amount=" + prParam[Number($(this).attr("id"))]["amount"] + "&id=" + Number($(this).attr("id")),
		cache: false,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	updateCart();
});

$("body").on("click", ".btn-minus-cart", function() {
	if(prParam[Number($(this).attr("id"))]["amount"] == 1) {
		$("#" + $(this).attr("id") +".cart-info").remove();
	} else {
		$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"] - 1);
		$("#" + $(this).attr("id") +".pr-price").html((prParam[Number($(this).attr("id"))]["amount"] - 1) * prParam[Number($(this).attr("id"))]["price"] + "&#8381;");
	}
	prParam[Number($(this).attr("id"))]["amount"]--
	$.ajax({
		url: "./ajax/amount.php",
		type: "POST",
		data: "amount=" + prParam[Number($(this).attr("id"))]["amount"] + "&id=" + Number($(this).attr("id")),
		cache: false
	});
	updateSum();
});

$("body").on("click", ".btn-plus-cart", function() {
	prParam[Number($(this).attr("id"))]["amount"]++
	$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"]);
	$("#" + $(this).attr("id") +".pr-price").html(prParam[Number($(this).attr("id"))]["amount"] * prParam[Number($(this).attr("id"))]["price"] + "&#8381;");
	$.ajax({
		url: "./ajax/amount.php",
		type: "POST",
		data: "amount=" + prParam[Number($(this).attr("id"))]["amount"] + "&id=" + Number($(this).attr("id")),
		cache: false
	});
	updateSum();
});

$.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
$("input[type='tel']").mask("+7 (h99) 999-99-99");

$("input[name='paydelivery'").click(function() {
	if($(this).val() == 3)
		$(".change").css("display", "flex");
	else
		$(".change").css("display", "none");
});

$(".btn-order").click(function() {
	var elem = $(this);
	elem.parent().children("div").children("input[name='name']").removeClass("is-invalid");
	elem.parent().children("div").children("input[name='phone']").removeClass("is-invalid");
	elem.parent().children("div").children("input[name='street']").removeClass("is-invalid");
	elem.parent().children("div").children("input[name='house']").removeClass("is-invalid");
	$("input[name='change']").removeClass("is-invalid");
	$.ajax({
		url: "../ajax/order.php",
		type: "POST",
		data: $(this).parent().serialize(),
		cache: false,
		success: function(data){
			if(data) {
				var errors = JSON.parse(data);
				if(errors[1] == 1) {
					elem.parent().children("div").children("input[name='name']").addClass("is-invalid");
				}
				if(errors[2] == 1) {
					elem.parent().children("div").children("input[name='phone']").addClass("is-invalid");
				}
				if(errors[3] == 1) {
					elem.parent().children("div").children("input[name='street']").addClass("is-invalid");
				}
				if(errors[4] == 1) {
					elem.parent().children("div").children("input[name='house']").addClass("is-invalid");
				}
				if(errors[5] == 1) {
					$("input[name='change']").addClass("is-invalid");
				}
			}
		}
	});
	return false;
});