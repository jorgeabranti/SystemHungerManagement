<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Gate;

class ProductsController extends Controller
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
    
    public function index(){
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can do this actions");
        }            
        return view('pages/registerproducts');
    }

    public function getProduct(){
        $request = Input::get('value');
        //Log::info($request);        
        $produto = Produtos::where('produtos.id_produto','=',$request)
                ->get();
        $html = view('layouts.editProduct',compact('produto'))->render();
       return response()->json(compact('html'));         
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

    public function listaProdutosEmpresa($id_empresa){
        $produtos_empresa = Produtos::join('tipos_produtos','tipos_produtos.id_tipo_produto','=','produtos.tipos_produtos_id_tipo_produto')
                ->where('tipos_produtos.empresas_id_empresa', '=',$id_empresa)
                ->orderBy('produtos.status_produto', 'DESC')
                ->get();
       return view('layouts.productsregisterform', ['produtos_empresa'=>$produtos_empresa]);
    }     
    
    public function produtosEmpresa(){
        $request = Input::get('value');
        $produtos_empresa = Produtos::where('produtos.tipos_produtos_id_tipo_produto', '=',$request)
                ->get();
        $html = view('layouts.requestregisterproducts',compact('produtos_empresa'))->render();
       return response()->json(compact('html'));
    }

    public function produtosEmpresaAtivos(){
        $request = Input::get('value');
        $produtos_empresa = Produtos::where('produtos.tipos_produtos_id_tipo_produto', '=',$request)
                ->where('produtos.status_produto', '=',1)
                ->get();
        $html = view('layouts.requestregisterproducts',compact('produtos_empresa'))->render();
       return response()->json(compact('html'));
    }    
    
    public function saveProduct(Request $request) {
    //    Log::info($status_produto); 
        if (is_null($request['id_produto'])) {
            $produto = new Produtos();
            $produto->nome_produto = $request['nome_produto'];
            $produto->valor_unitario_produto = number_format($request['valor_unitario_produto'], 2);
            $produto->descricao_produto = $request['descricao_produto'];
            $produto->quant_sabores_produto = $request['quant_sabores_produto'];
            $produto->status_produto = isset($request['status_produto']) ? $request['status_produto'] : "0";
            $produto->tipos_produtos_id_tipo_produto = $request['id_tipo_produto'];
            $produto->save();
            $id_produto = $produto->id;
        } else {
            DB::table('produtos')
                    ->where('id_produto', $request['id_produto'])
                    ->update(['nome_produto' => $request['nome_produto'],
                        'valor_unitario_produto' => number_format($request['valor_unitario_produto'], 2),
                        'descricao_produto' => $request['descricao_produto'],
                        'quant_sabores_produto' => $request['quant_sabores_produto'],
                        'status_produto' => isset($request['status_produto']) ? $request['status_produto'] : "0",
                        'tipos_produtos_id_tipo_produto' => $request['id_tipo_produto']]);
            $id_produto = $request['id_produto'];
        }
        if (!is_null($request['product_image'])){
            $destinationPath = public_path('/img/products');
            if (!is_null($request['produto_img'])) {  
                File::delete($destinationPath.'/'.$request['produto_img']);
            }   
            $this->validate($request, [
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('product_image');
            $input['imagename'] = $request['id_empresa'].'_'.$id_produto.'_'.time().'.'.$image->getClientOriginalExtension();
                DB::table('produtos')
                    ->where('id_produto', $id_produto)
                    ->update(['produto_img' => $input['imagename']]);
            $image->move($destinationPath, $input['imagename']);
            //$this->postImage->add($input);
        }         
        return back()->with('success','Successful');  
    }
    
    
    public function getNewProduct(){
        $request = Input::get('value');
        //Log::info($request);        
        $produto = Produtos::where('produtos.id_produto','=',$request)
                ->get();
        $html = view('layouts.editProduct',compact('produto'))->render();
       return response()->json(compact('html'));         
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
     * @param  \HungerManagement\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function show(Produtos $produtos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HungerManagement\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtos $produtos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HungerManagement\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produtos $produtos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HungerManagement\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produtos $produtos)
    {
        //
    }
}
