<?php

namespace HungerManagement\Http\Controllers;

use HungerManagement\Validacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ValidationSystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }     
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('pages/validation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {      // Log::info($request);
            $validacao = new Validacao();
            $validacao->nome = $request['nome'];
            $validacao->idade = $request['idade'];
            $validacao->telefone = $request['telefone'];
            $validacao->areas = $request['areas'];
            $validacao->data = DB::raw('now()');
            $validacao->q1_1 = $request['1_1'];
            $validacao->q1_2 = $request['1_2'];
            $validacao->q1_3 = $request['1_3'];
            $validacao->q2_1 = $request['2_1'];
            $validacao->q2_2 = $request['2_2'];
            $validacao->q2_3 = $request['2_3'];
            $validacao->q3_1 = $request['3_1'];
            $validacao->q3_2 = $request['3_2'];
            $validacao->q3_3 = $request['3_3'];
            $validacao->q4_1 = $request['4_1'];
            $validacao->q4_2 = $request['4_2'];
            $validacao->q4_3 = $request['4_3'];
            $validacao->q5_1 = $request['5_1'];
            $validacao->q5_2 = $request['5_2'];
            $validacao->q5_3 = $request['5_3'];
            $validacao->q6_1 = $request['6_1'];
            $validacao->q6_2 = $request['6_2'];
            $validacao->q6_3 = $request['6_3'];
            $validacao->q7_1 = $request['7_1'];
            $validacao->q7_2 = $request['7_2'];
            $validacao->q7_3 = $request['7_3'];
            $validacao->q8_1 = $request['8_1'];
            $validacao->q8_2 = $request['8_2'];
            $validacao->q8_3 = $request['8_3'];
            $validacao->save();
        return redirect()->route('home')->with('success', 'Validação salva com sucesso');
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
