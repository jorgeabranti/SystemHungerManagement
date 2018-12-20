window.onload = function () {
    valueSalesMonth();
    salesMonth();
    salesServiceChannel();
    topSalesProduct();
};
$(function () {
    $('#valueSalesMonth').change(function () {
        valueSalesMonth();
    });
    $('#salesMonth').change(function () {
        salesMonth();
    });
    $('#salesServiceChannel').change(function () {
        salesServiceChannel();
    });
    $('#topSalesProduct').change(function () {
        topSalesProduct();
    });
});

function valueSalesMonth() {
    $('#canvas_container_bar-3').html('');
    $('#canvas_container_bar-3').html('<canvas id="bar-graph-3" width="auto" height="auto"></canvas>');
    $.getJSON("/getvaluesalesmonth", {id_empresa: document.getElementById("id_empresa").value, periodo: $("#valueSalesMonth").val()}, function (result) {
        var labels = [], data = [];
        for (var i = 0; i < result.length; i++) {
            var convert = JSON.parse(result[i]);
            labels.push(convert.data);
            data.push(convert.quantidade);
        }
        var data = {
            labels: labels,
            datasets: [
                {
                    label: "Valor R$",
                    data: data,
                    fill: false,
                    backgroundColor: "#0c6f95"
                }
            ]
        };
        var bar = document.getElementById('bar-graph-3').getContext('2d');
        var chartInstance = new Chart(bar, {
            type: 'bar',
            data: data,
            options: {
                legend: {
                    display: true
                }
            }
        });
    });
}
/*
function valueSalesMonth() {
    $('#canvas_container_line-1').html('');
    $('#canvas_container_line-1').html('<canvas id="line-graph-1" width="auto" height="auto"></canvas>');
    $.getJSON("/getvaluesalesmonth", {id_empresa: document.getElementById("id_empresa").value, periodo: $("#valueSalesMonth").val()}, function (result) {
        var labels = [], data = [];
        for (var i = 0; i < result.length; i++) {
            var convert = JSON.parse(result[i]);
            labels.push(convert.data);
            data.push(convert.quantidade);
        }
        var data = {
            labels: labels,
            datasets: [
                {
                    label: "Valor R$",
                    data: data,
                    fill: false,
                    lineTension: 0.1,
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    pointHitRadius: 10
                }
            ]
        };
        var line = document.getElementById('line-graph-1').getContext('2d');
        var chartInstance = new Chart(line, {
            type: 'line',
            data: data,
            options: {
                legend: {
                    display: true
                }
            }
        });
    });
}
*/
function salesMonth() {
    $('#canvas_container_bar-1').html('');
    $('#canvas_container_bar-1').html('<canvas id="bar-graph-1" width="auto" height="auto"></canvas>');
    $.getJSON("/getsalesmonth", {id_empresa: document.getElementById("id_empresa").value, periodo: $("#salesMonth").val()}, function (result) {
        var labels = [], data = [];
        for (var i = 0; i < result.length; i++) {
            var convert = JSON.parse(result[i]);
            labels.push(convert.data);
            data.push(convert.quantidade);
        }
        var data = {
            labels: labels,
            datasets: [
                {
                    label: "Quantidade",
                    data: data,
                    fill: false,
                    backgroundColor: "#1cb2ec"
                }
            ]
        };
        var bar = document.getElementById('bar-graph-1').getContext('2d');
        var chartInstance = new Chart(bar, {
            type: 'horizontalBar',
            data: data,
            options: {
                legend: {
                    display: true
                }
            }
        });
    });
}

function salesServiceChannel() {
    $('#canvas_container_bar-2').html('');
    $('#canvas_container_bar-2').html('<canvas id="bar-graph-2" width="auto" height="auto"></canvas>');
    $.getJSON("/getsalesservicechannel", {id_empresa: document.getElementById("id_empresa").value, periodo: $("#salesServiceChannel").val()}, function (result) {
        var labels = [], data = [], data2 = [];
        for (var i = 0; i < result.length; i++) {
            var convert = JSON.parse(result[i]);
            labels.push(convert.data);
            data.push(convert.quantidade_auto);
            data2.push(convert.quantidade_manual);
        }
        var data = {
            labels: labels,
            datasets: [
                {
                    label: "Quantidade ATM",
                    data: data,
                    fill: false,
                    backgroundColor: "#adc5f9"
                },
                {
                    label: "Quantidade Manual",
                    data: data2,
                    fill: false,
                    backgroundColor: "#f6ea9d"
                }
            ]
        };
        var bar = document.getElementById('bar-graph-2').getContext('2d');
        var chartInstance = new Chart(bar, {
            type: 'bar',
            data: data,
            options: {
                legend: {
                    display: true
                }
            }
        });
    });
}

function topSalesProduct() {
    $('#canvas_container_pie-1').html('');
    $('#canvas_container_pie-1').html('<canvas id="pie-graph-1" width="auto" height="auto"></canvas>');
    $.getJSON("/gettopsalesproduct", {id_empresa: document.getElementById("id_empresa").value, periodo: $("#topSalesProduct").val()}, function (result) {
        var labels = [], data = [], data2 = null;
        for (var i = 0; i < result.length; i++) {
            var convert = JSON.parse(result[i]);
            labels.push(convert.produtos);
            data.push(convert.quantidade);
            data2 = convert.data;
        }
        var data = {
            labels: labels,
            datasets: [
                {
                    label: "Produtos Mais Vendidos",
                    data: data,
                    backgroundColor: ['#0ab4c8', '#00b0ff', '#ff9b4f', '#c0d6e4', '#afd7b4', '#c0c0c0']
                }
            ]
        };
        var pie = document.getElementById('pie-graph-1').getContext('2d');
        var chartInstance = new Chart(pie, {
            type: 'pie',
            data: data
        });
    });
}   