$(function() {

	$(document).on('change', 'select.stock-control', function () {
		this.form.submit();
	});
	
	$(document).on('keyup', 'input.qty', function() {

		var $priceElement = $(this).parent().next().next().find('.price');
		var qty 					= parseInt($(this).val());
		var price 				= parseFloat($priceElement.data('price')) * qty;

		if (qty > 0) {
			price = price.toFixed(2).toString().replace('.', ',');
		} else {
			price = $priceElement.data('price').toString().replace('.', ',');
		}

		$priceElement.html(price + ' €');

	});

	$('body [data-toggle="tooltip"]').tooltip();

});

function showAlert(){
  $("#alert-message").addClass('in');
}

function removeAlert(){
  $("#alert-message").removeClass('in').delay(500).hide(1, function () {
    $(this).remove();
	});
}

window.setTimeout(function () {
    showAlert();
		window.setTimeout(function () {
		    removeAlert();
		}, 3000);
}, 200);