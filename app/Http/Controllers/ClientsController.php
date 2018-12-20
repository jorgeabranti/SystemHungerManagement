<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Gate;

class ClientsController extends Controller {

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
        return view('pages/registerclient');
    }

    public function getClientesEmpresa($id_empresa) {
        $clientes_empresa = Clientes::where('clientes.empresas_id_empresa', '=', $id_empresa)
                ->get();
        return view('layouts.requestregisterform', ['clientes_empresa' => $clientes_empresa]);
    }

    public function saveClient(Request $request) {
        if (is_null($request['telefone_residencial_cliente'])) {
            $tel_residencial = null;
        } else {
            $tel_residencial = str_replace(['(', ')', '-', ' '], '', $request['telefone_residencial_cliente']);
        }
        if (is_null($request['id_cliente'])) {
            $cliente = new Clientes();
            $cliente->empresas_id_empresa = $request['id_empresa'];
            $cliente->nome_cliente = $request['nome_cliente'];
            $cliente->cpf_cliente = str_replace(['.', '-'], '', $request['cpf_cliente']);
            $cliente->email_cliente = $request['email_cliente'];
            $cliente->endereco_cliente = $request['endereco_cliente'];
            $cliente->endereco_numero_cliente = $request['endereco_numero_cliente'];
            $cliente->bairro_cliente = $request['bairro_cliente'];
            $cliente->cidade_cliente = $request['cidade_cliente'];
            $cliente->cep_cliente = str_replace('-','',$request['cep_cliente']);
            $cliente->uf_cliente = $request['uf_cliente'];
            $cliente->telefone_celular_cliente = str_replace(['(', ')', '-', ' '], '', $request['telefone_celular_cliente']);
            $cliente->telefone_residencial_cliente = $tel_residencial;
            $cliente->save();
        } else {
            DB::table('clientes')
                    ->where('id_cliente', $request['id_cliente'])
                    ->update(['empresas_id_empresa' => $request['id_empresa'],
                        'nome_cliente' => $request['nome_cliente'],
                        'cpf_cliente' => str_replace(['.', '-'], '', $request['cpf_cliente']),
                        'email_cliente' => $request['email_cliente'],
                        'endereco_cliente' => $request['endereco_cliente'],
                        'endereco_numero_cliente' => $request['endereco_numero_cliente'],
                        'bairro_cliente' => $request['bairro_cliente'],
                        'cidade_cliente' => $request['cidade_cliente'],
                        'cep_cliente' => str_replace('-','',$request['cep_cliente']),
                        'uf_cliente' => $request['uf_cliente'],
                        'distancia_endereco_km' => null,
                        'telefone_celular_cliente' => str_replace(['(', ')', '-', ' '], '', $request['telefone_celular_cliente']),
                        'telefone_residencial_cliente' => $tel_residencial]);
        }
        return redirect('/registerclient');
    }

    public function getCliente() {
        $request = Input::get('value');
        $cliente = Clientes::where('clientes.id_cliente', '=', $request)
                ->get();
        $html = view('layouts.clientregisterdata', compact('cliente'))->render();
        //  Log::info($html);
        return response()->json(compact('html'));
    }

    public function getDataClient() {
        $value = Input::get('value');
        $empresa = Input::get('empresa');
        $cliente = Clientes::where('clientes.cpf_cliente', '=', $value)
                ->where('clientes.empresas_id_empresa','=',$empresa['id_empresa'])
                ->get();
        $html = view('layouts.dataclient', compact('cliente'))->render();
        $client = view('layouts.valuedelivery', compact('cliente','empresa'))->render();
        $tablerequest = view('layouts.renderdatarequest', compact(''))->render();
     //   Log::info($value);
        return response()->json(compact('html','client','tablerequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \HungerManagement\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HungerManagement\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id_cliente) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HungerManagement\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HungerManagement\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes) {
        //
    }

    public function searchByCep($cep) {            
        $response = file_get_contents('https://viacep.com.br/ws/'.$cep.'/json/');     
        $json_response = json_decode($response, true);
        //Log::info($json_response);
      //  return $json_response;
    }    
}
