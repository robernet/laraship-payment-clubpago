<?php

namespace Corals\Modules\Payment\ClubPago\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;
use Corals\User\Models\User;

class ClubPagoReferencePolicy extends BasePolicy
{
    protected $administrationPermission = 'Administrations::admin.clubpago';
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ClubPago::clubpago_reference.view')) {
            return true;
        }
        return false;
    }


}
