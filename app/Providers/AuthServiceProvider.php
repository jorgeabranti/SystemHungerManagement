<?php

namespace HungerManagement\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'HungerManagement\Model' => 'HungerManagement\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', function($user){
            return $user->tipo_usuario == '1';
        });
    
        $gate->define('isAttendent', function($user){
            return $user->tipo_usuario == '2';
        });
        
        $gate->define('isViewer', function($user){
            return $user->tipo_usuario == '3';
        });
    }
}
