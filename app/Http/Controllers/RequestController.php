<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\Pedidos;
use HungerManagement\PedidosSaboresProdutos;
use HungerManagement\PagamentosPedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Gate;

class RequestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        if(!Gate::allows('isAdmin') && !Gate::allows('isAttendent')){
            abort(404,"Sorry, You can do this actions");
        }                    
        return view('pages/registerrequests');
    }    
    public function getRequestsCompany($empresas_id_empresa) {    
        $pedidos = Pedidos::where('pedidos.empresas_id_empresa', '=', $empresas_id_empresa)
                ->where('pedidos.status_pedido', '<', 4)
                ->join('clientes', 'clientes.id_cliente', '=', 'pedidos.clientes_id_cliente')
                ->orderBy('id_pedido')
                ->get();
        return view('layouts.requestqueuetable', ['pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRequestStatus(Request $request, $id_pedido) {
        $status = $request->input('status_pedido');
        DB::table('pedidos')
                ->where('id_pedido', $id_pedido)
                ->update(['status_pedido' => $status,'data_ultimo_status_pedido'=> DB::raw('now()')]);
        return redirect()->route('home')->with('success', 'Status Alterado');
    }

    public function updateRequestDeliveryman(Request $request, $id_pedido) {
        $id_entregador = $request->input('id_entregador');
     //   Log::info($id_entregador);  
     //   Log::info($id_pedido);  
        DB::table('pedidos')
                ->where('id_pedido', $id_pedido)
                ->update(['entregadores_id_entregador' => $id_entregador]);
        return redirect()->route('home')->with('success', 'Entregador Definido');
    }    
    
    public function saveRequest(Request $request) {
        /*  $this->validate(request(),[
          //put fields to be validated here]);*/  
        $pagamento_pedido = new PagamentosPedidos();
        $pagamento_pedido->data_pagamento_pedido = DB::raw('now()');
        $pagamento_pedido->valor_pago = floatval ($request['total_valor_pedido']);
        $pagamento_pedido->bandeira_cartao = null;
        $pagamento_pedido->id_transacao = null;
        $pagamento_pedido->formas_pagamento_empresa_id_forma_pagamento_empresa = $request['forma_pagamento'];
        $pagamento_pedido->save();
        $id_pagamento_pedido = $pagamento_pedido->id;
        
        $pedido = new Pedidos();
        $pedido->status_pedido = 1;
        $pedido->taxa_entrega_pedido = $request['taxa_entrega_pedido'];
        $pedido->data_pedido = DB::raw('now()');
        $pedido->data_ultimo_status_pedido = DB::raw('now()');
        $pedido->total_valor_pedido = floatval ($request['total_valor_pedido']);
        $pedido->usuarios_id_usuario = 1;
        $pedido->clientes_id_cliente = $request['id_cliente'];
        $pedido->pagamento_pedido_id_pagamento_pedido = $id_pagamento_pedido;
        $pedido->empresas_id_empresa = $request['id_empresa'];
        $pedido->save();
        $id_pedido = $pedido->id;
 
        foreach ($request['rows'] as $itens) {
            foreach (json_decode($itens['id_sabor_produto']) as $id_sabore) {
                $pedidos_sabores_produtos = new PedidosSaboresProdutos();
                $pedidos_sabores_produtos->sabores_produtos_id_sabor_produto = $id_sabore;
                $pedidos_sabores_produtos->produtos_id_produto = $itens['id_produto'];
                $pedidos_sabores_produtos->pedidos_id_pedido = $id_pedido;
                $pedidos_sabores_produtos->id_item = $itens['id_item'];
                $pedidos_sabores_produtos->save();                
            }
        }
        return redirect('/registerrequests');
    }

    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function updateRequestQueue() {
        // use this if you need to retrieve your variable
        $request = Input::get('value');
        //render and return the 'container' blade view
        $html = view('layouts.requestqueuetable', compact('view'))->render();
        return response()->json(compact('html'));
    }

    public function getFlavorsItem() {
        // use this if you need to retrieve your variable
        $array_id_sabores = Input::get('array_id_sabores');
        $row = Input::get('row'); 
        $id_tipo_produto = Input::get('id_tipo_produto');
        $html = view('layouts.editFlavorsItemRequest', compact('array_id_sabores', 'row', 'id_empresa', 'id_tipo_produto'))->render();
        return response()->json(compact('html'));
    }

    public function getValueKm() {
        // use this if you need to retrieve your variable
        $valor_km = Input::get('valor_km');
        $pedidos = Pedidos::where('pedidos.empresas_id_empresa', '=', $empresas_id_empresa)
                ->where('pedidos.status_pedido', '<', 4)
                ->join('clientes', 'clientes.id_cliente', '=', 'pedidos.clientes_id_cliente')
                ->orderBy('id_pedido')
                ->get();
        return view('layouts.requestqueuetable', ['pedidos' => $pedidos]);
    }     
}
