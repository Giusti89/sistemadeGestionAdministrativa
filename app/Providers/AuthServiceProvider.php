<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\ordenpago;
use App\Models\pago;
use App\Policies\OrdenpagoPolicy;
use App\Policies\PagoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        pago::class => PagoPolicy::class,
        ordenpago::class => OrdenpagoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
    }
}
