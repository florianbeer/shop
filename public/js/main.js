$(function() {

	// Calculate price based on quantity for detail view
	$(document).on('keyup', 'input.qty', function() {

		var $priceElement = $(this).parent().next().next().find('.price');
		var qty 					= parseInt($(this).val());
		var price 				= parseFloat($priceElement.data('price')) * qty;

		if (qty > 0) {
			price = price.toFixed(2).toString().replace('.', ',');
		} else {
			price = $priceElement.data('price').toString().replace('.', ',');
		}

		$priceElement.html(price);

	});

	// Initialize Bootstrap tooltip plugin
	$('body [data-toggle="tooltip"]').tooltip();

});


// Alert fade in & out
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
		}, 2000);
}, 200);