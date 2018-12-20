<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\SaboresProdutos;
use HungerManagement\PedidosSaboresProdutos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class FlavorsProductsController extends Controller
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
    
    public function index() {
  
    }    
    public function getFlavor() {    
        $request = Input::get('value');
        $sabor_produto = SaboresProdutos::where('sabores_produtos.id_sabor_produto','=',$request)
                ->get();
        $html = view('layouts.editFlavor',compact('sabor_produto'))->render();
       return response()->json(compact('html'));   
    }
    
    public function saborProduto($id_sabor_produto) {
        $sabor_produto = SaboresProdutos::where('sabores_produtos.id_sabor_produto','=',$id_sabor_produto)
                ->first();
      //   Log::info($sabor_produto);
      return view('layouts.editflavorsitemrequest',['sabor_produto' => $sabor_produto]);   
    }
    
    public function saborProdutoPedido($id_pedido, $id_item){
      // Log::info($id_pedido);  
       $sabor_produto = PedidosSaboresProdutos::where('pedidos_sabores_produtos.pedidos_id_pedido', '=',$id_pedido)
               ->where('pedidos_sabores_produtos.id_item', '=',$id_item)
               ->join('sabores_produtos','sabores_produtos.id_sabor_produto','=','pedidos_sabores_produtos.sabores_produtos_id_sabor_produto')
                ->get();
      return view('layouts.requestqueuetable',['sabor_produto' => $sabor_produto]);
    }
    
    public function saboresTipoProduto($id_tipo_produto){
       $sabor_produto = SaboresProdutos::where('sabores_produtos.tipos_produtos_id_tipo_produto', '=',$id_tipo_produto)
                ->get();
      return view('layouts.requestqueuetable',['sabor_produto' => $sabor_produto]);
    }
      
    public function listaSaboresProdutosEmpresa($id_empresa){
        $sabores_produtos = SaboresProdutos::join('tipos_produtos','tipos_produtos.id_tipo_produto','=','sabores_produtos.tipos_produtos_id_tipo_produto')
                ->where('tipos_produtos.empresas_id_empresa', '=',$id_empresa)
                ->orderBy('sabores_produtos.status_sabor_produto', 'DESC')
                ->get();
       return view('layouts.productsregisterform', ['sabores_produtos'=>$sabores_produtos]);
    }
    
    public function saveflavor(Request $request) {
        if (is_null($request['id_sabor_produto'])) {
            $sabor_produto = new SaboresProdutos();
            $sabor_produto->nome_sabor_produto = $request['nome_sabor_produto'];
            $sabor_produto->descricao_sabor_produto = $request['descricao_sabor_produto'];
            $sabor_produto->status_sabor_produto = isset($request['status_sabor_produto']) ? $request['status_sabor_produto'] : "0";
            $sabor_produto->tipos_produtos_id_tipo_produto = $request['id_tipo_produto'];
            $sabor_produto->save();
        } else {
            DB::table('sabores_produtos')
                    ->where('id_sabor_produto', $request['id_sabor_produto'])
                    ->update(['nome_sabor_produto' => $request['nome_sabor_produto'],
                        'descricao_sabor_produto' => $request['descricao_sabor_produto'],
                        'status_sabor_produto' => isset($request['status_sabor_produto']) ? $request['status_sabor_produto'] : "0",
                        'tipos_produtos_id_tipo_produto' => $request['id_tipo_produto']]);
        }
        return redirect('/registerproducts');    
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
}
