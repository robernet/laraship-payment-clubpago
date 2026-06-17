<?php

namespace Corals\Modules\Payment\ClubPago\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Payment\ClubPago\Models\ClubPagoReference;
use Corals\Modules\Payment\ClubPago\Transformers\ClubPagoReferenceTransformer;
use Yajra\DataTables\EloquentDataTable;

class ClubPagoReferencesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('clubpago.models.clubpago_reference.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ClubPagoReferenceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param ClubPagoReference $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(ClubPagoReference $model)
    {
        if (user()->hasRole('member')) {
            return $model->newQuery()->where('user_id', user()->id);
        }

        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'order_number' => ['title' => trans('ClubPago::labels.clubpago_reference.order_number')],
            'amount' => ['title' => trans('ClubPago::labels.clubpago_reference.amount')],
            'reference' => ['title' => trans('ClubPago::labels.clubpago_reference.reference')],
            'folio' => ['title' => trans('ClubPago::labels.clubpago_reference.folio')],
            'pay_format' => ['title' => trans('ClubPago::labels.clubpago_reference.pay_format')],
            'status' => ['title' => trans('Corals::attributes.status')],
            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => false];
    }

}
