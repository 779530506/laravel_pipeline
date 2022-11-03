<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Departement;
use App\Models\Hopital;
use App\Models\Pipeline;
use App\Models\User;
use App\Policies\DepartementPolicie;
use App\Policies\HopitalPolicie;
use App\Policies\PermissionPolicie;
use App\Policies\PipelinePolicie;
use App\Policies\RolePolicie;
use App\Policies\UserPolicie;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicie::class,
        Pipeline::class => PipelinePolicie::class,
        Hopital::class => HopitalPolicie::class,
        Departement::class => DepartementPolicie::class,
        Role::class => RolePolicie::class,
        Permission::class => PermissionPolicie::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
