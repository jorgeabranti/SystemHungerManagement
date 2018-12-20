window.onload = function () {
    document.getElementById("tipos_produtos").disabled = true;
    document.getElementById("produtos").disabled = true;
    document.getElementById("sabores").disabled = true;
    document.getElementById("finalizar_pedido").disabled = true;
};

function loadClient($data_company) {
    var cliente = $('#cliente').val();
    var cliente_telefone = $('#cliente_telefone').val(); 
    if (!cliente){
        var cpf = cliente_telefone.split("cpf:")[1];
    } else if (!cliente_telefone){
        var cpf = cliente.split("cpf:")[1];
    }
    var $request = $.get('/getdataclient', {value: cpf, empresa: $data_company}, function (result)
    {
        $('#data').html(result.html);
        $('#valuedelivery').html(result.client);
        $('#dadospedido').html('');
        $('#dadospedido').html(result.tablerequest);
        document.getElementById("valor").value = decimalToMoney(Number(0).toFixed(2));
        document.getElementById("tipos_produtos").disabled = false;
        document.getElementById("produtos").disabled = false;
        document.getElementById("sabores").disabled = false;
        document.getElementById("finalizar_pedido").disabled = false;
    });
    $('#cliente').val("");
    $('#cliente_telefone').val("");
};

$("#additem").click(function () {
    var p = JSON.parse($("#produtos").val());
    var s = JSON.parse($("#sabores").val());
    var tbl = document.getElementById('tableitens');
    var novoitem = false;
    if (s !== "") {
        if (tbl.rows.length > 1) {
            if ($("#newproduct").is(":checked")) {
                novoitem = true;
            } else {
                for (var i = 1; i < tbl.rows.length; i++) {
                    if (tbl.rows.item(i).getElementsByTagName("input")[0].value.indexOf(p['id_produto']) > -1) {
                        var array_id_sabores = JSON.parse(tbl.rows.item(i).getElementsByTagName("input")[2].value);
                        if (array_id_sabores.length !== p['quant_sabores_produto']) {
                            array_id_sabores.push(s['id_sabor_produto']);
                            tbl.rows.item(i).getElementsByTagName("input")[2].value = JSON.stringify(array_id_sabores);
                            tbl.rows[i].cells[2].innerHTML = tbl.rows[i].cells[2].innerHTML + " - " + s['nome_sabor_produto'];
                            novoitem = false;
                            break;
                        } else {
                            novoitem = true;
                        }
                    } else {
                        novoitem = true;
                    }
                }
            }
            if (novoitem === true) {
                var array_id_sabores = [];
                array_id_sabores.push(s['id_sabor_produto']);               
                var markup = "<tr class='even'><td class='col-xs-1'><input type='hidden' name='rows[" + tbl.rows.length + "][id_produto]' value='" + p['id_produto'] +
                        "' readonly>"+tbl.rows.length  +
                        "</td><td class='col-xs-3'><input type='text' name='rows[" + tbl.rows.length + "][nome_produto]' value='" + p['nome_produto'] +
                        "' readonly></td><td class='col-xs-4'><input type='hidden' name='rows[" + tbl.rows.length + "][id_sabor_produto]' value='[" + array_id_sabores + "]' readonly>" + s['nome_sabor_produto'] +
                        "</td><td class='col-xs-2'>" +decimalToMoney(p['valor_unitario_produto'])+
                        "</td><td class='col-xs-2'>" +
                        "<button type='button' class='btn btn-primary btn-xs' onclick='setEditItemForm(" + tbl.rows.length +","+p['tipos_produtos_id_tipo_produto']+")'><i class='fa fa-pencil'></i></button>" +
                        "<button type='button' class='btn btn-danger btn-xs' onClick='deleteRow(this," + tbl.rows.length + ")' name='status_pedido' value='' title='Excluir Pedido'><i class='fa fa-trash-o'></i></button>" +
                        "</td><input type='hidden' name='rows[" + tbl.rows.length + "][id_item]' value='" + tbl.rows.length + "' readonly></tr>";
                $("#rowstable").append(markup);
                var sum = document.getElementById("valor").value;
                var n = parseFloat(p['valor_unitario_produto'].replace(',','.')) + parseFloat(sum.replace(',','.'));
                document.getElementById("valor").value = decimalToMoney(Number(n).toFixed(2));
            }
        } else {
            var array_id_sabores = [];
            array_id_sabores.push(s['id_sabor_produto']);
            var markup = "<tr class='even'><td class='col-xs-1'><input type='hidden' name='rows[" + tbl.rows.length + "][id_produto]' value='" + p['id_produto'] +
                    "' readonly>"+tbl.rows.length +
                    "</td><td class='col-xs-3'><input type='text' name='rows[" + tbl.rows.length + "][nome_produto]' value='" + p['nome_produto'] +
                    "' readonly></td><td class='col-xs-4'><input type='hidden' name='rows[" + tbl.rows.length + "][id_sabor_produto]' value='[" + array_id_sabores + "]' readonly>" + s['nome_sabor_produto'] +
                    "</td><td class='col-xs-2'>" +decimalToMoney(p['valor_unitario_produto'])+
                    "</td><td class='col-xs-2'>" +
                    "<button type='button' class='btn btn-primary btn-xs' onclick='setEditItemForm("+tbl.rows.length +","+p['tipos_produtos_id_tipo_produto']+")'><i class='fa fa-pencil'></i></button>" +
                    "<button type='button' class='btn btn-danger btn-xs' onClick='deleteRow(this," + tbl.rows.length + ")' name='status_pedido' value='' title='Excluir Pedido'><i class='fa fa-trash-o'></i></button>" +
                    "</td><input type='hidden' name='rows[" + tbl.rows.length + "][id_item]' value='" + tbl.rows.length + "' readonly></tr>";
            $("#rowstable").append(markup);
            var frete = document.getElementById("valorfrete").value;
            var n = parseFloat(p['valor_unitario_produto'].replace(',','.')) + parseFloat(frete.replace(',','.'));
            document.getElementById("valor").value = decimalToMoney(Number(n).toFixed(2));
        }
    }
});

function deleteRow(o, row) {
    if (confirm('Deseja excluir este ítem?')) {
        var tbl = document.getElementById('tableitens');
        if (row > tbl.rows.length) {
            var valorsub = tbl.rows[tbl.rows.length - 1].cells[3].innerHTML;
            var n = parseFloat(document.getElementById("valor").value) - parseFloat(valorsub);
            document.getElementById("valor").value = Number(n).toFixed(2);
        } else if (row < tbl.rows.length) {
            var valorsub = tbl.rows[row].cells[3].innerHTML;
            var n = parseFloat(document.getElementById("valor").value) - parseFloat(valorsub);
            document.getElementById("valor").value = Number(n).toFixed(2);
        } else if (row === tbl.rows.length) {
            var valorsub = tbl.rows[row - 1].cells[3].innerHTML;
            var n = parseFloat(document.getElementById("valor").value) - parseFloat(valorsub);
            document.getElementById("valor").value = Number(n).toFixed(2);
        }
        $(o).closest("tr").remove();
    }
}

function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function decimalToMoney(n, c, d, t)
{
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d === undefined ? "," : d, t = t === undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

$(function () {
    $('#produtos').change(function () {
        var p = JSON.parse($("#produtos").val());
        var $request = $.get('/getflavors', {value: p['tipos_produtos_id_tipo_produto']}, function (result)
        {
            //callback function once server has complete request
            $('#sabores').html(result.html);
        });
    });

    $('#tipos_produtos').change(function () {
        var tp = JSON.parse($("#tipos_produtos").val());
        var $request = $.get('/getproducts', {value: tp['id_tipo_produto']}, function (result)
        {
            //callback function once server has complete request
            $('#produtos').html(result.html);
        });
    });
    
    $('#cliente').focus(function () {
        $('#cliente_telefone').val('');
    });  
    
    $('#cliente_telefone').focus(function () {
        $('#cliente').val('');
    });    
});

function filter() {
    var keyword = document.getElementById("filtro").value;
    var select = document.getElementById("clientes");
    for (var i = 0; i < select.length; i++) {
        var txt = select.options[i].text;
        if (txt.substring(0, keyword.length).toLowerCase() !== keyword.toLowerCase() && keyword.trim() !== "") {
            $(select.options[i]).attr('disabled', 'disabled').hide();
        } else {
            $(select.options[i]).removeAttr('disabled').show();
        }
    }
}

function setEditItemForm(row, id_tipo_produto) {
    var tbl = document.getElementById('tableitens');
    var array_id_sabores = JSON.parse(tbl.rows.item(row).getElementsByTagName("input")[2].value);
    var $request = $.get('/editflavorsitemrequest', {array_id_sabores: array_id_sabores, row: row, id_tipo_produto:  id_tipo_produto}, function (result)
    {    alert('Desculpe, edição em desenvolvimento');      
       // $('#rowEdiItem').html(result.html);
    });
   // $('#editItemForm').fadeToggle();
}
;

$(document).mouseup(function (e) {
    var container = $("#editItemForm");
    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
        $('#rowEdiItem').html('');
    }
});