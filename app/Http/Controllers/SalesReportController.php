<?php

namespace HungerManagement\Http\Controllers;

use Illuminate\Http\Request;
use HungerManagement\Pedidos;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use HungerManagement\Charts\SalesChart;
use Gate;

class SalesReportController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(!Gate::allows('isAdmin') && !Gate::allows('isAttendent')){
            abort(404,"Sorry, You can do this actions");
        }          
        return view('pages/salesreport');
    }

    public function salesMonth(Request $request) {
        $id_empresa = $request->input('id_empresa');
        $periodo  = $request->input('periodo');
        if ($periodo == 1){
            $value = '3 MONTH';
        } else if ($periodo == 2){
            $value = '6 MONTH';
        } else if ($periodo == 3){
            $value = '1 YEAR';
        }
        $pedidos = Pedidos::select(DB::raw('count(1) as quantidade'), DB::raw('DATE_FORMAT(data_pedido, "%Y,%m") as data'))
                ->where('empresas_id_empresa', '=', $id_empresa)
                ->where('status_pedido', '=', 4)
                ->where('data_pedido', '>', DB::raw('DATE_SUB(now(), INTERVAL '.$value.')'))
                ->groupBy('data')
                ->orderBy('data_pedido')
                ->get();
        $arrayQuantidade = null;
        $arrayMes = null;
        foreach ($pedidos as $key => $mes) {
            $arrayQuantidade[$key] = $mes->quantidade;
            if (substr($mes->data, 5) === '01') {
                $arrayMes[$key] = 'Janeiro';
            } else if (substr($mes->data, 5) === '02') {
                $arrayMes[$key] = 'Fevereiro';
            } else if (substr($mes->data, 5) === '03') {
                $arrayMes[$key] = 'Março';
            } else if (substr($mes->data, 5) === '04') {
                $arrayMes[$key] = 'Abril';
            } else if (substr($mes->data, 5) === '05') {
                $arrayMes[$key] = 'Maio';
            } else if (substr($mes->data, 5) === '06') {
                $arrayMes[$key] = 'Junho';
            } else if (substr($mes->data, 5) === '07') {
                $arrayMes[$key] = 'Julho';
            } else if (substr($mes->data, 5) === '08') {
                $arrayMes[$key] = 'Agosto';
            } else if (substr($mes->data, 5) === '09') {
                $arrayMes[$key] = 'Setembro';
            } else if (substr($mes->data, 5) === '10') {
                $arrayMes[$key] = 'Outubro';
            } else if (substr($mes->data, 5) === '11') {
                $arrayMes[$key] = 'Novembro';
            } else if (substr($mes->data, 5) === '12') {
                $arrayMes[$key] = 'Dezembro';
            }
            $result[$key] = '{"quantidade":'.$arrayQuantidade[$key].',"data":"'.$arrayMes[$key].'"}';
        }
        if (is_null($arrayQuantidade) || is_null($arrayMes)) {
            $arrayQuantidade[0] = 0;
            $arrayMes[0] = '';
            $result[0] = '{"quantidade":'.$arrayQuantidade[0].',"data":"'.$arrayMes[0].'"}';
        }
        return $result;
    }

    public function valueSalesMonth(Request $request) {
        $id_empresa = $request->input('id_empresa');
        $periodo  = $request->input('periodo');
        if ($periodo == 1){
            $value = '3 MONTH';
        } else if ($periodo == 2){
            $value = '6 MONTH';
        } else if ($periodo == 3){
            $value = '1 YEAR';
        }        
        $pedidos = Pedidos::select(DB::raw('count(*) as quantidade'), DB::raw('DATE_FORMAT(data_pedido, "%Y,%m") as data'), DB::raw('sum(total_valor_pedido)-sum(taxa_entrega_pedido) as total_vendas'))
                ->where('empresas_id_empresa', '=', $id_empresa)
                ->where('status_pedido', '=', 4)
                ->where('data_pedido', '>', DB::raw('DATE_SUB(now(), INTERVAL '.$value.')'))
                ->groupBy('data')
                ->orderBy('data_pedido')
                ->get();
        $arrayMes = null;
        $arrayTotalVendas = null;
        foreach ($pedidos as $key => $mes) {
            $arrayTotalVendas[$key] = $mes->total_vendas;
            if (substr($mes->data, 5) === '01') {
                $arrayMes[$key] = 'Janeiro';
            } else if (substr($mes->data, 5) === '02') {
                $arrayMes[$key] = 'Fevereiro';
            } else if (substr($mes->data, 5) === '03') {
                $arrayMes[$key] = 'Março';
            } else if (substr($mes->data, 5) === '04') {
                $arrayMes[$key] = 'Abril';
            } else if (substr($mes->data, 5) === '05') {
                $arrayMes[$key] = 'Maio';
            } else if (substr($mes->data, 5) === '06') {
                $arrayMes[$key] = 'Junho';
            } else if (substr($mes->data, 5) === '07') {
                $arrayMes[$key] = 'Julho';
            } else if (substr($mes->data, 5) === '08') {
                $arrayMes[$key] = 'Agosto';
            } else if (substr($mes->data, 5) === '09') {
                $arrayMes[$key] = 'Setembro';
            } else if (substr($mes->data, 5) === '10') {
                $arrayMes[$key] = 'Outubro';
            } else if (substr($mes->data, 5) === '11') {
                $arrayMes[$key] = 'Novembro';
            } else if (substr($mes->data, 5) === '12') {
                $arrayMes[$key] = 'Dezembro';
            }
            $result[$key] = '{"quantidade":'.$arrayTotalVendas[$key].',"data":"'.$arrayMes[$key].'"}';
        }
        if (is_null($arrayTotalVendas) || is_null($arrayMes)) {
            $arrayTotalVendas[0] = 0;
            $arrayMes[0] = '';
            $result[0] = '{"quantidade":'.$arrayTotalVendas[0].',"data":"'.$arrayMes[0].'"}';
        }
        return $result;  
    }

    public function salesServiceChannel(Request $request) {
        $id_empresa = $request->input('id_empresa');
        $periodo  = $request->input('periodo');
        if ($periodo == 1){
            $value = '3 MONTH';
        } else if ($periodo == 2){
            $value = '6 MONTH';
        } else if ($periodo == 3){
            $value = '1 YEAR';
        }         
        $pedidos = Pedidos::select(DB::raw('DATE_FORMAT(data_pedido, "%Y,%m") as data'),
                DB::raw('sum(case when usuarios_id_usuario = -1 then 1 end) as auto_atendimento'),
                DB::raw('sum(case when usuarios_id_usuario >= 1 then 1 end) as manual_atendimento'))
                ->where('empresas_id_empresa', '=', $id_empresa)
                ->where('status_pedido', '=', 4)
                ->where('data_pedido', '>', DB::raw('DATE_SUB(now(), INTERVAL '.$value.')'))
                ->groupBy('data')
                ->orderBy('data_pedido')
                ->get();
        $arrayMes = null;
        $arrayVendasAuto = null;
        $arrayVendasManual = null;
        foreach ($pedidos as $key => $mes) {
            if (!is_null($mes->auto_atendimento)){
                $arrayVendasAuto[$key] = $mes->auto_atendimento;
            } else {
                 $arrayVendasAuto[$key] = 0;
            }
            if (!is_null($mes->manual_atendimento)) {
                $arrayVendasManual[$key] = $mes->manual_atendimento;
            } else {
                $arrayVendasManual[$key] = 0;
            }
            if (substr($mes->data, 5) === '01') {
                $arrayMes[$key] = 'Janeiro';
            } else if (substr($mes->data, 5) === '02') {
                $arrayMes[$key] = 'Fevereiro';
            } else if (substr($mes->data, 5) === '03') {
                $arrayMes[$key] = 'Março';
            } else if (substr($mes->data, 5) === '04') {
                $arrayMes[$key] = 'Abril';
            } else if (substr($mes->data, 5) === '05') {
                $arrayMes[$key] = 'Maio';
            } else if (substr($mes->data, 5) === '06') {
                $arrayMes[$key] = 'Junho';
            } else if (substr($mes->data, 5) === '07') {
                $arrayMes[$key] = 'Julho';
            } else if (substr($mes->data, 5) === '08') {
                $arrayMes[$key] = 'Agosto';
            } else if (substr($mes->data, 5) === '09') {
                $arrayMes[$key] = 'Setembro';
            } else if (substr($mes->data, 5) === '10') {
                $arrayMes[$key] = 'Outubro';
            } else if (substr($mes->data, 5) === '11') {
                $arrayMes[$key] = 'Novembro';
            } else if (substr($mes->data, 5) === '12') {
                $arrayMes[$key] = 'Dezembro';
            }
            $result[$key] = '{"quantidade_auto":'.$arrayVendasAuto[$key].',"quantidade_manual":'.$arrayVendasManual[$key].',"data":"'.$arrayMes[$key].'"}';
        }
        if (is_null($arrayVendasAuto) || is_null($arrayVendasManual) || is_null($arrayMes)) {
            $arrayVendasAuto[0] = 0;
            $arrayVendasManual[0] = 0;
            $arrayMes[0] = '';
            $result[0] = '{"quantidade_auto":'.$arrayVendasAuto[0].',"quantidade_manual":'.$arrayVendasManual[0].',"data":"'.$arrayMes[0].'"}';
        }
        return $result;  
    }

    public function topSalesProduct(Request $request) {
        $id_empresa = $request->input('id_empresa');
        $periodo  = $request->input('periodo');
        if ($periodo == 1){
            $value = '0';
        } else if ($periodo == 2){
            $value = '1';
        } else if ($periodo == 3){
            $value = '2';
        } else if ($periodo == 4){
            $value = '3';
        }
       // Log::info($value);
        $pedidos = Pedidos::select(DB::raw('DATE_FORMAT(data_pedido, "%Y,%m") as data'),
                DB::raw('count(1) as quantidade'),'produtos.nome_produto as nome_produto')
                ->join('pedidos_sabores_produtos','pedidos.id_pedido','=','pedidos_sabores_produtos.pedidos_id_pedido')                
                ->join('produtos','pedidos_sabores_produtos.produtos_id_produto','=','produtos.id_produto')
                ->where('empresas_id_empresa', '=', $id_empresa)
                ->where('pedidos.status_pedido', '=', 4)
                ->where(DB::raw('MONTH(pedidos.data_pedido)'),'=',DB::raw('MONTH(now())-'.$value))
                ->groupBy('data','produtos.nome_produto')
                ->orderBy('data_pedido')
                ->get();
        $arrayMes = null;
        $arrayQuantidade = null;
        $arrayProdutos = null;
        foreach ($pedidos as $key => $mes) {
            $arrayQuantidade[$key] = $mes->quantidade;
            $arrayProdutos[$key] = $mes->nome_produto;
            if (substr($mes->data, 5) === '01') {
                $arrayMes[$key] = 'Janeiro';
            } else if (substr($mes->data, 5) === '02') {
                $arrayMes[$key] = 'Fevereiro';
            } else if (substr($mes->data, 5) === '03') {
                $arrayMes[$key] = 'Março';
            } else if (substr($mes->data, 5) === '04') {
                $arrayMes[$key] = 'Abril';
            } else if (substr($mes->data, 5) === '05') {
                $arrayMes[$key] = 'Maio';
            } else if (substr($mes->data, 5) === '06') {
                $arrayMes[$key] = 'Junho';
            } else if (substr($mes->data, 5) === '07') {
                $arrayMes[$key] = 'Julho';
            } else if (substr($mes->data, 5) === '08') {
                $arrayMes[$key] = 'Agosto';
            } else if (substr($mes->data, 5) === '09') {
                $arrayMes[$key] = 'Setembro';
            } else if (substr($mes->data, 5) === '10') {
                $arrayMes[$key] = 'Outubro';
            } else if (substr($mes->data, 5) === '11') {
                $arrayMes[$key] = 'Novembro';
            } else if (substr($mes->data, 5) === '12') {
                $arrayMes[$key] = 'Dezembro';
            }
            $result[$key] = '{"quantidade":'.$arrayQuantidade[$key].',"produtos":"'.$arrayProdutos[$key].'","data":"'.$arrayMes[$key].'"}';
        }
        if (is_null($arrayQuantidade) || is_null($arrayProdutos) || is_null($arrayMes)) {
            $arrayQuantidade[0] = 0;
            $arrayProdutos[0] = 0;
            $arrayMes[0] = '';
            $result[0] = '{"quantidade":'.$arrayQuantidade[0].',"produtos":"'.$arrayProdutos[0].'","data":"'.$arrayMes[0].'"}';
        }                           
        return $result;
    }    
}