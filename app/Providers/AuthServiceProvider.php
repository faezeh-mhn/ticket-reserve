<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

//use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', function ($user) {
            return $user->user_type == 'admin';
        });

         $gate->define('isSuperUser', function ($user) {
            return $user->user_type == 'superUser';
        });


         $gate->define('isNormalUser', function ($user) {
            return $user->user_type == 'normalUser';
        });


         $gate->define('isCompany', function ($user) {
            return $user->user_type == 'company';
        });



        Passport::routes();
    }
}
