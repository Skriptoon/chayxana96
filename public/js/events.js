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
		if($(this).hasClass('cart')) {
			$("#" + $(this).attr("id") +".cart-info").remove();
		} else {
			$(this).parent().html('<button class="btn btn-main btn-inbusket" id="' + Number($(this).attr("id")) + '">В корзину</button>');
		}

	} else {
		if($(this).hasClass('cart')) {
			$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"] - 1);
			$("#" + $(this).attr("id") +".pr-price").html((prParam[Number($(this).attr("id"))]["amount"] - 1) * prParam[Number($(this).attr("id"))]["price"] + "&#8381;");
		} else {
			$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"] - 1);
		}
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
	if($(this).hasClass('cart')) {
		updateSum();
	} else {
		updateCart();
	}
});

$("body").on("click", ".btn-plus", function() {
	prParam[Number($(this).attr("id"))]["amount"]++
	if($(this).hasClass('cart')) {
		$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"]);
		$("#" + $(this).attr("id") +".pr-price").html(prParam[Number($(this).attr("id"))]["amount"] * prParam[Number($(this).attr("id"))]["price"] + "&#8381;");
	} else {
		$("#" + $(this).attr("id") +".pr-amount").html(prParam[Number($(this).attr("id"))]["amount"]);
	}
	$.ajax({
		url: "/ajax/session/set",
		type: "POST",
		data: "amount=" + prParam[Number($(this).attr("id"))]["amount"] + "&id=" + Number($(this).attr("id")),
		cache: false,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	if($(this).hasClass('cart')) {
		updateSum();
	} else {
		updateCart();
	}
});

$.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
$("input[type='tel']").mask("+7 (h99) 999-99-99");

$("input[name='paydelivery']").click(function() {
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
	/*$.ajax({
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
	});*/
	$.ajax({
		url: 'https://paymaster.ru/api/v2/invoices',
		type: 'POST',
		headers: {
			"Authorization": "Bearer 2a17d9f5ff12d8147dad6f5567eecbbde0c92923895f5ceec747a7a556b4a5cd4566c44ce44ddbaa29d0b77ba1458d155f7d",
			"Content-type": "application/json"
		},
		data: '{\
			"merchantId": "cf128151-127b-44ed-bde5-26c531cad20d",\
			"invoice": {\
			  "description": "test payment",\
			  "params": {\
				"BT_USR": "34"\
			  }\
			},\
			"amount": {\
			  "value": 10.50,\
			  "currency": "RUB"\
			},\
			"paymentMethod": "BankCard"   \
		  }'
	})
	return false;
});
