function updateCart() {
	var sum = 0;
	prParam.forEach(function(item, i, arr) {
		if(item["amount"]) 
			sum += item["price"] * item["amount"];
	});
	if(sum)
		$(".btn-busket").html("Корзина | " + sum);
	else
		$(".btn-busket").html("Корзина");
}

function updateSum() {
	var sum = 0;
	prParam.forEach(function(item, i, arr) {
		if(item["amount"]) 
			sum += item["price"] * item["amount"];
	});
	$(".pr-sum").html(sum);
}