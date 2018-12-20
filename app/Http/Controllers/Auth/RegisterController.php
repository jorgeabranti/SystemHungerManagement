<?php

namespace HungerManagement\Http\Controllers\Auth;

use HungerManagement\Usuarios;
use HungerManagement\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registeruser';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('guest');
        $this->middleware('auth');
    }

    public function index() {
        if (!Gate::allows('isAdmin')) {
            abort(404, "Sorry, You can do this actions");
        }
        return view('pages/registeruser');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'nome_usuario' => 'required|string|max:255',
                    'login_usuario' => 'required|string|max:20|unique:usuarios',
                    //  'email' => 'required|string|email|max:255|unique:users',
                    'senha_usuario' => 'required|string|min:6|confirmed',
                    'cpf' => 'required|string|max:11',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \HungerManagement\User
     */
    protected function create(array $data) {
        if (is_null($data['id_usuario'])) {
            return Usuarios::create([
                        'nome_usuario' => $data['nome_usuario'],
                        'login_usuario' => $data['login_usuario'],
                        //   'email' => $data['email'],
                        'senha_usuario' => Hash::make($data['senha_usuario']),
                        'empresas_id_empresa' => $data['id_empresa'],
                        'tipo_usuario' => $data['tipo_usuario'],
                        'cpf_usuario' => $data['cpf'],
                        'status_usuario' => isset($data['status_usuario']) ? $data['status_usuario'] : "0",
            ]);
        } else if (!is_null($data['id_usuario']) && $data['senha_usuario'] != "******") {
            DB::table('usuarios')
                    ->where('id_usuario', $data['id_usuario'])
                    ->update(['nome_usuario' => $data['nome_usuario'],
                        'senha_usuario' => Hash::make($data['senha_usuario']),
                        'tipo_usuario' => $data['tipo_usuario'],
                        'cpf_usuario' => $data['cpf'],
                        'status_usuario' => isset($data['status_usuario']) ? $data['status_usuario'] : "0"]);
        } else if (!is_null($data['id_usuario']) && $data['senha_usuario'] == "******") {
            DB::table('usuarios')
                    ->where('id_usuario', $data['id_usuario'])
                    ->update(['nome_usuario' => $data['nome_usuario'],
                        'tipo_usuario' => $data['tipo_usuario'],
                        'cpf_usuario' => $data['cpf'],
                        'status_usuario' => isset($data['status_usuario']) ? $data['status_usuario'] : "0"]);
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        if (is_null($request['id_usuario'])) {
            $this->validator($request->all())->validate();
        }
        event(new Registered($user = $this->create($request->all())));
        // $this->guard()->login($user);
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function getUser() {
        $request = Input::get('value');
        $user = Usuarios::where('id_usuario', '=', $request)
                ->first();
        $html = view('auth.passwords.usereditdata', compact('user'))->render();
        return response()->json(compact('html'));
    }

}
