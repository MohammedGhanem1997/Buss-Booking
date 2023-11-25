<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        try {
            $user=  auth()->guard("api")->check()&& auth()->guard("api")->user() && auth()->guard("api")->user()->type=='isAdmin'?auth()->guard("api")->user()->load('roles.permissions'):(auth()->user() != null?auth()->user()->load('roles.permissions') :null );
           if ($user !=null){
            foreach($user->roles[0]->permissions as $permission) {
                Gate::define($permission->title, function ($user) {

                    return true;
                });
            }
           }
        }catch ( \Exception $exception){

            Gate::define('isCustomer', function ($user) {
                return true;
            });
        }



    }

}
