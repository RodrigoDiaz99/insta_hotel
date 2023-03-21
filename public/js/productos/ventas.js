$('.detallesTableVenta').on('click', '.addProduct', function () {
    $('#productRowVenta').clone().find("input,textarea").val("").end().find('.removeProduct').removeAttr('disabled').end().find('.subtotal').text('0.00').end().appendTo('.detallesTableVenta');
});

$('#detallesTableVenta').on('click', '.removeProduct', function () {
    $(this).parents('#productRowVenta').remove();
});


$('.detallesTableVenta').on('keyup change', '.cantidad_venta, .precio_unitario', function () {
    var cantidad = $(this).parents('#productRowVenta').find('.cantidad_venta').val();
    var precio = $(this).parents('#productRowVenta').find('.precio_unitario').val();
    var subtotal = cantidad * precio;
    $(this).parents('#productRowVenta').find('.subtotal').text(subtotal)
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
