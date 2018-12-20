<?php

namespace HungerManagement\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class ParameterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    
    
    public function index(){
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can do this actions");
        }          
        return view('pages/parameters');
    }
}
