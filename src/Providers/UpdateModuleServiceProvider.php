<?php

namespace Corals\Modules\Payment\ClubPago\Providers;

use Corals\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'corals-payment-clubpago';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
