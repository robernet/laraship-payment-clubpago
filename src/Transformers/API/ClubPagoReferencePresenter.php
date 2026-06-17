<?php

namespace Corals\Modules\Payment\ClubPago\Transformers\API;

use Corals\Foundation\Transformers\FractalPresenter;

class ClubPagoReferencePresenter extends FractalPresenter
{

    /**
     * @return ClubPagoReferenceTransformer
     */
    public function getTransformer()
    {
        return new ClubPagoReferenceTransformer();
    }
}
