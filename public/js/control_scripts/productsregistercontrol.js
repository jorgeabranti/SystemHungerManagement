function newTypeProduct() {
    document.getElementById('novoproduto').disabled = true;
    document.getElementById('novotipoproduto').disabled = true;
    document.getElementById('novosabor').disabled = true;
    var tbl = document.getElementById('rowsTypeProduct');
    var markup = "<tr class='even'>" +
            "<td class='col-xs-3'><input type='text' class='form-control' name='nome_tipo_produto' value='' required autofocus></td>" +
            "<td class='col-xs-5'><input type='text' class='form-control' name='descricao_tipo_produto' value='' required autofocus></td>" +
            "<td class='col-xs-2'><input type='checkbox' checked='checked' class='form-control' name='status_tipo_produto' value='1'></td>" +
            "<td class='col-xs-2'>" +
            "<button type='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i></button>" +
            "<button class='btn btn-danger btn-xs' onclick='window.location.reload()'><i class='fa fa-asterisk'></i></button>" +
            "</td>" +
            "</tr>" +
            "<tr class='even'>" +
            "<td class='col-xs-4'>" +
            "<h4>Adicionar Imagem >>></h4>"+
            "</td>" +
            "<td class='col-xs-8'>" +
            "<label for='product_type_image' class='textfile'>Selecionar um arquivo</label>" +
            "<input type='file' name='product_type_image' id='product_type_image' onchange='setfilenametypeproduct()'>" +
            "<span id='file-name'></span>"+
            "</td>" +
            "</tr>";
    $("#rowsTypeProduct").append(markup);
}
;
function setfilenametypeproduct() {
    document.getElementById('file-name').textContent = document.getElementById('product_type_image').files[0].name;
}
;

function setEditTypeProductForm(id_tipo_produto) {
    var $request = $.get('/gettypeproduct', {value: id_tipo_produto}, function (result) {
        //callback function once server has complete request
        $('#rowEditTypeProduct').html(result.html);
    });
    $('#editTypeProductForm').fadeToggle();
}
;

$(document).mouseup(function (e) {
    var container = $("#editTypeProductForm");
    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
        $('#rowEditTypeProduct').html('');
    }
});

$(function () {
    $("#filtrotipoproduto").keyup(function () {
        var index = $(this).parent().index();
        var nth = "#tabletypeproduct td:nth-child(" + (index + 2).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#tabletypeproduct tbody tr").show();
        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });
});
function cancelEditTypeProduct() {
    $('#editTypeProductForm').fadeToggle();
}
//**************************************************************************
function newProduct(id_empresa) {
    document.getElementById('novoproduto').disabled = true;
    document.getElementById('novotipoproduto').disabled = true;
    document.getElementById('novosabor').disabled = true;
    var tbl = document.getElementById('rowsProduct');

    var $request = $.get('/setnewproduct', {value: id_empresa}, function (result) {
        $("#rowsProduct").append(result.html);
    });
}
;

function setfilenameproduct() {
    document.getElementById('file-name').textContent = document.getElementById('product_image').files[0].name;
}
;

function setEditProductForm(id_produto) {
    var $request = $.get('/getproduct', {value: id_produto}, function (result) {
        //callback function once server has complete request
        $('#rowEditProduct').html(result.html);
    });
    $('#editProductForm').fadeToggle();
}
;

$(document).mouseup(function (e) {
    var container = $("#editProductForm");
    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
        $('#rowEditProduct').html('');
    }
});

$(function () {
    $("#filtroproduto").keyup(function () {
        var index = $(this).parent().index();
        var nth = "#tableproducts td:nth-child(" + (index + 3).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#tableproducts tbody tr").show();
        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });
});
function cancelEditProduct() {
    $('#editProductForm').fadeToggle();
}
//**************************************************************************        
function newFlavor(id_empresa) {
    document.getElementById('novoproduto').disabled = true;
    document.getElementById('novotipoproduto').disabled = true;
    document.getElementById('novosabor').disabled = true;
    var tbl = document.getElementById('rowsFlavor');
    var $request = $.get('/setnewflavor', {value: id_empresa}, function (result) {
        $("#rowsFlavor").append(result.html);
    });
}
;

function setEditFlavorForm(id_sabor_produto) {
    var $request = $.get('/getflavor', {value: id_sabor_produto}, function (result) {
        //callback function once server has complete request
        $('#rowEditFlavor').html(result.html);
    });
    $('#editFlavorForm').fadeToggle();
}
;

$(document).mouseup(function (e) {
    var container = $("#editFlavorForm");
    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
        $('#rowEditFlavor').html('');
    }
});

$(function () {
    $("#filtrosabor").keyup(function () {
        var index = $(this).parent().index();
        var nth = "#tableflavors td:nth-child(" + (index + 3).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#tableflavors tbody tr").show();
        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });
});
function cancelEditFlavor() {
    $('#editFlavorForm').fadeToggle();
}        