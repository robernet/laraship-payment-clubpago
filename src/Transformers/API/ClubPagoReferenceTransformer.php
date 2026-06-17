<?php

namespace Corals\Modules\Payment\ClubPago\Transformers\API;

use Corals\Foundation\Transformers\APIBaseTransformer;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;

class ClubPagoReferenceTransformer extends APIBaseTransformer
{
    /**
     * @param ClubPagoReference $clubpago_reference
     * @return array
     * @throws \Throwable
     */
    public function transform(ClubPagoReference $clubpago_reference)
    {
        $transformedArray = [
            'id' => $clubpago_reference->id,
            'order_number' => $clubpago_reference->order_number,
            'amount' => $clubpago_reference->amount,
            'reference' => $clubpago_reference->reference,
            'pay_format' => $clubpago_reference->pay_format,
            'created_at' => format_date($clubpago_reference->created_at),
            'updated_at' => format_date($clubpago_reference->updated_at),
        ];

        return parent::transformResponse($transformedArray);
    }
}
