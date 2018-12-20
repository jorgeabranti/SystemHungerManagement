<?php

namespace HungerManagement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable {

    use Notifiable;

    protected $primaryKey = 'id_usuario';
    protected $table = 'usuarios';

    //public $timestamps = false;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_usuario', 'login_usuario', /* 'email', */ 'senha_usuario', 'empresas_id_empresa', 'cpf_usuario', 'tipo_usuario', 'status_usuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha_usuario', 'token',
    ];

    public function getAuthPassword() {
        return $this->attributes['senha_usuario'];
    }

    public function findForPassport($identifier) {
        return Usuarios::orWhere('login_usuario', $identifier)->where('status_usuario', 1)->first();
    }

}
