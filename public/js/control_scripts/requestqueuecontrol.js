$(function () {
    $('#entregadores').change(function () {
        var e = JSON.parse($(this).val());
        $('#data').html('<input type="hidden" name="id_entregador" value="' + e['id_entregador'] + '">Nome Entregador: ' + e['nome_entregador'] +
                '<br> - Placa Veic:' + e['placa_entregador'] +
                '<br> - Cpf: ' + e['cpf_entregador']
                ); // selector for div
        $("#id_entregador").prop('value', e['id_entregador']);
    });
});
var reloadAbilities = function () {
    if (document.getElementById('hidden_row').value === "0") {
        var $request = $.get('/updateAbility', {}, function (result) {
            //callback function once server has complete request
            if (document.getElementById('hidden_row').value === "0") {
                $('#abilityListContainer').html(result.html);
            }
        });
    } else {
        setTimeout(function () {
            document.getElementById('hidden_row').value = "0";
        }, 20000);
    }
};
var auto_refresh = setInterval(
        function () {
            if (document.getElementById("filtro").value === "") {
                reloadAbilities();
            }
        }, 10000);

$(function () {
    $("#filtro").keyup(function () {
        var index = $(this).parent().index();
        var nth = "#filapedidos td:nth-child(" + (index + 3).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#filapedidos tbody tr").show();
        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });

    /*
     $("#filtro").blur(function () {
     $(this).val("");
     });
     */
});

function show_hide_row(row) {
    if (row.style.display === "none") {
        row.style.display = "";
        document.getElementById('hidden_row').value = "1";
    } else {
        row.style.display = "none";
        document.getElementById('hidden_row').value = "0";
    }
}

function setDeliveryman(id_pedido) {
    $('#deliverymanForm').fadeToggle();
    document.getElementById('formentregador').action = "/updatedeliveryman/" + id_pedido;
}

$(document).mouseup(function (e) {
    var container = $("#deliverymanForm");
    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
    }
});

function alertPostDelivery(id_pedido) { 
    var $request = $.get('/alertpostdelivery', {id_pedido: id_pedido}, function (result) {
         alert('Alerta de envio para o '+id_pedido+' enviado com sucesso!!!');
    });      
};

function alertDeliveryMan() {
    alert('Por favor defina um entregador!');
    return false;
} 