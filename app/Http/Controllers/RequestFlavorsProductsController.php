<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\PedidosSaboresProdutos;
use HungerManagement\SaboresProdutos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RequestFlavorsProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }    
    
    public function index()
    {
        //
    }
    public function itensPedido($id_pedido){
       $itens_pedido = PedidosSaboresProdutos::where('pedidos_sabores_produtos.pedidos_id_pedido', '=',$id_pedido)
               ->join('produtos','produtos.id_produto','=','pedidos_sabores_produtos.produtos_id_produto')
               ->groupBy('pedidos_sabores_produtos.id_item')
               ->get();
      return view('layouts.requestqueuetable',['itens_pedido' => $itens_pedido]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function getFlavorsRequest() {
        $request = Input::get('value');         
        $sabores = SaboresProdutos::where('sabores_produtos.tipos_produtos_id_tipo_produto', '=',$request)
                ->where('sabores_produtos.status_sabor_produto', '=',1)
                ->get();
        $html = view('layouts.requestregisterflavors', compact('sabores'))->render();
        return response()->json(compact('html'));
    }    
}
