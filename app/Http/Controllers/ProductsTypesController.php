<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\TiposProdutos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductsTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    
        
    }    
    public function getTypeProduct(){    
        $request = Input::get('value');
       // Log::info($request);        
        $tipo_produto = TiposProdutos::where('tipos_produtos.id_tipo_produto','=',$request)
                ->get();
        $html = view('layouts.editTypeProduct',compact('tipo_produto'))->render();
       return response()->json(compact('html'));   
    }

    public function tiposProdutosEmpresa($id_empresa){
       $produtos_empresa = TiposProdutos::where('tipos_produtos.empresas_id_empresa', '=',$id_empresa)
                ->orderBy('tipos_produtos.status_tipo_produto', 'DESC')
                ->get();
      return view('layouts.requestregisterform',['tipos_produtos_empresa' => $produtos_empresa]);
    }
    
    public function tiposProdutosEmpresaAtivos($id_empresa){
       $produtos_empresa = TiposProdutos::where('tipos_produtos.empresas_id_empresa', '=',$id_empresa)
                ->where('tipos_produtos.status_tipo_produto','=', 1)
                ->get();
      return view('layouts.requestregisterform',['tipos_produtos_empresa' => $produtos_empresa]);
    }    
    
    public function saveTypeProduct(Request $request) {
      //  Log::info($request);
        if (is_null($request['id_tipo_produto'])) {
            $tipo_produto = new TiposProdutos();
            $tipo_produto->nome_tipo_produto = $request['nome_tipo_produto'];
            $tipo_produto->descricao_tipo_produto = $request['descricao_tipo_produto'];
            $tipo_produto->status_tipo_produto = isset($request['status_tipo_produto']) ? $request['status_tipo_produto'] : "0";
            $tipo_produto->empresas_id_empresa = $request['id_empresa'];
            $tipo_produto->save();
            $id_tipo_produto = $tipo_produto->id;
        } else {
            DB::table('tipos_produtos')
                    ->where('id_tipo_produto', $request['id_tipo_produto'])
                    ->update(['nome_tipo_produto' => $request['nome_tipo_produto'],
                        'descricao_tipo_produto' => $request['descricao_tipo_produto'],
                        'status_tipo_produto' => isset($request['status_tipo_produto']) ? $request['status_tipo_produto'] : "0",
                        'empresas_id_empresa' => $request['id_empresa']]);
            $id_tipo_produto = $request['id_tipo_produto'];
        }
        
        if (!is_null($request['product_type_image'])){
            $destinationPath = public_path('/img/typeproducts');
            if (!is_null($request['tipo_produto_img'])) {  
                File::delete($destinationPath.'/'.$request['tipo_produto_img']);
            }   
            $this->validate($request, [
                'product_type_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('product_type_image');
            $input['imagename'] = $request['id_empresa'].'_'.$id_tipo_produto.'_'.time().'.'.$image->getClientOriginalExtension();
                DB::table('tipos_produtos')
                    ->where('id_tipo_produto', $id_tipo_produto)
                    ->update(['tipo_produto_img' => $input['imagename']]);
            $image->move($destinationPath, $input['imagename']);
            //$this->postImage->add($input);
        } 
        return back()->with('success','Successful');  
    }
    
    
    public function setNewProduct(){
        $request = Input::get('value');
        //Log::info($request);        
       $tipos_produtos_empresa = TiposProdutos::where('tipos_produtos.empresas_id_empresa', '=',$request)
                ->where('tipos_produtos.status_tipo_produto','=', 1)
                ->get();
        $html = view('layouts.newProduct',compact('tipos_produtos_empresa'))->render();
       return response()->json(compact('html'));         
    }
    
    public function setNewFlavor(){
        $request = Input::get('value');
        //Log::info($request);        
       $tipos_produtos_empresa = TiposProdutos::where('tipos_produtos.empresas_id_empresa', '=',$request)
                ->where('tipos_produtos.status_tipo_produto','=', 1)
                ->get();
        $html = view('layouts.newFlavor',compact('tipos_produtos_empresa'))->render();
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
     * @param  \HungerManagement\TiposProdutos  $tiposProdutos
     * @return \Illuminate\Http\Response
     */
    public function show(TiposProdutos $tiposProdutos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HungerManagement\TiposProdutos  $tiposProdutos
     * @return \Illuminate\Http\Response
     */
    public function edit(TiposProdutos $tiposProdutos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HungerManagement\TiposProdutos  $tiposProdutos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TiposProdutos $tiposProdutos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HungerManagement\TiposProdutos  $tiposProdutos
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiposProdutos $tiposProdutos)
    {
        //
    }
}
