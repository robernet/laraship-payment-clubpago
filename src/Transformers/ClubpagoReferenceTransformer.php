<?php

namespace Corals\Modules\Payment\ClubPago\Transformers;

use Corals\Foundation\Transformers\BaseTransformer;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;

class ClubPagoReferenceTransformer extends BaseTransformer
{
    public function __construct($extras = [])
    {
        $this->resource_url = config('clubpago.models.clubpago_reference.resource_url');

        parent::__construct($extras);
    }

    /**
     * @param ClubPagoReference $clubpago_reference
     * @return array
     * @throws \Throwable
     */
    public function transform(ClubPagoReference $clubpago_reference)
    {
        $show_url = $clubpago_reference->getShowURL();

        $transformedArray = [
            'id' => $clubpago_reference->id,
            'order_number' => $clubpago_reference->order_number,
            'amount' => \Currency::format($clubpago_reference->amount),
            'reference' => $clubpago_reference->reference,
            'folio' => $clubpago_reference->folio,
            'pay_format' => '<a target="_blank" href="' . $clubpago_reference->pay_format . '">'.trans('ClubPago::labels.clubpago_reference.pay_format').'</a>',
            'status' => formatStatusAsLabels($clubpago_reference->status),
            'created_at' => format_date($clubpago_reference->created_at),
            'updated_at' => format_date($clubpago_reference->updated_at)
        ];

        return parent::transformResponse($transformedArray);
    }
}
