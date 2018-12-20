<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\Empresas;
use HungerManagement\Usuarios;
use HungerManagement\FormasPagamentoEmpresa;
use HungerManagement\FormasPagamento;
use HungerManagement\HorariosAtendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class CompanyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresas_id_empresa) {
        $empresa = Empresas::where('empresas.id_empresa', '=', $empresas_id_empresa)
                ->get();
        return view('includes.app', ['empresa' => $empresa]);
    }

    public function getCompany($empresas_id_empresa) {
        $empresa = Empresas::where('empresas.id_empresa', '=', $empresas_id_empresa)
                ->first();
        return $empresa;
    }

    public function listHoursCompany($empresas_id_empresa) {
        $horarios_atendimento = HorariosAtendimento::where('empresas_id_empresa', '=', $empresas_id_empresa)
                ->first();
        // Log::info($horarios_atendimento);  
        return $horarios_atendimento;
    }

    public function listUsersCompany($user) {
        $usuarios = Usuarios::where('empresas_id_empresa', '=', $user->empresas_id_empresa)
                ->where('tipo_usuario','>',1)
                ->orWhere('id_usuario','=',$user->id_usuario)
                ->get(); 
        return $usuarios;
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

    public function listPaymentCompanyActive($empresas_id_empresa) {
        $listpayment = FormasPagamentoEmpresa::where('empresas_id_empresa', '=', $empresas_id_empresa)
                ->join('formas_pagamento', 'formas_pagamento.id_forma_pagamento', '=', 'formas_pagamento_empresa.formas_pagamento_id_forma_pagamento')
                ->where('status_forma_pagamento_empresa', '=', 1)
                ->get();
        return view('includes.app', ['listaformaspagamento' => $listpayment]);
    }

    public function listPaymentCompany($empresas_id_empresa) {
        $listpayment = FormasPagamentoEmpresa::where('empresas_id_empresa', '=', $empresas_id_empresa)
                ->join('formas_pagamento', 'formas_pagamento.id_forma_pagamento', '=', 'formas_pagamento_empresa.formas_pagamento_id_forma_pagamento')
                ->get();
        return view('includes.app', ['listaformaspagamento' => $listpayment]);
    }

    public function listPaymentCompanyNotRegistered($empresas_id_empresa) {
        $listpaymentactived = FormasPagamentoEmpresa::select(DB::raw('formas_pagamento_id_forma_pagamento'))
                ->where('empresas_id_empresa', '=', $empresas_id_empresa)
                ->get();
        $listpayment = FormasPagamento::whereNotIn('id_forma_pagamento', $listpaymentactived->pluck('formas_pagamento_id_forma_pagamento'))
                ->get();
        return view('includes.app', ['listaformaspagamento' => $listpayment]);
    }

    public function saveFormPayment(Request $request) {
        foreach ($request['id_forma_pagamento'] as $key => $id_forma_pagamento) {
            $status_forma_pagamento = isset($request['status_forma_pagamento_empresa'][$key]) ? $request['status_forma_pagamento_empresa'][$key] : "0";
            // Log::info($status_forma_pagamento); 
            if ($request['cadastrado'][$key] == -1) {
                $foma_pagamento_empresa = new FormasPagamentoEmpresa();
                $foma_pagamento_empresa->empresas_id_empresa = $request['id_empresa'];
                $foma_pagamento_empresa->status_forma_pagamento_empresa = $status_forma_pagamento;
                $foma_pagamento_empresa->formas_pagamento_id_forma_pagamento = $id_forma_pagamento;
                $foma_pagamento_empresa->save();
            } else {
                DB::table('formas_pagamento_empresa')
                        ->where('id_forma_pagamento_empresa', $request['cadastrado'][$key])
                        ->update(['status_forma_pagamento_empresa' => $status_forma_pagamento]);
            }
        }
        return redirect('/systemparameters');
    }

    public function saveHourCompany(Request $request) {
        $horarios_atendimento = HorariosAtendimento::where('empresas_id_empresa', '=', $request['id_empresa'])
                ->first();
        if (is_null($horarios_atendimento)) {
            $horarios_atendimento = new HorariosAtendimento();
            $horarios_atendimento->empresas_id_empresa = $request['id_empresa'];
            $horarios_atendimento->atendimento_segunda = isset($request['status_dia'][1]) ? $request['status_dia'][1] : "0";
            $horarios_atendimento->atendimento_terca = isset($request['status_dia'][2]) ? $request['status_dia'][2] : "0";
            $horarios_atendimento->atendimento_quarta = isset($request['status_dia'][3]) ? $request['status_dia'][3] : "0";
            $horarios_atendimento->atendimento_quinta = isset($request['status_dia'][4]) ? $request['status_dia'][4] : "0";
            $horarios_atendimento->atendimento_sexta = isset($request['status_dia'][5]) ? $request['status_dia'][5] : "0";
            $horarios_atendimento->atendimento_sabado = isset($request['status_dia'][6]) ? $request['status_dia'][6] : "0";
            $horarios_atendimento->atendimento_domingo = isset($request['status_dia'][0]) ? $request['status_dia'][0] : "0";
            $horarios_atendimento->horario_inicio_segunda = $request['horario_inicio'][1];
            $horarios_atendimento->horario_fim_segunda = $request['horario_fim'][1];
            $horarios_atendimento->horario_inicio_terca = $request['horario_inicio'][2];
            $horarios_atendimento->horario_fim_terca = $request['horario_fim'][2];
            $horarios_atendimento->horario_inicio_quarta = $request['horario_inicio'][3];
            $horarios_atendimento->horario_fim_quarta = $request['horario_fim'][3];
            $horarios_atendimento->horario_inicio_quinta = $request['horario_inicio'][4];
            $horarios_atendimento->horario_fim_quinta = $request['horario_fim'][4];
            $horarios_atendimento->horario_inicio_sexta = $request['horario_inicio'][5];
            $horarios_atendimento->horario_fim_sexta = $request['horario_fim'][5];
            $horarios_atendimento->horario_inicio_sabado = $request['horario_inicio'][6];
            $horarios_atendimento->horario_fim_sabado = $request['horario_fim'][6];
            $horarios_atendimento->horario_inicio_domingo = $request['horario_inicio'][0];
            $horarios_atendimento->horario_fim_domingo = $request['horario_fim'][0];
            $horarios_atendimento->save();
        } else {
            DB::table('horarios_atendimento')
                    ->where('id_horario_atendimento', $horarios_atendimento->id_horario_atendimento)
                    ->update(['atendimento_segunda' => isset($request['status_dia'][1]) ? $request['status_dia'][1] : "0",
                        'atendimento_terca' => isset($request['status_dia'][2]) ? $request['status_dia'][2] : "0",
                        'atendimento_quarta' => isset($request['status_dia'][3]) ? $request['status_dia'][3] : "0",
                        'atendimento_quinta' => isset($request['status_dia'][4]) ? $request['status_dia'][4] : "0",
                        'atendimento_sexta' => isset($request['status_dia'][5]) ? $request['status_dia'][5] : "0",
                        'atendimento_sabado' => isset($request['status_dia'][6]) ? $request['status_dia'][6] : "0",
                        'atendimento_domingo' => isset($request['status_dia'][0]) ? $request['status_dia'][0] : "0",
                        'horario_inicio_segunda' => $request['horario_inicio'][1],
                        'horario_fim_segunda' => $request['horario_fim'][1],
                        'horario_inicio_terca' => $request['horario_inicio'][2],
                        'horario_fim_terca' => $request['horario_fim'][2],
                        'horario_inicio_quarta' => $request['horario_inicio'][3],
                        'horario_fim_quarta' => $request['horario_fim'][3],
                        'horario_inicio_quinta' => $request['horario_inicio'][4],
                        'horario_fim_quinta' => $request['horario_fim'][4],
                        'horario_inicio_sexta' => $request['horario_inicio'][5],
                        'horario_fim_sexta' => $request['horario_fim'][5],
                        'horario_inicio_sabado' => $request['horario_inicio'][6],
                        'horario_fim_sabado' => $request['horario_fim'][6],
                        'horario_inicio_domingo' => $request['horario_inicio'][0],
                        'horario_fim_domingo' => $request['horario_fim'][0]]);
        }
        return redirect('/systemparameters');
    }

    public function updateValueKm(Request $request) {
        $valor_km = str_replace('$', '', $request['valor_km']);
        $valor_km = str_replace('.', '', $valor_km);
        $valor_km = str_replace(',', '.', $valor_km);

        $valor_taxa_fixa = str_replace('$', '', $request['taxa_fixa_entrega']);
        $valor_taxa_fixa = str_replace('.', '', $valor_taxa_fixa);
        $valor_taxa_fixa = str_replace(',', '.', $valor_taxa_fixa);
        // Log::info($valor_km); 
        DB::table('empresas')
                ->where('id_empresa', $request['id_empresa'])
                ->update(['taxa_km_entrega' => $valor_km,
                    'taxa_fixa_entrega' => $valor_taxa_fixa,
                    'utilizar_taxa_fixa' => isset($request['utilizar_taxa_fixa'][0]) ? $request['utilizar_taxa_fixa'][0] : "0"]);
        return redirect('/systemparameters');
    }

    public function calculateValueDelivery($origins, $destinations, $valueDelivery, $id_cliente, $distancia_endereco_km) {
        if (is_null($distancia_endereco_km)) {
            $mode = 'driving';
            $key = 'AIzaSyBXK7_BG1JOfm22HyhZPm807Bk2fOwxxeQ';
            $response = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.str_replace(' ', '+', $origins).'&destinations='.str_replace(' ', '+', $destinations).'&mode='.$mode.'&key='.$key);
            $json_response = json_decode($response, true);
            if ($json_response['error_message'][0])
            {
                $distancia_endereco_km = 0.0; 
            }else {
                $distancia_endereco_km = (double) str_replace('km', '', $json_response['rows'][0]['elements'][0]['distance']['text']);
                // Log::info($response);
            }
            $taxa_entrega = $valueDelivery * $distancia_endereco_km;
            DB::table('clientes')
                    ->where('id_cliente', $id_cliente)
                    ->update(['distancia_endereco_km' => $distancia_endereco_km]);
        } else {
            $taxa_entrega = $valueDelivery * (double) $distancia_endereco_km;
        }
        return $taxa_entrega;
    }

    public function alertPostDelivery(Request $request) {
            //Log::info($request->input('id_pedido'));
            $ch = curl_init('http://wshungermanagement.herokuapp.com/api-hm');
            $jsonData = array( 'object' => 'page',
                                'entry' => array(['user' => 'hunger-management-system',
                                            'verify_token' => '4SWZVxQg8QHXIkhkAjKU4IL6bCtqzmta',
                                            'id_pedido' =>  (int) $request->input('id_pedido')]));
           // $jsonEncoded = json_encode($jsonData);
           // Log::info($jsonData);
          //  Log::info($jsonEncoded);
            //Tell cURL that we want to send a POST request.
            curl_setopt($ch, CURLOPT_POST, 1);
            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonData));
            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
            //Execute the request
          //  $result = curl_exec($ch);
           // Log::info($result);
        return back()->with('success','Image Upload successful');
    }    
    
    public function uploadLogo(Request $request) {
        if (!is_null($request->file('logo'))){
            $destinationPath = public_path('/img/logo');
            if (!is_null($request['logo_img'])) {  
                File::delete($destinationPath.'/'.$request['logo_img']);
            }   
            $this->validate($request, [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('logo');
            $input['imagename'] = $request['id_empresa'].'_'.time().'.'.$image->getClientOriginalExtension();
                DB::table('empresas')
                    ->where('id_empresa', $request['id_empresa'])
                    ->update(['logo_img' => $input['imagename']]);
            $image->move($destinationPath, $input['imagename']);
            //$this->postImage->add($input);
        }
        return back()->with('success','Image Upload successful');
    }

}
