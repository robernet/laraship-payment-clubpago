<?php

namespace Corals\Modules\Payment\ClubPago\Providers;

use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;
use Corals\Modules\Payment\ClubPago\Policies\ClubPagoReferencePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ClubPagoAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ClubPagoReference::class => ClubPagoReferencePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
