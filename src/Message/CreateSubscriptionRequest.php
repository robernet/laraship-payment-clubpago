<?php

namespace Corals\Modules\Payment\ClubPago\Message;

use Carbon\Carbon;

/**
 * Authorize Request
 *
 * @method SubscriptionResponse send()
 */
class CreateSubscriptionRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getSubscriptionData();
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return SubscriptionResponse
     */
    public function sendData($data)
    {


        $response['subscription_reference'] = $data['subscription_reference'];

        return new SubscriptionResponse($this, $response);
    }
}
