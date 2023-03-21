$('.detallesTable').on('click', '.addProduct', function () {
    $('#productRow').clone().find("input,textarea").val("").end().find('.removeProduct').removeAttr('disabled').end().find('.subtotal').text('0.00').end().appendTo('.detallesTable');
});

$('#detallesTable').on('click', '.removeProduct', function () {
    $(this).parents('#productRow').remove();
});


$('.detallesTable').on('keyup change', '.cantidad, .precio_unitario', function () {
    var cantidad = $(this).parents('#productRow').find('.cantidad').val();
    var precio = $(this).parents('#productRow').find('.precio_unitario').val();
    var subtotal = cantidad * precio;
    $(this).parents('#productRow').find('.subtotal').text(subtotal)
    sumIt();

});

function sumIt() {
    var total = 0, val;
    $('.subtotal').each(function () {
        val = parseFloat($(this).text());
        val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
        total += val;
        $('#total').text(total);
    });
}
