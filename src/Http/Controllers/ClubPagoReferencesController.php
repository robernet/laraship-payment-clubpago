<?php

namespace Corals\Modules\Payment\ClubPago\Http\Controllers;

use Corals\Foundation\Http\Controllers\BaseController;
use Corals\Modules\Payment\ClubPago\DataTables\ClubPagoReferencesDataTable;
use Corals\Modules\Payment\ClubPago\Http\Requests\ClubPagoReferenceRequest;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;
use Corals\Modules\Payment\ClubPago\Services\ClubPagoReferenceService;

class ClubPagoReferencesController extends BaseController
{
    protected $clubpagoReferenceService;

    public function __construct(ClubPagoReferenceService $clubpagoReferenceService)
    {
        $this->clubpagoReferenceService = $clubpagoReferenceService;

        $this->resource_url = config('clubpago.models.clubpago_reference.resource_url');

        $this->title = trans('ClubPago::module.clubpago_reference.title');
        $this->title_singular = trans('ClubPago::module.clubpago_reference.title_singular');

        parent::__construct();
    }

    /**
     * @param ClubPagoReferenceRequest $request
     * @param ClubPagoReferencesDataTable $dataTable
     * @return mixed
     */
    public function index(ClubPagoReferenceRequest $request, ClubPagoReferencesDataTable $dataTable)
    {
//        if (user()->hasRole('member')) {
            $this->setViewSharedData([
                'hideCreate' => true
            ]);
//        }

        return $dataTable->render('ClubPago::clubpago-references.index');
    }

}
