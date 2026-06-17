<?php

namespace Corals\Modules\Payment\ClubPago;

use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;
use Corals\Modules\Payment\ClubPago\Notifications\ClubPagoReferenceNotification;
use Corals\Modules\Payment\ClubPago\Providers\ClubPagoRouteServiceProvider;
use Corals\User\Communication\Facades\CoralsNotification;

use Corals\Settings\Facades\Settings;
use Illuminate\Support\ServiceProvider;

class ClubPagoServiceProvider extends ServiceProvider
{
    public function bootPackage()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ClubPago');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'ClubPago');

        // Load migrations
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerCustomFieldsModels();
        $this->addEvents();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function registerPackage()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/clubpago.php', 'clubpago');

        $this->app->register(ClubPagoRouteServiceProvider::class);
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(ClubPagoReference::class);
    }

    public function addEvents()
    {
        CoralsNotification::addEvent('notifications.clubpago.send_reference', 'Reference', ClubPagoReferenceNotification::class);
    }
}
