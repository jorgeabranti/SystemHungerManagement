$("input[id*='cpf_entregador']").inputmask({
    mask: ['999.999.999-99'/*, '99.999.999/9999-99'*/],
    keepStatic: true
});

$("input[id*='placa_entregador']").inputmask({
    mask: ['AAA-9999'],
    keepStatic: true
});

function updateDeliveryMan(id_entregador) {
    var $request = $.get('/getdeliveryman', {value: id_entregador}, function (result) {
        //callback function once server has complete request
        $('#deliveryData').html(result.html);
    });
}