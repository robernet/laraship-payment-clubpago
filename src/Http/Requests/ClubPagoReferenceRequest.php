<?php

namespace Corals\Modules\Payment\ClubPago\Http\Requests;

use Corals\Foundation\Http\Requests\BaseRequest;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;

class ClubPagoReferenceRequest extends BaseRequest
{
    public function authorize(): bool
    {
        $this->setModel(ClubPagoReference::class);

        return $this->isAuthorized();
    }

    public function rules(): array
    {
        $this->setModel(ClubPagoReference::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, []);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, []);
        }

        if ($this->isUpdate()) {
            $rules = array_merge($rules, []);
        }

        return $rules;
    }
}
