<?php

namespace Corals\Modules\Payment\ClubPago\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Corals\Modules\Marketplace\Models\Store;
use Corals\User\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class ClubPagoReference extends BaseModel
{
    use PresentableTrait, LogsActivity;

    protected $table = 'marketplace_clubpago_references';

    public $config = 'clubpago.models.clubpago_reference';

    protected static $logAttributes = ['status', 'amount'];

    protected $guarded = ['id'];

    protected $casts = [
    ];

    public function scopeMyReferences($query)
    {
        return $query->where('user_id', user()->id);
    }

    public function scopeMyStoreReferences($query)
    {
        $store = \Store::getStore();
        return $query->where('store_id', $store->id);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function getClubPagoReference($target = "dashboard")
    {
        $order_number = $this->order_number;
        if ($target == "pdf") {
            return $order_number;
        } else {
            return "<a href='" . url('marketplace/clubpago-reference/' . $this->hashed_id) . "'>  $order_number </a>";

        }
    }


}
