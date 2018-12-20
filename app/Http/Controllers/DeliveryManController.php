<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\Entregadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Gate;

class DeliveryManController extends Controller
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
       return view('pages/registerdeliveryman'); 
    }
    public function getDeliveryman($id_entregador){
        $entregador = Entregadores::where('entregadores.id_entregador', '=', $id_entregador)
                ->first();
        return $entregador;
    }

    public function listDeliveryMan($id_empresa) {
        $entregadores = Entregadores::where('entregadores.empresas_id_empresa', '=', $id_empresa)
                ->orderBy('entregadores.status_entregador', 'DESC')
                ->get();
        return view('layouts.requestqueuetable', ['entregadores' => $entregadores]);
    }

    public function listDeliveryManActive($id_empresa) {
        $entregadores = Entregadores::where('entregadores.empresas_id_empresa', '=', $id_empresa)
                ->where('entregadores.status_entregador','=', 1)
                ->get();
        return view('layouts.requestqueuetable', ['entregadores' => $entregadores]);
    }   
    
    public function saveDeliveryMan(Request $request) {
        if (is_null($request['status_entregador'])){
            $status_entregador = 0;
        } else {
            $status_entregador = 1;
        }
       // Log::info($status_tipo_produto);
        if (is_null($request['id_entregador'])) {
            $entregador = new Entregadores();
            $entregador->nome_entregador = $request['nome_entregador'];
            $entregador->placa_entregador = $request['placa_entregador'];
            $entregador->cpf_entregador = str_replace(['.', '-'], '', $request['cpf_entregador']);
            $entregador->status_entregador = $status_entregador;
            $entregador->empresas_id_empresa = $request['id_empresa'];
            $entregador->save();
        } else {
            DB::table('entregadores')
                    ->where('id_entregador', $request['id_entregador'])
                    ->update(['nome_entregador' => $request['nome_entregador'],
                        'placa_entregador' => $request['placa_entregador'],
                        'cpf_entregador' => str_replace(['.', '-'], '', $request['cpf_entregador']),
                        'status_entregador' => $status_entregador,
                        'empresas_id_empresa' => $request['id_empresa']]);
        }
        return redirect('/registerdeliveryman');    
    }
   
    public function getEditDeliveryMan() {
        $request = Input::get('value');
        $entregador = Entregadores::where('entregadores.id_entregador', '=', $request)
                ->get();
        $html = view('layouts.deliverymanregisterdata', compact('entregador'))->render();
        //  Log::info($html);
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
     * @param  \HungerManagement\Entregadores  $entregadores
     * @return \Illuminate\Http\Response
     */
    public function show(Entregadores $entregadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HungerManagement\Entregadores  $entregadores
     * @return \Illuminate\Http\Response
     */
    public function edit(Entregadores $entregadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HungerManagement\Entregadores  $entregadores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entregadores $entregadores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HungerManagement\Entregadores  $entregadores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entregadores $entregadores)
    {
        //
    }
}
